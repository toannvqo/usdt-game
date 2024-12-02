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
$session = isset($_SESSION['login']) ? check_string($_SESSION['login']) : '';

$gameType = check_string($_POST['gameType']);
$iduser = $tkuma->get_row("SELECT * FROM `users` WHERE `token` = ? ",[$session]);
$req = $tkuma->get_list("SELECT * FROM `settings_game` WHERE `keyd` = ?",[$gameType]);
$arr_res = array();

if (!empty($iduser)){
foreach ($req as $row)
{
        $idusedr = $iduser['username'] ?? 'NICKNAME';
        $numberTLS = explode(',', $row['result']);
	    $arr_res[] = array(
	    	'gameType' => $row['keyd'],
	    	'content' => $tkuma->site('ndnaptien').$idusedr,
	    	'numberTLS' => $numberTLS,
	    	'amount' => $row['tile'],
	    	'code' => $row['comment'],
	    	'displayName' => $row['display_name']
	    );
	
}
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