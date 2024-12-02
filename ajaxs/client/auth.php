<?php
define("IN_SITE", true);
require_once(__DIR__ . '/../../libs/config.php');
require_once(__DIR__."/../../libs/db.php");
require_once(__DIR__."/../../libs/helper.php");


$tkuma = new DB();
$Mobile_Detect = new Mobile_Detect();
use PragmaRX\Google2FAQRCode\Google2FA;


if (isset($_POST['action'])) {
    if ($tkuma->site('status') != 1 && !isset($_SESSION['admin_login'])) {
        die(json_encode(['status' => 'error', 'msg' => 'Hệ thống đang bảo trì định kỳ, vui lòng quay lại sau !']));
    }


    if($_POST['action'] == 'Login'){
        $username = check_string2($_POST['usernicknamelog']);
        $password = check_string($_POST['pass']);

        if (empty($username)) {
            die(json_encode([
                'status'    => 'error',
                'msg'       => 'Nickname không được để trống'
            ]));
        }
        if (empty($password)) {
            die(json_encode([
                'status'    => 'error',
                'msg'       => 'Mật khẩu không được để trống'
            ]));
        }
        $getUser = $tkuma->get_row("SELECT * FROM `users` WHERE `username` = ? ",[$username]);
        if (!$getUser) {
            die(json_encode([
                'status'    => 'error',
                'msg'       => 'Nickname không chính xác'
            ]));
        }
        if (time() > $getUser['time_request']) {
            if (time() - $getUser['time_request'] < max_time_load ) {
                die(json_encode(['status' => 'error', 'msg' => 'Bạn đang thao tác quá nhanh, vui lòng chờ']));
            }
        }
        if ($tkuma->site('type_password') == 'bcrypt') {
            if (!password_verify($password, $getUser['password'])) {
                die(json_encode([
                    'status'    => 'error',
                    'msg'       => 'Thông tin đăng nhập không chính xác'
                ]));
            }
        } else {
            if (kuma_dec($getUser['password']) != $password ) {
                die(json_encode(['status'    => 'error', 'msg'       => 'Thông tin đăng nhập không chính xác' ]));
            }
        }
        $token = md5(random('QWERTYUIOPASDGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm0123456789', 64).time());
        $tkuma->insert("logs", [
            'user_id'       => $getUser['id'],
            'ip'            => myip(),
            'device'        => $Mobile_Detect->getUserAgent(),
            'createdate'    => gettime(),
            'action'        => '[Warning] '.'Đăng nhập thành công'
        ]);
        $tkuma->update("users", [
            'ip'        => myip(),
            'time_request' => time(),
            'time_session' => time(),
            'token' => $token,
            'device'    => $Mobile_Detect->getUserAgent()
        ], " `id` = ? ",[$getUser['id']]);
        setcookie("token", $token, time() + $tkuma->site('session_login'), "/");
        $_SESSION['login'] = $token;
        $_SESSION['userid'] = $getUser['id'];
         $_SESSION['username'] = $getUser['username'];
        die(json_encode(['status' => 'success','msg' => 'Đăng nhập thành công!']));
    }

    if($_POST['action'] == 'Register'){
        $username =  check_string2($_POST['usernickname']);
        $password = check_string($_POST['pass']);
        $accname = check_string($_POST['accname']);
        $nickbankid =  check_string2($_POST['nickbankcode']);
        $nickstk =  check_string2($_POST['nickstk']);
        $confirmPass =  check_string($_POST['confirmPass']);
        $ref = check_string($_POST['agentCode']);
        
        
        if (empty($username)) {
            die(json_encode(['status' => 'error', 'msg' => 'Username không được để trống']));
        }
        
              
        if (!preg_match('/^\d{10}$/', $username)) {
            die(json_encode(['status' => 'error', 'msg' => 'Số điện thoại không hợp lệ']));
        }
          if (empty($password)) {
            die(json_encode(['status' => 'error', 'msg' => 'Mật khẩu không được để trống']));
        }

        if ($password != $confirmPass) {
            die(json_encode(['status' => 'error', 'msg' => 'Mật khẩu không trùng khớp']));
        }
        
        if ($nickbankid == '') {
            die(json_encode(['status' => 'error', 'msg' => 'Vui lòng chọn một ngân hàng nhận thưởng']));
        }
           if (empty($nickstk)) {
            die(json_encode(['status' => 'error', 'msg' => 'Số tài khoản không được để trống']));
        }
          if (empty($accname)) {
            die(json_encode(['status' => 'error', 'msg' => 'Chủ tài khoản không được để trống']));
        }
        if ($tkuma->num_rows("SELECT * FROM `users` WHERE `username` = ? ",[$username]) > 0) {
            die(json_encode(['status' => 'error','msg' => 'Tên đăng nhập đã tồn tại trong hệ thống']));
        }
        if ($tkuma->num_rows("SELECT * FROM `users` WHERE `ip` = ? ",[myip()]) >= 5) {
            die(json_encode(['status' => 'error', 'msg' => 'IP của bạn đã đạt giới hạn tạo tài khoản cho phép']));
        }
        
        $refId = 0;
        if($ref != ''){
            $refUser = $tkuma->get_row("SELECT * FROM `users` WHERE `RefCode` = ? ",[$ref]);
            if (!$refUser) {
            die(json_encode(['status' => 'error', 'msg' => 'Mã giới thiệu không tồn tại']));
            } else {
            $refId = $refUser['id'];
            }
        }
        
        $token = md5(random('QWERTYUIOPASDGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm0123456789', 64).time());
        $isCreate = $tkuma->insert("users", [
            'token'         => $token,
            'username'      => $username,
            'email'         => '0',
            'bankid'      => $nickbankid,
            'stk'            => $nickstk,
            'acc_name'      => $accname,
            'password'      => TypePassword($password),
            'ip'            => myip(),
            'device'        => $Mobile_Detect->getUserAgent(),
            'create_date'   => gettime(),
            'update_date'   => gettime(),
            'time_session'  => time(),
            'SecretKey_2fa' => '0',
            'ctv' => '0',
            'ParentId' => $refId
        ]);
        if ($isCreate) {
            $tkuma->insert("logs", [
                'user_id'       => $tkuma->get_row("SELECT * FROM `users` WHERE `token` = ? ",[$token])['id'],
                'ip'            => myip(),
                'device'        => $Mobile_Detect->getUserAgent(),
                'createdate'    => gettime(),
                'action'        => 'Thực hiện tạo tài khoản'
            ]);
            setcookie("token", $token, time() + $tkuma->site('session_login'), "/");
            $_SESSION['login'] = $token;
            $_SESSION['userid'] = $tkuma->get_row("SELECT * FROM `users` WHERE `token` = ? ",[$token])['id'];
            $_SESSION['username'] = $tkuma->get_row("SELECT * FROM `users` WHERE `token` = ? ",[$token])['username'];
            die(json_encode(['status' => 'success', 'msg' => 'Đăng ký thành công']));
        } else {
            die(json_encode(['status' => 'error', 'msg' => 'Tạo tài khoản thất bại, vui lòng thử lại']));
        }
    }




         
    
}
