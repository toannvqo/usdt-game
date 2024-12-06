<?php

require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . "/../db.php");
require_once(__DIR__ . "/../helper.php");

use GuzzleHttp\Client;

class GateIO
{
    protected $uid;
    protected $BALANCE;
    protected $apiKey_gateio;
    protected $apiSecret_gateio;
    protected $tkuma;
    protected $client;
    protected $url = [
        "apiKey_gateio" => "8d97591cc0ba56da5699a5965e48a207",
        "apiSecret_gateio" => "d192be47ffed9938445f29fda253e5882cc6ff12a74d9c65135576ec7de1bb26",
        "baseUrl_gateio" => "https://api.gateio.ws/api/v4",
        "transfer_history_endpoint" => "/wallet/push",
        "UID_transfer" => "/withdrawals/push",
        "total_balance" => "/wallet/total_balance",
    ];
    public function __construct($uid, $apiKey_gateio, $apiSecret_gateio)
    {
        error_log("Bắt đầu tạo tài khoản");
        //Log các biến truyền vào
        error_log("Uid: " . $uid);
        //Kết nối database
        $this->tkuma = new DB();
        $this->client = new Client(['http_errors' => false]);
        $row =  $this->tkuma->get_row("SELECT * FROM `gate_account` WHERE `uid` = ?", [$uid]);
        $this->uid = $uid;
        $this->apiKey_gateio = $apiKey_gateio;
        $this->apiSecret_gateio = $apiSecret_gateio;
        if (!$this->tkuma->get_row("SELECT * FROM `gate_account` WHERE `uid` = ?", [$uid])) {
            //Nếu chưa có tài khoản thì tạo mới
            $this->tkuma->insert("gate_account", [
                'uid'      => $this->uid,
                'apiKey'       => $this->apiKey_gateio,
                'apiSecret'       => $this->apiSecret_gateio,
                'time'          => time(),
                'status'          => "success",
                'BALANCE'          => $this->BALANCE,
            ]);
        }
    }

    function getBalance()
    {
        $url = $this->url['total_balance'];
        $queryParam = "currency=USDT";
        $signHeaders = $this->genSign("GET", $url, $queryParam, "");

        $headers = [
            "Accept: application/json",
            "KEY: " . $signHeaders['KEY'],
            "Timestamp: " . $signHeaders['Timestamp'],
            "SIGN: " . $signHeaders['SIGN']
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url['baseUrl_gateio'] . $url . "?" . $queryParam);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $transactions = json_decode($response, true);
        return $transactions;
    }


    private function genSign($method, $url, $queryString, $payloadString)
    {
        $prefix = "/api/v4";

        $t = time();
        $hashedPayload = hash('sha512', $payloadString ?? "");
        $s = "$method\n$prefix$url\n$queryString\n$hashedPayload\n$t";
        $sign = hash_hmac('sha512', $s, $this->apiSecret_gateio);

        return [
            'KEY' => $this->apiKey_gateio,
            'Timestamp' => $t,
            'SIGN' => $sign
        ];
    }


    function getTransactionHistoryV2()
    {
        $url = $this->url['transfer_history_endpoint'];
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
        //Log kết quả trả về
        error_log("Lịch sử giao dịch: " . json_encode($transactions));
        return $transactions;
    }


    function transferFundsGateio($recipientUserId, $amount, $currency = "USDT")
    {
        $url = $this->url['UID_transfer'];

        $body = json_encode([
            'receive_uid' => $recipientUserId,
            'currency' => $currency,
            'amount' => $amount
        ]);
        $signHeaders = $this->genSign("POST", $url, "", $body);

        $headers = [
            "Accept: application/json",
            "Content-Type: application/json",
            "KEY: " . $signHeaders['KEY'],
            "Timestamp: " . $signHeaders['Timestamp'],
            "SIGN: " . $signHeaders['SIGN']
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url['baseUrl_gateio'] . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $transactions = json_decode($response, true);
        return $transactions;
    }
}
