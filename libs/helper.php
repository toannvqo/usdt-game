<?php

if (!defined('IN_SITE')) {
	die('The Request Not Found');
}

use phpseclib\Crypt\RSA;

date_default_timezone_set("Asia/Ho_Chi_Minh");
require_once(__DIR__ . "/class/VietCombank.php");
require_once(__DIR__ . '/class/MBB.php');
require_once(__DIR__ . '/class/bidv.php');
require_once(__DIR__ . '/config.php');

function chuyentien($sdt, $amount, $password, $comment, $phone, $keyloca)
{
	$tkuma = new DB;
	//check thông tin
	if ($keyloca != base64_decode($tkuma->site('keyloca'))) {
		return array('status' => 'false', 'msg' => 'Thông tin api không chính xác');
	}
	$row = $tkuma->get_row(" SELECT * FROM `account_vcb` WHERE `password` = ? AND `username` = ? ",[$password,$sdt]);
	if (!$row) {
		return array('status' => 'false', 'msg' => 'Thông tin api không chính xác');
	}
	$app = new VietCombank($sdt, $password, $row['account_number']);

	$checkBalance = $row['BALANCE'];
	if ($checkBalance < $amount) {
		return array("status" => "99", "msg" => "Tài khoản không đủ tiền");
	} else {
		// /payMent
		$result = $app->getlistDDAccount();
		$result = $app->createTranferInVietCombank($row['account_number'], $phone, $amount, $comment);
		//dd($result);
		if ($result->code == '00') {
			$tranId = $result->transaction->tranId;
			$result = $app->genOtpTranFer($tranId, 'IN');
			if ($result->code == '00') {
				$challenge = $result->challenge;
				
				$data['challenge'] = $challenge;
				$resud = curlPost2($tkuma->site('ipserver').'/process', $data);
				if (!empty($resud["error"])) {
					return array('status' => 'false', 'msg' => 'Lỗi Không kết nối được server');
				}
				$otp = $resud['SmartOTP'];
				if (!$otp) {
					return array('status' => 'false', 'msg' => 'Không lấy được OTP');
				} else {
					$result = json_encode($app->confirmTranfer($tranId, $challenge, $otp, 'IN'));
					$resultd = json_decode($result, true);
					if ($resultd['code'] == '00') {
						return array(
							"status" => "200",
							"msg" => "Chuyển tiền thành công",
							"tranId" => $resultd['transaction']['tranId'],
							"description" => $comment,
							"amount" => intval(str_replace(',', '', $resultd['transaction']['amount'])),
							"partnerId" => $phone,
							"partnerName" => $resultd['transaction']['creditAccountName'],
							"trans_time" => $resultd['transaction']['createTime'],
							"ownerNumber" => $resultd['transaction']['debitAccountNo'],
							"ownerName" => $resultd['transaction']['debitAccountName'],
						);
					} else {
						return array('status' => '99', 'msg' => 'Lỗi Không xác Định');
					}
				}
			}
		} else {
		    return array('status' => '99', 'msg' => $result->des);
		}
	}
}

function chuyentienout($sdt, $amount, $password, $comment, $phone, $keyloca, $bankcode)
{
	$tkuma = new DB;
	//check thông tin
	if ($keyloca != base64_decode($tkuma->site('keyloca'))) {
		return array('status' => 'false', 'msg' => 'Thông tin api không chính xác');
	}
	$row = $tkuma->get_row(" SELECT * FROM `account_vcb` WHERE `password` = ? AND `username` = ? ",[$password,$sdt]);
	if (!$row) {
		return array('status' => 'false', 'msg' => 'Thông tin api không chính xác');
	}
	$app = new VietCombank($sdt, $password, $row['account_number']);
	$checkBalance = $row['BALANCE'];
	if ($checkBalance < $amount) {
		return array("status" => "99", "msg" => "Tài khoản không đủ tiền");
	} else {
		// /payMent
		$result = $app->getlistDDAccount();
		$result = $app->createTranferOutVietCombank($row['account_number'], $bankcode, $phone, $amount, $comment);
		//dd($result);
		if ($result->code == '00') {
			$tranId = $result->tranxId;
			$result = $app->genOtpTranFer($tranId);
			if ($result->code == '00') {
				$challenge = $result->challenge;
				
			    $data['challenge'] = $challenge;
				$resud = curlPost2($tkuma->site('ipserver').'/process', $data);
				if (!empty($resud["error"])) {
					return array('status' => 'false', 'msg' => 'Lỗi Không kết nối được server');
				}
				$otp = $resud['SmartOTP'];
				if (!$otp) {
					return array('status' => 'false', 'msg' => 'Không lấy được OTP');
				} else {
					$result = json_encode($app->confirmTranfer($tranId, $challenge, $otp));
					$resultd = json_decode($result, true);
					if ($resultd['code'] == '00') {
						return array(
							"status" => "200",
							"msg" => "Chuyển tiền thành công",
							"tranId" => $resultd['transaction']['tranId'],
							"description" => $comment,
							"amount" => intval(str_replace(',', '', $resultd['transaction']['amount'])),
							"partnerId" => $phone,
							"partnerName" => $resultd['transaction']['creditAccountName'],
							"trans_time" => $resultd['transaction']['createTime'],
							"ownerNumber" => $resultd['transaction']['debitAccountNo'],
							"ownerName" => $resultd['transaction']['debitAccountName'],
						);
					} else {
						return array('status' => '99', 'msg' => 'Lỗi Không xác Định');
					}
				}
			}
		} else {
		    return array('status' => '99', 'msg' => $result->des);
		}
	}
}


function balance($token)
{
	$tkuma = new DB;
	//check thông tin
	$getData = $tkuma->get_row(" SELECT * FROM `account_vcb` WHERE `token` = ? AND `sessionId` != '' ",[$token]);
	if ($getData) {
		$app = new VietCombank($getData['username'], $getData['password'], $getData['account_number']);
		$balance = json_encode($app->getAccountDeltail());
		$balanceb = json_decode($balance, true);
		if ($balanceb['code'] != '00') {
			$tam = json_encode($app->doLogin());
			if (json_decode($tam, true)['message'] == 'success') {
				$balanceb = json_encode($app->getAccountDeltail());
				$money = isset($balanceb['accountDetail']['availBalance']) ? $balanceb['accountDetail']['availBalance'] : 0;
				if (preg_replace('/[^\d]/', '', $money) != '0') {
					$tkuma->update("account_vcb",['BALANCE' => preg_replace('/[^\d]/', '', $money),]," `username` = ?  ",[$getData['username']]);
				}
				return array('status' => '200', 'SoDu' => '' .  preg_replace('/[^\d]/', '', $money) . '');
			} else {
				$tkuma->update("account_vcb",['msg' => json_decode($tam, true)['message'],]," `username` = ?  ",[$getData['username']]);
				// die(json_encode(array('status' => '1', 'msg' => '' . json_decode($tam, true)['message'] . '')));
				return array('status' => '99', 'SoDu' => '-99');
			}
		}
		if (isset($balanceb['accountDetail'])) {
			$money = isset($balanceb['accountDetail']['availBalance']) ? $balanceb['accountDetail']['availBalance'] : 0;
			if (empty($getData['name'])) {
				$tkuma->update(
					"account_vcb",
					[
						'name'              => $balanceb['accountDetail']['customerName'],
					],
					" `username` = ?  ",[$getData['username']]
				);
			}
			if ($checname2 = $tkuma->get_row(" SELECT * FROM `phone` WHERE `phone` = '" . $getData['account_number'] . "' LIMIT 1")) {
				if (empty($checname2['ctk'])) {
					$tkuma->update(
						"phone",
						[
							'ctk'              => $balanceb['accountDetail']['customerName'],
						],
						" `phone` = ? ",[$getData['account_number']]
					);
				}
			}
			if (preg_replace('/[^\d]/', '', $money) != '0') {
				$tkuma->update(
					"account_vcb",
					[
						'BALANCE'              => preg_replace('/[^\d]/', '', $money),
					],
					" `username` = ?  ",[$getData['username']]
				);
			}
			return array('status' => '200', 'SoDu' => '' . preg_replace('/[^\d]/', '', $money) . '');
		} else {
			return array('status' => '99', 'SoDu' => '0');
		}
	}
}

