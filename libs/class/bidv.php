<?php

require_once(__DIR__ . '/../config.php');
require_once(__DIR__ . "/../db.php");
require_once(__DIR__ . "/../helper.php");


if(!function_exists('debug')){
    function debug($v, $die = true){
        echo "<pre>";
        print_r($v);
        echo "</pre>";
        if($die)
            die();

    }
}


use GuzzleHttp\Client;
use Illuminate\Support\Str;
use phpseclib\Crypt\RSA;


class BIDV {
    
    
    
    private $tkuma;
    
    public $config = array();
    

	protected $defaultPublicKey =   "-----BEGIN PUBLIC KEY-----\r\nMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAy6bC9ub46VDwZL5rwtbW\r\n2vBlHsqGzn6kr8OX7dKn+jHZxJxHSOGwTlqi+/QsSZ8wbUDkyK66atYB4Y06j1HS\r\nRimLG2zKK6BwqtMwM1VBwepy6nB+JsbobmvDInU/8cArdQRVNwWMHWwV0ZB0a3wp\r\nFCvVSwF61zFh5aG1Gbfvkbwdh4bpRa860MTyK19+rRXboROQmQYXfLWbrsI7vc3Q\r\nFRfgHIdh3baVd0mjmgMhE9yXwzroOxd418aWUQ9eSY1xmEmX9QynG9dYBMl/zzuS\r\nmM6CfJwKdsswKF0vmhRSLOBv+j/jABADcnrcIhcBS3EnTtSXDQPn/O/osqvRu5q\r\nxvQIDAQAB\r\n-----END PUBLIC KEY-----";



	protected $clientPublicKey = "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCLDAD6Wr+W7SXLJMECvt3/W9zMmVcbzwUniO7vYLBJDOEcWJoci5TrfAXlA+z3vxLmEKif41f6wlDBiY+Njj0fNkVH9w+dBbIz2CBaB8RsoDSFYA5zzUbdXfVMV+fs3o3nK/dDAZNX1MU96cISsgQTe+dIIkpMs3jSFvrxjtGg+wIDAQAB";

	protected $clientPrivateKey = "-----BEGIN RSA PRIVATE KEY-----
MIICXAIBAAKBgQCLDAD6Wr+W7SXLJMECvt3/W9zMmVcbzwUniO7vYLBJDOEcWJoc
i5TrfAXlA+z3vxLmEKif41f6wlDBiY+Njj0fNkVH9w+dBbIz2CBaB8RsoDSFYA5z
zUbdXfVMV+fs3o3nK/dDAZNX1MU96cISsgQTe+dIIkpMs3jSFvrxjtGg+wIDAQAB
AoGAWyToMzNvKPCUeH/EIReaD3xY1KijJ/Bg0ZR6AuGfTJMrsFgH1TRNzrqCZqdX
GuLd8X7z+bKdhhr/so2IUuLs/uF8/dQHtT9TxFoM2SPsgAqWZlxPOUZ+cBdNEv94
JA9JywJQBuPTrnojrgcsODW3zOCMmiSWEr8lRtKZY/cvgWkCQQDbVqoKUl4T7yt2
Dz8DxcZvgHMqyzvZyuYXLWyCg+cc6pd9iJ0uJdVe7YEE7bVoyHEBCF/6ufF53UuE
dHPAnknPAkEAokm4A42/6BWFgL5R0UdDCoIp03ODn1GRo3Bcte/4b2Jm9pXsZrYS
lwKyT66UuwXzcG1qkeLY33H0Zo6tC9z9FQJAf42GlToRO8Z6n81999Or8mvgjaJi
y+USqafg0oWigU5rirVHsu6NhwbXYOZb+POXw+H67vPzWcs3f2+5YOqsQQJAbEDI
YnZ3gJR6jTpm0Ta73ZKd29K+BdQfVepprWL5UTNOg0XWf10MYXcHAmfuBiMeE+yo
nc+34rTc1lxtyfALUQJBANCy9hPELiv+c36RT7XISDfEX2ZwOo12yexNb545dL8n
5whUm8qm5P9OAGgPgHBIVbOVp8qdHmRr1FT/qJt/LFw=
-----END RSA PRIVATE KEY-----
";
	protected $url = [
	    "getCaptcha" => "https://smartbanking.bidv.com.vn/w2/captcha/",
	    "auth" => "https://smartbanking.bidv.com.vn/w2/auth",
	    "process" => "https://smartbanking.bidv.com.vn/w2/process"
	];
	
