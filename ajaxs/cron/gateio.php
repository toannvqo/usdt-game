<?php
define("IN_SITE", true);
require_once(__DIR__ . '/../../libs/db.php');
require_once(__DIR__ . '/../../libs/config.php');
require_once(__DIR__ . '/../../libs/helper.php');
require_once(__DIR__ . '/../../libs/redis.php');
require_once(__DIR__ . "/../../libs/class/GateIO.php");

$tkuma = new DB();

// $cronController = new CronController('gateio');
// if ($_GET['type'] == $tkuma->site('pin_cron')) {
// 	//	sendMessTelegramNew("Bắt đầu cron lsgd");
// 	// 	// if (checkCron('5') == false) {
// 	// 		die(json_encode(['status' => 'error', 'msg' => 'Thao tác quá nhanh, vui lòng đợi']));
// 	// 	// }
// 	if (!$cronController->canRun()) {
// 		//  sendMessTelegramNew("Cron job đã chạy quá số lần cho phép trong khoảng thời gian này.");
// 		die('Cron job đã chạy quá số lần cho phép trong khoảng thời gian này.');
// 	}
// 	if (getRowRealtime('cronjobsact', '5', 'status') == 0) {
// 		//  sendMessTelegramNew("Chức năng không hoạt động");
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
// 	$msg_send = $get_cmt . ": " . $tranIdd;
// 	$msg_band = $get_cmt_band;

//Lấy danh sách tài khoản gateio
$gateAccounts = $tkuma->get_list("SELECT * FROM `gate_account` WHERE `status` = ? ORDER BY `id` ASC ", ['success']);