function pingphone()
{
    $tkuma = new DB;
    //get game
    $arr_resphone = array();
    foreach ($tkuma->get_list("SELECT * FROM `phone`  ORDER BY `id` DESC") as $rowphone) 
    {
        	$arr_resphone[] = array(
                "id" => (int)$rowphone['id'],
                "phone" => $rowphone['phone'],
                "limitDay" =>  '0',
                "limitMonth" => '12',
                "number" =>  '0',
                "name" => $rowphone['ctk'],
                "bankname" => $rowphone['namebank'],
                "amountDay" => '3',
                "amountMonth" => '12',
                "count" => '0',
                "status" => $rowphone['status'],
                "bankimg" => display_bank($rowphone['namebank']),
        	);
    }
    $tkuma->WebSocket('tablePhone',$arr_resphone);
}
function pinghistoryuser($sessiond)
{
    $tkuma = new DB;
    //get game
    $arr_reshisuer = array();
    $getUser = $tkuma->get_row(" SELECT * FROM `users` WHERE `token` = ? ",[$sessiond]);
    if (!empty($getUser)){
        foreach ($tkuma->get_list("SELECT * FROM `lich_su_choi` WHERE `partnerName` = ? ORDER BY `id` DESC LIMIT 10",[$getUser['username']]) as $rowuser)
        {
    	    $game2 = $tkuma->get_row("SELECT * FROM `danh_sach_game` WHERE `ma_game` = ? ",[$rowuser['ma_game']])['ten_game'] ?? 'SAI NỘI DUNG';
    	   // if($game2==''){$game2 = 'SAI NỘI DUNG';}
    	    $arr_reshisuer[] = array(
    	    	'phone' => substr($rowuser['phone'], 0, -5).'****',
    	    	'tranid' => '****' . substr($rowuser['tranId'], -4),
    	    	'comment' => $rowuser['comment'],
    	    	'money' => (int)$rowuser['amount_play'],
    	    	'bonus' => (int)$rowuser['amount_game'],
    	    	'gameName' => $game2,
    	    	'content' => $rowuser['comment'],
    	    	'result' => $rowuser['status'],
    	    	'time' => $rowuser['time'],
    	    	'trangthai' => $rowuser['result_text']
    	    );
        }
    }
    $tkuma->WebSocket('loadhisuser',$arr_reshisuer,1,$sessiond);
}
function pinghistory()
{
    $tkuma = new DB;
    $arr_reshis = array();
    foreach ($tkuma->get_list("SELECT * FROM `lich_su_choi` WHERE `type_gd` = ? AND `result` = ? AND `result_text` = ? ORDER BY `id` DESC LIMIT 10",['real','success','CHIẾN THẮNG']) as $rowd)
    {
    	$gamed = $tkuma->get_row("SELECT * FROM `danh_sach_game` WHERE `ma_game` = ? ",[$rowd['ma_game']]);
    	$arr_reshis[] = array(
    	    	'phone' => substr($rowd['partnerName'], 0, -5).'****',
    	    	'tranid' => '****' . substr($rowd['tranId'], -4),
    	    	'comment' => $rowd['comment'],
    	    	'money' => (int)$rowd['amount_play'],
    	    	'bonus' => (int)$rowd['amount_game'],
    	    	'gameName' => $gamed['ten_game'],
    	    	'content' => $rowd['comment'],
    	    	'result' => $rowd['status'],
    	    	'time' => $rowd['time'],
    	    	'trangthai' => $rowd['result_text']
    	    );
    	    
    }
    $tkuma->WebSocket('tableHistory',$arr_reshis);
}

function balancemb($token)
{
    
    $tkuma = new DB;
    //check thông tin
    $rows = $tkuma->get_row(" SELECT * FROM `account_mbbank` WHERE `token` = ? AND `status` = ? ",[$token,'success']);
    if ($rows) {
            $mbbank = new MBB($rows['phone'], $rows['password'], $rows['stk']);
			$gethistt = json_encode($mbbank->getBalance());
			$gethistt = json_decode($gethistt, true);
			if ($gethistt['result']['responseCode'] != '00') {
				$tam = json_encode($mbbank->doLogin());
		        if ($tam->result->responseCode == 00) {
					$gethistt = json_encode($mbbank->getBalance());
					$gethistt = json_decode($gethistt, true);
				}  
			}
			if (isset($gethistt['totalBalanceEquivalent'])) {
			    $money = isset($gethistt['totalBalanceEquivalent']) ? $gethistt['totalBalanceEquivalent'] : 0;
    			if (preg_replace('/[^\d]/', '', $money) != '0') {
    				$tkuma->update("account_mbbank",['BALANCE' => preg_replace('/[^\d]/', '', $money),]," `stk` = ?  ",[$rows['stk']]);
    			}
    			return array('status' => '200', 'SoDu' => '' . preg_replace('/[^\d]/', '', $money) . '');
		    } 
		    else {
			    return array('status' => '99', 'SoDu' => '0');
		    }
    }
}

function balancemb2($token)
{
    	sendMessTelegramNew('bắt đầu update balance!');
    $tkuma = new DB;
    //check thông tin
    $rows = $tkuma->get_row(" SELECT * FROM `account_mbbank2` WHERE `token` = ? AND `status` = ? ",[$token,'success']);
    sendMessTelegramNew("token: " . $token);
    if ($rows) {
            $mbbank = new MBB2($rows['phone'], $rows['password'], $rows['stk']);
			$gethistt = json_encode($mbbank->getBalance());
			$gethistt = json_decode($gethistt, true);
			if ($gethistt['result']['responseCode'] != '00') {
				$tam = json_encode($mbbank->doLogin());
		        if ($tam->result->responseCode == 00) {
					$gethistt = json_encode($mbbank->getBalance());
					$gethistt = json_decode($gethistt, true);
				}  
			}
			if (isset($gethistt['totalBalanceEquivalent'])) {
			    $money = isset($gethistt['totalBalanceEquivalent']) ? $gethistt['totalBalanceEquivalent'] : 0;
    			if (preg_replace('/[^\d]/', '', $money) != '0') {
    				$tkuma->update("account_mbbank2",['BALANCE' => preg_replace('/[^\d]/', '', $money),]," `stk` = ?  ",[$rows['stk']]);
    			}
    			return array('status' => '200', 'SoDu' => '' . preg_replace('/[^\d]/', '', $money) . '');
		    } 
		    else {
			    return array('status' => '99', 'SoDu' => '0');
		    }
    }
}

function chonglo($tranId, $comment)
{
	$tkuma = new DB;

    $tylera = random('0123456789', '1');
	if ($tylera < $tkuma->site('tylethua')) {
		for ($i = 1; $i < 1000; $i++) {
			$tranId_5 = substr($tranId, 0, -1) . random('0123456789', '1');
			$result = CHECK_STATUS_GAME($comment, $tranId_5);
			if ($result == "") {
				break;
			}
		}
		return $tranId_5;
	} else {
	    for ($i = 1; $i < 1000; $i++) {
			$randidd = substr($tranId, 0, -1) . random('0123456789', '1');
			$resultt = CHECK_STATUS_GAME($comment, $randidd);
			if ($resultt != "") {
				break;
			}
		}
		return $randidd;
	}
}
function balancebidv($token)
{
 	$tkuma = new DB;
	//check thông tin
	$getData = $tkuma->get_row(" SELECT * FROM `account_bidv` WHERE `id` = ? AND `sessionId` != '' AND `status` = 'success' LIMIT 1",[$token]);
	if ($getData) {
		$app = new BIDV($getData['username'], $getData['password'], check_string($getData['account_number']));
		$balance = json_encode($app->getBalance());
		$balanceb = json_decode($balance, true);
		if ($balanceb['code'] != '00') {
			$tam = json_encode($app->doLogin());
		}
		if (isset($balanceb['lstTotal'])) {
			$money = isset($balanceb['lstTotal']['0']['amount']) ? $balanceb['lstTotal']['0']['amount'] : 0;
			if (preg_replace('/[^\d]/', '', $money) != '0') {
				$tkuma->update(
					"account_bidv",
					[
						'BALANCE'              => preg_replace('/[^\d]/', '', $money),
					],
					" `id` = ?  ",[$getData['id']]
				);
			}
			return array('status' => '200', 'SoDu' => '' . preg_replace('/[^\d]/', '', $money) . '');
		} else {
			return array('status' => '99', 'SoDu' => '0');
		}
	}
}
function checkremove($bank)
{
 	$tkuma = new DB;
	//check thông tin
	$getData = $tkuma->get_row(" SELECT * FROM `account_$bank` WHERE `status` = ? ",['LOGIN']);
	if ($getData) {
		$tkuma->remove("account_$bank", "`status` = ? ",['LOGIN']);
	}
}
function encrypt($string, $key)
{
	$rsa = new RSA();
	$rsa->loadKey($key);
	$endeco = $rsa->encrypt($string);
	return base64_encode($endeco);
}
function decrypt($string, $key)
{
	$rsa = new RSA();
	$rsa->loadKey($key);
	$decode = base64_decode($string);
	return $rsa->decrypt($decode);
}
function kuma_enc($string)
{
	return encrypt($string, publickey);
}