	protected $lang = 'vi';
	protected $_timeout = 60;
	protected $DT = "WINDOWS";
	protected $E = "";
	protected $OV = "111.0.0.0";
	protected $PM = "Chrome";
	protected $appVersion = "2.4.1.15";
	protected $captchaToken = "";
	protected $captchaValue = "";
	#account
	protected $username;
	protected $password;
	protected $account_number;
	#store account
	protected $sessionId = "";
	protected $mobileId = "";
	protected $clientId = "";
	protected $cif = "";
	protected $token = "";
	protected $accessToken = "";
	protected $authToken = "";

	private $file = '';

	public function __construct($username,$password,$account_number)
	{
	    $this->tkuma = new DB();
		$row =  $this->tkuma->get_row("SELECT * FROM `account_bidv` WHERE `username` = ? AND `password` = ?  ",[$username,$password]);

		$this->password = $password;
		if (!$this->tkuma->get_row("SELECT * FROM `account_bidv` WHERE `username` = ? ",[$username])) {
		    $this->username = $username;
		    $this->password = $password;
		    $this->account_number = $account_number;
		    $this->clientId = '';
		    $this->E = '';
		    $this->tkuma->insert("account_bidv", [
                'username'              => $this->username,
                'password'              => $this->password,
                'account_number'        => $this->account_number,
                'sessionId'             => $this->sessionId,
                'mobileId'              => $this->mobileId,
                'clientId'              => $this->clientId,
                'cif'                   => $this->cif,
                'token'             => $this->token,
                'accessToken'          => $this->accessToken,
                'E'                     => $this->E,
                'status'          => "LOGIN",
                'authToken'             => $this->authToken,
            ]);
		}	else	{
		    $this->config = $row;
            $this->parseData();
		}
	}

	public function saveData(){
		 $this->tkuma->update( "account_bidv", [
                'password'              => $this->password,
                'account_number'        => $this->account_number,
                'sessionId'             => $this->sessionId,
                'mobileId'              => $this->mobileId,
                'clientId'              => $this->clientId,
                'token' 				=> $this->token,
                'accessToken'          => $this->accessToken,
                'authToken'             => $this->authToken,
                'cif'                   => $this->cif,
                'E'                     => $this->E,
            ],
            " `username` = ?  ",[$this->username]
        );
	}
	public function parseData(){
		$this->username = $this->config['username'];
        $this->password = $this->password;
        $this->account_number = isset($this->config['account_number']) ? $this->config['account_number'] : '';
        $this->sessionId = isset($this->config['sessionId']) ? $this->config['sessionId'] : '';
        $this->mobileId = isset($this->config['mobileId']) ? $this->config['mobileId'] : '';
        $this->clientId = isset($this->config['clientId']) ? $this->config['clientId'] : '';
        $this->token = isset($this->config['token']) ? $this->config['token'] : '';
        $this->accessToken = isset($this->config['accessToken']) ? $this->config['accessToken'] : '';
        $this->authToken = isset($this->config['authToken']) ? $this->config['authToken'] : '';
        $this->cif = isset($this->config['cif']) ? $this->config['cif'] : '';
        $this->E = isset($this->config['E']) ? $this->config['E'] : '';
	}


	private function createTask($image)
	{
	  global $config;
	  $client = new Client();
	  try {
	    $res = $client->request('POST', 'https://api.1stcaptcha.com/recognition', [
          'json' => array(
            'Apikey' => $config['captcha1st'],
            'Type'    => 'imagetotext',
            'Image'    => $image
          )
        ]);
	    return json_decode($res->getBody());
	  } catch (\Throwable $th) {
	  }
	  return false;
	}

