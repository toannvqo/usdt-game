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

$now = date("Y/m/d");
$siteeven = $tkuma->get_row("SELECT * FROM `event` WHERE `keyd` = ? ",['no-hu']);

if($siteeven['trangthai'] != 'run') {
    $arr_total = array(
            'success' => false,
            'message' => "Chức năng hiện đang bảo trì"
    );
    die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)));
}
$phone = check_string2($_POST['transId']);
$lanchoi = $tkuma->get_row("SELECT * FROM `lich_su_choi` WHERE `tranId` = ? AND `partnerName` != '' AND `time` >= '$now 00:00:00'  ",[$phone]); // check xem sdt chơi lần nào chưa nè
$dem1 = checktamhoa($phone,$lanchoi['phone']);
$username = $tkuma->get_row("SELECT * FROM `users` WHERE `username` = ? ",[$lanchoi['partnerName']]);
if (!$lanchoi)
{
	$arr_total = array(
		'success' => false,
		'message' => 'Không tồn tại trong hệ thống !'
	);
	die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
}
if ($dem1 != 0)
{
	$arr_total = array(
		'success' => false,
		'message' => 'Mã Này Đã Nhận Thưởng!'
	);
	die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
}

$username = $tkuma->get_row("SELECT * FROM `users` WHERE `username` = ? ",[$lanchoi['partnerName']]);
if (isSequential5($phone)) {
    $tkuma->insert("lich_su_choi", [
					'phone'  =>   $username['stk'],
					'phone_nhan' => 0,
					'tranId' =>   strtotime(gettime()),
					'partnerName' => $username['username'],
					'id_momo' => $username['id'],
					'amount_play' => $siteeven['thuong5'],
					'amount_game' => $siteeven['thuong5'],
					'comment' => $phone,
					'game' => 'Nổ Hủ',
					'ma_game' => 'no-hu',
					'result' => 'success',
					'result_text' => 'Nổ Hủ',
					'type_gd' => 'nohu',
					'status' => 'pending',
					'result_number' => 1,
					'time_tran' => strtotime(gettime()),
					'time' => gettime(),
					'msg_send' => 'Đang Chờ Thanh Toán'
					]);
   $SEND_L = $tkuma->insert("user_giftcode", [
                    'phone' => $lanchoi['phone'],
                    'giftcode' => $phone,
                    'amount' => $siteeven['thuong5'],
                    'time' => gettime(),
                    'status	' => 1
                ]);
    if($SEND_L){
        $arr_total = array(
            'amount' => $siteeven['thuong5'],
			'success' => true,
			'message' => 'Sử dụng thành công!'
		);
		die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
    }
                
} else if (isSequential4($phone)) {
    $tkuma->insert("lich_su_choi", [
					'phone'  =>   $username['stk'],
					'phone_nhan' => 0,
					'tranId' =>   strtotime(gettime()),
					'partnerName' => $username['username'],
					'id_momo' => $username['id'],
					'amount_play' => $siteeven['thuong4'],
					'amount_game' => $siteeven['thuong4'],
					'comment' => $phone,
					'game' => 'Nổ Hủ',
					'ma_game' => 'no-hu',
					'result' => 'success',
					'result_text' => 'Nổ Hủ',
					'type_gd' => 'nohu',
					'status' => 'pending',
					'result_number' => 1,
					'time_tran' => strtotime(gettime()),
					'time' => gettime(),
					'msg_send' => 'Đang Chờ Thanh Toán'
					]);
   $SEND_L = $tkuma->insert("user_giftcode", [
                    'phone' => $lanchoi['phone'],
                    'giftcode' => $phone,
                    'amount' => $siteeven['thuong4'],
                    'time' => gettime(),
                    'status	' => 1
                ]);
                if($SEND_L){
                    $arr_total = array(
                        'amount' => $siteeven['thuong4'],
						'success' => true,
						'message' => 'Sử dụng thành công!'
					);
					die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
                }
                
} else if (isSequential3($phone)) {
    $tkuma->insert("lich_su_choi", [
					'phone'  =>   $username['stk'],
					'phone_nhan' => 0,
					'tranId' =>   strtotime(gettime()),
					'partnerName' => $username['username'],
					'id_momo' => $username['id'],
					'amount_play' => $siteeven['thuong3'],
					'amount_game' => $siteeven['thuong3'],
					'comment' => $phone,
					'game' => 'Nổ Hủ',
					'ma_game' => 'no-hu',
					'result' => 'success',
					'result_text' => 'Nổ Hủ',
					'type_gd' => 'nohu',
					'status' => 'pending',
					'result_number' => 1,
					'time_tran' => strtotime(gettime()),
					'time' => gettime(),
					'msg_send' => 'Đang Chờ Thanh Toán'
					]);
   $SEND_L = $tkuma->insert("user_giftcode", [
                    'phone' => $lanchoi['phone'],
                    'giftcode' => $phone,
                    'amount' => $siteeven['thuong3'],
                    'time' => gettime(),
                    'status	' => 1
                ]);
                if($SEND_L){
                    $arr_total = array(
                        'amount' => $siteeven['thuong3'],
						'success' => true,
						'message' => 'Sử dụng thành công!'
					);
					die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
                }
                
} else if (nguquy($phone)) {
        $tkuma->insert("lich_su_choi", [
					'phone'  =>   $username['stk'],
					'phone_nhan' => 0,
					'tranId' =>   strtotime(gettime()),
					'partnerName' => $username['username'],
					'id_momo' => $username['id'],
					'amount_play' => $siteeven['thuong5'],
					'amount_game' => $siteeven['thuong5'],
					'comment' => $phone,
					'game' => 'Nổ Hủ',
					'ma_game' => 'no-hu',
					'result' => 'success',
					'result_text' => 'Nổ Hủ',
					'type_gd' => 'nohu',
					'status' => 'pending',
					'result_number' => 1,
					'time_tran' => strtotime(gettime()),
					'time' => gettime(),
					'msg_send' => 'Đang Chờ Thanh Toán'
					]);
   $SEND_L = $tkuma->insert("user_giftcode", [
                    'phone' => $lanchoi['phone'],
                    'giftcode' => $phone,
                    'amount' => $siteeven['thuong5'],
                    'time' => gettime(),
                    'status	' => 1
                ]);
                if($SEND_L){
                    $arr_total = array(
                        'amount' => $siteeven['thuong5'],
						'success' => true,
						'message' => 'Sử dụng thành công!'
					);
					die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
                }
                
} else if (tuquy($phone)) {
     $tkuma->insert("lich_su_choi", [
					'phone'  =>   $username['stk'],
					'phone_nhan' => 0,
					'tranId' =>   strtotime(gettime()),
					'partnerName' => $username['username'],
					'id_momo' => $username['id'],
					'amount_play' => $siteeven['thuong4'],
					'amount_game' => $siteeven['thuong4'],
					'comment' => $phone,
					'game' => 'Nổ Hủ',
					'ma_game' => 'no-hu',
					'result' => 'success',
					'result_text' => 'Nổ Hủ',
					'type_gd' => 'nohu',
					'status' => 'pending',
					'result_number' => 1,
					'time_tran' => strtotime(gettime()),
					'time' => gettime(),
					'msg_send' => 'Đang Chờ Thanh Toán'
					]);
   $SEND_L = $tkuma->insert("user_giftcode", [
                    'phone' => $lanchoi['phone'],
                    'giftcode' => $phone,
                    'amount' => $siteeven['thuong4'],
                    'time' => gettime(),
                    'status	' => 1
                ]);
                if($SEND_L){
                    $arr_total = array(
                        'amount' => $siteeven['thuong4'],
						'success' => true,
						'message' => 'Sử dụng thành công!'
					);
					die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
                }
                
} else if (tamhoa($phone)) {
     $tkuma->insert("lich_su_choi", [
					'phone'  =>   $username['stk'],
					'phone_nhan' => 0,
					'tranId' =>   strtotime(gettime()),
					'partnerName' => $username['username'],
					'id_momo' => $username['id'],
					'amount_play' => $siteeven['thuong3'],
					'amount_game' => $siteeven['thuong3'],
					'comment' => $phone,
					'game' => 'Nổ Hủ',
					'ma_game' => 'no-hu',
					'result' => 'success',
					'result_text' => 'Nổ Hủ',
					'type_gd' => 'nohu',
					'status' => 'pending',
					'result_number' => 1,
					'time_tran' => strtotime(gettime()),
					'time' => gettime(),
					'msg_send' => 'Đang Chờ Thanh Toán'
					]);
   $SEND_L = $tkuma->insert("user_giftcode", [
                    'phone' => $lanchoi['phone'],
                    'giftcode' => $phone,
                    'amount' => $siteeven['thuong3'],
                    'time' => gettime(),
                    'status	' => 1
                ]);
                if($SEND_L){
                    $arr_total = array(
                        'amount' => $siteeven['thuong3'],
						'success' => true,
						'message' => 'Sử dụng thành công!'
					);
					die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
                }
                
} else {
	$arr_total = array(
		'success' => false,
		'message' => 'TranId này có cái nịt!'
	);
	die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
}

ob_flush();