function kuma_dec($string)
{
	return decrypt($string, privatekey);
}
function display($data)
{
	if ($data == 'HIDE') {
		$show = '<span class="badge badge-danger">ẨN</span>';
	} else if ($data == 'SHOW') {
		$show = '<span class="badge badge-success">HIỂN THỊ</span>';
	}
	return $show;
}

function is_admin()
{
	$tkuma = new DB;
	if (isset($_SESSION['admin_login'])) {
		$id_admin = id_admin;
		$getUser = $tkuma->get_row(" SELECT `id` FROM `users` WHERE `token` = ? ",[$_SESSION['admin_login']])["id"];
		if ($getUser == $id_admin) {
			return true;
		}
		return false;
	}
	return false;
}

function format_cred($str)
{
	// Tìm vị trí của chuỗi "CUSTOMER"
	$startPos = strpos($str, "CUSTOMER");
	// Tìm vị trí của chuỗi ". TU"
	$endPos = strpos($str, ". TU");
	if ($startPos !== false && $endPos !== false) {
		// Lấy phần tử từ vị trí sau "CUSTOMER" cho đến trước ". TU"
		$result = substr($str, $startPos + strlen("CUSTOMER"), $endPos - ($startPos + strlen("CUSTOMER")));
		return $result; // Kết quả: tY9T43
	} else {
		return 0;
	}
}

function format_name($str)
{
	// Tìm vị trí của chuỗi "CUSTOMER"
	if (preg_match("/\. TU: (.*)/", $str, $matches)) {
		$result = $matches[1];
		return $result; // Kết quả: BUI DUC BINH
	} else {
		return 0;
	}
}

function cardtudong($telco, $amount, $serial, $pin, $request_id){
    $tkuma = new DB;
    
    $url_apithe = $tkuma->site('url_apithe');
    
    $url = "$url_apithe/chargingws/v2";
    
    $dataPost = array(
		"request_id" => $request_id,
		"code" => $pin,
		"partner_id" => $tkuma->site('partner_id'),
		"serial" => $serial,
		"telco" => $telco,
		"command" => 'charging',
		"amount" => $amount,
		"sign" => md5($tkuma->site('partner_key').$pin.$serial)
	);
    $result = curl_post($url,$dataPost);
    
    return $result;
}

function checkFormatCard($type, $seri, $pin)
{
    $seri = strlen($seri);
    $pin = strlen($pin);
    $data = [];
    if ($type == 'Viettel' || $type == "viettel" || $type == "VT" || $type == "VIETTEL") {
        if ($seri != 11 && $seri != 14) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if ($pin != 13 && $pin != 15) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if ($type == 'Mobifone' || $type == "mobifone" || $type == "Mobi" || $type == "MOBIFONE") {
        if ($seri != 15) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if ($pin != 12) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if ($type == 'VNMB' || $type == "Vnmb" || $type == "VNM" || $type == "VNMOBI") {
        if ($seri != 16) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if ($pin != 12) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if ($type == 'Vinaphone' || $type == "vinaphone" || $type == "Vina" || $type == "VINAPHONE") {
        if ($seri != 14) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if ($pin != 14) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if ($type == 'Garena' || $type == "garena") {
        if ($seri != 9) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if ($pin != 16) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if ($type == 'Zing' || $type == "zing" || $type == "ZING") {
        if ($seri != 12) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if ($pin != 9) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    if ($type == 'Vcoin' || $type == "VTC") {
        if ($seri != 12) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài seri không phù hợp'
            ];
            return $data;
        }
        if ($pin != 12) {
            $data = [
                'status'    => false,
                'msg'       => 'Độ dài mã thẻ không phù hợp'
            ];
            return $data;
        }
    }
    $data = [
        'status'    => true,
        'msg'       => 'Success'
    ];
    return $data;
}

function setLanguage($id)
{
	$tkuma = new DB;
	if ($row = $tkuma->get_row("SELECT * FROM `theme` WHERE `id` = ? ",[$id])) {
		$isSet = setcookie('theme', $row['name'], time() + (31536000 * 30), "/"); // 31536000 = 365 ngày
		if ($isSet) {
			return true;
		} else {
			return false;
		}
	}
	return false;
}
// lấy ngôn ngữ mặc định
function getLanguage()
{
	$tkuma = new DB;
	if (isset($_COOKIE['theme'])) {
		$language = check_string($_COOKIE['theme']);
		$rowLang = $tkuma->get_row("SELECT * FROM `theme` WHERE `name` = ? ",[$language]);
		if ($rowLang) {
			return $rowLang['name'];
		}
	}
	$rowLang = $tkuma->get_row("SELECT * FROM `theme` WHERE `id` = ? ",['1']);
	if ($rowLang) {
		return $rowLang['name'];
	}
	return false;
}

function theme()
{
	$tkuma = new DB;
	if (isset($_COOKIE['theme'])) {
		$language = check_string($_COOKIE['theme']);
		$rowLang = $tkuma->get_row("SELECT * FROM `theme` WHERE `name` = ? ",[$language]);
		if ($rowLang) {
			$rowTran = $tkuma->get_row("SELECT * FROM `theme` WHERE `name` = ?  ",[$language]);
			if ($rowTran) {
				return $rowTran['name'];
			}
		}
	}
	$rowLang = $tkuma->get_row("SELECT * FROM `theme` WHERE `name` = ? ",[$tkuma->site('home_page')]);
	if ($rowLang) {
		$rowTran = $tkuma->get_row("SELECT * FROM `theme` WHERE `name` = ? ",[$tkuma->site('home_page')]);
		if ($rowTran) {
			return $rowTran['name'];
		}
	}
	return $name;
}


function curlPost2($url = "", $data = array())
{
	$curl = curl_init($url);
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json'
		),
		CURLOPT_POSTFIELDS => json_encode($data)
	));
	$response = curl_exec($curl);
	if ($response === false) {
		$error = curl_error($curl);
		curl_close($curl);
		return array('error' => $error);
	}
	curl_close($curl);
	return json_decode($response, true);
}

function checkCron($id_cron)
{
// 	global $config;
	$tkuma = new DB;
	if (time() > getRowRealtime('cronjobsact', $id_cron, 'timeload')) {
		if (time() - getRowRealtime('cronjobsact', $id_cron, 'timeload') < getRowRealtime('cronjobsact', $id_cron, 'maxload')) {
			return false;
		}
	}
	$tkuma->update("cronjobsact", ['timeload' => time()], " `id` = ? ",[$id_cron]);
	return true;
}

function xoadaucham($path)
{
	$arr = explode(",", trim($path));
	foreach ($arr as &$str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		$str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);

		$str = preg_replace('/\p{M}/u', '', $str); // Loại bỏ các ký tự đặc biệt
		$str = mb_strtolower($str, 'UTF-8'); // Chuyển về viết thường không dấu
		$str = preg_replace('/[^a-z0-9\s]/', '', trim($str)); // Loại bỏ các ký tự đặc biệt
		$str = preg_replace('/\s+/', '-', $str); // Thay thế khoảng trắng bằng dấu -
	}
	$str = implode(",", $arr);

	return $str;
}

function lamtronvnd($num)
{
	$last3digits = $num % 1000; // Lấy 3 số cuối
	if ($last3digits > 500) {
		$num = ceil($num / 1000) * 1000; // Làm tròn lên thành 1000
	} else {
		$num = floor($num / 1000) * 1000; // Làm tròn xuống thành 0
	}
	return $num; // Kết quả là 549000
}
function checkPackage($package, $array)
{
	foreach ($array as $row) {
		if ($row == $package) {
			return true;
		}
	}
	return false;
}

