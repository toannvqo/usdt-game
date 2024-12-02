<?php

define("IN_SITE", true);
require_once(__DIR__ . "/../../libs/config.php");
require_once(__DIR__ . "/../../libs/db.php");
require_once(__DIR__ . "/../../libs/helper.php");

$tkuma = new DB();
$Mobile_Detect = new Mobile_Detect();

if (!isset($_POST['action'])) {
    die(json_encode(['status' => 'error', 'msg' => 'The Request Not Found !']));
}
if (empty($_SESSION['admin_login'])) {
    die(json_encode(['status' => 'error', 'msg' => 'Bạn không có quyền này !']));
}
if (!$check_admin = $tkuma->get_row(" SELECT * FROM `users` WHERE  `token` = ? ",[$_SESSION['admin_login']])) {
    die(json_encode(['status' => 'error', 'msg' => 'API Token không hợp lệ']));
}
if (is_admin() != true) {
    die(json_encode(['status' => 'error', 'msg' => 'API Token không hợp lệ']));
}
if ($tkuma->site('status_demo') != 0) {
    die(json_encode(['status' => 'error', 'msg' => 'Không được dùng chức năng này vì đây là trang web demo !']));
}

if ($_POST['action'] == "delete-account") {
    if ($id = check_string($_POST['id'])) {
        if (!$user = $tkuma->get_row("SELECT * FROM `accounts` WHERE `id` = ? ",[$id])) {
            die(json_encode(['status' => 'error', 'msg' => 'Tài khoản này không tồn tại trong hệ thống !']));
        }
        $isRemove = $tkuma->remove("accounts", " `id` = ? ",[$id]);
        if ($isRemove) {
            if (!empty($user['listimg'])) {
                $a = explode(PHP_EOL, $user['listimg']);
                foreach ($a as $b) {
                    if (!empty($b)) {
                        unlink("../../" . $b);
                    }
                }
            }
            if ($user['img'] != '0') {
                unlink("../../" . $user['img']);
            }
            $tkuma->insert("logs", [
                'user_id'       => $check_admin['id'],
                'ip'            => myip(),
                'device'        => $Mobile_Detect->getUserAgent(),
                'createdate'    => gettime(),
                'action'        => 'Xoá account (TK:' . $user['account'] . ' ID: ' . $user['id'] . ')'
            ]);
            die(json_encode(['status' => 'success', 'msg' => 'Xóa tài khoản thành công !']));
        } else {
            die(json_encode(['status' => 'error', 'msg' => 'ID không tồn tại trong hệ thống !']));
        }
    }
}
if ($_POST['action'] == "delete-bank") {
    if ($id = check_string($_POST['id'])) {
        if (!$user = $tkuma->get_row("SELECT * FROM `bank` WHERE `id` = ? ",[$id])) {
            die(json_encode(['status' => 'error', 'msg' => 'Tài khoản này không tồn tại trong hệ thống !']));
        }
        $isRemove = $tkuma->remove("bank", " `id` = ? ",[$id]);
        if ($isRemove) {
            $tkuma->insert("logs", [
                'user_id'       => $check_admin['id'],
                'ip'            => myip(),
                'device'        => $Mobile_Detect->getUserAgent(),
                'createdate'    => gettime(),
                'action'        => 'Xoá Bank (TK:' . $user['name'] . ' ID: ' . $user['id'] . ')'
            ]);
            die(json_encode(['status' => 'success', 'msg' => 'Xóa tài khoản thành công !']));
        } else {
            die(json_encode(['status' => 'error', 'msg' => 'ID không tồn tại trong hệ thống !']));
        }
    }
}
if ($_POST['action'] == "delete-user") {
    if ($id = check_string($_POST['id'])) {
        if (!$user = $tkuma->get_row("SELECT * FROM `users` WHERE `id` = ? ",[$id])) {
            die(json_encode(['status' => 'error', 'msg' => 'Tài khoản này không tồn tại trong hệ thống !']));
        }
        $isRemove = $tkuma->remove("users", " `id` = ? ",[$id]);
        if ($isRemove) {
            $tkuma->insert("logs", [
                'user_id'       => $check_admin['id'],
                'ip'            => myip(),
                'device'        => $Mobile_Detect->getUserAgent(),
                'createdate'    => gettime(),
                'action'        => 'Xoá User (TK:' . $user['username'] . ' ID: ' . $user['id'] . ')'
            ]);
            die(json_encode(['status' => 'success', 'msg' => 'Xóa tài khoản thành công !']));
        } else {
            die(json_encode(['status' => 'error', 'msg' => 'ID không tồn tại trong hệ thống !']));
        }
    }
}
if ($_POST['action'] == "delete-groups") {
    if ($id = check_string($_POST['id'])) {
        if (!$user = $tkuma->get_row("SELECT * FROM `groups` WHERE `id` = ? ",[$id])) {
            die(json_encode(['status' => 'error', 'msg' => 'chuyên mục này không tồn tại trong hệ thống !']));
        }
        if (format_cash($tkuma->num_rows(" SELECT * FROM `accounts` WHERE `groups` = ? AND `id_user` = ? ",[$id,'0'])) != '0') {
            die(json_encode(['status' => 'error', 'msg' => 'Acc đang bán của chuyên mục này vẫn còn !']));
        }
        $isRemove = $tkuma->remove("groups", " `id` = ? ",[$id]);
        if ($isRemove) {
            if ($user['img'] != '0') {
                unlink("../../" . $user['img']);
            }
            $tkuma->insert("logs", [
                'user_id'       => $check_admin['id'],
                'ip'            => myip(),
                'device'        => $Mobile_Detect->getUserAgent(),
                'createdate'    => gettime(),
                'action'        => 'Xoá chuyên mục (Title:' . $user['title'] . ' ID: ' . $user['id'] . ')'
            ]);
            die(json_encode(['status' => 'success', 'msg' => 'Xóa chuyên mục thành công !']));
        } else {
            die(json_encode(['status' => 'error', 'msg' => 'ID không tồn tại trong hệ thống !']));
        }
    }
}
if ($_POST['action'] == "delete-champ") {
    if ($id = check_string($_POST['id'])) {
        if (!$user = $tkuma->get_row("SELECT * FROM `champskin` WHERE `id` = ? ",[$id])) {
            die(json_encode(['status' => 'error', 'msg' => 'chuyên mục này không tồn tại trong hệ thống !']));
        }
        $isRemove = $tkuma->remove("champskin", " `id` = ? ",[$id]);
        if ($isRemove) {
            unlink("../.." . $user['img']);
            die(json_encode(['status' => 'success', 'msg' => 'Xóa chuyên mục thành công !']));
        } else {
            die(json_encode(['status' => 'error', 'msg' => 'ID không tồn tại trong hệ thống !']));
        }
    }
}
if ($_POST['action'] == "delete-category") {
    if ($id = check_string($_POST['id'])) {
        if (!$user = $tkuma->get_row("SELECT * FROM `category` WHERE `id` = ? ",[$id])) {
            die(json_encode(['status' => 'error', 'msg' => 'chuyên mục này không tồn tại trong hệ thống !']));
        }
        if (format_cash($tkuma->num_rows(" SELECT * FROM `groups` WHERE `category` = ? ",[$id])) != '0') {
            die(json_encode(['status' => 'error', 'msg' => 'Chuyên mục con của chuyên mục này vẫn còn !']));
        }
        $isRemove = $tkuma->remove("category", " `id` = ? ",[$id]);
        if ($isRemove) {
            $tkuma->insert("logs", [
                'user_id'       => $check_admin['id'],
                'ip'            => myip(),
                'device'        => $Mobile_Detect->getUserAgent(),
                'createdate'    => gettime(),
                'action'        => 'Xoá chuyên mục Home (Title:' . $user['title'] . ' ID: ' . $user['id'] . ')'
            ]);
            die(json_encode(['status' => 'success', 'msg' => 'Xóa chuyên mục Home thành công !']));
        } else {
            die(json_encode(['status' => 'error', 'msg' => 'ID không tồn tại trong hệ thống !']));
        }
    }
}
