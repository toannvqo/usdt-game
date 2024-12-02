<?php
define("IN_SITE", true);
require_once(__DIR__ . '/../../libs/db.php');
require_once(__DIR__ . '/../../libs/config.php');
require_once(__DIR__ . '/../../libs/helper.php');
require_once(__DIR__ . '/../../libs/class/VietCombank.php');
require_once(__DIR__ . '/../../libs/redis.php');
$tkuma = new DB();

$cronController = new CronController('vcbank');
if ($_GET['type'] == $tkuma->site('pin_cron')) {
//     if (checkCron('6') == false) {
// 		die(json_encode(['status' => 'error', 'msg' => 'Thao tác quá nhanh, vui lòng đợi']));
// 	}

	if (!$cronController->canRun()) {
		die('Cron job đã chạy quá số lần cho phép trong khoảng thời gian này.');
	}
	if (getRowRealtime('cronjobsact', '6', 'status') == 0) {
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
	$getlist_momo = $tkuma->get_list("SELECT * FROM `phone` WHERE `status` = ? AND `namebank` = ?  ORDER BY `id` ASC ",['success','VietCombank']);
    $msg_send = $get_cmt . ": " . $tranIdd;
    $msg_band = $get_cmt_band;
                                                              

	//print_r($getlist_momo);
	//  echo $get_cmt_band;
	if ($getlist_momo) {
		#1
		foreach ($getlist_momo as $rows2) {
		    
		    $currentHour = date('H'); 


			$rows = $tkuma->get_row("SELECT * FROM `account_vcb` WHERE  `account_number` = ?  ",[$rows2['phone']]);
				//print_r($getlist_momo);
			$app = new VietCombank($rows['username'], $rows['password'], $rows['account_number']);
			$checkBalance = balance($rows['token'])['SoDu'];
			$result = $app->getHistories(date("d/m/Y"), date("d/m/Y"), $rows['account_number']);
			if ($result->code == 00) {
				$gethistt = json_encode($result);
				$gethistt = json_decode($gethistt, true);
			} else {
				$result = $app->doLogin();
				if ($result->code == 00) {
					$result = $app->getHistories(date("d/m/Y"), date("d/m/Y"), $rows['account_number']);
					$gethistt = json_encode($result);
					$gethistt = json_decode($gethistt, true);
				}
			}
			
			// check nhận tiền
			if ($gethistt['transactions'] != null || $gethistt['transactions'] != "") {
				foreach ($gethistt['transactions'] as $ROWHIST) {
					#3
					$settings1 = $ROWHIST['Description']; //ND chuyển TIỀN
					
					$vi_tri = strpos($settings1, "MBVCB");
                    // Kiểm tra nếu chuỗi "MBVCB" xuất hiện trong phần đầu tiên
                    if ($vi_tri !== false && $vi_tri == 0) {
                        $pattern = '/MBVCB\.(\d+)/';
    					if (preg_match($pattern, $settings1, $matchesd)) { 
                            $tranIdd = $matchesd[1]; // Chuỗi số sau "MBVCB" //MÃ GIAO DỊCH
                        }
                    } else {
                        $settings1 = str_replace("MBVCB.", "", $settings1);
                        $tranIdd = preg_replace("/[^0-9]/", "", $ROWHIST['Reference']); //MÃ GIAO DỊCH
                    }
					
					$staudc = $ROWHIST['CD'];
					
					
					$getiduser = parse_order_name($settings1);
					$getuser = $tkuma->get_row("SELECT * FROM `users` WHERE `username` = ?",[$getiduser]);
					if(!$getuser){
					    $ID_momo = '0'; //Get userid
					} else {
					    $ID_momo = $getuser['id']; //Get userid
					}
				
					$amount = preg_replace("/[^0-9]/", "", $ROWHIST['Amount']); //SỐ TIỀN GIAO DỊCH
					$partnerID = $getuser['stk'] ?? '';
                
					#lay61noidung chuyen
					$pattern = $tkuma->site('ndnaptien').$getiduser;
					if (preg_match("/$pattern ([^-.\s]+)[. -]?/", $settings1, $matches)) {
				// 	if (preg_match("/$pattern ([^. ]+)[. ]?/", $settings1, $matches)) {
						$comment = $matches[1];
					} else {
						$comment = $settings1;
					}
                    $dataline = "VCB|".date("d/m/Y")."|".$settings1."|".$ROWHIST['Reference']."|".format_cash($amount);
					$partnerName = $getuser['username'] ?? '';  //NGƯỜI CHUYỂN 
				// 	$gettranId = checkcrontran($tranIdd);
				    $gettranId = $cronController->checkdata($tranIdd); //kiểm tra tranID ở redis
				    $tranIdd2 = 0;
					if ($gettranId  || $staudc != '+') {
						echo "ĐÃ TỒN TẠI MÃ GIAO DỊCH: " . $tranIdd . " ❎<br>\n";
					} else {
					    
					    if ($tkuma->site('status_bipvcb') == '1') {
                            if (strpos($settings1, 'IBVCB') === false && strpos($settings1, 'MBVCB') === false) {
                                $tranIdd2 = $tranIdd;
                                $tranIdd = chonglo($tranIdd, $comment);
                                $dataline = "VCB|".date("d/m/Y")."|".$settings1."|".substr($ROWHIST['Reference'], 0, -1).substr($tranIdd, -1)."|".format_cash($amount);
                            }
                        }
					    $RESULT_PLAY = KETQUA_BILL($comment, $tranIdd);
					    
		    
						$ti_le =  $RESULT_PLAY['tile'] ?? 0;
				
						$tien_nhan = so_nguyen($amount * $ti_le);


                        $tkuma->insert("lich_su_choi", [
                            'phone'  =>   $partnerID,
                            'phone_nhan' => $rows['account_number'],
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
                        if (strpos($settings1, 'IBVCB') !== false) {
							$GHI_DTB = $tkuma->update("lich_su_choi",[
								'game' => $RESULT_PLAY['game'] ?? '',
                                'ma_game' => $RESULT_PLAY['key'] ?? '',
                                'result' => 'error',
                                'result_text' => 'THUA CUỘC',
                                'status' => 'success',
								'msg_send' => 'Không thanh toán cho các giao dịch chuyển từ website VCB'
							]," `tranId` = ?  ",[$tranIdd]);
							if ($GHI_DTB) {
								echo "CRON THÀNH CÔNG : " . $tranIdd . " ✅<br>\n";
								continue;
							} else {
								echo "* CRON KHÔNG THÀNH CÔNG, KHÔNG THỂ GHI DỮ LIỆU : " . $tranIdd . " ⛔<br>\n";
								continue;
							}
						}
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
							$get_minmax = $tkuma->get_row("SELECT * FROM `phone` WHERE `phone` = ?  ",[$rows['account_number']]);
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
									if ($tkuma->num_rows("SELECT * FROM `momo_band` WHERE `sdt` = ?",[$partnerID]) >= 1) {
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
