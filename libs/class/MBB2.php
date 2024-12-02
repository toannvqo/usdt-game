<?php

require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . "/../db.php");
require_once(__DIR__ . "/../helper.php");

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class MBB2
{
    protected $account;
    protected $_timeout = 15;
    protected $captchaCode = "";
    protected $captchaImage = "";
    protected $encryptedCaptcha = "";
    protected $session_id = "";
    protected $accessToken = "";
    protected $cust = "";
    protected $corpId = "";
    protected $myname = "";
    protected $client;
    protected $BALANCE;
    protected $url = [
        "getCaptcha" => "https://ebank.mbbank.com.vn/corp/common/generateCaptcha",
        "doLogin" => "https://ebank.mbbank.com.vn/corp/common/do-login-v2",
        "getHistories" => "https://api-public.mbbank.com.vn/ms/transaction-statement/v1/transaction-statement",
        "getBalance" => "https://online.mbbank.com.vn/api/retail-web-accountms/getBalance",
        "getNameBank" => "https://online.mbbank.com.vn/api/retail_web/transfer/inquiryAccountName",
        "getBankList" => "https://online.mbbank.com.vn/api/retail_web/common/getBankList",
        "getDomesticInfo" => "https://online.mbbank.com.vn/api/retail_web/transfer/getDomesticInfo",
        "verifyMakeTransfer" => "https://online.mbbank.com.vn/api/retail_web/transfer/verifyMakeTransfer",
        "getAuthList" => "https://online.mbbank.com.vn/api/retail_web/internetbanking/getAuthList",
        "qrcode" => "https://generator.qrcode-gen.com/api/qrcode-url",
        "createTransactionAuthen" => "https://online.mbbank.com.vn/api/retail_web/vtap/createTransactionAuthen",
        "makeTransfer" => "https://online.mbbank.com.vn/api/retail_web/transfer/makeTransfer",
        "getTokenApigee"=> "https://ebank.mbbank.com.vn/corp/common/get-token-apigee"
    ];
    public function __construct($corpId,$username,$password,$account_number)
    {
        error_log("Bắt đầu tạo tài khoản");
        //Log các biến truyền vào
        error_log("CorpId: " . $corp_Id);
        error_log("Username: " . $username);
        error_log("Password: ". $password);
        error_log("Account_number: ". $account_number);
        error_log("Kết thúc tạo tài khoản: " . $this-> generateImei());
        //Kết nối database
        $this->tkuma = new DB();
        $this->client = new Client(['http_errors' => false]);
        $row =  $this->tkuma->get_row("SELECT * FROM `account_mbbank2` WHERE `phone` = ? AND `password` = ?  ",[$username,$password]);
        $this->password = $password;
        if (!$this->tkuma->get_row("SELECT * FROM `account_mbbank2` WHERE `phone` = ? ",[$username])) {
            $this->username = $username;
            $this->password = $password;
            $this->corpId = $corpId;
            $this->account_number = $account_number;
            $this->imei     = $this->generateImei();
            $this->tkuma->insert("account_mbbank2", [
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
				'BALANCE'          => $this->BALANCE,
				'corpId'         => $this->corpId
            ]);
        } else {
            $this->config = $row;
            $this->parseData();
        }

    }

    public function saveData(){
        $this->tkuma->update( "account_mbbank2", [
                'stk'         => $this->account_number,
                'name'         => $this->myname,
                'password'      => $this->password,
                'sessionId'         => $this->session_id,
                'deviceId'       => $this->imei,
                'time'          => time(),
                'BALANCE'          => $this->BALANCE,
                'corpid'          => $this->corpId,
                'token'          => $this->accessToken,
            ],
            " `phone` = ?  ",[$this->username]);
    }

    public function parseData(){
        $this->username = $this->config['username'];
        $this->password = $this->password;
        $this->corpId = isset($this->config['corpId']) ? $this->config['corpId'] : '';
        $this->account_number = isset($this->config['stk']) ? $this->config['stk'] : '';
        $this->session_id = isset($this->config['sessionId']) ? $this->config['sessionId'] : '';
        $this->accessToken = isset($this->config['token']) ? $this->config['token'] : '';
        $this->imei = isset($this->config['deviceId']) ? $this->config['deviceId'] : '';
        $this->myname = isset($this->config['name']) ? $this->config['name'] : '';

    }

    private function getTaskResult($taskId)
    {
        // $currentIpAddress = gethostbyname(gethostname());
        $currentIpAddress = gethostbyname(gethostname());
        if($this->tkuma->site("server_captcha") == 0)
        {$currentIpAddress = '192.168.1.9';}
        $client = new Client();
        //log server_captcha
        error_log("server_captcha: " . $this->tkuma->site("server_captcha"));
        try {
            $res = $client->request('POST', 'https://win32.vn/api/v1/Taskcaptcha', [
                // $res = $client->request('POST', 'http://' . $currentIpAddress . ':8835/api/captcha/mbbank2', [
                'json' => array(
                    'typecaptcha'    => 'mbbank2',
                    'token'    => $this->tkuma->site("server_captcha"),
                    'base64'    => $taskId
                )
            ]);
            $result = json_decode($res->getBody());
            error_log("Phản hồi từ yêu cầu resolver captcha: " . $res->getBody());
  sendMessTelegramNew("Phản hồi từ yêu cầu resolver captcha: ", $res->getBody());
            if ($result->success == true) {
                $this->captchaCode = $result->captcha;
                return ["status" => true, "captcha" => $result->captcha];
            }
        } catch (\Throwable $th) {
        }
        return ["status" => false];
    }

    public function solveCaptcha()
    {
        // Ghi log khi bắt đầu giải captcha
        error_log("Bắt đầu giải captcha");
        $getCaptcha = $this->captchaImage;
        $result = $this->getTaskResult($getCaptcha);
        sendMessTelegramNew( $result['captcha'],"Giá trị captcha: ");
        if ($result['status'] == true) {
            error_log("Giá trị captcha: " . $result['captcha']);

            $this-> captchaValue = $result['captcha'];
            // Ghi log giá trị captcha
            return ["status" => true, "captcha" => $result['captcha']];
        } else {
            return ["status" => false, "msg" => "Error getTaskResult"];
        }
    }

    public function getCaptcha() {
        try {
            // Ghi log khi bắt đầu yêu cầu captcha
            error_log("Bắt đầu yêu cầu captcha");
            $res = $this->client->request('POST', $this->url['getCaptcha'], array(
                'json' => array(
                    'refNo'     => date('YmdHms'),
                    'deviceId' => $this-> generateImei()
                ),
                'timeout' => $this->_timeout,           //Có thể phải comment lại vì khi call báo Access Denied
                //'headers'     => $this->headerDefault(),//Có thể phải comment lại vì khi call báo Access Denied
            ));
    
            // Ghi log phản hồi từ yêu cầu
            error_log("Phản hồi từ yêu cầu captcha: " . $res->getBody());
    
            $data = json_decode($res->getBody());

            $this->captchaImage = $data->imageBase64;
            $this->encryptedCaptcha = $data->encryptedCaptcha;
            
            sendMessTelegramNew( $this->imageBase64, "captcha: ");
             sendMessTelegramNew($this->encryptedCaptcha, "encryptedCaptcha: ");
    
            // Ghi log thông tin captcha
            error_log("Captcha Image: " . $this->captchaImage);
            error_log("Encrypted Captcha: " . $this->encryptedCaptcha);
    
            $this->solveCaptcha();
            return $data;
        } catch (\Throwable $e) {
            // Ghi log lỗi
            error_log("Lỗi khi yêu cầu captcha: " . $e->getMessage());
            dd($e);
        }
    }

    public function doLogin()
    {
        try {
            $this->getCaptcha();
            $params = array(
                'captcha' => $this->captchaCode,
                'corpId'    => $this->corpId,
                'deviceId' => $this->imei,
                'encryptedCaptcha' => $this->encryptedCaptcha,
                'password'  => md5($this->password),
                'refNo'     => $this->ref_no(),
                'userId'     => $this->username
            );
            // Ghi log thông tin đăng nhập
            error_log("Thông tin đăng nhập: " . json_encode($params));
            //sendMessTelegramNew("thong tin dang nhap: ", json_encode($params));
            $res = $this->client->request('POST',$this->url['doLogin'], array(
                'json' => $params,
                'timeout' => $this->_timeout,
               'headers' => $this->headerDefault(),
            ));
            $data = json_decode($res->getBody());
            
             sendMessTelegramNew( json_encode($data), "login Response: ");
            // Ghi log phản hồi từ yêu cầu
            error_log("Phản hồi từ yêu cầu đăng nhập: " . $res->getBody());
            if(isset($data->result->responseCode) && $data->result->responseCode == '00'){
                $this->session_id = $data->sessionId;
                $this->myname = $data->cust->name;
                $this->getTokenApigee();
                $this->saveData();
            }
            return $data;
        } catch (\Throwable $e) {
            sendMessTelegramNew("loi login: ", $e);
            dd($e);
        }
    }

    public function getTokenApigee()
    {
       
        try {
            $res = $this->client->request('POST', $this->url['getTokenApigee'], array(
                'json' => array(
                    'refNo'         => $this->ref_no(),
                ),
                'headers'     => $this->headerGetTokenApigee()
            ));

            //Log request
            error_log("URL yêu cầu lấy token apigee: " . $this->url['getTokenApigee']);
            error_log("Header yêu cầu lấy token apigee:
            " . json_encode($this->headerGetTokenApigee()));

            //Log $res 

            $data = json_decode($res->getBody());

            if(isset($data->result->responseCode) && $data->result->responseCode == '00'){
                //Log phản hồi từ yêu cầu
                $data = json_decode($res->getBody());
                $this->accessToken = $data->apigeeAuthResponse->accessToken;
            }
            error_log("Phản hồi từ yêu cầu lấy token apigee: " . $res->getBody());
            
            return json_decode($res->getBody());
        } catch (\Throwable $e) {
            sendMessTelegramNew("getTransactionHistoryV2 start: ", $e);
        }
        return false;
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

    public function getTransactionHistoryV2($account_no)
    {
        try {
           // sendMessTelegramNew("getTransactionHistoryV2 start: ");
            // Xây dựng URL với các tham số truy vấn
            $url = $this->url['getHistories'] . '?' . http_build_query([
                'acctNo' => $account_no,
                'fromDate' => date("d/m/Y") . ' 00:00',
                'toDate' => date("d/m/Y") . ' 23:59',
                'page' => 1,
                'size' => 999,
                'top' => 999,
                'currency' => 'VND'
            ]);

            // Ghi log URL yêu cầu
            error_log("URL yêu cầu lịch sử giao dịch: " . $url);
            // Thực hiện yêu cầu GET
           //  sendMessTelegramNew("befor request getTransactionHistoryV2: ");
            $res = $this->client->request('GET', $url, [
                'timeout' => $this->_timeout,
                 'headers' => $this->headerv3()
            ]);
             sendMessTelegramNew("getTransactionHistoryV2: "  . $res->getBody());
            //Log Header
            error_log("Header yêu cầu lịch sử giao dịch: " . json_encode($this->headerv3()));
            //Log phản hồi từ yêu cầu
            error_log("Phản hồi từ yêu cầu lịch sử giao dịch: " . $res->getBody());
            return json_decode($res->getBody());
        } catch (\Throwable $e) {
            // Ghi log lỗi nếu cần
            sendMessTelegramNew("Lỗi khi lấy lịch sử giao dịch:: "  . $e->getMessage());
            error_log("Lỗi khi lấy lịch sử giao dịch: " . $e->getMessage());
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
            // 'Host'              => 'online.mbbank.com.vn',
            // 'Content-Type'      => 'application/json; charset=UTF-8',
            'User-Agent'        => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0',
            // 'Connection'        => 'keep-alive',
            // 'Accept'            => 'application/json',
            // 'Accept-Language'   => 'vi-VN,vi;q=0.9',
            // 'Authorization'     => 'Basic QURNSU46QURNSU4=',
            // 'Accept-Encoding'   => 'gzip, deflate, br',
            // 'X-Request-Id'   => $this->ref_no()
        ];
    }

    private function headerGetTokenApigee(){
        return [
            'User-Agent'        => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0',
            'Authorization'     => 'Bearer ' . $this->session_id,
            'X-Request-Id'   => $this->ref_no(),
        ];

        // return [
        //     'Host'              => 'ebank.mbbank.com.vn',
        //     'Content-Type'      => 'application/json; charset=UTF-8',
        //     'User-Agent'        => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36 Edg/128.0.0.0',
        //     'Connection'        => 'keep-alive',
        //     'Accept'            => 'application/json, text/plain, */*',
        //     'Accept-Language'   => 'en-US,en;q=0.9,vi;q=0.8,zh-CN;q=0.7,zh;q=0.6',
        //     // 'Authorization'     => 'Bearer ' . $this->session_id,
        //     'Accept-Encoding'   => 'gzip, deflate, br',
        //     'X-Request-Id'   => $this->ref_no(),
        //     'referer'   => 'https://ebank.mbbank.com.vn/cp/pl/login',
        //     'Origin'   => 'https://ebank.mbbank.com.vn',
        //     'biz-tracking' => '/cp/pl/login/1',
        // ];
    }

    private function headerv2(){
        return [
            'Host'              => 'api-public.mbbank.com.vn',
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

    private function headerv3(){
        return [
            'Host'              => 'api-public.mbbank.com.vn',
            'Origin'            => 'https://ebank.mbbank.com.vn',
            'Referer'           => 'https://ebank.mbbank.com.vn/',
            'Content-Type'      => 'application/json; charset=UTF-8',
            'User-Agent'        => 'MB%20Bank/2 CFNetwork/1331.0.3 Darwin/21.4.0',
            'Connection'        => 'keep-alive',
            'Accept'            => 'application/json, text/plain, */*',
            'Accept-Language'   => 'en-US,en;q=0.9,vi;q=0.8,zh-CN;q=0.7,zh;q=0.6',
            'Authorization'     => 'Bearer ' . $this->accessToken,
            'Accept-Encoding'   => 'gzip, deflate, br, zstd',
            'Deviceid'          => $this->imei,
            'Refno'             => $this->ref_no(), 
            'Sessionid'         => $this->session_id,
            'clientmessageid'   => $this->ref_no(),
        ];
    }
}
