<?php

/**
* @package     MomoCMS
* @link        http://
* @copyright   Copyright (C) 2022-2022 TimoCMS Community
* @author      Tran Long IT mb_strtoupper($core->Unicode_VNI($row['name'])),
*/

define("IN_SITE", true);
require_once(__DIR__."/../../libs/db.php");
require_once(__DIR__.'/../../libs/config.php');
require_once(__DIR__."/../../libs/helper.php");
$tkuma = new DB();
$Mobile_Detect = new Mobile_Detect();
header('Content-Type: application/json');

$session = isset($_SESSION['login']) ? check_string($_SESSION['login']) : '';
$getUser = $tkuma->get_row(" SELECT * FROM `users` WHERE `token` = ? ",[$session]);
$nameuser = $getUser['username'] ?? 'NICKNAME';
//get history
$arr_reshis = array();
foreach ($tkuma->get_list("SELECT * FROM `lich_su_choi` WHERE `type_gd` = ? AND `result` = ? AND `result_text` = ? ORDER BY `id` DESC LIMIT 10",['real','success','CHIẾN THẮNG']) as $rowd)
{
	$gamed = $tkuma->get_row("SELECT * FROM `danh_sach_game` WHERE `ma_game` = ? ",[$rowd['ma_game']]);
	$arr_reshis[] = array(
	    	'phone' => substr($rowd['partnerName'], 0, -5).'****',
	    	'tranid' => '****' . substr($rowd['tranId'], -4),
	    	'comment' => $rowd['comment'],
	    	'money' => (int)$rowd['amount_play'],
	    	'bonus' => (int)$rowd['amount_game'],
	    	'gameName' => $gamed['ten_game'],
	    	'content' => $rowd['comment'],
	    	'result' => $rowd['status'],
	    	'time' => $rowd['time'],
	    	'trangthai' => $rowd['result_text']
	    );
	    
}

//get history gần đây
$arr_reshisgd = array();
foreach ($tkuma->get_list("SELECT * FROM `lich_su_choi` WHERE `type_gd` = ? AND `result` = ? AND `partnerName` != '' ORDER BY `id` DESC LIMIT 10",['real','success']) as $rowd)
{
	$gamed = $tkuma->get_row("SELECT * FROM `users` WHERE `username` = ?",[$rowd['partnerName']]);
	$bankname = $tkuma->get_row("SELECT * FROM `bankcode` WHERE `id` = ?",[$gamed['bankid']]);
	$arr_reshisgd[] = array(
	    	'nickname' => $rowd['partnerName'],
	    	'bankname' => $bankname['bankname'],
	    	'bankcode' => $bankname['bankcode'],
	    	'stk' => substr($gamed['stk'], 0, -5).'****',
	    	'time' => $rowd['time']
	    );
}

//danh sach game
$arr_resgame = array();
foreach ($tkuma->get_list("SELECT * FROM `danh_sach_game` WHERE `status` = ? ORDER BY `id` ASC ",['run']) as $rowgame) 
{
	$arr_resgame[] = array(
		'description' => check_string($rowgame['mo_ta']),
		'display' => 'show',
		'gameType' => $rowgame['ma_game'],
		'name' => $rowgame['ten_game']
	);
}

//get game
$arr_resphone = array();
foreach ($tkuma->get_list("SELECT * FROM `phone`  ORDER BY `id` DESC") as $rowphone) 
{
    	$arr_resphone[] = array(
            "id" => (int)$rowphone['id'],
            "phone" => $rowphone['phone'],
            "limitDay" =>  '0',
            "limitMonth" => '12',
            "number" =>  '0',
            "name" => $rowphone['ctk'],
            "bankname" => $rowphone['namebank'],
            "amountDay" => '3',
            "amountMonth" => '12',
            "count" => '0',
            "status" => $rowphone['status'],
            "bankimg" => display_bank($rowphone['namebank']),
    	);
}
//top tuan
$arr_restoptuan = array();
$now = date("Y/m/d H:i:s");

