<?php
define("IN_SITE", true);
require_once(__DIR__ . '/../../libs/db.php');
require_once(__DIR__ . '/../../libs/config.php');
require_once(__DIR__ . '/../../libs/helper.php');
require_once(__DIR__ . '/../../libs/redis.php');

$tkuma = new DB();
$cronController = new CronController('cronnvn');
$now = date("Y/m/d");
if ($_GET['type'] == $tkuma->site('pin_cron')) {
    if($tkuma->get_row("SELECT * FROM `event` WHERE  `keyd` = ?  ",['nhiem-vu-ngay'])['trangthai'] =! 'run') {
        die('Chức năng hiện đang bảo trì.');
    }
	if (!$cronController->canRun()) {
		die('Cron job đã chạy quá số lần cho phép trong khoảng thời gian này.');
	}
	if (getRowRealtime('cronjobsact', '8', 'status') == 0) {
		die(json_encode(['status' => 'error', 'msg' => 'Chức năng không hoạt động']));
	}
	
    $getlist_momo = $tkuma->get_list("SELECT * FROM `lich_su_choi` WHERE `time` >= '$now 00:00:00' AND `type_gd` >= ? AND `sttbot` = ? AND `result_text` != ? AND `phone` != '' GROUP BY id ",['real','0','SAI NỘI DUNG']);
	if (isset($getlist_momo)) {
	    foreach ($getlist_momo as $rows) {
            $getdl2 = $tkuma->get_row("SELECT * FROM `event` WHERE  `keyd` = ? AND `trangthai` = ? ",['nhiem-vu-ngay','run']);
            $sdtchoi = $rows['phone'];
            $moc1 = $getdl2['moc1'];
            $thuong1 = $getdl2['thuong1'];
            $moc2 = $getdl2['moc2'];
            $thuong2 = $getdl2['thuong2'];
            $moc3 = $getdl2['moc3'];
            $thuong3 = $getdl2['thuong3'];
            $moc4 = $getdl2['moc4'];
            $thuong4 = $getdl2['thuong4'];
            $moc5 = $getdl2['moc5'];
            $thuong5 = $getdl2['thuong5'];
            $comment1 = 'NHIEMVUNGAY1';
            $comment2 = 'NHIEMVUNGAY2';
            $comment3 = 'NHIEMVUNGAY3';
            $comment4 = 'NHIEMVUNGAY4';
            $comment5 = 'NHIEMVUNGAY5';
            $dem1 = checkvnv($comment1, $sdtchoi); // check xem đã trả thưởng mốc 1 chưa
            $dem2 = checkvnv($comment2, $sdtchoi); // check xem đã trả thưởng mốc 2 chưa
            $dem3 = checkvnv($comment3, $sdtchoi); // check xem đã trả thưởng mốc 3 chưa
            $dem4 = checkvnv($comment4, $sdtchoi); // check xem đã trả thưởng mốc 4 chưa
            $dem5 = checkvnv($comment5, $sdtchoi); // check xem đã trả thưởng mốc 5 chưa
            
            $cashchoi = $tkuma->get_row("SELECT SUM(`amount_play`) AS totalAmount FROM `lich_su_choi` WHERE `type_gd` = ? AND `phone` = ? AND `time` >= ?", ['real', $rows['phone'], date("Y/m/d 00:00:00")])['totalAmount'];
            if ($cashchoi < $moc1) {
                echo "Người chơi ".$rows['partnerName']." đã chơi $cashchoi VNĐ, hãy chơi tiếp để nhận mốc 1 !\n";;
            } elseif ($cashchoi >= $moc1 && $dem1 == 0) {
                $SEND_L = $tkuma->insert("user_nvn", [
                    'phone' => $sdtchoi,
                    'mocthuong' => $comment1,
                    'amount' => $thuong1,
                    'time' => gettime(),
                    'status	' => 1
                ]);
                if ($SEND_L) {
                    $tkuma->insert("lich_su_choi", [
					'phone'  =>   $sdtchoi,
					'phone_nhan' => 0,
					'tranId' =>   random('123456789', '9'),
					'partnerName' => $rows['partnerName'],
					'id_momo' => $rows['id_momo'],
					'amount_play' => $thuong1,
					'amount_game' => $thuong1,
					'comment' => $comment1,
					'game' => 'Nhiệm Vụ Ngày',
					'ma_game' => 'nhien-vu-ngay',
					'result' => 'success',
					'result_text' => 'Thưởng mốc 1',
					'type_gd' => 'nhiemvungay',
					'status' => 'pending',
					'result_number' => 1,
					'time_tran' => strtotime(gettime()),
					'time' => gettime(),
					'msg_send' => 'Đang Chờ Thanh Toán'
					]);
                    echo "Người chơi ".$rows['partnerName']." đã chơi $cashchoi VNĐ, nhận được thưởng mốc 1 hãy chơi tiếp để nhận mốc 2 !\n";
                } else {
                    echo "Trả thưởng nhiệm vụ mốc 1 thất bại,  xin thử lại sau ! Người chơi ".$rows['partnerName']." đã chơi $cashchoi VNĐ !\n";
                }
            } elseif ($cashchoi < $moc2) {
                echo "Người chơi ".$rows['partnerName']." đã chơi $cashchoi VNĐ, hãy chơi tiếp để nhận mốc 2 !\n";
            } elseif ($cashchoi >= $moc2 && $dem2 == 0) {
                $SEND_L = $tkuma->insert("user_nvn", [
                    'phone' => $sdtchoi,
                    'mocthuong' => $comment2,
                    'amount' => $thuong2,
                    'time' => gettime(),
                    'status	' => 1
                ]);
                if ($SEND_L) {
                    $tkuma->insert("lich_su_choi", [
					'phone'  =>   $sdtchoi,
					'phone_nhan' => 0,
					'tranId' =>   random('123456789', '9'),
					'partnerName' => $rows['partnerName'],
					'id_momo' => $rows['id_momo'],
					'amount_play' => $thuong2,
					'amount_game' => $thuong2,
					'comment' => $comment2,
					'game' => 'Nhiệm Vụ Ngày',
					'ma_game' => 'nhien-vu-ngay',
					'result' => 'success',
					'result_text' => 'Thưởng mốc 2',
					'type_gd' => 'nhiemvungay',
					'status' => 'pending',
					'result_number' => 1,
					'time_tran' => strtotime(gettime()),
					'time' => gettime(),
					'msg_send' => 'Đang Chờ Thanh Toán'
					]);
                    echo "Người chơi ".$rows['partnerName']." đã chơi $cashchoi VNĐ, nhận được thưởng mốc 2 hãy chơi tiếp để nhận mốc 3 !\n";
                } else {
                    echo "Trả thưởng nhiệm vụ mốc 2 thất bại,  xin thử lại sau ! Người chơi ".$rows['partnerName']." đã chơi $cashchoi VNĐ !\n";
                }
            } elseif ($cashchoi < $moc3) {
                 echo "Người chơi ".$rows['partnerName']." đã chơi $cashchoi VNĐ, hãy chơi tiếp để nhận mốc 3 !\n";
            } elseif ($cashchoi >= $moc3 && $dem3 == 0) {
                $SEND_L = $tkuma->insert("user_nvn", [
                    'phone' => $sdtchoi,
                    'mocthuong' => $comment3,
                    'amount' => $thuong3,
                    'time' => gettime(),
                    'status	' => 1
                ]);
                if ($SEND_L) {
                    $tkuma->insert("lich_su_choi", [
					'phone'  =>   $sdtchoi,
					'phone_nhan' => 0,
					'tranId' =>   random('123456789', '9'),
					'partnerName' => $rows['partnerName'],
					'id_momo' => $rows['id_momo'],
					'amount_play' => $thuong3,
					'amount_game' => $thuong3,
					'comment' => $comment3,
					'game' => 'Nhiệm Vụ Ngày',
					'ma_game' => 'nhien-vu-ngay',
					'result' => 'success',
					'result_text' => 'Thưởng mốc 3',
					'type_gd' => 'nhiemvungay',
					'status' => 'pending',
					'result_number' => 1,
					'time_tran' => strtotime(gettime()),
					'time' => gettime(),
					'msg_send' => 'Đang Chờ Thanh Toán'
					]);
                    echo "Người chơi ".$rows['partnerName']." đã chơi $cashchoi VNĐ, nhận được thưởng mốc 3 hãy chơi tiếp để nhận mốc 4 !\n";
                } else {
                   echo "Trả thưởng nhiệm vụ mốc 3 thất bại,  xin thử lại sau ! Người chơi ".$rows['partnerName']." đã chơi $cashchoi VNĐ !\n";
                }
            } elseif ($cashchoi < $moc4) {
                echo "Người chơi ".$rows['partnerName']." đã chơi $cashchoi VNĐ, hãy chơi tiếp để nhận mốc 4 !\n";
            } elseif ($cashchoi >= $moc4 && $dem4 == 0) {
                $SEND_L = $tkuma->insert("user_nvn", [
                    'phone' => $sdtchoi,
                    'mocthuong' => $comment4,
                    'amount' => $thuong4,
                    'time' => gettime(),
                    'status	' => 1
                ]);
                if ($SEND_L) {
                    $tkuma->insert("lich_su_choi", [
					'phone'  =>   $sdtchoi,
					'phone_nhan' => 0,
					'tranId' =>   random('123456789', '9'),
					'partnerName' => $rows['partnerName'],
					'id_momo' => $rows['id_momo'],
					'amount_play' => $thuong4,
					'amount_game' => $thuong4,
					'comment' => $comment4,
					'game' => 'Nhiệm Vụ Ngày',
					'ma_game' => 'nhien-vu-ngay',
					'result' => 'success',
					'result_text' => 'Thưởng mốc 4',
					'type_gd' => 'nhiemvungay',
					'status' => 'pending',
					'result_number' => 1,
					'time_tran' => strtotime(gettime()),
					'time' => gettime(),
					'msg_send' => 'Đang Chờ Thanh Toán'
					]);
                    echo "Người chơi ".$rows['partnerName']." đã chơi $cashchoi VNĐ, nhận được thưởng mốc 4 hãy chơi tiếp để nhận mốc 5 !\n";
                } else {
                    echo "Trả thưởng nhiệm vụ mốc 4 thất bại,  xin thử lại sau ! Người chơi ".$rows['partnerName']." đã chơi $cashchoi VNĐ !\n";
                }
            } elseif ($cashchoi < $moc5) {
                echo "Người chơi ".$rows['partnerName']." đã chơi $cashchoi VNĐ, hãy chơi tiếp để nhận mốc 5 !\n";
            } elseif ($cashchoi >= $moc5 && $dem5 == 0) {
                
                $SEND_L = $tkuma->insert("user_nvn", [
                    'phone' => $sdtchoi,
                    'mocthuong' => $comment5,
                    'amount' => $thuong5,
                    'time' => gettime(),
                    'status	' => 1
                ]);
                if ($SEND_L) {
                    $tkuma->insert("lich_su_choi", [
					'phone'  =>   $sdtchoi,
					'phone_nhan' => 0,
					'tranId' =>   random('123456789', '9'),
					'partnerName' => $rows['partnerName'],
					'id_momo' => $rows['id_momo'],
					'amount_play' => $thuong5,
					'amount_game' => $thuong5,
					'comment' => $comment5,
					'game' => 'Nhiệm Vụ Ngày',
					'ma_game' => 'nhien-vu-ngay',
					'result' => 'success',
					'result_text' => 'Thưởng mốc 5',
					'type_gd' => 'nhiemvungay',
					'status' => 'pending',
					'result_number' => 1,
					'time_tran' => strtotime(gettime()),
					'time' => gettime(),
					'msg_send' => 'Đang Chờ Thanh Toán'
					]);
                    echo "Người chơi ".$rows['partnerName']." đã chơi $cashchoi VNĐ, nhận được thưởng mốc 5 !\n";
                } else {
                    echo "Trả thưởng nhiệm vụ mốc 5 thất bại,  xin thử lại sau ! Người chơi ".$rows['partnerName']." đã chơi $cashchoi VNĐ !\n";
                }
            }
	        
	    }
	}
}