function tong2lay1($so)
{
    $soChuoi = strval($so);
    $tong_moi = 0;
    for ($i = 0; $i < strlen($soChuoi); $i++) {
        $so1 = intval($soChuoi[$i]);
        $tong_moi += $so1;
    }
    if ($tong_moi > 9) {
        $ketQua = intval(strval($tong_moi)[1]);
    } else {
        $ketQua = $tong_moi;
    }
    return $ketQua;
}
function totalDigitsOfNumber($n)
{
	define("DEC_10", 10);
	$total = 0;
	do {
		$total = $total + ($n % DEC_10);
		$n = floor($n / DEC_10);
	} while ($n > 0);
	return $total;
}
///tính hiệu
function subDigitsOfNumber($n)
{
	define("DEC_10", 10);
	$total = $n % DEC_10;
	$n = floor($n / DEC_10);
	do {
		$total = ($n % DEC_10) - $total;
		$n = floor($n / DEC_10);
	} while ($n > 0);
	return $total;
}
function checkvnv($comment, $sdtchoi)
{
	$now = date("Y/m/d");
	$tkuma = new DB;
	$result = $tkuma->num_rows("SELECT * FROM `user_nvn` WHERE `mocthuong` = ? AND `phone` = ? AND `time` >= '$now 00:00:00'" ,[$comment,$sdtchoi]);
	if ($result == 0) {
		return 0;
	} else {
		return 1;
	}
}
function checkcrontran($tranIdd)
{
	$now = date("Y/m/d 00:00:00");
	$tkuma = new DB;
	$result = $tkuma->num_rows("SELECT * FROM `lich_su_choi` WHERE `tranId` = ? AND `time` >= ? " ,[$tranIdd,$now]);
	if ($result != 0) {
		return true;
	}
	$result2 = $tkuma->get_row("SELECT * FROM `lich_su_choi` WHERE `tranId` = ? AND `time` >= ? ",[$tranIdd,$now]);
	if (!empty($result2)) {
		return true;
	}
	return false;
}
function checkcrontran2($tranIdd)
{
	$now = date("Y/m/d 00:00:00");
	$tkuma = new DB;
	$result = $tkuma->num_rows("SELECT * FROM `lich_su_choi` WHERE `tranId` = ? AND `time` >= ? " ,[$tranIdd,$now]);
	if ($result != 0) {
		return true;
	}
	$result2 = $tkuma->get_row("SELECT * FROM `lich_su_choi` WHERE `tranId` = ? AND `time` >= ? ",[$tranIdd,$now]);
	if (!empty($result2)) {
		return true;
	}
	$result3 = $tkuma->num_rows("SELECT * FROM `lich_su_choi` WHERE `tranid2` = ? AND `time` >= ? " ,[$tranIdd,$now]);
	if ($result != 0) {
		return true;
	}
	$result4 = $tkuma->get_row("SELECT * FROM `lich_su_choi` WHERE `tranid2` = ? AND `time` >= ? ",[$tranIdd,$now]);
	if (!empty($result2)) {
		return true;
	}
	return false;
}
function so_nguyen($price)
{
	return str_replace(",", "", number_format($price));
}
function doidauso($sdt)
{
	// Khai báo mảng chứa phần tử cần thay đổi
	$array = array(
		'0162' => '032',
		'0163' => '033',
		'0164' => '034',
		'0165' => '035',
		'0166' => '036',
		'0167' => '037',
		'0168' => '038',
		'0169' => '039',
		'0123' => '083',
		'0124' => '084',
		'0125' => '085',
		'0127' => '081',
		'0129' => '082',
		'0188' => '058',
		'0186' => '056',
		'0120' => '070',
		'0121' => '079',
		'0122' => '077',
		'0126' => '076',
		'0128' => '078'
	);

	// Lấy 4 ký tự đầu tiên
	$sdtp = substr($sdt, 0, 4);

	// Nếu số đầu không có trong mảng thì trả về định dạng gốc
	if (!array_key_exists($sdtp, $array)) return $sdt;

	// Thay đổi theo mảng.
	return str_replace($sdtp, $array[$sdtp], $sdt);
}

function chuyenmabidv($inputString) {
    $inputString = str_replace(' ', '', $inputString);
    $charMap = [
        'a' => 0, 'b' => 1, 'c' => 2, 'd' => 3, 'e' => 4,
        'f' => 5, 'g' => 6, 'h' => 7, 'i' => 8, 'j' => 9,
        'k' => 0, 'l' => 1, 'm' => 2, 'n' => 3, 'o' => 4,
        'p' => 5, 'q' => 2, 'r' => 7, 's' => 8, 't' => 9,
        'u' => 0, '-' => 1, 'v' => 2, 'w' => 3, '_' => 4,
        'x' => 5, 'y' => 6, 'z' => 9,
    ];
    $result = '';
    $len = strlen($inputString);
    for ($i = 0; $i < $len; $i++) {
        $char = strtolower($inputString[$i]);
        if (isset($charMap[$char])) {
            $result .= $charMap[$char];
        } else {
            // Nếu ký tự không có trong ánh xạ, giữ nguyên
            $result .= $inputString[$i];
        }
    }

    return $result;
}


function CHECK_STATUS_GAME($comment, $tranid)
{
	$tkuma = new DB;

	$CHECK_OPTION_GAME = $tkuma->get_list(" SELECT * FROM `settings_game` WHERE `comment` = ? ",[strtoupper($comment)]);
	if (!$CHECK_OPTION_GAME) {
		return array(
			"status" => "error",
			"message" => 'SAI NỘI DUNG'
		);
	}

	foreach ($CHECK_OPTION_GAME as $row_check) {
		$explode = (explode(',', $row_check['result']));
		$LAYSO =  $row_check['type'];
		$so_cuoi_tranId = substr($tranid, -$LAYSO);
		$CHECK_GAME = $tkuma->get_row(" SELECT * FROM `danh_sach_game` WHERE `ma_game` = ? ",[$row_check['keyd']]);
		$TYPE_GAME = $CHECK_GAME['type'];
		if ($TYPE_GAME == "socuoi") {
			$trandid_ac = $so_cuoi_tranId;
		} elseif ($TYPE_GAME == "tong") {
			$trandid_ac = totalDigitsOfNumber($so_cuoi_tranId);
		} elseif ($TYPE_GAME == "hieu") {
			$trandid_ac = subDigitsOfNumber($so_cuoi_tranId);
	    } elseif ($TYPE_GAME == "tong2lay1") {
			$trandid_ac = tong2lay1($so_cuoi_tranId);
		}
		foreach ($explode as $row) {
			if ($trandid_ac == $row) {
				return array(
					"status" => "success",
					"message" => 'CHIẾN THẮNG',
					"comment"  => $comment,
					"tranId"  => $tranid,
					"game" => '' . $CHECK_GAME['ten_game'] . '',
					"key" => '' . $CHECK_GAME['ma_game'] . '',
					"tile" => '' . $row_check['tile'] . ''
				);
				exit();
			} else {
				continue;
			}
		}
	}
}

function milisc()
{
	return round(microtime(true) * 1000);;
}

function CreateToken()
{
	return random('qwertyuiopasdfghjklzxcvbxnmQWERTYUIOPASDFGHJKLZXVCBNM123456789', '24');
}

function numberFormat($number)
{
	if ($number > 999 && $number < 1e6) {
		return round($number / 1e3, 2) . "K";
	} elseif ($number >= 1e6) {
		return round($number / 1e6, 2) . "M";
	} else {
		return number_format($number);
	}
}


function KETQUA_BILL($comment, $tranid)
{
	$tkuma = new DB;
	$result = CHECK_STATUS_GAME($comment, $tranid);
	if ($result != "") {
		return $result;
	} else {
		$CHECK_GAME = $tkuma->get_row(" SELECT * FROM `settings_game` WHERE `comment` = ? ",[strtoupper($comment)]);
		$NAME = $tkuma->get_row(" SELECT * FROM `danh_sach_game` WHERE `ma_game` = ? ",[$CHECK_GAME['keyd']]);
		return array(
			"status" => "error",
			"message" => "THUA CUỘC",
			"comment"  => $comment,
			"tranId"  => $tranid,
			"game" => '' . $NAME['ten_game'] . '',
			"key" => '' . $NAME['ma_game'] . '',
			"tile" => 0
		);
	}
}
function isInteger($input)
{
	return (ctype_digit(strval($input)));
}
function is_valid_domain_name($domain_name)
{
	return (preg_match("/^([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) && preg_match("/^.{1,253}$/", $domain_name) && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name));
}

function sendMessTelegram($my_text)
{
	$tkuma = new DB;
	if ($tkuma->site('token_telegram') != '' && $tkuma->site('id_telegram') != '') {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.telegram.org/bot' . $tkuma->site('token_telegram') . '/sendMessage?chat_id=' . $tkuma->site('id_telegram') . '&text=' . urlencode($my_text),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 10,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
	return true;
}

function sendMessTelegramNew($message, $title = '') {
    $token = '7122725402:AAGXxMjMiWR7t674vFT8cHrcZsDwQg7fdoQ';
    $chat_id = '-1002160870301'; // Thay thế bằng ID chat của bạn
    $url = "https://api.telegram.org/bot$token/sendMessage";
    
  // Kiểm tra nếu $message là JSON và chuyển đổi sang UTF-8 nếu cần
  if (is_string($message) && is_array(json_decode($message, true)) && (json_last_error() == JSON_ERROR_NONE)) {
    $message = $title . json_encode(json_decode($message, true), JSON_UNESCAPED_UNICODE);
  }
  else {
    $message = $title . $message;
  }
    $data = [
        'chat_id' => $chat_id,
        'text' => $message
    ];

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url, // Đảm bảo rằng URL được thiết lập
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true, // Đảm bảo rằng phương thức POST được sử dụng
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded; charset: UTF-8"
        ),
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 100,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    ));
    
    $response = curl_exec($curl);

  // Kiểm tra lỗi cURL
    if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        curl_close($curl);
        // Xử lý lỗi, ví dụ: ghi log hoặc trả về lỗi
        error_log("cURL error: " . $error_msg);
        return "Failed to send message: " . $error_msg;
    }

    curl_close($curl);
    return $response;
}



