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


$arr_res = array();
foreach ($tkuma->get_list("SELECT * FROM `danh_sach_game` WHERE `status` = ? ORDER BY `id` ASC",['run']) as $row) 
{
	$arr_res[] = array(
		'description' => check_string($row['mo_ta']),
		'display' => 'show',
		'gameType' => $row['ma_game'],
		'name' => $row['ten_game']
	);
}

$arr_total = array(
	'success' => true,
	'message' => 'Lấy thành công!',
	'data' => $arr_res
);

header('Content-Type: application/json');

echo stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
ob_flush();
?>