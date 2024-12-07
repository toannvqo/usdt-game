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
function sendResponse($status, $message, $data = null, $tranIdd = null)
{
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
// if ($_GET['type'] == $tkuma->site('pin_cron')) {
// 	// 	if (checkCron('4') == false) {
// 	// 		die(json_encode(['status' => 'error', 'msg' => 'Thao tác quá nhanh, vui lòng đợi']));
// 	// 	}


// 	if (!$cronController->canRun()) {
// 		// sendMessTelegramNew("trathuong type Cron job đã chạy quá số lần cho phép trong khoảng thời gian này." . $_GET['type']);
// 		die('Cron job đã chạy quá số lần cho phép trong khoảng thời gian này.');
// 	}
// 	if (getRowRealtime('cronjobsact', '4', 'status') == 0) {
// 		// sendMessTelegramNew("trathuong Chức năng không hoạt động");
// 		die(json_encode(['status' => 'error', 'msg' => 'Chức năng không hoạt động']));
// 	}

// 	if ($tkuma->site('status_randommsg') != 0) {
// 		$names = $tkuma->site('random_msg');
// 		$name_array = explode(",", $names);
// 		$random_key = array_rand($name_array);
// 		$selected_name = $name_array[$random_key];
// 		$get_cmt = $selected_name;
// 	} else {
// 		$get_cmt = $tkuma->site('msg_game');
// 	}
// 	$get_cmt_band = $tkuma->site('band');

$rows = $tkuma->get_list(" SELECT * FROM `lich_su_choi` WHERE `result` = ? AND `status` = ? AND `type_gd` = ? AND `phone` != '' ORDER BY `id` DESC  ", ['success', 'pending', 'real']);

// sendMessTelegramNew("danh sach tra thuong: ", $rows);

// $gettranId2 = $tkuma->num_rows("SELECT * FROM `lich_su_choi` WHERE `tranId` = ? ", [$rows['tranId']]);
// if ($gettranId2 >= 2) {
// 	$tkuma->update("lich_su_choi", ['status' => 'eror',	'msg_send' => 'Trùng TranID không trả thưởng'],	" `tranId` = ?	", [$rows['tranId']]);
// 	die("Trùng TranID không trả thưởng: " . $rows['tranId'] . " ❎<br>\n");
// }

// lay thong tin giftcode
$rows_giftcode = $tkuma->get_list(" SELECT * FROM `lich_su_choi` WHERE `result` = ? AND `status` = ? AND (`type_gd` = ? || `type_gd` = ? ||`type_gd` = ?) ORDER BY `id` DESC  ", ['success', 'pending', 'giftcode', 'nohu', 'nhiemvungay']);

$rows_sainoidung = $tkuma->get_list(" SELECT * FROM `lich_su_choi` WHERE  `status` = ? AND `phone` != '' ORDER BY `id` DESC  ", ['sainoidung']);

//Xem lại chỗ này, vì trừ 10% thì phải còn 90% để trả thưởng => 0.9
$tyleHoanTra = $tkuma->site('tylehoan') * 0.1;


if ($tyleHoanTra > 0 && $rows_sainoidung) {
	// thắng kèo nhưng sai nội dung chuyển khoản bị trừ 10%
	foreach ($rows_sainoidung as &$row) {
		$row['amount_game'] = $row['amount_play'] * $tyleHoanTra;
	}
	$rows = array_merge($rows, $rows_sainoidung);
}


$rows = array_merge($rows, $rows_giftcode);
if ($rows) {
	foreach ($rows as $row) {
		//log row
		sendMessTelegramNew("bat dau update otp: ", $row);
		$msg_send = xoadaucham($get_cmt . $row['tranId']);
		if ($row['status'] == 'sainoidung') {
			$msg_send = 'Sai noi dung chuyen khoan';
		}
		echo ("bat dau update otp: " . $row);
		sendMessTelegramNew("bat dau update otp: ");
		try {
			$getotp = $tkuma->update("lich_su_choi", ['status' => 'getotp',	'msg_send' => 'getotp'], " `tranId` = ? ", [$row['tranId']]);
			if ($getotp) {
				$msg_send = xoadaucham($get_cmt . $rows['tranId']);

				$getuser = $tkuma->get_row("SELECT * FROM `users` WHERE `id` = ? ", [$rows['id_momo']]);


				//Lấy danh sách tài khoản gateio
				$gateAccounts = $tkuma->get_list("SELECT * FROM `gate_account` WHERE `status` = ? ORDER BY `id` ASC ", ['success']);

				//Lấy tài khoản đầu tiên
				$gateAccount = $gateAccounts[0];

				//Check nếu không có tài khoản nào thì thông báo lỗi
				if (!$gateAccount) {
					sendResponse('error', 'Không có tài khoản GateIO nào hợp lệ');
				} else {

					//Cashout to Gate
					$gateio = new GateIO($gateAccount['uid'], $gateAccount['apiKey'], $gateAccount['apiSecret']);

					$result_pay = $gateio->transferFundsGateio($row['phone'], $row['amount_game'], $currency = "USDT");

					// result_pay trả ra {"id": 111 } hãy check xem có id hay không để biết giao dịch đã thành công hay không
					if (isset($result_pay['id'])) {
						$SEND_BILL = $tkuma->insert("chuyen_tien", [
							'type_gd' => $rows['type_gd'],
							'tranId' => $result_pay['id'],
							// 'partnerId' => $result_pay['partnerId'], // không có trong dữ liệu trả về
							// 'partnerName' => $result_pay['partnerName'], // không có trong dữ liệu trả về
							'amount' => $row['amount_game'],
							// 'comment' => $result_pay['description'],
							'status' => 'success', //$result_pay['status'],
							'message' => 'success',
							'data' => json_encode($result_pay),
							// 'balance' => $result_pay['balance'],
							// 'ownerNumber' => $result_pay['ownerNumber'],
							// 'ownerName' => $result_pay['ownerName'],
							'type' => 1,
							'date_time' => gettime(),
							'time' => gettime()
						]);
						$tkuma->update("lich_su_choi", ['status' => 'success', 'msg_send' => 'Thành công'], " `tranId` = ?  ", whereParameters: [$rows['tranId']]);
						// $tkuma->update("account_vcb", ['typech' => '0'], " `id` = ?  ", [$get_momo['id']]);
						echo "CRON THÀNH CÔNG : " . $rows['tranId'] . " ✅<br>\n";
					} else {
						// $tkuma->update("account_vcb", ['typech' => '0'], " `id` = ? ", [$get_momo['id']]);
						$tkuma->update("lich_su_choi",	['status' => 'Thất Bại',	'msg_send' => $result_pay['msg']],	" `tranId` = ?  ", [$rows['tranId']]);
						echo "CRON KHONG THÀNH CÔNG : " . $rows['tranId'] . " ✅<br>\n";
					}
				}
			}
		} catch (\Throwable $th) {
			echo ("Exception create cashout: " . $th);
			sendMessTelegramNew("Exception create cashout: ", $th);
		}
		//Trạng thái trung gian để kèo sau không gọi vào nữa!
	}
}
// }
