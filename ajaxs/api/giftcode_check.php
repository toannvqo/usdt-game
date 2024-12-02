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
$nickname = check_string2($_POST['phone']);
$lanchoi = $tkuma->num_rows("SELECT * FROM `lich_su_choi` WHERE `partnerName` = ? AND `time` >= '$now 00:00:00'  ",[$nickname]); // check xem sdt chơi lần nào chưa nè

$phone = $tkuma->get_row("SELECT * FROM `lich_su_choi` WHERE `partnerName` = ? ",[$nickname])['phone'] ?? null;
$username = $tkuma->get_row("SELECT * FROM `users` WHERE `username` = ? ",[$nickname]);
$giftcode = check_string2($_POST['giftcode']);

$sotien = $tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `result_text` != ? AND `phone` = ? AND `time` >= '$now 00:00:00'  ",['SAI NỘI DUNG',$phone])['SUM(`amount_play`)'];

if ($lanchoi == 0)
{
	$arr_total = array(
		'success' => false,
		'message' => 'Số tài khoản chưa chơi trên hệ thống'
	);
	die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
}

$ctk = $username['acc_name'];
$check_ctk = $tkuma->get_row("SELECT * FROM `user_giftcode` WHERE `ctk` = ? AND `giftcode` = ? ",[$ctk, $giftcode]);
if($check_ctk)
{
	$arr_total = array(
		'success' => false,
		'message' => 'Mã GiftCode này đã hết hạn hoặc hết lượt sử dụng!'
	);
	die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
}


if ($row = $tkuma->get_row("SELECT * FROM `giftcode` WHERE `giftcode` = ? ",[$giftcode]))
{
        if ($sotien < $row['min']) {
            $arr_total = array(
        		'success' => false,
        		'message' => 'Bạn phải chơi ít nhất '.$row['min'].' Đ mới được nhận code nhé !'
        	);
        	die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
        }
		if ($row['gioi_han'] <= $row['da_nhap'])
		{
            $arr_total = array(
				'success' => false,
				'message' => 'Mã GiftCode này đã hết hạn hoặc hết lượt sử dụng!'
			);
			die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
        }
		if ($tkuma->Num_Rows("SELECT * FROM `user_giftcode` WHERE `phone` = ? AND `giftcode` = ? ",[$phone,$giftcode]) > 0)
		{
			$arr_total = array(
				'success' => false,
				'message' => 'Bạn chỉ được dùng GiftCode này một lần!'
			);
			die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
		}
		else
		{
		    $tkuma->insert("lich_su_choi", [
					'phone'  =>   $phone,
					'phone_nhan' => 0,
					'tranId' =>   strtotime(gettime()),
					'partnerName' => $nickname,
					'id_momo' => $username['id'],
					'amount_play' => $row['money'],
					'amount_game' => $row['money'],
					'comment' => $giftcode,
					'game' => 'Gift Code',
					'ma_game' => 'gift-code',
					'result' => 'success',
					'result_text' => 'Gift Code',
					'type_gd' => 'giftcode',
					'status' => 'pending',
					'result_number' => 1,
					'time_tran' => strtotime(gettime()),
					'time' => gettime(),
					'msg_send' => 'Đang Chờ Thanh Toán'
					]);
				$act = $tkuma->insert("user_giftcode", [
					'phone'  =>   $phone,
					'giftcode' => $giftcode,
					'amount' =>   $row['money'],
					'time' => gettime(),
					'status' => 1,
					'ctk' => $username['acc_name']
					]);

			if ($act)
			{
				// $tkuma->cong("giftcode","da_nhap",'1', " `giftcode` = ? ",[$id]);
				$tkuma->Query("UPDATE `giftcode` SET `da_nhap` = `da_nhap` + '1' WHERE `giftcode` = '$giftcode'");
				$arr_total = array(
					'success' => true,
					'message' => 'Sử dụng thành công!'
				);
				die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
				
			}
			else
			{
				$arr_total = array(
					'success' => false,
					'message' => 'Lỗi hệ thống!'
				);
				die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
			}
		}
} else {
	$arr_total = array(
		'success' => false,
		'message' => 'Mã GiftCode không tồn tại!'
	);
	die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)));
}

ob_flush();
