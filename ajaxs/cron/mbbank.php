<?php
define("IN_SITE", true);
require_once(__DIR__ . '/../../libs/db.php');
require_once(__DIR__ . '/../../libs/config.php');
require_once(__DIR__ . '/../../libs/helper.php');
require_once(__DIR__ . '/../../libs/class/MBB.php');
require_once(__DIR__ . '/../../libs/redis.php');

$tkuma = new DB();

$cronController = new CronController('mbbank');
if ($_GET['type'] == $tkuma->site('pin_cron')) {
// 	// if (checkCron('5') == false) {
// 		die(json_encode(['status' => 'error', 'msg' => 'Thao tác quá nhanh, vui lòng đợi']));
// 	// }
	if (!$cronController->canRun()) {
		die('Cron job đã chạy quá số lần cho phép trong khoảng thời gian này.');
	}
	if (getRowRealtime('cronjobsact', '5', 'status') == 0) {
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
    $msg_send = $get_cmt . ": " . $tranIdd;
	$msg_band = $get_cmt_band;
	$getlist_momo = $tkuma->get_list("SELECT * FROM `account_mbbank` WHERE `status` = ? ORDER BY `id` ASC ",['success']);

	if ($getlist_momo) {
		#1
		foreach ($getlist_momo as $rows) {
		    $mbbank = new MBB($rows['phone'], $rows['password'], $rows['stk']);
            
			$gethistt = $mbbank->getTransactionHistory($rows['stk']);
			if ($gethistt->result->responseCode != '00') {
                balancemb($rows['token']);
                die("Vui lòng Chờ phiên tiếp theo:  ❎<br>\n");
                    
        // 			$gethistt = json_encode($mbbank->getBalance());
        // 			$gethistt = json_decode($gethistt, true);
        // 			if ($gethistt['result']['responseCode'] != '00') {
        // 				$tam = json_encode($mbbank->doLogin());
        // 		        if ($tam->result->responseCode != 00) {
        // 					die("Vui lòng Chờ phiên tiếp theo:  ❎<br>\n");
        // 				}  
        // 			}
  
			}

			if ($gethistt->transactionHistoryList != null || $gethistt->transactionHistoryList != "") {
				foreach ($gethistt->transactionHistoryList as $ROWHIST) {
					#3
					$phonenhan = $ROWHIST->accountNo;


					$gettranid = $ROWHIST->refNo;
					if (strpos($gettranid, '\\') !== false) {
						$tranIdd = substr($gettranid, 2, strpos($gettranid, '\\') - 2);
					} else {
						$tranIdd = preg_replace('/\D/', '', $gettranid);
					}

					$settings1 = strtolower($ROWHIST->description); //ND chuyển TIỀN
					$getiduser = parse_order_name($settings1);
					$getuser = $tkuma->get_row("SELECT * FROM `users` WHERE `username` = ? ",[$getiduser]);
					if(!$getuser){
					    $ID_momo = '0'; //Get userid
					} else {
					    $ID_momo = $getuser['id']; //Get userid
					}
					$partnerID = $getuser['stk'] ?? '';
					$pattern = $tkuma->site('ndnaptien').$getiduser;
				// 	if (preg_match("/$pattern ([^. ]+)[. ]?/", $settings1, $matches)) {
					if (preg_match("/$pattern ([^-.\s]+)[. -]?/", $settings1, $matches)) {
						$comment = $matches[1];
					} else {
						$comment = $settings1;
					}
					$amount = $ROWHIST->creditAmount;  //SỐ TIỀN GIAO DỊCH
					$partnerName = $getuser['username'] ?? '';  //NGƯỜI CHUYỂN 
					$dataline = "MBBANK|".date("d/m/Y")."|".$ROWHIST->postingDate."|+".format_cash($amount)."|".$gettranid."|".$settings1."|".getRowRealtime2('account_mbbank', 'phone',$phonenhan, 'name')."|".$phonenhan;
				    $tranIdd2 = 0;
				    $gettranIdc = $cronController->checkdata($tranIdd); //kiểm tra tranID ở redis
				    
				// 	$gettranIdc = checkcrontran($tranIdd);  //kiểm tra tranID ở databse
				
				// 	$gettranIdc2 = checkcrontran2($tranIdd);  //kiểm tra tranID ở databse
				
				// 	if($gettranIdc && !checkcrontran2($tranIdd)){
				// 	    $gettranIdc = $cronController->remote($tranIdd); //remoite tranID ở redis
				// 	    $gettranIdc = $cronController->checkdata($tranIdd); //kiểm tra tranID ở redis
				// 	}
					if ( $gettranIdc || $ROWHIST->debitAmount != 0 ) {
						echo "ĐÃ TỒN TẠI MÃ GIAO DỊCH: " . $tranIdd . " ❎<br>\n";
					} else {
					    
					    if ($tkuma->site('status_bipmbbank') == '1') {
                            if (strpos($settings1, 'tu:') === false) {
                                $tranIdd2 = $tranIdd;
                                $tranIdd = chonglo($tranIdd, $comment);
                                $dataline = "MBBANK|".date("d/m/Y")."|".$ROWHIST->postingDate."|+".format_cash($amount)."|".substr($gettranid, 0, 2).$tranIdd.$dauky."|".$settings1."|".getRowRealtime2('account_mbbank', 'phone',$phonenhan, 'name')."|".$phonenhan;
                            }
                        }
                        
						$RESULT_PLAY = KETQUA_BILL($comment, $tranIdd);
						$ti_le =  $RESULT_PLAY['tile'] ?? 0;
					
						$tien_nhan = so_nguyen($amount * $ti_le);


                        $tkuma->insert("lich_su_choi", [
                            'phone'  =>   $partnerID,
                            'phone_nhan' => $rows['stk'],
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
						if ($RESULT_PLAY['status'] == "error") {
							$GHI_DTB = $tkuma->update("lich_su_choi",[
                                'game' => $RESULT_PLAY['game'] ?? '',
                                'ma_game' => $RESULT_PLAY['key'] ?? '',
                                'result' => $RESULT_PLAY['status'],
                                'result_text' => $RESULT_PLAY['message']
                            ]," `tranId` = ?  ",[$tranIdd]);
							if ($GHI_DTB) {
								echo "CRON THÀNH CÔNG : " . $tranIdd . " ✅<br>\n";
							} else {
								echo "* CRON KHÔNG THÀNH CÔNG, KHÔNG THỂ GHI DỮ LIỆU : " . $tranIdd . " ⛔<br>\n";
							}
						}
						if ($RESULT_PLAY['status'] == "success") {
							$get_minmax = $tkuma->get_row("SELECT * FROM `phone` WHERE `phone` = ? ",[$phonenhan]);
							if (!$get_minmax) {
								echo "KHÔNG TỒN TẠI MOMO NÀY, MOMO ĐÃ BỊ TẮT : " . $tranIdd . " ⭕<br>\n";
							} elseif ($amount < $tkuma->site('mingame')  || $amount > $tkuma->site('maxgame')) {
								echo "TIỀN CHƠI KHÔNG HỢP LỆ : " . $tranIdd . " ⭕<br>\n";
                                $tkuma->update("lich_su_choi",[
                                    'game' => $RESULT_PLAY['game'],
									'ma_game' => $RESULT_PLAY['key'],
									'result' => $RESULT_PLAY['status'],
									'result_text' => 'TIỀN CHƠI KHÔNG HỢP LỆ'
                                ]," `tranId` = ?  ",[$tranIdd]);
							} else {
								$GHI_GAME = $tkuma->update("lich_su_choi",[
                                    'amount_game' => $tien_nhan,
									'game' => $RESULT_PLAY['game'],
									'ma_game' => $RESULT_PLAY['key'],
									'result' => $RESULT_PLAY['status'],
									'result_text' => $RESULT_PLAY['message'],
                                    'result_number' => 1,
                                    'msg_send' => $msg_send
                                ]," `tranId` = ?  ",[$tranIdd]);
								if ($GHI_GAME) {
									if ($tkuma->num_rows("SELECT * FROM `momo_band` WHERE `sdt` = ? ",[$partnerID]) >= 1) {
										$get_band = $tkuma->get_row("SELECT * FROM `momo_band` WHERE `sdt` = ?",[$partnerID]);
										if ($get_band) {
											echo "SỐ GIAO DỊCH BỊ BAND: " . $partnerID . " ❎<br>\n";
											continue;
										}
									} elseif ($partnerID == '') {
										$tkuma->update("lich_su_choi",[
                                            'status' => 'sainoidung',
                                            'msg_send' => 'Sai nọi dung'
                                        ]," `tranId` = ?  ",[$tranIdd]);
									} else {
$msgzz = substr($partnerName, 0, -2) . '****';							    
$namegame = $RESULT_PLAY['game'];
$tiendinhdang = format_currency($tien_nhan);
$my_text = $tkuma->site('notisendtele');
$my_text = str_replace('{domain}', $_SERVER['SERVER_NAME'], $my_text);
$my_text = str_replace('{tranid}', $tranIdd, $my_text);
$my_text = str_replace('{ketqua}', $RESULT_PLAY['message'] , $my_text);
$my_text = str_replace('{tienthang}', $tiendinhdang, $my_text);
$my_text = str_replace('{userwin}', $msgzz, $my_text);
$my_text = str_replace('{thoigian}', gettime() , $my_text);
$my_text = str_replace('{noidungchuyen}', $comment, $my_text);
$my_text = str_replace('{gamechoi}', $namegame, $my_text);
sendMessTelegram($my_text);
//if($tkuma->site("status_websoket") == 1){pinghistory();}
										$tkuma->update("lich_su_choi",[
                                            'status' => 'pending',
                                            'msg_send' => 'Đang Chờ Thanh Toán'
                                        ]," `tranId` = ?  ",[$tranIdd]);
									}
								
									echo "CRON THÀNH CÔNG : " . $tranIdd . " ✅<br>\n";
								} else {
									echo "** CRON KHÔNG THÀNH CÔNG, KHÔNG THỂ GHI DỮ LIỆU : " . $tranIdd . " ⛔<br>\n";
								}
							}
						}
					}
					#END3
					if($tkuma->site("status_websoket") == 1){pinghistory();pinghistoryuser($getuser['token']);}
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
}
