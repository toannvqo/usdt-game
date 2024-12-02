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

$transId = check_string2($_POST['transId']);

if ($row = $tkuma->get_row("SELECT * FROM `lich_su_choi` WHERE `tranId` = ? ",[$transId]))
{
	if (!$game = $tkuma->get_row("SELECT * FROM `danh_sach_game` WHERE `ma_game` = ? ",[$row['ma_game']]))
	{$namegame = 'Sai Nội Dung';} else {$namegame = $game['ten_game']; }
	$arr_res = array(
		'transId' => $row['tranId'],
		'phone' => substr($row['phone'], 0, 6)."****",
		'amount' => $row['amount_play'],
		'bonus' => $row['amount_game'],
		'gameName' => $namegame,
		'comment' => $row['comment'],
		'status' => $row['status'],
		'result' => $row['result_text'],
		'time' => $row['time']
	);
	$arr_total = array(
		'success' => true,
		'message' => 'Lấy thành công!',
		'data' => $arr_res
	);
	echo stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
}
else
{
    $arr_total = array(
		'success' => false,
		'message' => 'Không tìm thấy mã giao dịch này!',
		'data' => ''
	);
	echo stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
    
}
ob_flush();
?>