function getRandomWeightedElement(array $weightedValues)
{
	$Rand = mt_Rand(1, (int) array_sum($weightedValues));
	foreach ($weightedValues as $key => $value) {
		$Rand -= $value;
		if ($Rand <= 0) {
			return $key;
		}
	}
}


function active_sidebar_client($action)
{
	foreach ($action as $row) {
		$row2 = explode('/', $row);
		if ($row2[1]) {
			if (isset($_GET['shop']) && $_GET['shop'] == $row2[1]) {
				return 'active';
			}
		}
		if (isset($_GET['action']) && $_GET['action'] == $row) {
			return 'active';
		}
	}
	return '';
}
function show_sidebar_client($action)
{
	foreach ($action as $row) {
		if (isset($_GET['action']) && $_GET['action'] == $row) {
			return 'show';
		}
	}
	return '';
}
function parse_order_id($des)
{
	$tkuma = new DB;
	$re = '/' . $tkuma->site('ndnaptien') . '\d+/im';
	preg_match_all($re, $des, $matches, PREG_SET_ORDER, 0);
	if (count($matches) == 0)
		return null;
	// Print the entire match result
	$orderCode = $matches[0][0];
	$prefixLength = strlen($tkuma->site('ndnaptien'));
	$orderId = intval(substr($orderCode, $prefixLength));
	return $orderId;
}
function checktamhoa($comment, $sdtchoi)
{
	$now = date("Y/m/d");
	$tkuma = new DB;
	$result = $tkuma->num_rows("SELECT * FROM `user_giftcode` WHERE `giftcode` = ? AND `phone` = ? ",[$comment,$sdtchoi]);
	if ($result == 0) {
		return 0;
	} else {
		return 1;
	}
}
// check sảnh 3 số
function isSequential3($number) {
    $numberStr = (string)$number; // Chuyển số thành chuỗi để dễ xử lý

    // Kiểm tra xem dãy số có ít nhất 3 chữ số không
    if (strlen($numberStr) < 3) {
        return false;
    }

    // Lặp qua các chữ số từ phải qua trái
    for ($i = strlen($numberStr) - 1; $i >= 2; $i--) {
        $currentDigit = (int)$numberStr[$i];
        $prevDigit = (int)$numberStr[$i - 1];
        $prevPrevDigit = (int)$numberStr[$i - 2];

        // Kiểm tra xem 3 số cuối có tạo thành sảnh tiến không
        if ($currentDigit !== $prevDigit + 1 || $prevDigit !== $prevPrevDigit + 1) {
            return false;
        }
    }

    return true;
}
// check sảnh 4 số
function isSequential4($number) {
    $numberStr = (string)$number; // Chuyển số thành chuỗi để dễ xử lý

    // Kiểm tra xem dãy số có ít nhất 4 chữ số không
    if (strlen($numberStr) < 4) {
        return false;
    }

    // Lặp qua các chữ số từ phải qua trái
    for ($i = strlen($numberStr) - 1; $i >= 3; $i--) {
        $currentDigit = (int)$numberStr[$i];
        $prevDigit = (int)$numberStr[$i - 1];
        $prevPrevDigit = (int)$numberStr[$i - 2];
        $prevPrevPrevDigit = (int)$numberStr[$i - 3];

        // Kiểm tra xem 4 số cuối có tạo thành sảnh tiến không
        if ($currentDigit !== $prevDigit + 1 ||
            $prevDigit !== $prevPrevDigit + 1 ||
            $prevPrevDigit !== $prevPrevPrevDigit + 1) {
            return false;
        }
    }

    return true;
}
// check sảnh 5 số
function isSequential5($number) {
    $numberStr = (string)$number; // Chuyển số thành chuỗi để dễ xử lý

    // Kiểm tra xem dãy số có ít nhất 5 chữ số không
    if (strlen($numberStr) < 5) {
        return false;
    }

    // Lặp qua các chữ số từ phải qua trái
    for ($i = strlen($numberStr) - 1; $i >= 4; $i--) {
        $currentDigit = (int)$numberStr[$i];
        $prevDigit = (int)$numberStr[$i - 1];
        $prevPrevDigit = (int)$numberStr[$i - 2];
        $prevPrevPrevDigit = (int)$numberStr[$i - 3];
        $prevPrevPrevPrevDigit = (int)$numberStr[$i - 4];

        // Kiểm tra xem 5 số cuối có tạo thành sảnh tiến không
        if ($currentDigit !== $prevDigit + 1 ||
            $prevDigit !== $prevPrevDigit + 1 ||
            $prevPrevDigit !== $prevPrevPrevDigit + 1 ||
            $prevPrevPrevDigit !== $prevPrevPrevPrevDigit + 1) {
            return false;
        }
    }

    return true;
}
// check tam hoa
function tamhoa($number) {
    $numberStr = (string)$number; // Chuyển số thành chuỗi để dễ xử lý

    // Kiểm tra xem dãy số có ít nhất 3 chữ số không
    if (strlen($numberStr) < 3) {
        return false;
    }

    // Lấy 3 số cuối cùng của dãy số
    $lastThreeDigits = substr($numberStr, -3);

    // Kiểm tra xem 3 số cuối có giống nhau không
    if ($lastThreeDigits[0] === $lastThreeDigits[1] &&
        $lastThreeDigits[1] === $lastThreeDigits[2]) {
        return true;
    }

    return false;
}
// check tam hoa
function tuquy($number) {
    $numberStr = (string)$number; // Chuyển số thành chuỗi để dễ xử lý

    // Kiểm tra xem dãy số có ít nhất 4 chữ số không
    if (strlen($numberStr) < 4) {
        return false;
    }

    // Lấy 4 số cuối cùng của dãy số
    $lastFourDigits = substr($numberStr, -4);

    // Kiểm tra xem 4 số cuối có giống nhau không
    if ($lastFourDigits[0] === $lastFourDigits[1] &&
        $lastFourDigits[1] === $lastFourDigits[2] &&
        $lastFourDigits[2] === $lastFourDigits[3]) {
        return true;
    }

    return false;
}
//check ngu quy
function nguquy($number) {
    $numberStr = (string)$number; // Chuyển số thành chuỗi để dễ xử lý

    // Kiểm tra xem dãy số có ít nhất 5 chữ số không
    if (strlen($numberStr) < 5) {
        return false;
    }

    // Lấy 5 số cuối cùng của dãy số
    $lastFiveDigits = substr($numberStr, -5);

    // Kiểm tra xem 5 số cuối có giống nhau không
    if ($lastFiveDigits[0] === $lastFiveDigits[1] &&
        $lastFiveDigits[1] === $lastFiveDigits[2] &&
        $lastFiveDigits[2] === $lastFiveDigits[3] &&
        $lastFiveDigits[3] === $lastFiveDigits[4]) {
        return true;
    }

    return false;
}
function parse_order_name($des)
{
    $tkuma = new DB;
    $re = '/' . $tkuma->site('ndnaptien') . '[^\s.-]+/im'; // [^\s.]+ sẽ match các ký tự không phải dấu cách và không phải dấu chấm
    preg_match_all($re, $des, $matches, PREG_SET_ORDER, 0);
    if (count($matches) == 0)
        return null;
    // Print the entire match result
    $orderCode = $matches[0][0];
    $prefixLength = strlen($tkuma->site('ndnaptien'));
    $orderId = substr($orderCode, $prefixLength); // không cần chuyển đổi sang số nguyên vì có thể chứa ký tự chữ
    return $orderId;
}
function display_service($status)
{
	if ($status == 0) {
		return ' <b style="color:blue;">Đang chờ xử lý</b>';
	} else if ($status == 3) {
		return '<b style="color:blue;">Đang chạy</b>';
	} elseif ($status == 1) {
		return '<b style="color:green;">Hoàn tất</b>';
	} elseif ($status == 2) {
		return '<b style="color:red;">Huỷ</b>';
	} else {
		return '<b style="color:yellow;">Khác</b>';
	}
}