$this_monday = strtotime('this week Monday') + 0;
$next_monday = strtotime('next week Monday') + 0;
$this_monday_formatted = date('Y/m/d H:i:s', $this_monday);
$next_monday_formatted = date('Y/m/d H:i:s', $next_monday);
$result_momo_history = $tkuma->get_list("SELECT SUM(amount_play), partnerName, phone 
    FROM `lich_su_choi` 
    WHERE `phone` != '' 
        AND `status` = 'success' 
        AND `time` BETWEEN ? AND ?
    GROUP BY `phone` 
    ORDER BY SUM(amount_play) DESC 
    LIMIT 5",[$this_monday_formatted,$next_monday_formatted]);
$i = 0;
$top_up = $tkuma->get_row("SELECT * FROM `event` WHERE `keyd` = ? ",['top-tuan']);
foreach ($result_momo_history as $eow_top) 
{
$i++;
    if($tkuma->site("status_facetop") == 1){  
        
        $usertuan = substr($tkuma->site("usertuan".$i), 0, -3);
        if ($usertuan == "0" || empty($usertuan) || $usertuan == "") {
            $phone = substr($eow_top['partnerName'], 0, -3).'****';
        } else {
            $phone = $usertuan.'****';
        }
        
        $moneytuan = preg_replace("/[^0-9]/", "", $tkuma->site("toptuan".$i));
        if ($moneytuan == "0" || empty($moneytuan) || $moneytuan == "") {
            $money = preg_replace("/[^0-9]/", "",$eow_top['SUM(amount_play)']);
        } else {
            $money = $moneytuan;
       
        }
    
    
        $arr_restoptuan[] = array(
            "id" => (int)$i,
            "phone" => $phone,
            "money" => $money ,
            "thuong" =>  number_format($top_up['thuong' . $i])
    	);
    } else {
        $arr_restoptuan[] = array(
            "id" => (int)$i,
            "phone" => substr($eow_top['partnerName'], 0, -3).'****',
            "money" => preg_replace("/[^0-9]/", "",$eow_top['SUM(amount_play)']) ,
            "thuong" =>  number_format($top_up['thuong' . $i])
    	);
    }
}


//getlisdu lich_su_choi
$arr_reshisuer = array();
if (!empty($getUser)){
    foreach ($tkuma->get_list("SELECT * FROM `lich_su_choi` WHERE `partnerName` = ? ORDER BY `id` DESC LIMIT 10",[$getUser['username']]) as $rowuser)
    {
	    $game2 = $tkuma->get_row("SELECT * FROM `danh_sach_game` WHERE `ma_game` = ? ",[$rowuser['ma_game']])['ten_game'] ?? 'SAI NỘI DUNG';
	   // if($game2==''){$game2 = 'SAI NỘI DUNG';}
	    $arr_reshisuer[] = array(
	    	'phone' => substr($rowuser['phone'], 0, -5).'****',
	    	'tranid' => '' . substr($rowuser['tranId'], -14),
	    	'comment' => $rowuser['comment'],
	    	'money' => (int)$rowuser['amount_play'],
	    	'bonus' => (int)$rowuser['amount_game'],
	    	'gameName' => $game2,
	    	'content' => $rowuser['comment'],
	    	'result' => $rowuser['status'],
	    	'time' => $rowuser['time'],
	    	'trangthai' => $rowuser['result_text']
	    );
    }
}

$arr_suer = array();
//getlisdu lich_su_choi
if (!empty($getUser)){
	    $arr_suer = array(
	    	'username' => $getUser['username'],
	    	'update_date' => $getUser['update_date'],
	    	'bankname' => $getUser['bankname'],
	    	'stk' => $getUser['stk'],
	    	'bank' => getRowRealtime('bankcode', $getUser['bankid'], 'bankname')
	    );
}

//get game
$arr_reseven = array();
foreach ($tkuma->get_list("SELECT * FROM `event`  ORDER BY `id` DESC") as $roweven) 
{
    	$arr_reseven[] = array(
            "id" => (int)$roweven['id'],
            "key" => $roweven['keyd'],
            "name" => $roweven['game'],
            "mota" => $roweven['mota'],
            "trangthai" => $roweven['trangthai'],
            "thuong"  => array(
	            'moc1' => $roweven['moc1'],
	            'thuong1' => $roweven['thuong1'],
	            'moc2' => $roweven['moc2'],
	            'thuong2' => $roweven['thuong2'],
	            'moc3' => $roweven['moc3'],
	            'thuong3' => $roweven['thuong3'],
	            'moc4' => $roweven['moc4'],
	            'thuong4' => $roweven['thuong4'],
	            'moc5' => $roweven['moc5'],
	            'thuong5' => $roweven['thuong5'],
            )
    	);
}

//setting home
if($getUser['id_telegram'] != null){
    $linkddd = 0;
}else{
    $linkddd = $tkuma->site("telegrambot").'?start='.$session;
}
$arr_setting = array(
    "ndchoi" => $tkuma->site("ndnaptien").$nameuser
);

$arr_total = array(
	'success' => true,
	'message' => 'Lấy thành công!',
	'data' => array(
	    'datahistory' => $arr_reshis,
	    'datagame' => $arr_resgame,
	    'dataphone' => $arr_resphone,
	    'datatop' => $arr_restoptuan,
	    'datahisuer' => $arr_reshisuer,
	    'datasuer' => $arr_suer,
	    'dataeven' => $arr_reseven,
	    'arr_reshisgd' => $arr_reshisgd,
	    'setting' => $arr_setting
	    
    )
);


echo stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
// $tkuma->pusher('phoneData', $arr_res,'1');
ob_flush();
?>