	private function getTaskResult($taskId, $j = 0)
    {
        if ($j >= 5) {
            return ["status" => false];
        }
        $client = new Client();
        try {
            $res = $client->request('POST', 'https://win32.vn/api/v1/Taskcaptcha', [
                 'json' => array(
                    'typecaptcha'    => 'bidv',
                    'token'    => $this->tkuma->site("server_captcha"),
                    'base64'    => $taskId
                )
            ]);
            $result = json_decode($res->getBody());

            if ($result->success) {
                return ["status" => true, "captcha" => $result->captcha];
            } elseif ($result->status == 'processing') {
                sleep(3);
                ++$j;
                return $this->getTaskResult($taskId, $j);
            }
        } catch (\Throwable $th) {
        }
        return ["status" => false];
    }

    
    public function solveCaptcha()
    {
        $getCaptcha = $this->getCaptcha();
        $result = $this->getTaskResult($getCaptcha);
        if ($result['status'] == true) {
            $this->captchaValue = $result['captcha'];
            return ["status" => true, "key" => $this->captchaValue, "captcha" => $result['captcha']];
        } else {
            return ["status" => false, "msg" => "Error getTaskResult"];
        }
    }

	public function doLogin(){
	    $solveCaptcha = $this->solveCaptcha();
	    if($solveCaptcha['status'] == false){
	        return $solveCaptcha;
	    }
	    $param = array(
	        "DT" => $this->DT,
	        "E" => $this->E,
	        "OV" => $this->OV,
	        "PM" => $this->PM,
	        "appVersion" => $this->appVersion,
	        "captchaToken" => $this->captchaToken,
	        "captchaValue" => $this->captchaValue,
	        "clientId" => $this->clientId,
	        "mid" => 1,
	        "pin" => $this->password,
	        "user" => $this->username
	    );
	    $result = $this->curlPost($this->url['auth'],$param);


	    if($result['code'] == 00){
	    	if(isset($result['data']['accessToken'])){
	    		$data = $result['data'];
	    		$this->sessionId = $data['sessionId'];
	    		$this->accessToken = $data['accessToken'];
	    		$this->saveData();
	    	}
	    	else{
	    		if(isset($result['loginType']) && $result['loginType'] == 3){
		            $this->token = $result['token'];
		            $this->saveData();
		    		return array(
		    		    'status' => true,
		    		    'message' => "Vui lòng nhập OTP",
		    		    'data' => $result ? : ""
		    		);	
	    		}
	            $this->saveData();

	            // if(isset($result['code']) && $result['code'] == 'IB01')
	    		return array(
		            'status' => true,
		            'message' => 'Thành công',
		            'session' => '',
		            'data' => $result ? : ""
		        );
	    	}

	        
	    }else{
	        return array(
	            'status' => false,
	            'message' => $result['des'],
	            'session' => '',
	            'data' => $result ? : ""
	        );
	    }
	}

	public function verifyOTP($otp)
	{
	  $this->E = Str::random(10) . $this->username;
	  
	  $data = [
	    'user' =>  $this->username,
	    'clientId' =>  $this->clientId,
	    'location' =>  '',
	    'otp' =>  $otp,
	    'mid' =>  56,
	    "DT" => $this->DT,
	    "E" => $this->E,
	    "OV" => $this->OV,
	    "PM" => $this->PM,
        "appVersion" => $this->appVersion,
	    'token' =>  $this->token
	  ];
      $res = $this->curlPost($this->url['auth'],$data);
	  if ($res['code'] == '00') {
	    $this->sessionId  = $res['sessionId'];
	    $this->accessKey  = $res['accessKey'];
	    $this->cif  = $res['cif'];
		$this->accessToken = $res['accessToken'];
		$this->clientId = $res['clientId'];
	    $this->saveData();

	    return ['status' => true, 'message' => $res['des'], 'data' => $res];
	  } else {
	    return ['status' => false, 'message' => $res['des'], 'data' => $res];
	  }
	}

