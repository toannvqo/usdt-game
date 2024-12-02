<?php

define("IN_SITE", true);
require_once(__DIR__ . '/../../libs/config.php');
require_once(__DIR__."/../../libs/db.php");
require_once(__DIR__."/../../libs/helper.php");
 

$tkuma = new DB();
$Mobile_Detect = new Mobile_Detect();
use PragmaRX\Google2FAQRCode\Google2FA;


if (isset($_POST['action'])) {

    if($_POST['action'] == 'pass2')
    {
        if (empty($_SESSION['admin_login'])) {
            die(json_encode(['status' => 'error', 'msg' => 'Bạn không có quyền này !']));
        }
        $pass2 = base64_encode(check_string($_POST['pass2']));
        if (empty($_POST['pass2'])) {
            die(json_encode([
                'status'    => 'error',
                'msg'       => 'Mật khẩu không được để trống'
            ]));
        }
        if(getLocation(myip())['country'] != 'VN'){
            die(json_encode([
                'status'    => 'error',
                'msg'       => 'Vui lòng dùng địa chỉ IP thật để truy cập quản trị'
            ]));
        }
        
        $tkuma->update("settings", array(
            'value' => $pass2
        ), " `name` = 'keyloca' ");
        die(json_encode(['status' => 'success','msg' => 'SetPass2 thành công!']));
    }

    if ($_POST['action'] == 'VerifyGoogle2FA') {
        if (empty($_POST['token'])) {
            die(json_encode(['status' => 'error', 'msg' => 'Vui lòng đăng nhập']));
        }
        if (!$getUser = $tkuma->get_row("SELECT * FROM `users` WHERE `token` = '".check_string($_POST['token'])."' AND `id` = 1 ")) {
            die(json_encode(['status' => 'error', 'msg' => 'Vui lòng đăng nhập']));
        }
        if (empty($_POST['code'])) {
            die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập mã xác minh']));
        }
        $google2fa = new Google2FA();
        if ($google2fa->verifyKey($getUser['SecretKey_2fa'], check_string($_POST['code'])) != true) {
            $tkuma->insert("logs", [
                'user_id'       => $getUser['id'],
                'ip'            => myip(),
                'device'        => $Mobile_Detect->getUserAgent(),
                'createdate'    => gettime(),
                'action'        => '[Warning] Phát hiện có người đang cố gắng nhập mã xác minh'
            ]);
            die(json_encode(['status' => 'error', 'msg' => 'Mã xác minh không chính xác']));
        }
        $tkuma->insert("logs", [
            'user_id'       => $getUser['id'],
            'ip'            => myip(),
            'device'        => $Mobile_Detect->getUserAgent(),
            'createdate'    => gettime(),
            'action'        => 'Đăng nhập thành công vào hệ thống Admin.'
        ]);
        $tkuma->update("users", [
            'ip' => myip(),
            'device' => $Mobile_Detect->getUserAgent()
        ], " `id` = '".$getUser['id']."' ");
        setcookie("token", $getUser['token'], time() + $tkuma->site('session_login'), "/");
        $_SESSION['admin_login'] = $getUser['token'];
        die(json_encode([
            'status' => 'success',
            'msg' => 'Đăng nhập thành công!'
        ]));
    }
}
