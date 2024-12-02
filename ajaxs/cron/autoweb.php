<?php
define("IN_SITE", true);
require_once(__DIR__ . '/../../libs/db.php');
require_once(__DIR__ . '/../../libs/config.php');
require_once(__DIR__ . '/../../libs/helper.php');

require_once(__DIR__ . '/../../libs/redis.php');

$tkuma = new DB();

$cronController = new CronController('botauto');
if ($_GET['type'] == $tkuma->site('pin_cron')) {

// 	if (!$cronController->canRun()) {
// 		die('Cron job đã chạy quá số lần cho phép trong khoảng thời gian này.');
// 	}
	if (getRowRealtime('cronjobsact', '7', 'status') == 0) {
		die(json_encode(['status' => 'error', 'msg' => 'Chức năng không hoạt động']));
	}

	if ($tkuma->site('status_randommsg') != 0) {
	    $names = $tkuma->site('random_msg');
		$get_cmt = explode(",", $names)[array_rand(explode(",", $names))];
	} else {
		$get_cmt = $tkuma->site('msg_game');
	}
	$get_cmt_band = $tkuma->site('band');
    $msg_send = $get_cmt . ": " . $tranIdd;
	$msg_band = $get_cmt_band;
	
	

	if ($tkuma->site('status_bot') != 0) {
		#1
		$result_bot= $tkuma->get_row("SELECT COUNT(id) FROM `lich_su_choi` WHERE `sttbot` = ?  ",['1'])['COUNT(id)'];
		if ($result_bot >= $tkuma->site('maxbot')) {
    		$dell = $tkuma->get_list("SELECT * FROM `lich_su_choi` WHERE `sttbot` = ? LIMIT 10", ['1']);
            foreach ($dell as $row) {
                $DEL = $tkuma->remove("lich_su_choi", "`id` = ?", [$row['id']]);
            }
    		echo "XOA DATA: " . $tranIdd . " ❎<br>\n";
    	}
		
		if ($tkuma->site('time_bot') <= 0) {
				#3
				$phonenhan = $tkuma->get_row("SELECT `phone` FROM `phone` WHERE `status` = ? ORDER BY RAND() LIMIT 1 ",['success'])['phone'];
				
				$tranIdd = '2415'. random('1234567', '13'). '12';
				$settings1 = $ROWHIST->description; //ND chuyển TIỀN

				$ID_momo = '0'; //Get userid
				$partnerID = explode(",", $tkuma->site('phonebot'))[array_rand(explode(",", $tkuma->site('phonebot')))];  //SỐ CHUYỂN

				$getgame = $tkuma->get_row("SELECT `ma_game` FROM `danh_sach_game` WHERE `status` = ? ORDER BY RAND() LIMIT 1 ",['run'])['ma_game'];
				$comment = $tkuma->get_row("SELECT `comment` FROM `settings_game` WHERE `keyd` = ? ORDER BY RAND() LIMIT 1 ",[$getgame])['comment'];
				$amount = explode(",", $tkuma->site('monybot'))[array_rand(explode(",", $tkuma->site('monybot')))];  //SỐ TIỀN GIAO DỊCH
				$partnerName = create_namebot();
			 //   $gettranIdc = $cronController->checkdata($tranIdd); //kiểm tra tranID ở redis
				$gettranIdc = checkcrontran($tranIdd);  //kiểm tra tranID ở databse
				if ( $gettranIdc  ) {
					echo "ĐÃ TỒN TẠI MÃ GIAO DỊCH: " . $tranIdd . " ❎<br>\n";
				} else {
					$RESULT_PLAY = KETQUA_BILL($comment, $tranIdd);
					$ti_le =  $RESULT_PLAY['tile'] ?? 0;
					$tien_nhan = so_nguyen($amount * $ti_le);
                    $tkuma->insert("lich_su_choi", [
                        'phone'  =>   $partnerID,
                        'phone_nhan' => $phonenhan,
                        'tranId' =>   $tranIdd,
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
                        'sttbot' => '1'
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
						if ($amount < $tkuma->site('mingame')  || $amount > $tkuma->site('maxgame')) {
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
								if ($partnerID == '') {
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
$my_text = str_replace('{tienthang}', "300.000đ",$my_text);
$my_text = str_replace('{userwin}', "admin***", $my_text);
$my_text = str_replace('{thoigian}', gettime() , $my_text);
$my_text = str_replace('{noidungchuyen}', H3, $my_text);
$my_text = str_replace('{gamechoi}', (H3), $my_text);
sendMessTelegram($my_text);
									$tkuma->update("lich_su_choi",[
                                        'status' => 'success',
                                        'msg_send' => 'Thanh Toán Thành Công'
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
				if($tkuma->site("status_websoket") == 1){pinghistory();}
				$tkuma->update("settings",[ 'value' => random('1234', '1') ]," `name` = ?  ",['time_bot']);
		} else {
		    $tkuma->update("settings",[ 'value' => $tkuma->site('time_bot') - 1 ]," `name` = ?  ",['time_bot']);
			echo "KHÔNG CÓ GIAO DỊCH NÀO🅾<br>\n";
		}
		echo "<pre>";
		print_r($gethistt);
			#END2

		#END1
	}
}