	public function getTransactions($accNo, $limit, $fromDate, $endDate){
			$param = array(
			    "DT" => $this->DT,
			    "E" => $this->E,
			    "OV" => $this->OV,
			    "PM" => $this->PM,
			    "appVersion" => $this->appVersion,
			    "clientId" => $this->clientId,
			    "accType" => "D",
			    "accNo" => $accNo,
			    "mid" => 12,
			    // "fromDate" => $fromDate,
			    // "toDate" => $endDate,
			    // "moreRecord" => "N",
			    "serviceTypeCode" => "",
			    "transId" => 0
			);
			$result = $this->curlPost($this->url['process'],$param, ['Authorization' => $this->authToken]);
			return $result;
		
		
	}

	public function getBalance(){
	    $param = array(
	        "DT" => $this->DT,
	        "E" => $this->E,
	        "OV" => $this->OV,
	        "PM" => $this->PM,
	        "appVersion" => $this->appVersion,
	        "clientId" => $this->clientId,
	        "accType" => "D",
	        "mid" => 10,
	        "isCache" => false,
	        "maxRequestInCache" => false
	    );
	    $result = $this->curlPost($this->url['process'],$param, ['Authorization' => $this->authToken]);
	    return $result;
	}

	public function getCaptcha(){
	    $this->captchaToken = Str::random(30);
	    $client = new Client(['http_errors' => false]);
	    $res = $client->request('GET', $this->url['getCaptcha'].$this->captchaToken , [
	        'timeout' => $this->_timeout,
	        'headers' => array(
	            'user-agent' => $this->getUserAgent()
	        ),
	    ]);
	    $result = $res->getBody()->getContents();
	    return base64_encode($result);
	}

	

	public function checkBankAccount2($toAcc)
	{
	  $data = [
	    'accNo' =>  $toAcc,
	    'mid' =>  200, // mid = 201 : kiểm tra khác bank, mid = 200 : kiểm tra cùng bank
	  ];
	  $res = $this->curlPost($this->url['process'], $data, ['Authorization' => $this->authToken]);
	  return $res;
	}

// 	public function transferMoneyInt2($amount, $content = '', $toAccount = [], $accNo)
// 	{
		
// 	}

	public function checkBankAccount($toAcc, $bankCode247 = '')
	{
	  $data = [
	    'accNo' =>  $toAcc,
	    'bankCode247' =>  $bankCode247,
	    'mid' =>  201, // mid = 201 : kiểm tra khác bank, mid = 200 : kiểm tra cùng bank
	  ];
	  $res = $this->curlPost($this->url['process'], $data, ['Authorization' => $this->authToken]);
	  return $res;
	}

// 	public function transferMoneyInt($amount, $content = '', $toAccount = [], $accNo)
// 	{

// 	}

	public function transferMoney($tranToken, $otp, $type = 1)
	{
	  $data = [
	    'authenValue' =>  $otp,
	    'authenType' =>  1,
	    'tranToken' =>  $tranToken,
	    'isSmart' =>  false,
	    'time' =>  $type == 1 ? 110 : 97,
	    'mid' =>  $type == 1 ? 103 : 101
	  ];
	  $res = $this->curlPost($this->url['process'], $data, ['Authorization' => $this->authToken]);
	  return $res;
	}
	
	// public function solveCaptcha(){
	//     $getCaptcha = $this->getCaptcha();
	//     $client = new Client(['http_errors' => false]);
	//     $res = $client->request('POST', "https://api.tungduy.com/api/captcha/bidv", [ 
	//         'timeout' => $this->_timeout,
	//         "body" => json_encode(["apikey" => $this->captchaKey,"base64" => $getCaptcha]),
	//         'headers' => array(
	//             'user-agent' => "Captcha ".$this->captchaKey,
	//             'Content-Type' => 'application/json'
	//         ),
	//     ]);
	//     $result = json_decode($res->getBody()->getContents());
	//     if ($result->status !== true) {
	//         return ["status" => false,"msg" =>"Solve Captcha failed: ".$result->message];
	//     } else {
	//         $this->captchaValue = $result->captcha;
	//         return ["status" => true,"key" => $this->captchaToken,"captcha" => $this->captchaValue];
	//     }
	// }


