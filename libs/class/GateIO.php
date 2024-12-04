<?php

require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . "/../db.php");
require_once(__DIR__ . "/../helper.php");

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class GateIO
{
    protected $uid;
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
    protected $apiKey_gateio;
    protected $apiSecret_gateio;
    protected $config;
    protected $tkuma;

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
        "getTokenApigee"=> "https://ebank.mbbank.com.vn/corp/common/get-token-apigee",
        "apiKey_gateio" => "c5bbbefbd371abd552e7a508e8d032cd",
        "apiSecret_gateio" => "2de2b959049e7ee6c8e7698a69f68865ab5c8701049c12c6e52239ebf30a4aa8",
        "baseUrl_gateio" => "https://api.gateio.ws/api/v4",
        "transfer_history_endpoint" => "/wallet/push",
    ];
    public function __construct($uid, $apiKey_gateio, $apiSecret_gateio)
    {
        error_log("Bắt đầu tạo tài khoản");
        //Log các biến truyền vào
        error_log("Uid: ". $uid);
        //Kết nối database
        $this->tkuma = new DB();
        $this->client = new Client(['http_errors' => false]);
        $row =  $this->tkuma->get_row("SELECT * FROM `exchange_account` WHERE `uid` = ? AND `type` = 1  ",[$uid]);
        $this->uid = $uid;
        $this->apiKey_gateio = $apiKey_gateio;
        $this->apiSecret_gateio = $apiSecret_gateio;
        if (!$this->tkuma->get_row("SELECT * FROM `exchange_account` WHERE `uid` = ? AND `type` = 1  ",[$uid])) {
            //Nếu chưa có tài khoản thì tạo mới
            $this->tkuma->insert("exchange_account", [
                'uid'      => $this->uid,
                'type'         => 1, // 1: Gate.io 2: Binance.com
				'apiKey'       => $this->apiKey_gateio,
                'apiSecret'       => $this->apiSecret_gateio,
				'time'          => time(),
				'status'          => "success",
				'BALANCE'          => $this->BALANCE,
            ]);
        }
    }

    // public function getBalance()
    // {
       
    //     try {
    //         $res = $this->client->request('POST', $this->url['getBalance'], array(
    //             'json' => array(
    //                 'sessionId'     => $this->session_id,
    //                 'refNo'         => $this->ref_no(),
    //                 'deviceIdCommon' => $this->imei,
    //             ),
    //             'timeout' => $this->_timeout,
    //             'headers'     => $this->headerDefault()
    //         ));
    //         return json_decode($res->getBody());
    //     } catch (\Throwable $e) {
    //     }
    //     return false;
    // }

    private function genSign($method, $url, $queryString, $payloadString) {
        $prefix = "/api/v4";
    
        $t = time();
        $hashedPayload = hash('sha512', $payloadString ?? "");
        $s = "$method\n$prefix$url\n$queryString\n$hashedPayload\n$t";
        $sign = hash_hmac('sha512', $s, $this -> apiSecret_gateio);
    
        return [
            'KEY' => $this -> apiKey_gateio,
            'Timestamp' => $t,
            'SIGN' => $sign
        ];
    }

    
    function getTransactionHistoryV2() {
        $url = "/wallet/push";
        $queryParam = "";
        $signHeaders = $this->genSign("GET", $url, $queryParam, "");
    
        $headers = [
            "Accept: application/json",
            "KEY: " . $signHeaders['KEY'],
            "Timestamp: " . $signHeaders['Timestamp'],
            "SIGN: " . $signHeaders['SIGN']
        ];
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url['baseUrl_gateio'] . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        $transactions = json_decode($response, true);
        return $transactions;
    }
    

    // public function makeTransfer($bankcode,$bankout,$amount,$commet,$name,$authrlist,$coded,$transacid)
    // {
    //     $act = 'FAST';
    //     if ($bankcode == '970422'){
    //         $act = 'INHOUSE';
    //     }
    //     try {
    //         $adiuyf = "ibr|".$authrlist."||".$coded."||".time()."|".$transacid."|".$this->ref_nof();
    //         $params = array(
    //             'amount' => $amount,
    //             'benAccountName' => $name,
    //             'benAccountNumber' => $bankout,
    //             'benBankCd' => $bankcode,
    //             'destType' => 'ACCOUNT',
    //             'deviceIdCommon' => $this->imei,
    //             'message'     => $commet,
    //             'otp' => $adiuyf,
    //             'refNo'     => $this->ref_nof(),
    //             'sessionId'     => $this->session_id,
    //             'srcAccountNumber'     => $this->account_number,
    //             'transferType'     => $act
    //         );
    //         $res = $this->client->request('POST',$this->url['makeTransfer'], array(
    //             'json' => $params,
    //             'timeout' => $this->_timeout,
    //             'headers'     => $this->headerDefault()
    //         ));
    //         return json_decode($res->getBody());
    //     } catch (\Throwable $e) {

    //     }
    //     return false;
    // }
}
