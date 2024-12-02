<?php
define("IN_SITE", true);
require_once(__DIR__ . '/../../libs/db.php');
require_once(__DIR__ . '/../../libs/config.php');
require_once(__DIR__ . '/../../libs/helper.php');
require_once(__DIR__ . '/../../libs/redis.php');
$bots = new DB();
$Mobile_Detect = new Mobile_Detect();
$cronController = new CronController('diemdanh');
if ($_GET['type'] == $bots->site('pin_cron')) {
//     if (checkCron('3') == false) {
// 		die(json_encode(['status' => 'error', 'msg' => 'Thao tác quá nhanh, vui lòng đợi']));
// 	}
    if (!$cronController->canRun()) {
    	die('Cron job đã chạy quá số lần cho phép trong khoảng thời gian này.');
    }
	if (getRowRealtime('cronjobsact', '3', 'status') == 0) {
		die(json_encode(['status' => 'error', 'msg' => 'Chức năng không hoạt động']));
	}
    $date_current =  date("Y-m-d H:i:s");
    $date1 = date("Y-m-d 07:00:00");
    $date2 = date("Y-m-d 23:00:00");
    $date_currentz = new DateTime($date_current);
    $date_currentz->add(new DateInterval('PT10M'));
    $timenext = $date_currentz->format('Y-m-d H:i:s');
    if ($date_current < $date1 || $date_current > $date2) {
        echo json_encode(array("msg" => "Hiện tại chưa đến thời gian trả thưởng"));
        exit();
    } else {
        $data2 = $bots->get_row("SELECT * FROM `phiendiemdanh` WHERE `id` = ? ",['1']);
        $maphien = $data2['phien'];
        $phiennext = $data2['phiennext'];
        if ($date_current >= $phiennext) {
            $datakm = $bots->get_row("SELECT * FROM `event` WHERE `keyd` = ?",['diem-danh']);
            $tranthai = $datakm['trangthai'];
            if ($tranthai == 'run') {
                $datangtrung = $bots->get_row("SELECT * FROM `user_diemdanh` WHERE `phiendiemdanh` = ? AND `status` = ? ORDER by RAND()",[$maphien,'active']);
                $ddema3 =  $bots->num_rows("SELECT * FROM `user_diemdanh` WHERE  `phiendiemdanh` = ? AND `status` = ?",[$maphien,'active']);
                if (empty($datangtrung) || $ddema3 < 10) {
                    $phiennexta = $maphien + 1;
                    $bots->update("phiendiemdanh", ['phien' => $phiennexta, 'timephien' => $date_current, 'phiennext' => $timenext], " `id` = ? ",['1']);
                    $bots->update("user_diemdanh", ['status' => 'error'], " `phiendiemdanh` = ?",[$maphien ]);
                    // không có ai điểm danh tự động làm mới hệ thống không trả thưởng
                    echo json_encode(array("msg" => "Hệ thống làm mới luôn không ai thèm chơi"));
                    exit();
                } else {
                    $sdtdiemdanh = $datangtrung['phone'];
                    $dem =  $bots->num_rows("SELECT * FROM `diemdanh_win` WHERE `sdt` = ? AND `time` >= ? AND  `time` <= ? ",[$sdtdiemdanh,$date1,$date2]);
                    if ($dem > 2) {
                        $phiennexta = $maphien + 1;
                        $bots->update("phiendiemdanh", ['phien' => $phiennexta, 'timephien' => $date_current, 'phiennext' => $timenext], "`id` = ?",['1']);
                        $bots->update("user_diemdanh", ['status' => 'error'], "`phiendiemdanh` = ?",[$maphien]);
                        // không có ai điểm danh tự động làm mới hệ thống không trả thưởng
                        echo json_encode(array("msg" => "Tham lam quá trúng 2 nháy / ngày nên éo trả thưởng đâu"));
                        exit();
                    } else {
                        $amount = $datangtrung['amount'];
                        $noidung = $datangtrung['phiendiemdanh'];
                        $get_momo = $bots->get_row("SELECT * FROM `account_vcb` WHERE `status` = ? AND `type` = ?  ",['success','chuyen']);
                        if (isset($get_momo)) {
                            $message = $noidung; // nội dung chính là mã gift  
                            $getuser = $bots->get_row("SELECT * FROM `users` WHERE `stk` = ? ",[$sdtdiemdanh]);
                            
                            $result = $tkuma->insert("lich_su_choi", [
					            'phone'  =>   $getuser['stk'],
					            'phone_nhan' => 0,
					            'tranId' =>   strtotime(gettime()),
					            'partnerName' => $getuser['username'],
					            'id_momo' => $getuser['id'],
					            'amount_play' => $amount,
					            'amount_game' => $amount,
					            'comment' => $message,
					            'game' => 'Điểm Danh',
					            'ma_game' => 'diem-danh',
					            'result' => 'success',
					            'result_text' => 'Diem Danh',
					            'type_gd' => 'diemdanh',
					            'status' => 'pending',
					            'result_number' => 1,
					            'time_tran' => strtotime(gettime()),
					            'time' => gettime(),
					            'msg_send' => 'Đang Chờ Thanh Toán'
					            ]);
                            if ($result) {
                                $bots->insert("diemdanh_win", [
                                    'phien_thang'  =>   $noidung,
                                    'trangthai' => 'success',
                                    'sdt' => $sdtdiemdanh,
                                    'tien_nhan' => $amount,
                                    'time' => $date_current
                                ]);
                                $phiennexta = $maphien + 1;
                                $bots->update('phiendiemdanh', ['phien' => $phiennexta, 'timephien' => $date_current, 'phiennext' => $timenext], "`id` = ?",['1']);
                                $bots->update('user_diemdanh', ['status' => 'error'], "`phiendiemdanh` = ?",[$maphien]);
                                $bots->update('user_diemdanh', ['status' => 'error'], "`phiendiemdanh` = ?",[$noidung]);
                                // cập nhập lại trạng thái
                            } else {
                                echo json_encode(array("msg" => " " . $result['msg'] . "  "));
                                exit();
                            }
                        } else {
                            echo json_encode(array("msg" => "Không có momo nào có thể trả thưởng bây giờ"));
                            exit();
                        }
                    }
                }
            } else {
                echo json_encode(array("msg" => "Hệ thống đang LOAD"));
                exit();
            }
        } else {
            echo json_encode(array("msg" => "Chưa đến thời điểm trả thưởng"));
            exit();
        }
    }
}
