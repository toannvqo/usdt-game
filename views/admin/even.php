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

<link href="../public/hudadmin/assets/plugins/select-picker/dist/picker.min.css" rel="stylesheet">
<link href="../public/hudadmin/assets/plugins/jquery-typeahead/dist/jquery.typeahead.min.css" rel="stylesheet">

<script src="../../public/ckeditor/ckeditor.js"></script>
';
$body['footer'] = '
<script src="../public/hudadmin/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/moment/min/moment.min.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/bootstrap-slider/dist/bootstrap-slider.min.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/jquery-typeahead/dist/jquery.typeahead.min.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/tag-it/js/tag-it.min.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/blueimp-file-upload/js/vendor/jquery.ui.widget.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/blueimp-tmpl/js/tmpl.min.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/blueimp-load-image/js/load-image.all.min.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/blueimp-canvas-to-blob/js/canvas-to-blob.min.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/blueimp-gallery/js/jquery.blueimp-gallery.min.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/blueimp-file-upload/js/jquery.iframe-transport.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/blueimp-file-upload/js/jquery.fileupload.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/blueimp-file-upload/js/jquery.fileupload-process.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/blueimp-file-upload/js/jquery.fileupload-image.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/blueimp-file-upload/js/jquery.fileupload-audio.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/blueimp-file-upload/js/jquery.fileupload-video.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/blueimp-file-upload/js/jquery.fileupload-validate.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="../public/hudadmin/assets/plugins/blueimp-file-upload/js/jquery.fileupload-ui.js" type="e61886a4b625c4944b667678-text/javascript"></script>

<script src="' . BASE_URL('') . 'public/hudadmin/assets/plugins/spectrum-colorpicker2/dist/spectrum.min.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="' . BASE_URL('') . 'public/hudadmin/assets/plugins/select-picker/dist/picker.min.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="' . BASE_URL('') . 'public/hudadmin/assets/plugins/%40highlightjs/cdn-assets/highlight.min.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="' . BASE_URL('') . 'public/hudadmin/assets/js/demo/highlightjs.demo.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="' . BASE_URL('') . 'public/hudadmin/assets/js/demo/form-plugins.demo.js" type="e61886a4b625c4944b667678-text/javascript"></script>
<script src="' . BASE_URL('') . 'public/hudadmin/assets/js/demo/sidebar-scrollspy.demo.js" type="e61886a4b625c4944b667678-text/javascript"></script>
';
require_once(__DIR__ . '/../../libs/is_admin.php');
require_once(__DIR__ . '/layout/header.php');
require_once(__DIR__ . '/layout/head.php');
require_once(__DIR__ . '/layout/sidebar.php');

?>
<!-- Content Wrapper. Contains page content -->

<!-- /.content-header -->
<?php
if (isset($_GET['id']) && is_admin()) {
    $row = $tkuma->get_row(" SELECT * FROM `event` WHERE `id` = ?  ",[check_string($_GET['id'])]);
    if (!$row) {
        msg_error("Liên kết không tồn tại", BASE_URL(''), 500);
    }
} else {
    msg_error("Liên kết không tồn tại", BASE_URL(''), 0);
}

