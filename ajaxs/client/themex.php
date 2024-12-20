<?php

define("IN_SITE", true);
require_once(__DIR__."/../../libs/config.php");
require_once(__DIR__."/../../libs/db.php");
require_once(__DIR__."/../../libs/helper.php");

$tkuma = new DB();
$Mobile_Detect = new Mobile_Detect();

if (isset($_POST['id'])) {
    $id = check_string2($_POST['id']);
    $row = $tkuma->get_row("SELECT * FROM `theme` WHERE `id` = ? ",[$id]);
    if (!$row) {
        $data = json_encode([
            'status'    => 'error',
            'msg'       => 'ID ngôn ngữ không tồn tại trong hệ thống'
        ]);
        die($data);
    }
    $isUpdate = setLanguage($id);
    if ($isUpdate) {
        $data = json_encode([
            'status'    => 'success',
            'msg'       => 'Thay đổi theme thành công'
        ]);
        die($data);
    }
} else {
    $data = json_encode([
        'status'    => 'error',
        'msg'       => 'Dữ liệu không hợp lệ'
    ]);
    die($data);
}