function trangthais($status)
{
	if ($status == 'CHIẾN THẮNG') {
		return '<b style="color:green;">CHIẾN THẮNG</b>';
	} else if ($status == 'THUA CUỘC') {
		return '<b style="color:red;">THUA CUỘC</b>';
	} elseif ($status == 'Hoàn Tiền') {
		return '<b style="color:blue;">Hoàn Tiền</b>';
	} elseif ($status == 'TIỀN CHƠI KHÔNG HỢP LỆ') {
		return '<b style="color:Chocolate;">Sai MinM</b>';
	} elseif ($status == 'sainoidung') {
		return '<b style="color:Chocolate;">Chờ hoàn tiền</b>';
	} elseif ($status == 'getotp') {
		return '<b style="color:Chocolate;">Đang hoàn tiền</b>';
	} elseif ($status == 'success') {
		return '<b style="color:Chocolate;">Đã hoàn tiền</b>';
	} else {
		return '<b style="color:Fuchsia;">Khác</b>';
	}
}


function display_service_client($status)
{
	if ($status == 0) {
		return '<span class="badge bg-info">Đang chờ xử lý</span>';
	} elseif ($status == 1) {
		return '<span class="badge bg-success">Hoàn tất</span>';
	} elseif ($status == 2) {
		return '<span class="badge bg-danger">Huỷ</span>';
	} elseif ($status == 3) {
		return '<span class="badge bg-warning">Đang chạy</span>';
	} else {
		return '<span class="badge bg-warning">Khác</span>';
	}
}
function display_card($status)
{
	if ($status == 0) {
		return '<p class="mb-0 text-info font-weight-bold d-flex justify-content-start align-items-center">' . __('Đang chờ xử lý') . '</p>';
	} elseif ($status == 1) {
		return '<p class="mb-0 text-success font-weight-bold d-flex justify-content-start align-items-center">' . __('Thành công') . '</p>';
	} elseif ($status == 2) {
		return '<p class="mb-0 text-danger font-weight-bold d-flex justify-content-start align-items-center">' . __('Thất bại') . '</p>';
	} else {
		return '<b style="color:yellow;">Khác</b>';
	}
}
// display hoá đơn
function display_invoice($status)
{
	if ($status == 0) {
		return '<p class="mb-0 text-warning font-weight-bold d-flex justify-content-start align-items-center">
        <small><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 24 24" fill="none">                                                
        <circle cx="12" cy="12" r="8" fill="#db7e06"></circle></svg>
        </small>' . __('Đang chờ thanh toán') . '</p>';
	} elseif ($status == 1) {
		return '<p class="mb-0 text-success font-weight-bold d-flex justify-content-start align-items-center">
        <small><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 24 24" fill="none">                                                
        <circle cx="12" cy="12" r="8" fill="#3cb72c"></circle></svg>
        </small>' . __('Đã thanh toán') . '</p>';
	} elseif ($status == 2) {
		return '<p class="mb-0 text-danger font-weight-bold d-flex justify-content-start align-items-center">
        <small><svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="18" viewBox="0 0 24 24" fill="none">                                                
        <circle cx="12" cy="12" r="8" fill="#F42B3D"></circle></svg>
        </small>' . __('Huỷ bỏ') . '</p>';
	} else {
		return '<b style="color:yellow;">Khác</b>';
	}
}
function display_invoice_text($status)
{
	if ($status == 0) {
		return __('Đang chờ thanh toán');
	} elseif ($status == 1) {
		return __('Đã thanh toán');
	} elseif ($status == 2) {
		return __('Huỷ bỏ');
	} else {
		return __('Khác');
	}
}
// lấy dữ liệu theo thời gian thực
function getRowRealtime($table, $id, $row)
{
	$tkuma = new DB;
	return $tkuma->get_row("SELECT * FROM `$table` WHERE `id` = ? ",[$id])[$row];
}
function getRowRealtime2($table,$table2, $id, $row)
{
	$tkuma = new DB;
	return $tkuma->get_row("SELECT * FROM `$table` WHERE `$table2` = ? ",[$id])[$row];
}
function BASE_($url)
{
	global $base_url;
	return $base_url . $url;
}
// Hàm tạo URL
function base_url($url = '')
{
	$a = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
	if ($a == 'http://localhost') {
		$a = 'http://localhost';
	}
	$base_urld = 'https://' . $_SERVER['SERVER_NAME'];
	return $a . '/' . $url;
}
function base_url_admin($url = '')
{
	$a = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
	if ($a == 'http://localhost') {
		$a = 'https://localhost';
	}
	return $a . '/admin/' . $url;
}
// mã hoá password
function TypePassword($password)
{
	$tkuma = new DB();
	if ($tkuma->site('type_password') == 'md5') {
		return md5($password);
	}
	if ($tkuma->site('type_password') == 'bcrypt') {
		return password_hash($password, PASSWORD_BCRYPT);
	}
	if ($tkuma->site('type_password') == 'sha1') {
		return sha1($password);
	}
	if ($tkuma->site('type_password') == 'RAS') {
		return kuma_enc($password);
	}
	return $password;
}
// lấy thông tin user theo id
function getUser($id, $row)
{
	$tkuma = new DB();
	return $tkuma->get_row("SELECT * FROM `users` WHERE `id` = ? ",[$id])[$row];
}
// check định dạng email
function check_email($data)
{
	if (preg_match('/^.+@.+$/', $data, $matches)) {
		return true;
	} else {
		return false;
	}
}
// check định dạng số điện thoại
function check_phone($data)
{
	if (preg_match('/^\+?(\d.*){3,}$/', $data, $matches)) {
		return true;
	} else {
		return false;
	}
}
// get datatime
function gettime()
{
	return date('Y/m/d H:i:s', time());
}
//format money
function format_currency($amount)
{
	$tkuma = new DB();
	if($amount == '') {$amount = '0';};
	$currency = $tkuma->site('currency');
	if ($currency == 'USD') {
		return '$' . number_format($amount / $tkuma->site('usd_rate'), 2, '.', '');
	} elseif ($currency == 'VND') {
		return number_format($amount, 0, ',', '.') . 'đ';
	}
}
//show ip
function getStartAndEndDate()
{
	global $year;
	$date = date('Y-m-d');
	while (date('w', strtotime($date)) != 1) {
		$tmp = strtotime('-1 day', strtotime($date));
		$date = date('Y-m-d', $tmp);
	}
	$week = date('W', strtotime($date));

	$week_start = new DateTime();
	$week_start->setISODate($year, $week);
	$return[0] = $week_start->format('d-M-Y');
	$time = strtotime($return[0], time());
	$time += 6 * 24 * 3600;
	$return[1] = date('d-M-Y', $time);
	return $return;
}
function getTimeStartTuan()
{
	$ngay  = strtotime(getStartAndEndDate()[0]);
	return $ngay;
}
function getTimeEndTuan()
{

	$ngay  = strtotime(getStartAndEndDate()[1]);
	return $ngay;
}
function getStartTuan($tuan)
{

	if ($tuan == 1) {
		$day = 1;
	} else if ($tuan == 2) {
		$day = 8;
	} else if ($tuan == 3) {
		$day = 15;
	} else if ($tuan == 4) {
		$day = 21;
	} else if ($tuan == 5) {
		$day = 28;
	}
	return $day;
}

function randomColor()
{
	$str = '#';
	for ($i = 0; $i < 6; $i++) {
		$randNum = rand(0, 15);
		switch ($randNum) {
			case 10:
				$randNum = 'A';
				break;
			case 11:
				$randNum = 'B';
				break;
			case 12:
				$randNum = 'C';
				break;
			case 13:
				$randNum = 'D';
				break;
			case 14:
				$randNum = 'E';
				break;
			case 15:
				$randNum = 'F';
				break;
		}
		$str .= $randNum;
	}
	return $str;
}