?>
<!-- Main content -->
<!-- /.content-header -->
<?php
if (isset($_POST['SaveSettings']) && is_admin()) {
    if ($tkuma->site('status_demo') != 0) {
        die('<script type="text/javascript">if(!alert("Không được dùng chức năng này vì đây là trang web demo.")){window.history.back().location.reload();}</script>');
    }
    $service = check_string($_POST['service']);
    $trangthai = check_string($_POST['trangthai']);
    $name = check_string($_POST['name']);
    $mota = $_POST['mota'];
    if ($_POST['service'] == "top-tuan") {
        $thuong1  = check_string($_POST['thuong1']);
        $thuong2  = check_string($_POST['thuong2']);
        $thuong3  = check_string($_POST['thuong3']);
        $thuong4  = check_string($_POST['thuong4']);
        $thuong5  = check_string($_POST['thuong5']);
        $update_tile = $tkuma->update(
            "event",
            [
                'trangthai' => $trangthai,
                'thuong1' => $thuong1,
                'thuong2' => $thuong2,
                'thuong3' => $thuong3,
                'thuong4' => $thuong4,
                'thuong5' => $thuong5,
                'mota' => $mota
            ],
            " `keyd` = ? ",[$service] );
    }
    if ($_POST['service'] == "nhiem-vu-ngay") {
        $thuong1  = check_string($_POST['thuong1']);
        $thuong2  = check_string($_POST['thuong2']);
        $thuong3  = check_string($_POST['thuong3']);
        $thuong4  = check_string($_POST['thuong4']);
        $thuong5  = check_string($_POST['thuong5']);
        $moc1  = check_string($_POST['moc1']);
        $moc2  = check_string($_POST['moc2']);
        $moc3  = check_string($_POST['moc3']);
        $moc4  = check_string($_POST['moc4']);
        $moc5  = check_string($_POST['moc5']);
        $update_tile = $tkuma->update(
            "event",
            [
                'trangthai' => $trangthai,
                'moc1' => $moc1,
                'thuong1' => $thuong1,
                'moc2' => $moc2,
                'thuong2' => $thuong2,
                'moc3' => $moc3,
                'thuong3' => $thuong3,
                'moc4' => $moc4,
                'thuong4' => $thuong4,
                'moc5' => $moc5,
                'thuong5' => $thuong5,
                'mota' => $mota
            ],
            " `keyd` = ? ",[$service]
        );
    }
    if ($_POST['service'] == "no-hu") {
        $thuong3  = check_string($_POST['thuong3']);
        $thuong4  = check_string($_POST['thuong4']);
        $thuong5  = check_string($_POST['thuong5']);
        $update_tile = $tkuma->update(
            "event",
            [
                'trangthai' => $trangthai,
                'thuong3' => $thuong3,
                'thuong4' => $thuong4,
                'thuong5' => $thuong5,
                'mota' => $mota
            ],
            " `keyd` = ? ",[$service]
        );
    }
    if ($_POST['service'] == "diem-danh") {
        $moc1  = check_string($_POST['moc1']);
        $moc2  = check_string($_POST['moc2']);
        $toithieu  = check_string($_POST['toithieu']);
        $update_tile = $tkuma->update(
            "event",
            [
                'trangthai' => $trangthai,
                'moc1' => $moc1,
                'moc2' => $moc2,
                'toithieu' => $toithieu,
                'mota' => $mota
            ],
            " `keyd` = ? ",[$service]
        );
    }

    if ($update_tile) {
        die('<script type="text/javascript">if(!alert("Lưu thành công !")){window.history.back().location.reload();}</script>');
    } else {
        die('<script type="text/javascript">if(!alert("Lỗi.")){window.history.back().location.reload();}</script>');
    }
} ?>




<button class="app-sidebar-mobile-backdrop" data-toggle-target=".app" data-toggle-class="app-sidebar-mobile-toggled"></button>


