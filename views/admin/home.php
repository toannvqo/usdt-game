<?php if (!defined('IN_SITE')) {
    die('The Request Not Found');
}
$body = [
    'title' => 'Settings',
    'desc'   => 'tkuma Panel',
    'keyword' => 'tkuma, tkuma, jrt.co,'
];
$body['header'] = '
<link href="../public/hudadmin/assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet">
<link href="../public/hudadmin/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="../public/hudadmin/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<link href="../public/hudadmin/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="../public/hudadmin/assets/plugins/bootstrap-slider/dist/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="../public/hudadmin/assets/plugins/blueimp-file-upload/css/jquery.fileupload.css" rel="stylesheet">

<link href="../public/hudadmin/assets/plugins/spectrum-colorpicker2/dist/spectrum.min.css" rel="stylesheet">
<link href="../public/hudadmin/assets/plugins/select-picker/dist/picker.min.css" rel="stylesheet">
<link href="../public/hudadmin/assets/plugins/jquery-typeahead/dist/jquery.typeahead.min.css" rel="stylesheet">


<script src="../public/ckeditor/ckeditor.js"></script>
   ';
$body['footer'] = '
<script src="../public/hudadmin/assets/plugins/jvectormap-next/jquery-jvectormap.min.js" type="edcbbf6d8763280b6e6c8ee1-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/jvectormap-content/world-mill.js" type="edcbbf6d8763280b6e6c8ee1-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/apexcharts/dist/apexcharts.min.js" type="edcbbf6d8763280b6e6c8ee1-text/javascript"></script>
<script src="../public/hudadmin/assets/js/demo/dashboard.demo.js" type="edcbbf6d8763280b6e6c8ee1-text/javascript"></script>
';
require_once(__DIR__ . '/../../libs/is_admin.php');
require_once(__DIR__ . '/layout/header.php');
require_once(__DIR__ . '/layout/head.php');
require_once(__DIR__ . '/layout/sidebar.php');


?>
<?php
$now_time = date('Y/m/d H:i:s');
$time_day = date('Y/m/d') . " 00:00:00";
$week_old = date('Y/m/d H:i:s', strtotime('-7 day', strtotime($now_time)));
$month_old = date('Y/m/d H:i:s', strtotime('-30 day', strtotime($now_time)));

$firstDayOfWeek = date('Y/m/d', strtotime('monday this week'));
$lastDayOfWeek = date('Y/m/d 23:59:59', strtotime('sunday this week')); // updated to include full day

$firstDayOfMonth = date('Y/m/01 00:00:00');
$lastDayOfMonth = date('Y/m/d 23:59:59');

$yesterday_start = date('Y/m/d 00:00:00', strtotime('-1 day'));
$yesterday_end = date('Y/m/d 23:59:59', strtotime('-1 day'));

$list_mm = $tkuma->get_list(" SELECT * FROM `account_vcb` WHERE `sessionId` != '' ");
$tong = 0;
if ($list_mm) {
    foreach ($list_mm as $row) {
        $check = balance($row['token'])['SoDu'];
        $tong = $tong + $check;
    }
}
$list_mm2 = $tkuma->get_list(" SELECT * FROM `account_mbbank` ");
$tong2 = 0;
if ($list_mm2) {
    foreach ($list_mm2 as $row2) {
        $check2 = balancemb($row2['token'])['SoDu'];
        $tong2 = $tong2 + $check2;
    }
}

$list_mm3 = $tkuma->get_list(" SELECT * FROM `account_bidv` ");
$tong3 = 0;
if ($list_mm3) {
    foreach ($list_mm3 as $row3) {
        $check3 = balancebidv($row3['id'])['SoDu'];
        $tong3 = $tong3 + $check3;
    }
}

if ($tkuma->site('status_del') != 0) 
    {
        delllsgd('15');
    }

?>
<!-- Content Wrapper. Contains page content -->


<button class="app-sidebar-mobile-backdrop" data-toggle-target=".app" data-toggle-class="app-sidebar-mobile-toggled"></button>