function STATUS_HISS($a)
{
	if ($a == "success") {
		return '<span class="label label-success text-uppercase">Thắng</span>';
	} elseif ($a == "error") {
		return '<span class="label label-danger text-uppercase">Thua</span>';
	}
}

function myip()
{
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip_address = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip_address = $_SERVER['REMOTE_ADDR'];
	}
	return check_string($ip_address);
}
function check_string3($data)
{
	return trim(htmlspecialchars($data));
	//return str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($data))));
}

// lọc input
function check_string($data)
{
	return trim(htmlspecialchars(addslashes($data)));
	//return str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($data))));
}
function check_so($data)
{
	return trim(htmlspecialchars(addslashes($data)));
	//return str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($data))));
}
function check_string2($data) {
    $data = trim($data); // Loại bỏ khoảng trắng ở đầu và cuối chuỗi
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8'); // Ngăn chặn XSS
    // $data = mysqli_real_escape_string($conn, $data); // Ngăn chặn SQL injectioch
    $data = preg_replace('/[^a-zA-Z0-9]/', '', $data);
    return $data;
}
function EPOST($key)
{
    return isset($_POST[$key]) ? check_string2($_POST[$key]) : false;
}
// Hàm lấy value từ $_GET
function EGET($key)
{
	return isset($_GET[$key]) ? check_string2($_GET[$key]) : false;
}

// định dạng tiền tệ
function format_cash($number, $suffix = '')
{
	return number_format($number, 0, ',', '.') . "{$suffix}";
}
function create_slug($string)
{
	$search = array(
		'#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
		'#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
		'#(ì|í|ị|ỉ|ĩ)#',
		'#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
		'#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
		'#(ỳ|ý|ỵ|ỷ|ỹ)#',
		'#(đ)#',
		'#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
		'#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
		'#(Ì|Í|Ị|Ỉ|Ĩ)#',
		'#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
		'#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
		'#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
		'#(Đ)#',
		"/[^a-zA-Z0-9\-\_]/",
	);
	$replace = array(
		'a',
		'e',
		'i',
		'o',
		'u',
		'y',
		'd',
		'A',
		'E',
		'I',
		'O',
		'U',
		'Y',
		'D',
		'-',
	);
	$string = preg_replace($search, $replace, $string);
	$string = preg_replace('/(-)+/', '-', $string);
	$string = strtolower($string);
	return $string;
}
function create_namebot()
{
    $tkuma = new DB();
    $string = explode(",", $tkuma->site('randomnamebot'))[array_rand(explode(",", $tkuma->site('randomnamebot')))];
    $search = array(
        '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
        '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
        '#(ì|í|ị|ỉ|ĩ)#',
        '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
        '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
        '#(ỳ|ý|ỵ|ỷ|ỹ)#',
        '#(đ)#',
        '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
        '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
        '#(Ì|Í|Ị|Ỉ|Ĩ)#',
        '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
        '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
        '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
        '#(Đ)#',
        "/[^a-zA-Z0-9\-\_]/",
    );
    $replace = array(
        'a',
        'e',
        'i',
        'o',
        'u',
        'y',
        'd',
        'A',
        'E',
        'I',
        'O',
        'U',
        'Y',
        'D',
        '-',
    );
    $string = preg_replace($search, $replace, $string);
    $string = preg_replace('/(-)+/', '', $string);
    $string = trim($string, ' '); // Trim hyphens at the beginning and end
    $string = strtolower($string);
    return $string;
}
// curl get
function curl_get($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
function curl_get2($url)
{
	$ch = curl_init();
	curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
        ),
    ));
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
function curl_get3($url, $dataPosts)
{
	$dataPost = array(
		"action" => "history",
		"token" => $dataPosts,
	);
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => $dataPost,
	));
	$response = curl_exec($ch);
	curl_close($ch);
	return json_decode($response);
}

function curl_post($url, $dataPosts)
{
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => $dataPost,
	));
	$response = curl_exec($ch);
	curl_close($ch);
	return json_decode($response);
}

function delllsgd($token)
{
	$current_time = time();
	$tkuma = new DB();
	if ($tkuma->site('status_del') != 0) {
		$dell = $tkuma->get_list("SELECT * FROM `lich_su_choi` ");
		foreach ($dell as $row) {
			if (($current_time - $row['time_tran']) > $tkuma->site('time_del')) {
				$DEL = $tkuma->remove("lich_su_choi", "`id` = ? ",[$row['id']]);
			}
		}
	}
}


// hàm tạo string random
function random($string, $int)
{
	return substr(str_shuffle($string), 0, $int);
}
// Hàm redirect
function redirect($url)
{
	header("Location: {$url}");
	exit();
}

function active_post($slug)
{
	foreach ($slug as $row) {
		if (isset($_GET['slug']) && $_GET['slug'] == $row) {
			return 'active';
		}
	}
}
function show_sidebar($action)
{
	foreach ($action as $row) {
		if (isset($_GET['action']) && $_GET['action'] == $row) {
			return 'show';
		}
	}
	return '';
}
// show active sidebar AdminLTE3
function active_sidebar($action)
{
	foreach ($action as $row) {
		if (isset($_GET['action']) && $_GET['action'] == $row) {
			return 'active';
		}
	}
	return '';
}
function menuopen_sidebar($action)
{
	foreach ($action as $row) {
		if (isset($_GET['action']) && $_GET['action'] == $row) {
			return 'menu-open';
		}
	}
	return '';
}

// Hàm kiểm tra submit
function is_submit($key)
{
	return (isset($_POST['request_name']) && $_POST['request_name'] == $key);
}

function display_mark($data)
{
	if ($data == 1) {
		$show = '<span class="badge badge-success">Có</span>';
	} elseif ($data == 0) {
		$show = '<span class="badge badge-danger">Không</span>';
	}
	return $show;
}

// display banned
function display_banned($banned)
{
	if ($banned != 1) {
		return '<span class="badge badge-success">Active</span>';
	} else {
		return '<span class="badge badge-danger">Banned</span>';
	}
}
// display online
function display_online($time)
{
	if (time() - $time <= 300) {
		return '<span class="badge badge-success">Online</span>';
	} else {
		return '<span class="badge badge-danger">Offline</span>';
	}
}
// hiển thị cờ quốc gia
function display_flag($data)
{
	return '<img src="https://flagcdn.com/40x30/' . $data . '.png" >';
}
function display_bank($data)
{
	if ($data == 'MBBank') {
	    return 'https://api.vietqr.io/img/MB.png';
	} elseif ($data == 'VietCombank') {
		return 'https://api.vietqr.io/img/VCB.png';
	} elseif ($data == 1) {
		return 'https://api.vietqr.io/img/ICB.png';
	}  elseif ($data == 'BIDV') {
		return 'https://api.vietqr.io/img/BIDV.png';
	} elseif ($data == 0) {
		return 'https://api.vietqr.io/img/VCB.png';
	}

}
function display_bankusser($data)
{
	if ($data == 7) {
	    return 'https://api.vietqr.io/img/MB.png';
	} elseif ($data == 2) {
		return 'https://api.vietqr.io/img/VCB.png';
	} elseif ($data == 1) {
		return 'https://api.vietqr.io/img/ICB.png';
	} elseif ($data == 4) {
		return 'https://api.vietqr.io/img/TPB.png';
	} elseif ($data == 5) {
		return 'https://api.vietqr.io/img/HDB.png';
	} elseif ($data == 6) {
		return 'https://api.vietqr.io/img/VPB.png';
	} elseif ($data == 8) {
		return 'https://api.vietqr.io/img/OCEANBANK.png';
	} elseif ($data == 9) {
		return 'https://api.vietqr.io/img/BIDV.png';
	} elseif ($data == 10) {
		return 'https://api.vietqr.io/img/SCB.png';
	} elseif ($data == 11) {
		return 'https://api.vietqr.io/img/ACB.png';
	} elseif ($data == 12) {
		return 'https://api.vietqr.io/img/ABB.png';
	} elseif ($data == 13) {
		return 'https://api.vietqr.io/img/CIMB.png';
	} elseif ($data == 14) {
		return 'https://api.vietqr.io/img/EIB.png';
	} elseif ($data == 15) {
		return 'https://api.vietqr.io/img/SEAB.png';
	} elseif ($data == 16) {
		return 'https://api.vietqr.io/img/SCB.png';
	} elseif ($data == 17) {
		return 'https://api.vietqr.io/img/DOB.png';
	} elseif ($data == 18) {
		return 'https://api.vietqr.io/img/SGICB.png';
	} elseif ($data == 19) {
		return 'https://api.vietqr.io/img/PGB.png';
	} elseif ($data == 20) {
		return 'https://api.vietqr.io/img/PVCB.png';
	} elseif ($data == 21) {
		return 'https://api.vietqr.io/img/KLB.png';
	} elseif ($data == 22) {
		return 'https://api.vietqr.io/img/PVCB.png';
	} elseif ($data == 23) {
		return 'https://api.vietqr.io/img/OCB.png';
	} elseif ($data == 24) {
		return 'https://api.vietqr.io/img/MSB.png';
	} elseif ($data == 25) {
		return 'https://api.vietqr.io/img/SHB.png';
	}
}
function display_live($data)
{
	if ($data == 'LIVE') {
		$show = '<span class="badge badge-success">LIVE</span>';
	} elseif ($data == 'DIE') {
		$show = '<span class="badge badge-danger">DIE</span>';
	}
	return $show;
}
function display_checklive($data)
{
	if ($data == 1) {
		$show = '<span class="badge badge-success">Có</span>';
	} elseif ($data == 0) {
		$show = '<span class="badge badge-danger">Không</span>';
	}
	return $show;
}

