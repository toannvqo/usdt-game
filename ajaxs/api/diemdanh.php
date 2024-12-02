<?php

define("IN_SITE", true);
require_once(__DIR__ . "/../../libs/db.php");
require_once(__DIR__ . '/../../libs/config.php');
require_once(__DIR__ . "/../../libs/helper.php");
$tkuma = new DB();
$Mobile_Detect = new Mobile_Detect();
header('Content-Type: application/json');
$now = date("Y/m/d");
if($tkuma->get_row("SELECT * FROM `event` WHERE  `keyd` = ?  ",['diem-danh'])['trangthai'] =! 'run') {
    $arr_total = array(
            'success' => false,
            'message' => "Chức năng hiện đang bảo trì"
    );
    die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)));
}
$nitname = check_string2($_POST['phone']);
$phone = $tkuma->get_row("SELECT * FROM `lich_su_choi` WHERE `partnerName` = ? ",[$nitname])['phone'];
if (!empty($phone)) {
      $sdt = $phone;
      if (!$checkid = $tkuma->get_row("SELECT * FROM `lich_su_choi` WHERE `phone` = ? AND `time` >= '$now 00:00:00' ",[$sdt])) {
         $arr_total = array(
            'success' => false,
            'message' => "Số không tồn tại trong hệ thống!"
         );
         die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)));
      }
      $data2 = $tkuma->get_row("SELECT * FROM `phiendiemdanh` WHERE `id` = ? ",['1']);
      $magift = $data2['phien'];
      $dem  = $tkuma->num_rows("SELECT * FROM `user_diemdanh` WHERE `phone` = ? AND `phiendiemdanh` = ? ",[$sdt,$magift]);
      $tongchoi = $tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `phone` = ? AND `time` >= '$now 00:00:00' ",[$sdt]);
      $data3 = $tkuma->get_row("SELECT * FROM `event` WHERE `keyd` = ?  ",['diem-danh']);
      $toithieu = $data3['toithieu'];
      $moc1 = $data3['moc1'];
      $moc2 = $data3['moc2'];
      $date = date("Y-m-d H:i:s");
      $date1 = date("Y-m-d 07:00:00");
      $date2 = date("Y-m-d 23:00:00");
      $tienthuong = rand($moc1, $moc2);
      if (empty($tongchoi)) {
         $tongchoi = 0;
      }
      if ($tongchoi < $toithieu) {
         $arr_total = array(
            'success' => false,
            'message' => "Bạn cần chơi đủ " . $toithieu . " VNĐ để tiến hành điểm danh !"
         );
         die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)));
      } elseif ($dem > 0) {
         $arr_total = array(
            'success' => false,
            'message' => "Phiên này bạn đã điểm danh rồi !"
         );
         die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)));
      } elseif ($date < $date1 || $date > $date2) {
         $arr_total = array(
            'success' => false,
            'message' => "Thời gian điểm danh chỉ từ 7h sáng đến 11h tối"
         );
         die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)));
      } else {
         $tkuma->insert("user_diemdanh", [
            'phone' => $sdt,
            'phiendiemdanh' => $magift,
            'status' => 'active',
            'amount' => $tienthuong,
            'time	' => $date
         ]);
         $arr_total = array(
            'success' => true,
            'message' => "Đăng ký điểm danh thành công, chúc bạn may mắn !"
         );
         die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)));
      }
} else {
   $arr_total = array(
      'success' => false,
      'message' => "User name chưa chơi trên hệ thống "
   );
   die(stripslashes(json_encode($arr_total, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)));
}
