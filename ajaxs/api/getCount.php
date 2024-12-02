<?php

/**
 * @package     MomoCMS
 * @link        http://
 * @copyright   Copyright (C) 2022-2022 TimoCMS Community
 * @author      Tran Long IT
 */

 define("IN_SITE", true);
 require_once(__DIR__."/../../libs/db.php");
 require_once(__DIR__.'/../../libs/config.php');
 require_once(__DIR__."/../../libs/helper.php");
 $tkuma = new DB();
 $Mobile_Detect = new Mobile_Detect();
 
header('Content-Type: application/json');

$nitname = check_string2($_POST['phone']);
$phone = $tkuma->get_row("SELECT * FROM `lich_su_choi` WHERE `partnerName` = ? ",[$nitname])['phone'];
$username = $tkuma->get_row("SELECT * FROM `users` WHERE `username` = ? ",[$nitname]);
$now = date("Y/m/d");

if($tkuma->get_row("SELECT * FROM `event` WHERE  `keyd` = ?  ",['nhiem-vu-ngay'])['trangthai'] =! 'run') {
    $return = array('success' => false, 'message' => 'Chức năng hiện đang bảo trì');
    die(json_encode($return));
}
                
if ($tkuma->get_row("SELECT * FROM `lich_su_choi` WHERE `phone` = ? ",[$phone])) {
    $data = $tkuma->get_row("SELECT `phone`, SUM(`amount_play`),`time` FROM `lich_su_choi` WHERE `time` >= '$now 00:00:00' AND `type_gd` >= ? AND `phone` = ? GROUP BY `phone` ",['real',$phone]);
    $getdl2 = $tkuma->get_row("SELECT * FROM `event` WHERE  `keyd` = ? AND `trangthai` = ? ",['nhiem-vu-ngay','run']);
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


    if (isset($phone)) {
        $sdtchoi = $phone;
        $comment1 = 'NHIEMVUNGAY1';
        $comment2 = 'NHIEMVUNGAY2';
        $comment3 = 'NHIEMVUNGAY3';
        $comment4 = 'NHIEMVUNGAY4';
        $comment5 = 'NHIEMVUNGAY5';
        $now = date("Y/m/d");
        $lanchoi = $tkuma->num_rows("SELECT * FROM `lich_su_choi` WHERE `phone` = ? AND `time` >= '$now 00:00:00' ",[$sdtchoi]); // check xem sdt chơi lần nào chưa nè


        $get_giftcode_user = $tkuma->get_row("SELECT * FROM `user_nvn`  WHERE `mocthuong` = ? AND `phone` = ? ",[$comment1,$sdtchoi]);
        if ($lanchoi <= 0) {
            $return = array('success' => false, 'message' => 'Số điện thoại này hôm nay chưa chơi trên hệ thống !', 'count' => $data['SUM(`amount_play`)']);
            die(json_encode($return));
        } else {
            if (!$sdtchoi) {
                $return = array('success' => false, 'message' => 'Số điện thoại chơi không tồn tại hoặc lỗi hệ thống không có tài khoản MoMo trả thưởng !', 'count' => $data['SUM(`amount_play`)']);
                die(json_encode($return));
            }

            $cashchoi = ($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `phone` = ? AND `time` >= '$now 00:00:00' ",['real',$sdtchoi])['SUM(`amount_play`)']);
            $cashchoi2 = number_format($cashchoi);

            if ($cashchoi < $moc1) {
                $return = array('success' => false, 'message' => "Bạn đã chơi $cashchoi2 VNĐ, hãy chơi tiếp để nhận mốc !", 'count' => $data['SUM(`amount_play`)']);
                die(json_encode($return));
            }
            $dem1 = checkvnv($comment1, $sdtchoi);
            $dem2 = checkvnv($comment2, $sdtchoi); // check xem đã trả thưởng mốc 2 chưa
            $dem3 = checkvnv($comment3, $sdtchoi); // check xem đã trả thưởng mốc 3 chưa
            $dem4 = checkvnv($comment4, $sdtchoi); // check xem đã trả thưởng mốc 4 chưa
            $dem5 = checkvnv($comment5, $sdtchoi); // check xem đã trả thưởng mốc 5 chưa
            if ($cashchoi >= $moc1 && $dem1 == 0) {
                
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
					'tranId' =>   strtotime(gettime()),
					'partnerName' => $nitname,
					'id_momo' => $username['id'],
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
                    $return = array('success' => true, 'message' => "Chúc mừng: $sdtchoi  đã chơi $cashchoi2 VNĐ, nhận được thưởng mốc 1, hãy chơi thêm để nhận thêm phần quà giá trị !", 'count' => $data['SUM(`amount_play`)']);
                    die(json_encode($return));
                } else {
                    $return = array('success' => false, 'message' => 'Trả thưởng nhiệm vụ mốc 1 thất bại,  xin thử lại sau !', 'count' => $data['SUM(`amount_play`)']);
                    die(json_encode($return));
                }
            } elseif ($cashchoi < $moc2) {
                $return = array('success' => false, 'message' => "Xin lỗi bạn đã chơi $cashchoi2 VNĐ, sắp được thưởng mốc 2, hãy chơi tiếp để nhận mốc !", 'count' => $data['SUM(`amount_play`)']);
                die(json_encode($return));
            } elseif ($cashchoi >= $moc2 && $dem2 == 0) {
                 $tkuma->insert("lich_su_choi", [
					'phone'  =>   $sdtchoi,
					'phone_nhan' => 0,
					'tranId' =>   strtotime(gettime()),
					'partnerName' => $nitname,
					'id_momo' => $username['id'],
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
                $SEND_L = $tkuma->insert("user_nvn", [
                    'phone' => $sdtchoi,
                    'mocthuong' => $comment2,
                    'amount' => $thuong2,
                    'time' => gettime(),
                    'status	' => 1
                ]);
                if ($SEND_L) {
                    $return = array('success' => true, 'message' => "Chúc mừng: $sdtchoi  đã chơi $cashchoi2 VNĐ, nhận được thưởng mốc 2, hãy chơi thêm để nhận thêm phần quà giá trị !", 'count' => $data['SUM(`amount_play`)']);
                    die(json_encode($return));
                } else {
                    $return = array('success' => false, 'message' => 'Trả thưởng nhiệm vụ mốc 2 thất bại,  xin thử lại sau !', 'count' => $data['SUM(`amount_play`)']);
                    die(json_encode($return));
                }
            } elseif ($cashchoi < $moc3) {
                $return = array('success' => false, 'message' => "Xin lỗi bạn đã chơi $cashchoi2 VNĐ, sắp được thưởng mốc 3, hãy chơi tiếp để nhận mốc !", 'count' => $data['SUM(`amount_play`)']);
                die(json_encode($return));
            } elseif ($cashchoi >= $moc3 && $dem3 == 0) {
                 $tkuma->insert("lich_su_choi", [
					'phone'  =>   $sdtchoi,
					'phone_nhan' => 0,
					'tranId' =>   strtotime(gettime()),
					'partnerName' => $nitname,
					'id_momo' => $username['id'],
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
                $SEND_L = $tkuma->insert("user_nvn", [
                    'phone' => $sdtchoi,
                    'mocthuong' => $comment3,
                    'amount' => $thuong3,
                    'time' => gettime(),
                    'status	' => 1
                ]);
                if ($SEND_L) {
                    $return = array('success' => true, 'message' =>  "Chúc mừng: $sdtchoi  đã chơi $cashchoi2 VNĐ, nhận được thưởng mốc 3, hãy chơi thêm để nhận thêm phần quà giá trị !", 'count' => $data['SUM(`amount_play`)']);
                    die(json_encode($return));
                } else {
                    $return = array('success' => false, 'message' => 'Trả thưởng nhiệm vụ mốc 3 thất bại,  xin thử lại sau !', 'count' => $data['SUM(`amount_play`)']);
                    die(json_encode($return));
                }
            } elseif ($cashchoi < $moc4) {
                $return = array('success' => false, 'message' => "Xin lỗi bạn đã chơi $cashchoi2 VNĐ, sắp được thưởng mốc 4, hãy chơi tiếp để nhận mốc !", 'count' => $data['SUM(`amount_play`)']);
                die(json_encode($return));
            } elseif ($cashchoi >= $moc4 && $dem4 == 0) {
                $tkuma->insert("lich_su_choi", [
					'phone'  =>   $sdtchoi,
					'phone_nhan' => 0,
					'tranId' =>   strtotime(gettime()),
					'partnerName' => $nitname,
					'id_momo' => $username['id'],
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
                $SEND_L = $tkuma->insert("user_nvn", [
                    'phone' => $sdtchoi,
                    'mocthuong' => $comment4,
                    'amount' => $thuong4,
                    'time' => gettime(),
                    'status	' => 1
                ]);
                if ($SEND_L) {
                    $return = array('success' => true, 'message' => "Chúc mừng: $sdtchoi  đã chơi $cashchoi2 VNĐ, nhận được thưởng mốc 4, hãy chơi thêm để nhận thêm phần quà giá trị !", 'count' => $data['SUM(`amount_play`)']);
                    die(json_encode($return));
                } else {
                    $return = array('success' => false, 'message' => 'Trả thưởng nhiệm vụ mốc 4 thất bại,  xin thử lại sau !', 'count' => $data['SUM(`amount_play`)']);
                    die(json_encode($return));
                }
            } elseif ($cashchoi < $moc5) {
                $return = array('success' => false, 'message' => "Xin lỗi bạn đã chơi $cashchoi2 VNĐ, sắp được thưởng mốc 5, hãy chơi tiếp để nhận mốc !", 'count' => $data['SUM(`amount_play`)']);
                die(json_encode($return));
            } elseif ($cashchoi >= $moc5 && $dem5 == 0) {
                $tkuma->insert("lich_su_choi", [
					'phone'  =>   $sdtchoi,
					'phone_nhan' => 0,
					'tranId' =>   strtotime(gettime()),
					'partnerName' => $nitname,
					'id_momo' => $username['id'],
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
                $SEND_L = $tkuma->insert("user_nvn", [
                    'phone' => $sdtchoi,
                    'mocthuong' => $comment5,
                    'amount' => $thuong5,
                    'time' => gettime(),
                    'status	' => 1
                ]);
                if ($SEND_L) {
                    $return = array('success' => true, 'message' => "Chúc mừng: $sdtchoi  đã chơi $cashchoi2 VNĐ, nhận được thưởng mốc 5, hãy chơi thêm để nhận thêm phần quà giá trị !", 'count' => $data['SUM(`amount_play`)']);

                    die(json_encode($return));
                } else {
                    $return = array('success' => false, 'message' => 'Trả thưởng nhiệm vụ mốc 5 thất bại,  xin thử lại sau !', 'count' => $data['SUM(`amount_play`)']);
                    die(json_encode($return));
                }
            } else {
                $return = array('success' => false, 'message' => 'Bạn đã nhận hết thưởng hôm nay rồi, quay lại vào ngày mai nhé, nhận thưởng nữa mình còn cái nịt mất !', 'count' => $data['SUM(`amount_play`)']);
                die(json_encode($return));
            }
        }
    } else {
        $return = array('success' => false, 'message' => 'Thiếu số điện thoại !', 'count' => $data['SUM(`amount_play`)']);
        die(json_encode($return));
    }
} else {
    echo '{"status":false,"message":"User name chưa tham gia hôm nay!","data":[]}';
}



ob_flush();