function display_cron($data)
{
	if ($data == 1) {
		$show = '<span class="badge badge-success">Hoạt Động</span>';
	} elseif ($data == 0) {
		$show = '<span class="badge badge-danger">Chức năng không hoạt động</span>';
	}
	return $show;
}
function display_domains($data)
{
	if ($data == 1) {
		$show = '<span class="badge bg-success">' . __('Hoạt Động') . '</span>';
	} elseif ($data == 0) {
		$show = '<span class="badge bg-warning">' . __('Đang Xây Dựng') . '</span>';
	} elseif ($data == 2) {
		$show = '<span class="badge bg-danger">' . __('Huỷ') . '</span>';
	}
	return $show;
}
function display_autofb($data)
{
	if ($data == 1) {
		$show = '<span class="badge badge-success">' . __('Hoàn thành') . '</span>';
	} elseif ($data == 0) {
		$show = '<span class="badge badge-warning">' . __('Đang xử lý') . '</span>';
	} elseif ($data == 2) {
		$show = '<span class="badge badge-danger">' . __('Huỷ') . '</span>';
	}
	return $show;
}
function display_show_hide($data)
{
	if ($data == 1) {
		$show = '<span class="badge badge-success">Hiển thị</span>';
	} elseif ($data == 0) {
		$show = '<span class="badge badge-danger">Ẩn</span>';
	}
	return $show;
}
// hiển thị trạng thái hiển thị
function display_status_product($data)
{
	if ($data == 1) {
		$show = '<span class="badge badge-success">Hiển thị</span>';
	} elseif ($data == 0) {
		$show = '<span class="badge badge-danger">Ẩn</span>';
	}
	return $show;
}
//display rank admin
function display_role($data)
{
	if ($data == 1) {
		$show = '<span class="badge badge-danger">Admin</span>';
	} elseif ($data == 0) {
		$show = '<span class="badge badge-info">Member</span>';
	}
	return $show;
}
// Hàm show msg
function msg_success($text, $url, $time)
{
	return die('<script type="text/javascript">swal.fire("Thành Công", "' . $text . '","success");
    setTimeout(function(){ location.href = "' . $url . '" },' . $time . ');</script>');
}
function msg_error($text, $url, $time)
{
	return die('<script type="text/javascript">swal.fire("Thất Bại", "' . $text . '","error");
    setTimeout(function(){ location.href = "' . $url . '" },' . $time . ');</script>');
}
function msg_warning($text, $url, $time)
{
	return die('<script type="text/javascript">swal.fire("Thông Báo", "' . $text . '","warning");
    setTimeout(function(){ location.href = "' . $url . '" },' . $time . ');</script>');
}
//paginationBoostrap

function check_img($img)
{
	$filename = $_FILES[$img]['name'];
	$ext = explode(".", $filename);
	$ext = end($ext);
	$valid_ext = array("png", "jpeg", "jpg", "PNG", "JPEG", "JPG", "gif", "GIF");
	if (in_array($ext, $valid_ext)) {
		return true;
	}
}

function check_img2($filename)
{
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$valid_ext = array("png", "jpeg", "jpg", "PNG", "JPEG", "JPG", "gif", "GIF");

	if (in_array($ext, $valid_ext)) {
		return true;
	}

	return false;
}


function timeAgo($time_ago)
{
	$time_ago = empty($time_ago) ? 0 : $time_ago;
	if ($time_ago == 0) {
		return '--';
	}
	$time_ago   = date("Y-m-d H:i:s", $time_ago);
	$time_ago   = strtotime($time_ago);
	$cur_time   = time();
	$time_elapsed   = $cur_time - $time_ago;
	$seconds    = $time_elapsed;
	$minutes    = round($time_elapsed / 60);
	$hours      = round($time_elapsed / 3600);
	$days       = round($time_elapsed / 86400);
	$weeks      = round($time_elapsed / 604800);
	$months     = round($time_elapsed / 2600640);
	$years      = round($time_elapsed / 31207680);
	// Seconds
	if ($seconds <= 60) {
		return "$seconds giây trước";
	}
	//Minutes
	elseif ($minutes <= 60) {
		return "$minutes phút trước";
	}
	//Hours
	elseif ($hours <= 24) {
		return "$hours tiếng trước";
	}
	//Days
	elseif ($days <= 7) {
		if ($days == 1) {
			return 'Hôm qua';
		} else {
			return "$days ngày trước";
		}
	}
	//Weeks
	elseif ($weeks <= 4.3) {
		return "$weeks tuần trước";
	}
	//Months
	elseif ($months <= 12) {
		return "$months tháng trước";
	}
	//Years
	else {
		return "$years năm trước";
	}
}
function timeAgo2($time_ago)
{
	$time_ago   = date("Y-m-d H:i:s", $time_ago);
	$time_ago   = strtotime($time_ago);
	$time_elapsed   = $time_ago;
	$seconds    = $time_elapsed;
	$minutes    = round($time_elapsed / 60);
	$hours      = round($time_elapsed / 3600);
	$days       = round($time_elapsed / 86400);
	$weeks      = round($time_elapsed / 604800);
	$months     = round($time_elapsed / 2600640);
	$years      = round($time_elapsed / 31207680);
	// Seconds
	if ($seconds <= 60) {
		return "$seconds giây";
	}
	//Minutes
	elseif ($minutes <= 60) {
		return "$minutes phút";
	}
	//Hours
	elseif ($hours <= 24) {
		return "$hours tiếng";
	}
	//Days
	elseif ($days <= 7) {
		if ($days == 1) {
			return "$days ngày";
		} else {
			return "$days ngày";
		}
	}
	//Weeks
	elseif ($weeks <= 4.3) {
		return "$weeks tuần";
	}
	//Months
	elseif ($months <= 12) {
		return "$months tháng";
	}
	//Years
	else {
		return "$years năm";
	}
}

function dirToArray($dir)
{
	$result = array();

	$cdir = scandir($dir);
	foreach ($cdir as $key => $value) {
		if (!in_array($value, array(".", ".."))) {
			if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
				$result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
			} else {
				$result[] = $value;
			}
		}
	}

	return $result;
}


function GetCorrectMTime($filePath)
{
	$time = filemtime($filePath);

	$isDST = (date('I', $time) == 1);
	$systemDST = (date('I') == 1);

	$adjustment = 0;

	if ($isDST == false && $systemDST == true) {
		$adjustment = 3600;
	} elseif ($isDST == true && $systemDST == false) {
		$adjustment = -3600;
	} else {
		$adjustment = 0;
	}

	return ($time + $adjustment);
}


function getLocation($ip)
{
	if ($ip = '::1') {
		$data = [
			'country' => 'VN'
		];
		return $data;
	}
	$url = "http://ipinfo.io/" . $ip;
	$location = json_decode(file_get_contents($url), true);
	return $location;
}


function generateUniqueGiftcode($length = 10) {
    global $tkuma;
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $prefix = 'CLB';
    do {
        $giftcode = $prefix;
        for ($i = 0; $i < $length; $i++) {
            $giftcode .= $characters[rand(0, $charactersLength - 1)];
        }
        // Kiểm tra xem mã giftcode đã tồn tại trong cơ sở dữ liệu chưa
        $check_code = $tkuma->get_row("SELECT * FROM `giftcode` WHERE `giftcode` = ?", [$giftcode]);
    } while ($check_code);
    return $giftcode;
}