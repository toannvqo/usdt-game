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

<!-- Content Wrapper. Contains page content -->


<button class="app-sidebar-mobile-backdrop" data-toggle-target=".app" data-toggle-class="app-sidebar-mobile-toggled"></button>


<div id="content" class="app-content">
    <div class="row">
  


        <div class="col-xl-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">Lịch sử nhận tiền</span>
                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>

                    <div class="table-responsive">
                        <table id="datatableDefault" class="table text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th width="5%">STT</th>
                                    <!--  comment <th>Tong TIn</th> -->
                                    <th>Mã GD</th>
                                    <th>Phone nhận</th>
                                    <th>Số tiền</th>
                                    <th>Tiền nhận</th>
                                    <th>Nội dung</th>
                                    <th>Trạng thái</th>
                                    <th>Trả Thưởng</th>
                                    <th>Thời gian</th>
                                </tr>
                            </thead>
                           <tbody>
                                <?php
                                $i = 0;
                                foreach ($tkuma->get_list(" SELECT * FROM `lich_su_choi` WHERE `type_gd` = ? AND  `sttbot` != ? AND `result_text` != 'SAI NỘI DUNG' ORDER BY `id` DESC  ",['real','1']) as $rowls) {
                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                       <!-- comment <td><ul><li>Phone gửi: <?= $rowls['phone']; ?></li>
                                        <li>NICKNAME: <?= $rowls['partnerName']; ?></li></ul></td> -->
                                        <td><?= $rowls['tranId']; ?></td>
                                        <td><ul><li>Phone Nhận: <?= $rowls['phone_nhan']; ?>
                                            <li>Bank Nhận: <?=getRowRealtime2('phone', 'phone', $rowls['phone_nhan'], 'namebank');?></li>
                                        </li></ul></td>
                                        <td><?= format_currency($rowls['amount_play']); ?></td>
                                        <td><?= format_currency($rowls['amount_game']); ?></td>
                                        <td><?= $rowls['comment']; ?></td>
                                        <td><?= trangthais($rowls['result_text']); ?></td>
                                        <td><?= $rowls['status']; ?></td>
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
                <div class="col-xl-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">Lịch sử nhận Sai ND</span>
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
                                foreach ($tkuma->get_list(" SELECT * FROM `lich_su_choi` WHERE `type_gd` = ? AND  `sttbot` != ? AND `result_text` = 'SAI NỘI DUNG' ORDER BY `id` DESC  ",['real','1']) as $rowls) {
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