	public function encryptData($str){
	    $str["clientPubKey"] = $this->clientPublicKey;
	    $key = Str::random(32);
	    $iv = Str::random(16);
	    $rsa = new RSA();
	    $rsa->loadKey($this->defaultPublicKey);
	    $rsa->setEncryptionMode(2);
	    $body = base64_encode($iv . openssl_encrypt(json_encode($str), 'AES-256-CTR', $key, OPENSSL_RAW_DATA, $iv));
	    $header = base64_encode($rsa->encrypt(base64_encode($key)));
	    return [
	        'd'=> $body,
	        'k'=> $header,
	    ];
	}
	public function decryptData($cipher){
	    $header = $cipher->k;
	    $body = base64_decode($cipher->d);
	    $rsa = new RSA();
	    $rsa->loadKey($this->clientPrivateKey);
	    $rsa->setEncryptionMode(2);
	    $key = $rsa->decrypt(base64_decode($header));
	    $iv = substr($body, 0,16);
	    $cipherText = substr($body, 16);
	    $text = openssl_decrypt($cipherText, 'AES-256-CTR', base64_decode($key), OPENSSL_RAW_DATA, $iv);
	    return (array) json_decode($text, true);
	}


	private function curlPost($url = "",$data = array(), $header = []){
	    try {


	        $client = new Client();
	        $res = $client->request('POST', $url, [
	            'timeout' => $this->_timeout,
	            'headers' => $this->headerNull($header),
	            'body' => json_encode($this->encryptData($data)),
	        ]);
	        $result = json_decode($res->getBody()->getContents());
	        $this->authToken = $res->getHeaderLine("Authorization");
	        return $this->decryptData($result);
	    } catch (\Exception $e) {
	    	if($e->getResponse()->getStatusCode() == '403'){
	    		 return ["status" => false,"msg" => "Token hết hạn vui lòng đăng nhập lại"];
	    		 die();
	    	}

	    	$response = $e->getResponse()->getBody()->getContents();
	        return $this->decryptData(json_decode($response));

	        return false;
	    }
	}


	public function headerNull($header = [])
	{
	  $headers = [
	    'Accept-Language' =>  'vi',
	    'Accept'        =>  'application/json',
	    'Content-Type'  =>  'application/json',
	    'User-Agent'    =>  'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/95.0.4638.54 Safari/537.36',
	    'Host'          =>  'smartbanking.bidv.com.vn',
	    'Origin'        =>  'https://smartbanking.bidv.com.vn',
	    'Referer'       =>  'https://smartbanking.bidv.com.vn/'
	  ];
	  if ($headers) {
	    $headers  = array_merge($headers, $header);
	  }
	  return $headers;
	}

	public function getUserAgent()
	{
	    $userAgentArray[] = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36";
	    $getArrayKey = array_rand($userAgentArray);
	    return $userAgentArray[$getArrayKey];

	}

	public function isJson($string) {
	   json_decode($string);
	   return json_last_error() === JSON_ERROR_NONE;
	}


}


// $app = new BIDV('số điện thoại','mật khẩu','số tài khoản');
// $result = $app;
//Bước 1 Login
// $result = $app->doLogin();

//Bước 2 nhập OTP, lần đầu tiên thì mới cần làm bước này. Sau khi đã đăng nhập thành công thì sẽ k cần OTP này nữa, nếu session hết hạn thì chỉ cần chạy lại bước 1
// $result = $app->verifyOTP('070235');

//Bước 3 lấy LSGD
// $result = $app->getTransactions();

// $result = $app->getBalance();



// debug($result);


// Login thoải mái mà k cần OTP


?>