<div id="content" class="app-content">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Even <?= $row['game']; ?></a></li>
                    </ul>
                    <div class="col-xl-12">


                        <hr class="mb-4">

                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>Quản Lý Even</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">

                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Tên Game <span class="text-danger">*</span></label>
                                                    <input name="title" type="text" class="form-control" id="game" name="game" placeholder="Tên trang web" value="<?= $row['game']; ?>">
                                                    <input type="hidden" name="service" id="service" value="<?= $row['keyd']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6" style="display:none" id="dtoithieu">
                                                <div class="mb-3">
                                                    <label class="form-label">Chơi Tối Thiểu <span class="text-danger">*</span></label>
                                                    <input  type="text" class="form-control" id="toithieu" name="toithieu" placeholder="Tên trang web" value="<?= $row['toithieu']; ?>">
                                                </div>
                                            </div>

                                            <div class="col-xl-6">
                                                <label class="form-label" for="trangthai">Trạng Thái</label>
                                                <select class="form-select" id="trangthai" name="trangthai" data-gtm-form-interact-field-id="0">
                                                    <option <?= $row['trangthai'] == 'run' ? 'selected' : ''; ?> value="run">ON</option>
                                                    <option <?= $row['trangthai'] == 'off' ? 'selected' : ''; ?> value="off"> OFF</option>
                                                </select>
                                                <!--<i>Chọn OFF website sẽ bật chế độ bảo trì, ADMIN truy cập bình thường.</i>-->
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Cách Chơi<span class="text-danger">*</span></label>
                                                    <textarea name="mota" class="summernote" id="mota" title="Contents"><?= $row['mota']; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="col-xl-6" style="display:none" id="dmoc1">
                                                <div class="mb-3">
                                                    <label class="form-label">Móc 1 <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="moc1" name="moc1" placeholder="Móc Chơi" value="<?= $row['moc1']; ?>">
                                                    <div class="alert alert-success py-2">
                                                        - Móc 1: <?= format_currency($row['moc1']); ?> <br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6" style="display:none" id="dthuong1">
                                                <div class="mb-3">
                                                    <label class="form-label">Thưởng 1<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="thuong1" name="thuong1" placeholder="Thưởng" value="<?= $row['thuong1']; ?>">
                                                    <div class="alert alert-success py-2">
                                                        - Thưởng 1: <?= format_currency($row['thuong1']); ?> <br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6" style="display:none" id="dmoc2">
                                                <div class="mb-3">
                                                    <label class="form-label">Móc 2<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="moc2" name="moc2" placeholder="Móc Chơi" value="<?= $row['moc2']; ?>">
                                                    <div class="alert alert-success py-2">
                                                        - Móc 2: <?= format_currency($row['moc2']); ?> <br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6" style="display:none" id="dthuong2">
                                                <div class="mb-3">
                                                    <label class="form-label">Thưởng 2<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="thuong2" name="thuong2" placeholder="Thưởng" value="<?= $row['thuong2']; ?>">
                                                    <div class="alert alert-success py-2">
                                                        - Thưởng 2: <?= format_currency($row['thuong2']); ?> <br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6" style="display:none" id="dmoc3">
                                                <div class="mb-3">
                                                    <label class="form-label">Móc 3<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="moc3" name="moc3" placeholder="Móc Chơi" value="<?= $row['moc3']; ?>">
                                                    <div class="alert alert-success py-2">
                                                        - Móc 3: <?= format_currency($row['moc3']); ?> <br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6" style="display:none" id="dthuong3">
                                                <div class="mb-3">
                                                    <label class="form-label">Thưởng 3<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="thuong3" name="thuong3" placeholder="Thưởng" value="<?= $row['thuong3']; ?>">
                                                    <div class="alert alert-success py-2">
                                                        - Thưởng 3: <?= format_currency($row['thuong3']); ?> <br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6" style="display:none" id="dmoc4">
                                                <div class="mb-3">
                                                    <label class="form-label">Móc 4<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="moc4" name="moc4" placeholder="Móc Chơi" value="<?= $row['moc4']; ?>">
                                                    <div class="alert alert-success py-2">
                                                        - Móc 4: <?= format_currency($row['moc4']); ?> <br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6" style="display:none" id="dthuong4">
                                                <div class="mb-3">
                                                    <label class="form-label">Thưởng 4<span class="text-danger">*</span></label>
                                                    <input  type="text" class="form-control" id="thuong4" name="thuong4" placeholder="Thưởng" value="<?= $row['thuong4']; ?>">
                                                    <div class="alert alert-success py-2">
                                                        - Thưởng 4: <?= format_currency($row['thuong4']); ?> <br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6" style="display:none" id="dmoc5">
                                                <div class="mb-3">
                                                    <label class="form-label">Móc 5<span class="text-danger">*</span></label>
                                                    <input  type="text" class="form-control" id="moc5" name="moc5" placeholder="Móc Chơi" value="<?= $row['moc5']; ?>">
                                                    <div class="alert alert-success py-2">
                                                        - Móc 5: <?= format_currency($row['moc5']); ?> <br>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6" style="display:none" id="dthuong5">
                                                <div class="mb-3">
                                                    <label class="form-label">Thưởng 5<span class="text-danger">*</span></label>
                                                    <input  type="text" class="form-control" id="thuong5" name="thuong5" placeholder="Thưởng" value="<?= $row['thuong5']; ?>">
                                                    <div class="alert alert-success py-2">
                                                        - Thưởng 5: <?= format_currency($row['thuong5']); ?> <br>
                                                    </div>
                                                </div>
                                            </div>


                                            <button type="submit" name="SaveSettings" class="btn me-2 btn-primary">Lưu</button>
                                        </div>
                                    </form>
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
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('mota');
    var serviceValue = document.getElementById("service").value;

    if (serviceValue === "nhiem-vu-ngay") {
        document.getElementById("dmoc1").style.display = 'block';
        document.getElementById("dthuong1").style.display = 'block';
        document.getElementById("dmoc2").style.display = 'block';
        document.getElementById("dthuong2").style.display = 'block';
        document.getElementById("dmoc3").style.display = 'block';
        document.getElementById("dthuong3").style.display = 'block';
        document.getElementById("dmoc4").style.display = 'block';
        document.getElementById("dthuong4").style.display = 'block';
        document.getElementById("dmoc5").style.display = 'block';
        document.getElementById("dthuong5").style.display = 'block';
    } else if (serviceValue === "diem-danh") {
        document.getElementById("dmoc1").style.display = 'block';
        document.getElementById("dmoc2").style.display = 'block';
        document.getElementById("dtoithieu").style.display = 'block';
    } else if (serviceValue === "top-tuan") {
        document.getElementById("dthuong1").style.display = 'block';
        document.getElementById("dthuong2").style.display = 'block';
        document.getElementById("dthuong3").style.display = 'block';
        document.getElementById("dthuong4").style.display = 'block';
        document.getElementById("dthuong5").style.display = 'block';
    } else if (serviceValue === "no-hu") {
        document.getElementById("dthuong3").style.display = 'block';
        document.getElementById("dthuong4").style.display = 'block';
        document.getElementById("dthuong5").style.display = 'block';
    } else {
        document.getElementById("dthuong1").style.display = 'block';
        document.getElementById("vcbchuyen").style.display = 'none';
    }
</script>



<?php
require_once(__DIR__ . '/layout/nav.php');
require_once(__DIR__ . '/layout/footer.php');
?>