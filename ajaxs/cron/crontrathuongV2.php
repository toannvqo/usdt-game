<?php
define("IN_SITE", true);
require_once(__DIR__ . '/../../libs/db.php');
require_once(__DIR__ . '/../../libs/config.php');
require_once(__DIR__ . '/../../libs/helper.php');
require_once(__DIR__ . '/../../libs/redis.php');
require_once(__DIR__ . '/../../ajaxs/api/bank_cashout.php');
$tkuma = new DB();
$cronController = new CronController('trathuong');

// Hàm để trả về phản hồi JSON với mã lỗi và thông báo lỗi hoặc thành công
function sendResponse($status, $message, $data = null, $tranIdd = null) {
    if ($status === 'error') {
        http_response_code(400);
    } else {
        http_response_code(200);
    }
    
    $response = ['status' => $status, 'message' => $message];
    if ($tranIdd !== null) {
        $response['tranId'] = $tranIdd;
    }
    if ($data !== null) {
        $response['data'] = $data;
    }
   // sendMessTelegramNew(json_encode($response));
    die(json_encode($response));
}

// sendMessTelegramNew("trathuong type " . $_GET['type']);
if ($_GET['type'] == $tkuma->site('pin_cron')) {
// 	if (checkCron('4') == false) {
// 		die(json_encode(['status' => 'error', 'msg' => 'Thao tác quá nhanh, vui lòng đợi']));
// 	}


    if (!$cronController->canRun()) {
        // sendMessTelegramNew("trathuong type Cron job đã chạy quá số lần cho phép trong khoảng thời gian này." . $_GET['type']);
    		die('Cron job đã chạy quá số lần cho phép trong khoảng thời gian này.');
    	}
	if (getRowRealtime('cronjobsact', '4', 'status') == 0) {
	   // sendMessTelegramNew("trathuong Chức năng không hoạt động");
		die(json_encode(['status' => 'error', 'msg' => 'Chức năng không hoạt động']));
	}

	if ($tkuma->site('status_randommsg') != 0) {
		$names = $tkuma->site('random_msg');
		$name_array = explode(",", $names);
		$random_key = array_rand($name_array);
		$selected_name = $name_array[$random_key];
		$get_cmt = $selected_name;
	} else {
		$get_cmt = $tkuma->site('msg_game');
	}
	$get_cmt_band = $tkuma->site('band');
	
	$rows = $tkuma->get_list(" SELECT * FROM `lich_su_choi` WHERE `result` = ? AND `status` = ? AND `type_gd` = ? AND `phone` != '' ORDER BY `id` DESC  ",['success','pending', 'real']);
	$gettranId2 = $tkuma->num_rows("SELECT * FROM `lich_su_choi` WHERE `tranId` = ? ",[$rows['tranId']]);
	if ($gettranId2 >= 2 ) {
	    $tkuma->update("lich_su_choi",[	'status' => 'eror',	'msg_send' => 'Trùng TranID không trả thưởng'],	" `tranId` = ?	",[$rows['tranId']]);
			die("Trùng TranID không trả thưởng: " . $rows['tranId'] . " ❎<br>\n") ;
	}

	// lay thong tin giftcode
	$rows_giftcode = $tkuma->get_list(" SELECT * FROM `lich_su_choi` WHERE `result` = ? AND `status` = ? AND (`type_gd` = ? || `type_gd` = ? ||`type_gd` = ?) ORDER BY `id` DESC  ",['success','pending', 'giftcode', 'nohu', 'nhiemvungay']);
	
	$rows_sainoidung = $tkuma->get_list(" SELECT * FROM `lich_su_choi` WHERE  `status` = ? AND `phone` != '' ORDER BY `id` DESC  ",['sainoidung']);
	
	$tyleHoanTra = $tkuma->site('tylehoan') * 0.1;

	
	if($tyleHoanTra > 0 && $rows_sainoidung){
	    // thắng kèo nhưng sai nội dung chuyển khoản bị trừ 10%
    	foreach ($rows_sainoidung as &$row) {
    		$row['amount_game'] = $row['amount_play'] * $tyleHoanTra;
    	}
    	$rows = array_merge($rows, $rows_sainoidung);
	}


//	sendMessTelegramNew("danh sach tra thuong: " .$rows);
	
	$rows = array_merge($rows, $rows_giftcode);
	if ($rows) 
	{
		foreach ($rows as $row) {
				$msg_send = xoadaucham($get_cmt . $row['tranId']);
				if($row['status'] == 'sainoidung'){
					$msg_send = 'Sai noi dung chuyen khoan'; 
				}
				echo("bat dau update otp: " . $row);
			sendMessTelegramNew("bat dau update otp: ");
			try {
			    	$getotp = $tkuma->update("lich_su_choi",[	'status' => 'getotp',	'msg_send' => 'getotp'	]," `tranId` = ? ",[$row['tranId']]);
			if ($getotp) {
			
            echo("chuan bi buildCashout: " . $getotp);
				$getuser = $tkuma->get_row("SELECT * FROM `users` WHERE `id` = ? ",[$row['id_momo']]);
				//$getbankcode = $tkuma->get_row("SELECT * FROM `bankcode` WHERE `id` = ? ",[$getuser['bankid']]);
				
					$getbankcode = $tkuma->get_row("SELECT * FROM `aee_bank_code` WHERE `tId` = ? ",[$getuser['bankid']]);

				// Biến cờ để kiểm soát việc gửi phản hồi
				$responseSent = false;

				// Thay thế đoạn mã gọi API bank_cashout
				$response = buildCashout(
					$getbankcode['bankcode'],       // Mã ngân hàng
					$getuser['stk'],           // Số tài khoản
					$row['amount_game'],               // Số tiền cần chuyển
					$getuser['acc_name'],     // Tên khách hàng
					$row['tranId'],              // Mã giao dịch
					$msg_send              // Nội dung chuyển tiền
				);

				// Kiểm tra phản hồi từ API
				if ($response === false) {
					sendResponse('error', 'Lỗi cURL: ' . curl_error($ch));
				} else {
					// Giải mã phản hồi JSON từ API
					$responseData = json_decode($response, true);

					// Kiểm tra nếu phản hồi có lỗi
					if (isset($responseData['success']) && $responseData['success'] === false) {
						sendResponse('error', $responseData['message'], null, $responseData['error_code']);
					} else {
						// Trả về phản hồi thành công từ API
						sendResponse('success', 'XỬ LÝ GIAO DỊCH THÀNH CÔNG', $responseData);
					}
				}
			}
			} catch (\Throwable $th ) {
			   echo("Exception create cashout: " . $th) ;
			   sendMessTelegramNew("Exception create cashout: " , $th);
			}
			//Trạng thái trung gian để kèo sau không gọi vào nữa!
		
	}
}
}