if ($gateAccounts) {
	#1
	foreach ($gateAccounts as $rows) {
		//Log gateAccounts
		sendMessTelegramNew("gateAccounts: " . json_encode($rows));
		error_log("uid" . $rows['uid']);
		error_log("apiKey_gateio" . $rows['apiKey']);
		error_log("apiSecret_gateio" . $rows['apiSecret']);

		$gateio = new GateIO($rows['uid'], $rows['apiKey'], $rows['apiSecret']);

		$gethistt = $gateio->getTransactionHistoryV2();

		// if (isset($gethistt['data']['transactionHistoryList']) && count($gethistt['data']['transactionHistoryList']) > 0) {
		// 	foreach ($gethistt['data']['transactionHistoryList'] as $ROWHIST) {

		//   sendMessTelegramNew("gethistt->transactionHistoryList: " . $gethistt->data->transactionHistoryList );
		if (!empty($gethistt)) {
			foreach ($gethistt as $ROWHIST) {

				// Kiểm tra xem uid của giao dịch có khác với uid hiện tại không
				//Chỉ lấy giao dịch có uid khác với uid hiện tại, tránh trường hợp lấy giao dịch của chính mình
				if ($ROWHIST['uid'] !== $rows['uid']) { //$ROWHIST['receive_uid'] === $rows['uid']
					sendMessTelegramNew("Lịch sử giao dịch: " . json_encode($ROWHIST));

					$push_uid = $ROWHIST['push_uid'];
					$gettranid = $ROWHIST['id'];
					
					echo "Transaction ID: " . $ROWHIST['id'] . "\n";
					echo "Push UID: " . $ROWHIST['push_uid'] . "\n";
					echo "Receive UID: " . $ROWHIST['receive_uid'] . "\n";
					echo "Currency: " . $ROWHIST['currency'] . "\n";
					echo "Amount: " . $ROWHIST['amount'] . "\n";
				    echo "Status: " . $ROWHIST['status'] . "\n";
					echo "Create Time: " . date('Y-m-d H:i:s', $ROWHIST['create_time']) . "\n";
					echo "Message: " . $ROWHIST['message'] . "\n";
					#3


					//	sendMessTelegramNew("gettranid " . $gettranid);

					if (strpos($gettranid, '\\') !== false) {
						$tranIdd = substr($gettranid, 2, strpos($gettranid, '\\') - 2);
					} else {
						$tranIdd = preg_replace('/\D/', '', $gettranid);
					}



					// $settings1 = strtolower($ROWHIST->message); //ND chuyển TIỀN
					// $getiduser = parse_order_name($settings1);
					//Tìm kiếm user từ push_uid
					$getuser = $tkuma->get_row("SELECT * FROM `users` WHERE `uid_gate` = ? ", [$push_uid]);
					$is_wrong_content = false;
					if (!$getuser) {
						// trường hợp này khách nhập sai nội dung, sẽ hoàn tiền lại
						// tìm user theo stk lấy được từ lsgd
						$getuser = $tkuma->get_row("SELECT * FROM `users` WHERE `stk` = ? ", [$ROWHIST->receive_uid]);
						$ID_momo = $getuser['id']; //Get userid
						$is_wrong_content = true;
					} else {
						$ID_momo = $getuser['id']; //Get userid
					}
					$partnerID = $getuser['stk'] ?? '';
					
					$pattern = $tkuma->site('ndnaptien') . $getiduser;
					// 	if (preg_match("/$pattern ([^. ]+)[. ]?/", $settings1, $matches)) {
					//	if (preg_match("/$pattern ([^-.\s]+)[. -]?/", $settings1, $matches)) {
					//		$comment = $matches[1];
					//	} else {
					//		$comment = $settings1;
					//	}

					$amount = $ROWHIST['amount'];  //SỐ TIỀN GIAO DỊCH

					//  sendMessTelegramNew("check sai noi dung :" . $getiduser);
					//  sendMessTelegramNew("getuser :" . $getuser['stk']);

					$comment = substr($amount, -2);
					$partnerName = $getuser['username'] ?? '';  //NGƯỜI CHUYỂN 
					$dataline = "gateio|" . date("d/m/Y") . "|" . date("d/m/Y", $ROWHIST['create_time']) . "|+" . format_cash($amount) . "|" . $gettranid . "|" . getRowRealtime2('gate_account', 'phone', $push_uid, 'name') . "|" . $push_uid;
					$tranIdd2 = 0;
					$gettranIdc = $cronController->checkdata($tranIdd); //kiểm tra tranID ở redis

					// 	$gettranIdc = checkcrontran($tranIdd);  //kiểm tra tranID ở databse

					// 	$gettranIdc2 = checkcrontran2($tranIdd);  //kiểm tra tranID ở databse

					// 	if($gettranIdc && !checkcrontran2($tranIdd)){
					// 	    $gettranIdc = $cronController->remote($tranIdd); //remoite tranID ở redis
					// 	    $gettranIdc = $cronController->checkdata($tranIdd); //kiểm tra tranID ở redis
					// 	}
					if ($gettranIdc || $ROWHIST->status != "PENDING") {
						//  sendMessTelegramNew("đã tồn tại mã gd");
						echo "ĐÃ TỒN TẠI MÃ GIAO DỊCH: " . $tranIdd . " ❎<br>\n";
					} else {
						$RESULT_PLAY = KETQUA_BILL($comment, $tranIdd);
						$ti_le =  $RESULT_PLAY['tile'] ?? 0;

						$tien_nhan = so_nguyen($amount * $ti_le);

						//   sendMessTelegramNew("RESULT_PLAY: ", $RESULT_PLAY);

						$tkuma->insert("lich_su_choi", [
							'phone'  =>   $partnerID,
							'phone_nhan' => $rows['uid'],
							'tranId' =>   $tranIdd,
							'tranid2' =>   $tranIdd2,
							'partnerName' => $partnerName,
							'id_momo' => $ID_momo,
							'amount_play' => $amount,
							'amount_game' => 0,
							'comment' => $comment,
							'game' => '',
							'ma_game' => '',
							'result' => '',
							'result_text' => '',
							'type_gd' => 'real',
							'status' => 'success',
							'result_number' => 0,
							'time_tran' => strtotime(gettime()),
							'time' => gettime(),
							'msg_send' => '',
							'databill' => base64_encode($dataline),
							'md5bill' => md5($dataline)
						]);


						//	sendMessTelegramNew("ket qua: ",$RESULT_PLAY['status']);

						//	echo ("update ban ghi thua: ". $GHI_DTB);
						if ($is_wrong_content == 1 || $is_wrong_content == "1") {
							$tkuma->update("lich_su_choi", [
								'status' => 'sainoidung',
								'msg_send' => 'Đang Chờ hoàn tiền',
								'result_text' => 'SAI NỘI DUNG',
								'result' => 'sainoidung',
								'result_number' => 1,
							], " `tranId` = ?  ", [$tranIdd]);
							echo "Giao dich sai noi dung: " . $getiduser . " ❎<br>\n";
							continue;
						}


						if ($RESULT_PLAY['status'] == "error") {
							$GHI_DTB = $tkuma->update("lich_su_choi", [
								'game' => $RESULT_PLAY['game'] ?? '',
								'ma_game' => $RESULT_PLAY['key'] ?? '',
								'result' => $RESULT_PLAY['status'],
								'result_text' => $RESULT_PLAY['message']
							], " `tranId` = ?  ", [$tranIdd]);


							if ($GHI_DTB) {
								echo "CRON THÀNH CÔNG : " . $tranIdd . " ✅<br>\n";
							} else {
								echo "* CRON KHÔNG THÀNH CÔNG, KHÔNG THỂ GHI DỮ LIỆU : " . $tranIdd . " ⛔<br>\n";
							}
						}
						if ($RESULT_PLAY['status'] == "success") {
							$get_minmax = $tkuma->get_row("SELECT * FROM `phone` WHERE `phone` = ? ", [$push_uid]);
							if (!$get_minmax) {
								echo "KHÔNG TỒN TẠI MOMO NÀY, MOMO ĐÃ BỊ TẮT : " . $tranIdd . " ⭕<br>\n";
							} elseif ($amount < $tkuma->site('mingame')  || $amount > $tkuma->site('maxgame')) {
								echo "TIỀN CHƠI KHÔNG HỢP LỆ : " . $tranIdd . " ⭕<br>\n";
								$tkuma->update("lich_su_choi", [
									'game' => $RESULT_PLAY['game'],
									'ma_game' => $RESULT_PLAY['key'],
									'result' => $RESULT_PLAY['status'],
									'result_text' => 'TIỀN CHƠI KHÔNG HỢP LỆ'
								], " `tranId` = ?  ", [$tranIdd]);
							} else {
								$GHI_GAME = $tkuma->update("lich_su_choi", [
									'amount_game' => $tien_nhan,
									'game' => $RESULT_PLAY['game'],
									'ma_game' => $RESULT_PLAY['key'],
									'result' => $RESULT_PLAY['status'],
									'result_text' => $RESULT_PLAY['message'],
									'result_number' => 1,
									'msg_send' => $msg_send
								], " `tranId` = ?  ", [$tranIdd]);
								if ($GHI_GAME) {
									if ($tkuma->num_rows("SELECT * FROM `momo_band` WHERE `sdt` = ? ", [$partnerID]) >= 1) {
										$get_band = $tkuma->get_row("SELECT * FROM `momo_band` WHERE `sdt` = ?", [$partnerID]);
										if ($get_band) {
											echo "SỐ GIAO DỊCH BỊ BAND: " . $partnerID . " ❎<br>\n";
											continue;
										}
									} elseif ($partnerID == '') {
										$tkuma->update("lich_su_choi", [
											'amout_game' => $amount,
											'status' => 'sainoidung',
											'msg_send' => 'Sai nội dung'
										], " `tranId` = ?  ", [$tranIdd]);
									} else {
										$msgzz = substr($partnerName, 0, -2) . '****';
										$namegame = $RESULT_PLAY['game'];
										$tiendinhdang = format_currency($tien_nhan);
										$my_text = $tkuma->site('notisendtele');
										$my_text = str_replace('{domain}', $_SERVER['SERVER_NAME'], $my_text);
										$my_text = str_replace('{tranid}', $tranIdd, $my_text);
										$my_text = str_replace('{ketqua}', $RESULT_PLAY['message'], $my_text);
										$my_text = str_replace('{tienthang}', $tiendinhdang, $my_text);
										$my_text = str_replace('{userwin}', $msgzz, $my_text);
										$my_text = str_replace('{thoigian}', gettime(), $my_text);
										$my_text = str_replace('{noidungchuyen}', $comment, $my_text);
										$my_text = str_replace('{gamechoi}', $namegame, $my_text);
										sendMessTelegram($my_text);
										//if($tkuma->site("status_websoket") == 1){pinghistory();}
										$tkuma->update("lich_su_choi", [
											'status' => 'pending',
											'msg_send' => 'Đang Chờ Thanh Toán'
										], " `tranId` = ?  ", [$tranIdd]);
									}

									echo "CRON THÀNH CÔNG : " . $tranIdd . " ✅<br>\n";
								} else {
									echo "** CRON KHÔNG THÀNH CÔNG, KHÔNG THỂ GHI DỮ LIỆU : " . $tranIdd . " ⛔<br>\n";
								}
							}
						}
					}
					#END3
					if ($tkuma->site("status_websoket") == 1) {
						pinghistory();
						pinghistoryuser($getuser['token']);
					}
				}
			}
		} else {
			echo "KHÔNG CÓ GIAO DỊCH NÀO🅾<br>\n";
		}
		echo "<pre>";
		print_r($gethistt);
		#END2
	}
	#END1
}
// }
