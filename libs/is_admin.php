<?php

if (!defined('IN_SITE')) {
    die('The Request Not Found');
}



$tkuma = new DB();
// if (isset($_COOKIE["token"])) {
//     $getUser = $tkuma->get_row(" SELECT * FROM `users` WHERE `token` = '".check_string($_COOKIE['token'])."' AND `id` = 1 ");
//     if (!$getUser) {
//         header("location: ".BASE_URL('client/logout'));
//         exit();
//     }
//     $_SESSION['admin_login'] = $getUser['token'];
// }
if (!isset($_SESSION['admin_login'])) {
    redirect(base_url('admin/login'));
} else {
    $getUser = $tkuma->get_row(" SELECT * FROM `users` WHERE `id` = ? AND `token` = ?  ",[id_admin,$_SESSION['admin_login']]);
    // chuyển hướng đăng nhập khi thông tin login không tồn tại
    if (!$getUser) {
        redirect(base_url('admin/login'));
    }
    if (myip() != $getUser['ip']) {
        $_SESSION['admin_login'] = '';
		redirect(base_url(''));
	}
    if (!is_admin()) {
        redirect(base_url('admin/login'));
    }
    // chuyển hướng khi bị khoá tài khoản
    if ($getUser['banned'] != 0) {
        redirect(base_url('common/banned'));
    }
    /* cập nhật thời gian online */
    $tkuma->update("users", [
        'time_session'  => time()
    ], " `id` = ? ",[$getUser['id']]);
}
