<?php

if (!defined('IN_SITE')) {
    die('The Request Not Found');
}


$tkuma = new DB();
if (isset($_COOKIE["token"])) {
    $getUser = $tkuma->get_row(" SELECT * FROM `users` WHERE `token` = ? ",[check_string($_COOKIE['token'])]);
    if (!$getUser) {
        header("location: ".BASE_URL('client/logout'));
        exit();
    }
    $_SESSION['login'] = $getUser['token'];
}
if (!isset($_SESSION['login'])) {
    redirect(base_url('client/login'));
} else {
    $getUser = $tkuma->get_row(" SELECT * FROM `users` WHERE `token` = ?  ",[check_string($_SESSION['login'])]);
    // chuyển hướng đăng nhập khi thông tin login không tồn tại
    if (!$getUser) {
        redirect(base_url('client/login'));
    }
    // chuyển hướng khi bị khoá tài khoản
    if ($getUser['banned'] != 0) {
        redirect(base_url('common/banned'));
    }
    // khoá tài khoản trường hợp âm tiền, tránh bug

}
