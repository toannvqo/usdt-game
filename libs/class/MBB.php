<?php

require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . "/../db.php");
require_once(__DIR__ . "/../helper.php");

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class MBB
{
    protected $account;
    protected $_timeout = 15;
    protected $captchaCode = "";
    protected $captchaImage = "";
    protected $session_id = "";
    protected $cust = "";
    protected $myname = "";
    protected $client;
    protected $BALANCE;
    protected $url = [
        "getCaptcha" => "https://online.mbbank.com.vn/api/retail-web-internetbankingms/getCaptchaImage",
        "doLogin" => "https://online.mbbank.com.vn/api/retail_web/internetbanking/doLogin",
        "doLogin2" => "https://online.mbbank.com.vn/api/retail_web/internetbanking/v2.0/doLogin",
        "getHistories" => "https://online.mbbank.com.vn/api/retail-transactionms/transactionms/get-account-transaction-history",
        "getBalance" => "https://online.mbbank.com.vn/api/retail-web-accountms/getBalance",
        "getNameBank" => "https://online.mbbank.com.vn/api/retail_web/transfer/inquiryAccountName",
        "getBankList" => "https://online.mbbank.com.vn/api/retail_web/common/getBankList",
        "getDomesticInfo" => "https://online.mbbank.com.vn/api/retail_web/transfer/getDomesticInfo",
        "verifyMakeTransfer" => "https://online.mbbank.com.vn/api/retail_web/transfer/verifyMakeTransfer",
        "getAuthList" => "https://online.mbbank.com.vn/api/retail_web/internetbanking/getAuthList",
        "qrcode" => "https://generator.qrcode-gen.com/api/qrcode-url",
        "createTransactionAuthen" => "https://online.mbbank.com.vn/api/retail_web/vtap/createTransactionAuthen",
        "makeTransfer" => "https://online.mbbank.com.vn/api/retail_web/transfer/makeTransfer"
    ];
    public function __construct($username,$password,$account_number)
    {
        $this->tkuma = new DB();
        $this->client = new Client(['http_errors' => false]);
        $row =  $this->tkuma->get_row("SELECT * FROM `account_mbbank` WHERE `phone` = ? AND `password` = ?  ",[$username,$password]);
        $this->password = $password;
        if (!$this->tkuma->get_row("SELECT * FROM `account_mbbank` WHERE `phone` = ? ",[$username])) {
            $this->username = $username;
            $this->password = $password;
            $this->account_number = $account_number;
            $this->imei     = $this->generateImei();
            $this->tkuma->insert("account_mbbank", [
                'username'      => $this->username,
				'phone'         => $this->username,
				'stk'         => $this->account_number,
				'name'         => $this->myname,
				'password'      => $this->password,
				'sessionId'         => $this->session_id,
				'deviceId'       => $this->imei,
				'token'       => Str::random(32),
				'time'          => time(),
				'status'          => "LOGIN",
				'BALANCE'          => $this->BALANCE
            ]);
        } else {
            $this->config = $row;
            $this->parseData();
        }

    }

    public function saveData(){
        $this->tkuma->update( "account_mbbank", [
                'stk'         => $this->account_number,
                'name'         => $this->myname,
                'password'      => $this->password,
                'sessionId'         => $this->session_id,
                'deviceId'       => $this->imei,
                'time'          => time(),
                'BALANCE'          => $this->BALANCE
            ],
            " `phone` = ?  ",[$this->username]);
    }

    public function parseData(){
        $this->username = $this->config['username'];
        $this->password = $this->password;
        $this->account_number = isset($this->config['stk']) ? $this->config['stk'] : '';
        $this->session_id = isset($this->config['sessionId']) ? $this->config['sessionId'] : '';
        $this->imei = isset($this->config['deviceId']) ? $this->config['deviceId'] : '';
        $this->myname = isset($this->config['name']) ? $this->config['name'] : '';

    }

    private function getTaskResult($taskId)
    {
        $client = new Client();
        try {
            $res = $client->request('POST', 'https://win32.vn/api/v1/Taskcaptcha', [
                'json' => array(
                    'typecaptcha'    => 'mbbank',
                    'token'    => $this->tkuma->site("server_captcha"),
                    'base64'    => $taskId
                )
            ]);
            $result = json_decode($res->getBody());

            if (isset($result->success)) {
                $this->captchaCode = $result->captcha;
                return ["status" => true, "captcha" => $result->captcha];
            }
        } catch (\Throwable $th) {
        }
        return ["status" => false];
    }

    public function solveCaptcha()
    {
        $getCaptcha = $this->captchaImage;
        $result = $this->getTaskResult($getCaptcha);
        if ($result['status'] == true) {
            $this->captchaValue = $result['captcha'];
            return ["status" => true, "captcha" => $result['captcha']];
        } else {
            return ["status" => false, "msg" => "Error getTaskResult"];
        }
    }

    public function getCaptcha(){
        try {
            $res = $this->client->request('POST', $this->url['getCaptcha'], array(
                'json' => array(
                    'sessionId'    => "",
                    'refNo'     => date('YmdHms'),
                    'deviceIdCommon' => $this->imei
                ),
                'timeout' => $this->_timeout,
                'headers'     => $this->headerDefault(),
            ));
            $data = json_decode($res->getBody());
            $this->captchaImage = $data->imageString;
            $this->solveCaptcha();
            return $data;
        } catch (\Throwable $e) {
                echo 'hoho' . $e;
            dd($e);
        }

    }
    public function doLogin()
    {
        try {
            $this->getCaptcha();
            
            $rId = $this->getTimeNow();
            $requestData =  array(
                'userId' => $this->username,
                'password' => md5($this->password),
                'captcha' => $this->captchaCode,
                'ibAuthen2faString' => '',
                'sessionId' => null,
                'refNo' => $this->getTimeNow(),
                'deviceIdCommon' =>  $this->imei,
            );
            $encrypt = $this->wasmEnc($requestData)['dataEnc'];
            
            $params = array(
                'dataEnc' => $encrypt
            );
            $res = $this->client->request('POST',$this->url['doLogin2'], array(
                'json' => $params, // This automatically encodes $params as JSON
                'timeout' => $this->_timeout,
                'headers' => $this->headerv3(),
            ));
            $data = json_decode($res->getBody());
            if(isset($data->result->responseCode) && $data->result->responseCode == '00'){
                $this->session_id = $data->sessionId;
                $this->myname = $data->cust->nm;
                $this->saveData();

            }
            return $data;
        } catch (\Throwable $e) {
            echo 'hehe' . $e;
            dd($e);
        }
    }
    public function wasmEnc($data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://103.211.207.135:1872/enc',//nhap url api
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }
    private function getTimeNow()
    {
        return round(microtime(true) * 1000);
    }

    public function getBalance()
    {
       
        try {
            $res = $this->client->request('POST', $this->url['getBalance'], array(
                'json' => array(
                    'sessionId'     => $this->session_id,
                    'refNo'         => $this->ref_no(),
                    'deviceIdCommon' => $this->imei,
                ),
                'timeout' => $this->_timeout,
                'headers'     => $this->headerDefault()
            ));
            return json_decode($res->getBody());
        } catch (\Throwable $e) {
        }
        return false;
    }

    public function getTransactionHistory($account_no)
    {
        try {
            $res = $this->client->request('POST',$this->url['getHistories'] , array(
                'json' => array(
                    'accountNo'     => $account_no,
                    'deviceIdCommon' => $this->imei,
                    'fromDate'      => date("d/m/Y"),
                    'refNo'         => $this->ref_no(),
                    'sessionId'     => $this->session_id,
                    'toDate'        => date("d/m/Y")
                ),
                'timeout' => $this->_timeout,
                'headers'     => $this->headerv2()
            ));
            return json_decode($res->getBody());
        } catch (\Throwable $e) {

        }
        return false;
    }
    public function getListBank(){
        try {
            $params = array(
                'sessionId'     => $this->session_id,
                'refNo'         => $this->ref_no(),
                'deviceIdCommon' => $this->imei
            );
            $res = $this->client->request('POST',$this->url['getBankList'], array(
                'json' => $params,
                'timeout' => $this->_timeout,
                'headers'     => $this->headerDefault()
            ));
            return json_decode($res->getBody());
        } catch (\Throwable $e) {

        }
        return false;
    }
    public function getNameBank($bankID,$account_number){

        try {
            $type = "FAST";
            if($bankID == "970422"){
                $type = "INHOUSE";
            }
            $params = array(
                "bankCode" => $bankID,
                "creditAccount" => $account_number,
                "creditAccountType" => "ACCOUNT",
                "debitAccount" => $this->account_number,
                "remark" => "",
                "type" => $type,
                'sessionId'     => $this->session_id,
                'refNo'         => $this->ref_no(),
                'deviceIdCommon' => $this->imei,
            );
            $res = $this->client->request('POST',$this->url['getNameBank'], array(
                'json' => $params,
                'timeout' => $this->_timeout,
                'headers'     => $this->headerDefault()
            ));
            return json_decode($res->getBody());
        } catch (\Throwable $e) {

        }
        return false;
    }

    public function getDomesticInfo($bankcd,$bankout,$amount)
    {
        try {
            $params = array(
                "accountNo" => $bankout,
                "accountType" => "ACCOUNT",
                "amount" => $amount,
                "benBankCd" => $bankcd,
                "deviceIdCommon" => $this->imei,
                "refNo" => $this->ref_nof(),
                'sessionId'     => $this->session_id,
                "sourceAccount"  => $this->account_number
            );
            $res = $this->client->request('POST',$this->url['getDomesticInfo'], array(
                'json' => $params,
                'timeout' => $this->_timeout,
                'headers'     => $this->headerDefault()
            ));
            return json_decode($res->getBody());
        } catch (\Throwable $e) {

        }
        return false;
    }

    public function verifyMakeTransfer($bankcode,$bankout,$amount,$nameout,$commet,$houst)
    {
        
        $act = 'FAST';
        if ($houst == 'IN'){
            $act = 'INHOUSE';
        }
        try {
            $params = array(
                "amount" => $amount,
                "benAccountName" => $nameout,
                "benAccountNumber" => $bankout,
                "benBankCd" => $bankcode,
                "destType" => "ACCOUNT",
                "deviceIdCommon" => $this->imei,
                "message"     => $commet,
                "refNo"     => $this->ref_nof(),
                "sessionId"     => $this->session_id,
                "srcAccountNumber"     => $this->account_number,
                "transferType"     => $act
            );
            $res = $this->client->request('POST',$this->url['verifyMakeTransfer'], array(
                'json' => $params,
                'timeout' => $this->_timeout,
                'headers'     => $this->headerDefault()
            ));
            return json_decode($res->getBody());
        } catch (\Throwable $e) {

        }
        return false;
    }
    public function getAuthList($amount,$houst)
    {
        $act = 'GCM_FTR_DOM_FAST';
        if ($houst == 'IN'){
            $act = 'GCM_FTR_IH_3RD';
        }
        try {
            $params = array(
                "amount" => $amount,
                "serviceCode" => $act,
                'sessionId'     => $this->session_id,
                'refNo'         => $this->ref_nof(),
                'deviceIdCommon' => $this->imei
            );
            $res = $this->client->request('POST', $this->url['getAuthList'], array(
                'json' => $params,
                'timeout' => $this->_timeout,
                'headers'     => $this->headerDefault()
            ));
            return json_decode($res->getBody());
        } catch (\Throwable $e) {

        }
        return false;
    }
    public function getQr($plainText)
    {
        try {
              $header = array(
                'Content-Type: application/json; charset=utf-8',
            );
            $adiuyf = "TRANID|".$plainText;
            $params = array(
                'contentType' => 'text',
                'plainText' => $adiuyf
            );
            $res = $this->client->request('POST', 'https://generator.qrcode-gen.com/api/qrcode-url', array(
                'json' => $params,
                'timeout' => $this->_timeout,
                'headers'     => $header
            ));
            return json_decode($res->getBody());
        } catch (\Throwable $e) {

        }
        return false;
    }
    public function createTransactionAuthen($bankcode,$bankout,$amount,$commet)
    {
        $act = 'OUT';
        $transactionType = 'GCM_FTR_DOM_FAST';
        if ($bankcode == '970422'){
            $act = 'IN';
            $transactionType = 'GCM_FTR_IH_3RD';
        }
        $get_namebank = $this->getNameBank($bankcode,$bankout);
        if($get_namebank->result->responseCode == '00'){
            $nameout = $get_namebank->benName;
        }
        
        if ($act == 'OUT'){
            $get_namebankdd = $this->getListBank();
            if($get_namebankdd->result->responseCode == '00'){
                foreach ($get_namebankdd->listBank as $ROWHIST) {
                    if ($ROWHIST->smlCode == $bankcode){
                        $bankcd = $ROWHIST->bankId;
                    }
                }
            }
            $getDomesticInfo = $this->getDomesticInfo($bankcd,$bankout,$amount);
            if($getDomesticInfo->result->responseCode != '00'){
                return array(
                    "status" => "error",
                    "message"=> $getDomesticInfo->result->message
                );
            }
        }
        
        
        $verifyMakeTransferd = $this->verifyMakeTransfer($bankcode,$bankout,$amount,$nameout,$commet,$act);
        if($verifyMakeTransferd->result->responseCode != '00'){
            return array(
                "status" => "error",
                "message"=> 'Hết thời gian đăng nhập vui lòng đăng nhập lại 2'
            );
        }
        $custId1 = $this->getAuthList($amount,$act);
        $custId = $custId1->authList[0]->code;
        if($custId1->result->responseCode != '00'){
            return array(
                "status" => "error",
                "message"=> $custId
            );
        }
        try {
            $params = array(
                'deviceIdCommon'  => $this->imei,
                'refNo'  => $this->ref_nof(),
                'sessionId'     => $this->session_id,
                'transactionAuthen' => array(
                    'amount'    => $amount,
                    'custId'  => $custId,
                    'destAccount'     => $bankout,
                    'destAccountName' => $nameout,
                    'refNo' => $this->ref_nof(),
                    'sourceAccount' => $this->account_number,
                    'transactionType' => $transactionType
                )
            );
            $res = $this->client->request('POST',$this->url['createTransactionAuthen'], array(
                'json' => $params,
                'timeout' => $this->_timeout,
                'headers' => $this->headerDefault(),
            ));
            $result = json_decode($res->getBody());
            if($custId1->result->responseCode == '00'){
                $Transferid = $result->transactionAuthen->id;
                $image = $this->getQr($Transferid);
                if($image->success == true){
                    $imag = $image->qrImage;
                }
                return array(
                    "status" => "success",
                    "authListcode"=> $custId,
                    "Transferid"=> $Transferid,
                    "destAccountName"=> $nameout,
                    "img"=> $imag
                );
            }
            return $data;
        } catch (\Throwable $e) {
            dd($e);
        }
    }
    

    public function makeTransfer($bankcode,$bankout,$amount,$commet,$name,$authrlist,$coded,$transacid)
    {
        $act = 'FAST';
        if ($bankcode == '970422'){
            $act = 'INHOUSE';
        }
        try {
            $adiuyf = "ibr|".$authrlist."||".$coded."||".time()."|".$transacid."|".$this->ref_nof();
            $params = array(
                'amount' => $amount,
                'benAccountName' => $name,
                'benAccountNumber' => $bankout,
                'benBankCd' => $bankcode,
                'destType' => 'ACCOUNT',
                'deviceIdCommon' => $this->imei,
                'message'     => $commet,
                'otp' => $adiuyf,
                'refNo'     => $this->ref_nof(),
                'sessionId'     => $this->session_id,
                'srcAccountNumber'     => $this->account_number,
                'transferType'     => $act
            );
            $res = $this->client->request('POST',$this->url['makeTransfer'], array(
                'json' => $params,
                'timeout' => $this->_timeout,
                'headers'     => $this->headerDefault()
            ));
            return json_decode($res->getBody());
        } catch (\Throwable $e) {

        }
        return false;
    }
    
    
    private function ref_nof()
    {
        return $this->username . '-2022090511534518';
    }
    
    private function ref_no()
    {
        return $this->username . '-' . date('YmdHms');
    }

    private function ref_nomd5()
    {
        return md5($this->username). '-' . date('YmdHms');
    }

    public function generateImei()
    {
        return $this->generateRandomString(8) . '-mbib-0000-0000-' . date('YmdHms');
    }
    private function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    private function headerDefault(){
        return [
            'Host'              => 'online.mbbank.com.vn',
            'Content-Type'      => 'application/json; charset=UTF-8',
            'User-Agent'        => 'MB%20Bank/2 CFNetwork/1331.0.3 Darwin/21.4.0',
            'Connection'        => 'keep-alive',
            'Accept'            => 'application/json',
            'Accept-Language'   => 'vi-VN,vi;q=0.9',
            'Authorization'     => 'Basic QURNSU46QURNSU4=',
            'Accept-Encoding'   => 'gzip, deflate, br',
            'X-Request-Id'   => $this->ref_no()
        ];
    }
    private function headerv3(){
        return [
             'Authorization' => 'Basic RU1CUkVUQUlMV0VCOlNEMjM0ZGZnMzQlI0BGR0AzNHNmc2RmNDU4NDNm',
                'elastic-apm-traceparent' => ' 00-990ae541635925153418b611d6a6a570-3ac4e7378551e9a3-01',
                'RefNo' => ' dsad-2024071400390758',
                'Content-Type' => ' application/json; charset=UTF-8',
                'Accept' => ' application/json, text/plain, */*',
                'User-Agent' => ' Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
                'Referer' => ' https://online.mbbank.com.vn/pl/login?returnUrl=%2F',
                'app' => ' MB_WEB',
                 'sec-ch-ua-platform' => ' "Windows"',
            'Host'              => 'online.mbbank.com.vn',
            'Content-Type'      => 'application/json; charset=UTF-8',
            'User-Agent'        => 'MB%20Bank/2 CFNetwork/1331.0.3 Darwin/21.4.0',
            'Connection'        => 'keep-alive',
            'Accept'            => 'application/json',
            'Accept-Language'   => 'vi-VN,vi;q=0.9',
            'Authorization'     => 'Basic QURNSU46QURNSU4=',
            'Accept-Encoding'   => 'gzip, deflate, br',
            'X-Request-Id'   => $this->ref_nof()
        ];
    }
    private function headerv2(){
        return [
            'Host'              => 'online.mbbank.com.vn',
            'Content-Type'      => 'application/json; charset=UTF-8',
            'User-Agent'        => 'MB%20Bank/2 CFNetwork/1331.0.3 Darwin/21.4.0',
            'Connection'        => 'keep-alive',
            'Accept'            => 'application/json',
            'Accept-Language'   => 'vi-VN,vi;q=0.9',
            'Authorization'     => 'Basic QURNSU46QURNSU4=',
            'Accept-Encoding'   => 'gzip, deflate, br',
            'Deviceid'   => $this->imei,
            'Refno'   => $this->ref_no()
        ];
    }
}