<div id="content" class="app-content">
    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">HÔM NAY</span>
                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="row align-items-center mb-2">
                        <div class="col-7">
                             <h3 class="mb-0"><?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND `time` >= ? AND `sttbot` != ? ",['real','SAI NỘI DUNG','Hoàn Tiền',$time_day,'1'])['SUM(`amount_play`)'] - $tkuma->get_row("SELECT SUM(`amount_game`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND `time` >= ? AND `sttbot` != ?  ",['real','SAI NỘI DUNG','Hoàn Tiền',$time_day,'1'])['SUM(`amount_game`)']); ?></h3>
                        </div>
                        <div class="col-5">
                            
                            <div class="mt-n2" data-render="apexchart" data-type="bar" data-title="Visitors" data-height="30"></div>
                        </div>
                    </div>
                    <div class="small text-inverse text-opacity-50 text-truncate">
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng nhận: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND `time` >= ?  AND `sttbot` != ?  ",['real','SAI NỘI DUNG','Hoàn Tiền',$time_day,'1'])['SUM(`amount_play`)']); ?><br>
                        <i class="far fa-user fa-fw me-1"></i> Tổng trừ: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_game`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND `time` >= ? AND `sttbot` != ? ",['real','SAI NỘI DUNG','Hoàn Tiền',$time_day,'1'])['SUM(`amount_game`)']); ?><br>
                      
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng Gift Code: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `time` >= ?  AND `sttbot` != ?  ",['giftcode',$time_day,'1'])['SUM(`amount_play`)']); ?><br>
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng NVN: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `time` >= ?  AND `sttbot` != ?  ",['nhiemvungay',$time_day,'1'])['SUM(`amount_play`)']); ?><br>
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng Nổ Hủ: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `time` >= ?  AND `sttbot` != ?  ",['nohu',$time_day,'1'])['SUM(`amount_play`)']); ?>
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">HÔM QUA</span>
                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="row align-items-center mb-2">
                        <div class="col-7">
                            <h3 class="mb-0"><?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND time BETWEEN ? AND ? AND `sttbot` != ? ",['real','SAI NỘI DUNG','Hoàn Tiền',$yesterday_start,$yesterday_end,'1'])['SUM(`amount_play`)'] - $tkuma->get_row("SELECT SUM(`amount_game`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND time BETWEEN ? AND ? AND `sttbot` != ?  ",['real','SAI NỘI DUNG','Hoàn Tiền',$yesterday_start,$yesterday_end,'1'])['SUM(`amount_game`)']); ?></h3>
                        </div>
                        <div class="col-5">
                            
                            <div class="mt-n2" data-render="apexchart" data-type="bar" data-title="Visitors" data-height="30"></div>
                        </div>
                    </div>
                    <div class="small text-inverse text-opacity-50 text-truncate">
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng nhận: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND time BETWEEN ? AND ?  AND `sttbot` != ?  ",['real','SAI NỘI DUNG','Hoàn Tiền',$yesterday_start,$yesterday_end,'1'])['SUM(`amount_play`)']); ?><br>
                        <i class="far fa-user fa-fw me-1"></i> Tổng trừ: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_game`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND time BETWEEN ? AND ? AND `sttbot` != ? ",['real','SAI NỘI DUNG','Hoàn Tiền',$yesterday_start,$yesterday_end,'1'])['SUM(`amount_game`)']); ?><br>
                        
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng Gift Code: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND time BETWEEN ? AND ?  AND `sttbot` != ?  ",['giftcode',$firstDayOfWeek,$lastDayOfWeek,'1'])['SUM(`amount_play`)']); ?><br>
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng NVN: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND time BETWEEN ? AND ?  AND `sttbot` != ?  ",['nhiemvungay',$firstDayOfWeek,$lastDayOfWeek,'1'])['SUM(`amount_play`)']); ?><br>
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng Nổ Hủ: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND time BETWEEN ? AND ?  AND `sttbot` != ?  ",['nohu',$firstDayOfWeek,$lastDayOfWeek,'1'])['SUM(`amount_play`)']); ?>
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">TUẦN QUA</span>
                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="row align-items-center mb-2">
                        <div class="col-7">
                            <h3 class="mb-0"><?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND  `result_text` != ? AND `result_text` != ? AND time BETWEEN ? AND ? AND `sttbot` != ? ",['real','SAI NỘI DUNG','Hoàn Tiền',$firstDayOfWeek,$lastDayOfWeek,'1'])['SUM(`amount_play`)'] - $tkuma->get_row("SELECT SUM(`amount_game`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND time BETWEEN ? AND ? AND `sttbot` != ? ",['real','SAI NỘI DUNG','Hoàn Tiền',$firstDayOfWeek,$lastDayOfWeek,'1'])['SUM(`amount_game`)']); ?> </h3>
                        </div>
                        <div class="col-5">
                            <div class="mt-n2" data-render="apexchart" data-type="line" data-title="Visitors" data-height="30"></div>
                        </div>
                    </div>
                    <div class="small text-inverse text-opacity-50 text-truncate">
                        <i class="fa fa-chevron-up fa-fw me-1"></i>Tổng nhận: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND  `result_text` != ? AND `result_text` != ? AND time BETWEEN ? AND ? AND `sttbot` != ? ",['real','SAI NỘI DUNG','Hoàn Tiền',$firstDayOfWeek,$lastDayOfWeek,'1'])['SUM(`amount_play`)']); ?><br>
                        <i class="fa fa-shopping-bag fa-fw me-1"></i>Tổng trừ: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_game`) FROM `lich_su_choi` WHERE `type_gd` = ? AND  `result_text` != ? AND `result_text` != ? AND time BETWEEN ? AND ? AND `sttbot` != ? ",['real','SAI NỘI DUNG','Hoàn Tiền',$firstDayOfWeek,$lastDayOfWeek,'1'])['SUM(`amount_game`)']); ?><br>
                      
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng Gift Code: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND time BETWEEN ? AND ?  AND `sttbot` != ?  ",['giftcode',$firstDayOfWeek,$lastDayOfWeek,'1'])['SUM(`amount_play`)']); ?><br>
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng NVN: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND time BETWEEN ? AND ?  AND `sttbot` != ?  ",['nhiemvungay',$firstDayOfWeek,$lastDayOfWeek,'1'])['SUM(`amount_play`)']); ?><br>
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng Nổ Hủ: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND time BETWEEN ? AND ?  AND `sttbot` != ?  ",['nohu',$firstDayOfWeek,$lastDayOfWeek,'1'])['SUM(`amount_play`)']); ?>
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">THÁNG NÀY</span>
                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="row align-items-center mb-2">
                        <div class="col-7">
                            <h3 class="mb-0"><?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND time BETWEEN ? AND ? AND `sttbot` != ? ",['real','SAI NỘI DUNG','Hoàn Tiền',$firstDayOfMonth,$lastDayOfMonth,'1'])['SUM(`amount_play`)'] - $tkuma->get_row("SELECT SUM(`amount_game`) FROM `lich_su_choi` WHERE `type_gd` = ? AND  `result_text` != ? AND `result_text` != ? AND time BETWEEN ? AND ? AND `sttbot` != ? ",['real','SAI NỘI DUNG','Hoàn Tiền',$firstDayOfMonth,$lastDayOfMonth,'1'])['SUM(`amount_game`)']); ?></h3>
                        </div>
                        <div class="col-5">
                            <div class="mt-n3 mb-n2" data-render="apexchart" data-type="pie" data-title="Visitors" data-height="45"></div>
                        </div>
                    </div>
                   <div class="small text-inverse text-opacity-50 text-truncate">
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng nhận: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND  `result_text` != ? AND `result_text` != ? AND time BETWEEN ? AND ? AND `sttbot` != ? ",['real','SAI NỘI DUNG','Hoàn Tiền',$firstDayOfMonth,$lastDayOfMonth,'1'])['SUM(`amount_play`)']); ?><br>
                        <i class="fab fa-facebook-f fa-fw me-1"></i> Tổng trừ: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_game`) FROM `lich_su_choi` WHERE `type_gd` = ? AND  `result_text` != ? AND `result_text` != ? AND time BETWEEN ? AND ? AND `sttbot` != ? ",['real','SAI NỘI DUNG','Hoàn Tiền',$firstDayOfMonth,$lastDayOfMonth,'1'])['SUM(`amount_game`)']); ?><br>
                      
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng Gift Code: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND time BETWEEN ? AND ?  AND `sttbot` != ?  ",['giftcode',$firstDayOfMonth,$lastDayOfMonth,'1'])['SUM(`amount_play`)']); ?><br>
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng NVN: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND time BETWEEN ? AND ?  AND `sttbot` != ?  ",['nhiemvungay',$firstDayOfMonth,$lastDayOfMonth,'1'])['SUM(`amount_play`)']); ?><br>
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng Nổ Hủ: <?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND time BETWEEN ? AND ?  AND `sttbot` != ?  ",['nohu',$firstDayOfMonth,$lastDayOfMonth,'1'])['SUM(`amount_play`)']); ?>
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">Tổng tiền</span>
                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>
                    <div class="row align-items-center mb-2">
                        <div class="col-7">
                            <h3 class="mb-0"><?= format_currency($tong + $tong2 + $tong3) ?></h3>
                        </div>
                        <div class="col-5">
                            <div class="mt-n3 mb-n2" data-render="apexchart" data-type="donut" data-title="Visitors" data-height="45"></div>
                        </div>
                    </div>
                    <div class="small text-inverse text-opacity-50 text-truncate">
                        <i class="fa fa-chevron-up fa-fw me-1"></i> Tổng VCB: <?= format_currency($tong) ?><br>
                        <i class="far fa-hdd fa-fw me-1"></i> Tổng MB: <?= format_currency($tong2) ?><br>
                        <i class="far fa-hand-point-up fa-fw me-1"></i> Tổng BIDV: <?= format_currency($tong3) ?>
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>



        <div class="col-xl-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">200 Lịch sử nhận tiền</span>
                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>

                    <div class="table-responsive">
                        <table id="datatableDefault" class="table text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th width="5%">STT</th>
                                 <!--  comment <th>Tong TIn</th> -->
                                    <th>DCAP</th>
                                    <th>Phone nhận</th>
                                    <th>Số tiền</th>
                                    <th>MSG</th>
                                </tr>
                            </thead>
                           <tbody>
                                <?php
                                $i = 0;
                                foreach ($tkuma->get_list(" SELECT * FROM `lich_su_choi` WHERE `type_gd` = ? AND  `sttbot` != ? AND `result_text` != 'SAI NỘI DUNG' ORDER BY `id` DESC LIMIT 200 ",['real','1']) as $rowls) {
                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                       <!--  comment   <td><ul>
                                           <li>Phone gửi: <?= $rowls['phone']; ?></li>
                                            <li>NICKNAME: <?= $rowls['partnerName']; ?></li>
                                        </ul></td> -->
                                        <td><ul>
                                            <?php if( $rowls['tranid2'] != '0' ) { ?>
                                            <li>Mã GD Góc: <?= $rowls['tranid2']; ?></li>
                                            <li>Mã GD: <?= $rowls['tranId']; ?></li>
                                            <?php } else { ?>
                                             <li>Mã GD: <?= $rowls['tranId']; ?></li>
                                            <?php } ?>
                                            <li>Nội dung: <?= $rowls['comment']; ?></li>
                                            <li>Thời gian: <?= $rowls['time']; ?></li>
                                        </ul></td>
                                        <td><ul>
                                            <li>Phone Nhận: <?= $rowls['phone_nhan']; ?></li>
                                            <li>Bank Nhận: <?=getRowRealtime2('phone', 'phone', $rowls['phone_nhan'], 'namebank');?></li>
                                        </ul></td>
                                        <td><ul>
                                            <li>Tiền Chơi: <?= format_currency($rowls['amount_play']); ?></li>
                                            <li>Tiền Thắng: <?= format_currency($rowls['amount_game']); ?></li>
                                        </ul></td>
                                        <td><ul>
                                            <li>Trạng thái: <?= trangthais($rowls['result_text']); ?> </li>
                                            <li>Trả Thưởng: <?= $rowls['status']; ?></li>
                                            <li>MSG SEND: <?= $rowls['msg_send']; ?></li>
                                        </ul></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>
                <div class="col-xl-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">200 Lịch sử nhận Sai ND</span>
                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>

                    <div class="table-responsive">
                        <table id="datatableDefault2" class="table text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th width="5%">STT</th>
                                    <th>Mã GD</th>
                                    <th>Phone nhận</th>
                                    <th>Số tiền</th>
                                    <th>Nội dung</th>
                                    <th>Trạng thái</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                           <tbody>
                                <?php
                                $i = 0;
                                foreach ($tkuma->get_list(" SELECT * FROM `lich_su_choi` WHERE `type_gd` = ? AND  `sttbot` != ? AND `result_text` = 'SAI NỘI DUNG' ORDER BY `id` DESC LIMIT 200  ",['real','1']) as $rowls) {
                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $rowls['tranId']; ?></td>
                                        <td><?= $rowls['phone_nhan']; ?></td>
                                        <td><?= format_currency($rowls['amount_play']); ?></td>
                                        <td><?= $rowls['comment']; ?></td>
                                        <td><?= trangthais($rowls['status']); ?></td>
                                        <td><?= $rowls['time']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-arrow">
                    <div class="card-arrow-top-left"></div>
                    <div class="card-arrow-top-right"></div>
                    <div class="card-arrow-bottom-left"></div>
                    <div class="card-arrow-bottom-right"></div>
                </div>
            </div>
        </div>


    
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#datatableDefault').DataTable();
        $('#datatableDefault2').DataTable();
    });
</script>
<?php
require_once(__DIR__ . '/layout/nav.php');
require_once(__DIR__ . '/layout/footer.php');
?>