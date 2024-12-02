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

<script src="../public/ckeditor/ckeditor.js"></script>
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
if (isset($_POST['SaveSettings']) && is_admin()) {
    if ($tkuma->site('status_demo') != 0) {
        msg_error("Không được dùng chức năng này vì đây là trang web demo.", BASE_URL(''), 1000);
    }
    foreach ($_POST as $key => $value) {
        $tkuma->update("settings", array(
            'value' => $value
        ), " `name` = ? ",[$key]);
    }
    msg_success("Lưu thành công", '', 1000);
} ?>
<!-- Main content -->
<?php
if (isset($_POST['chaneltheme']) && is_admin()) {
    if ($tkuma->site('status_demo') != 0) {
        msg_error("Không được dùng chức năng này vì đây là trang web demo.", BASE_URL(''), 1000);
    }
    if (check_img('favicon') == true) {
        unlink(check_string($tkuma->site('favicon')));
        $rand = random('0123456789QWERTYUIOPASDGHJKLZXCVBNM', 6);
        $uploads_dir = 'public/storage/theme/' . $rand . '.png';
        $tmp_name = $_FILES['favicon']['tmp_name'];
        $addlogo = move_uploaded_file($tmp_name, $uploads_dir);
        if ($addlogo) {
            $tkuma->update('settings', [
                'value'  => 'public/storage/theme/' . $rand . '.png'
            ], " `name` = ? ",['favicon']);
        }
    }
    if (check_img('anhbia') == true) {
        unlink(check_string($tkuma->site('anhbia')));
        $rand = random('0123456789QWERTYUIOPASDGHJKLZXCVBNM', 6);
        $uploads_dir = 'public/storage/theme/' . $rand . '.png';
        $tmp_name = $_FILES['anhbia']['tmp_name'];
        $addlogo = move_uploaded_file($tmp_name, $uploads_dir);
        if ($addlogo) {
            $tkuma->update('settings', [
                'value'  => 'public/storage/theme/' . $rand . '.png'
            ], " `name` = ? ",['anhbia']);
        }
    }
    msg_success("Lưu thành công", '', 1000);
} ?>




<button class="app-sidebar-mobile-backdrop" data-toggle-target=".app" data-toggle-class="app-sidebar-mobile-toggled"></button>


<div id="content" class="app-content">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">SETTING HOME</a></li>
                    </ul>
                    <div class="col-xl-6">


                        <hr class="mb-4">

                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>Setting Trang</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Tên trang <span class="text-danger">*</span></label>
                                                    <input name="title" type="text" class="form-control" id="datepicker-default" placeholder="Tên trang web" value="<?= $tkuma->site('title'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Mô tả trang <span class="text-danger">*</span></label>
                                                    <input name="description" type="text" class="form-control" id="datepicker-default" placeholder="Mô tả trang web" value="<?= $tkuma->site('description'); ?>">
                                                </div>
                                            </div>
                                           
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Từ Khóa <span class="text-danger">*</span></label>
                                                    <input name="keywords" type="text" class="form-control" id="datepicker-default" placeholder="từ khóa key tìm kiếm" value="<?= $tkuma->site('keywords'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">API KEY CAPTCHA <span class="text-danger">*</span></label>
                                                    <input name="server_captcha" type="text" class="form-control" id="datepicker-default" placeholder="API CAPTCHA" value="<?= $tkuma->site('server_captcha'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-label" for="statusweb">Status web</label>
                                                <select class="form-select" id="statusweb" name="statusweb" data-gtm-form-interact-field-id="0">
                                                    <option <?= $tkuma->site('statusweb') == 1 ? 'selected' : ''; ?> value="1">ON</option>
                                                    <option <?= $tkuma->site('statusweb') == 0 ? 'selected' : ''; ?> value="0"> OFF</option>
                                                </select>
                                                <i>Chọn OFF website sẽ bật chế độ bảo trì, ADMIN truy cập bình thường.</i>
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-label" for="status_footercustom">Status Footer động</label>
                                                <select class="form-select" id="status_footercustom" name="status_footercustom" data-gtm-form-interact-field-id="0">
                                                    <option <?= $tkuma->site('status_footercustom') == 1 ? 'selected' : ''; ?> value="1">ON</option>
                                                    <option <?= $tkuma->site('status_footercustom') == 0 ? 'selected' : ''; ?> value="0"> OFF</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Thông Báo<span class="text-danger">*</span></label>
                                                    <textarea name="notification" class="summernote" id="notification" title="Contents"><?= $tkuma->site('notification'); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Lưu ý<span class="text-danger">*</span></label>
                                                    <textarea name="nofication_ex" class="summernote" id="nofication_ex" title="Contents"><?= $tkuma->site('nofication_ex'); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Cách Chơi<span class="text-danger">*</span></label>
                                                    <textarea name="cachchoi" class="summernote" id="cachchoi" title="Contents"><?= $tkuma->site('cachchoi'); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">HTML-JS Footer <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" rows="10" style="background-color: #000;color:#00d230;" name="html_footer" placeholder="Chèn JS trang trí hay chèn code gì vô cũng được nếu muốn" rows="6"><?= $tkuma->site('html_footer'); ?></textarea>
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
                        
                        
                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>Bảo Mật</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                           
                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Bảo Mật Link Login Admin<span class="text-danger">*</span></label>
                                                    <input name="pin_admin" type="text" class="form-control" id="datepicker-default" placeholder="doamins" value="<?= $tkuma->site('pin_admin'); ?>">
                                                </div>
                                                <div class="alert alert-success py-2">
                                                        - Link login của bạn <?= base_url('admin/appdevices/'.$tkuma->site('pin_admin')); ?>
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
                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>FACE TOP TUẦN</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <label class="form-label" for="status_facetop">Status TOP TUẦN FACE</label>
                                                <select class="form-select" id="status_facetop" name="status_facetop" data-gtm-form-interact-field-id="0">
                                                    <option <?= $tkuma->site('status_facetop') == 1 ? 'selected' : ''; ?> value="1">ON</option>
                                                    <option <?= $tkuma->site('status_facetop') == 0 ? 'selected' : ''; ?> value="0"> OFF</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">User TOP 1 <span class="text-danger">*</span></label>
                                                    <input name="usertuan1" type="text" class="form-control" id="datepicker-default" value="<?= $tkuma->site('usertuan1'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">TIỀN TOP 1 <span class="text-danger">*</span></label>
                                                    <input name="toptuan1" type="text" class="form-control" id="datepicker-default" value="<?= $tkuma->site('toptuan1'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">User TOP 2 <span class="text-danger">*</span></label>
                                                    <input name="usertuan2" type="text" class="form-control" id="datepicker-default" value="<?= $tkuma->site('usertuan2'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">TIỀN TOP 2 <span class="text-danger">*</span></label>
                                                    <input name="toptuan2" type="text" class="form-control" id="datepicker-default" value="<?= $tkuma->site('toptuan2'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">User TOP 3 <span class="text-danger">*</span></label>
                                                    <input name="usertuan3" type="text" class="form-control" id="datepicker-default" value="<?= $tkuma->site('usertuan3'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">TIỀN TOP 3 <span class="text-danger">*</span></label>
                                                    <input name="toptuan3" type="text" class="form-control" id="datepicker-default" value="<?= $tkuma->site('toptuan3'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">User TOP 4 <span class="text-danger">*</span></label>
                                                    <input name="usertuan4" type="text" class="form-control" id="datepicker-default" value="<?= $tkuma->site('usertuan4'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">TIỀN TOP 4 <span class="text-danger">*</span></label>
                                                    <input name="toptuan4" type="text" class="form-control" id="datepicker-default" value="<?= $tkuma->site('toptuan4'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">User TOP 5 <span class="text-danger">*</span></label>
                                                    <input name="usertuan5" type="text" class="form-control" id="datepicker-default" value="<?= $tkuma->site('usertuan5'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">TIỀN TOP 5 <span class="text-danger">*</span></label>
                                                    <input name="toptuan5" type="text" class="form-control" id="datepicker-default" value="<?= $tkuma->site('toptuan5'); ?>">
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
                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>SETTING BOT</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <!--<div class="col-xl-6">-->
                                            <!--    <div class="mb-3">-->
                                            <!--        <label class="form-label">TIME Bắt Đầu<span class="text-danger">*</span></label>-->
                                            <!--        <input name="band" type="time" class="form-control" id="datepicker-default" placeholder="-10018xxxx1" value="<?= $tkuma->site('band'); ?>">-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <!--<div class="col-xl-6">-->
                                            <!--    <div class="mb-3">-->
                                            <!--        <label class="form-label">TIME Dừng<span class="text-danger">*</span></label>-->
                                            <!--        <input name="band" type="time" class="form-control" id="datepicker-default" placeholder="-10018xxxx1" value="<?= $tkuma->site('band'); ?>">-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <div class="col-xl-6">
                                                <label class="form-label" for="status_bot">Status BOT</label>
                                                <select class="form-select" id="status_bot" name="status_bot" data-gtm-form-interact-field-id="0">
                                                    <option <?= $tkuma->site('status_bot') == 1 ? 'selected' : ''; ?> value="1">ON</option>
                                                    <option <?= $tkuma->site('status_bot') == 0 ? 'selected' : ''; ?> value="0"> OFF</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Số Lượng bot tối đa<span class="text-danger">*</span></label>
                                                    <input name="maxbot" type="text" class="form-control" id="datepicker-default" placeholder="-10018xxxx1" value="<?= $tkuma->site('maxbot'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Random NAME BOT<span class="text-danger">*</span></label>
                                                    <textarea name="randomnamebot" type="text" class="form-control" id="datepicker-default" placeholder="-10018xxxx1"  rows="6"><?= $tkuma->site('randomnamebot'); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Random TIỀN CHƠI CỦA BOT<span class="text-danger">*</span></label>
                                                    <textarea name="monybot" type="text" class="form-control" id="datepicker-default" placeholder="-10018xxxx1"  rows="6"><?= $tkuma->site('monybot'); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Random PHONE BOT<span class="text-danger">*</span></label>
                                                    <textarea name="phonebot" type="text" class="form-control" id="datepicker-default" placeholder="-10018xxxx1"  rows="6"><?= $tkuma->site('phonebot'); ?></textarea>
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
                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>Cấu Hình Bịp Khác Bank</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <label class="form-label" for="tylethua">Tỷ Lệ Thua</label>
                                                <select class="form-select" id="tylethua" name="tylethua" data-gtm-form-interact-field-id="0">
                                                    <option <?= $tkuma->site('tylethua') == 1 ? 'selected' : ''; ?> value="1">10%</option>
                                                    <option <?= $tkuma->site('tylethua') == 2 ? 'selected' : ''; ?> value="2">20%</option>
                                                    <option <?= $tkuma->site('tylethua') == 3 ? 'selected' : ''; ?> value="3">30%</option>
                                                    <option <?= $tkuma->site('tylethua') == 4 ? 'selected' : ''; ?> value="4">40%</option>
                                                    <option <?= $tkuma->site('tylethua') == 5 ? 'selected' : ''; ?> value="5">50%</option>
                                                    <option <?= $tkuma->site('tylethua') == 6 ? 'selected' : ''; ?> value="6">60%</option>
                                                    <option <?= $tkuma->site('tylethua') == 7 ? 'selected' : ''; ?> value="7">70%</option>
                                                    <option <?= $tkuma->site('tylethua') == 8 ? 'selected' : ''; ?> value="8">80%</option>
                                                    <option <?= $tkuma->site('tylethua') == 9 ? 'selected' : ''; ?> value="9">90%</option>
                                                    <option <?= $tkuma->site('tylethua') == 10 ? 'selected' : ''; ?> value="10"> 100%</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-12">
                                                <label class="form-label" for="status_bipvcb">Trạng thái BỊP VCB</label>
                                                <select class="form-select" id="status_bipvcb" name="status_bipvcb" data-gtm-form-interact-field-id="0">
                                                    <option <?= $tkuma->site('status_bipvcb') == '1' ? 'selected' : ''; ?> value="1"> ON</option>
                                                    <option <?= $tkuma->site('status_bipvcb') == '0' ? 'selected' : ''; ?> value="0"> OFF</option>
                                                </select>
                                                <i>Lưu Ý: VCB phải luôn bật nếu không sẽ bị bug mã hóa đơn ban đêm khi khác bank</i>
                                                
                                            </div>
                                             <div class="col-xl-12">
                                                <label class="form-label" for="status_bipmbbank">Trạng thái BỊP MBBANK</label>
                                                <select class="form-select" id="status_bipmbbank" name="status_bipmbbank" data-gtm-form-interact-field-id="0">
                                                    <option <?= $tkuma->site('status_bipmbbank') == '1' ? 'selected' : ''; ?> value="1"> ON</option>
                                                    <option <?= $tkuma->site('status_bipmbbank') == '0' ? 'selected' : ''; ?> value="0"> OFF</option>
                                                </select>
                                                <i>Lưu Ý: VCB phải luôn bật nếu không sẽ bị bug mã hóa đơn ban đêm khi khác bank</i>
                                                
                                            </div>
                                            <div class="mb-3"></div>
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
                    <div class="col-xl-6">
                        <hr class="mb-4">
                        <div id="bootstrapDaterangepicker" class="mb-5">
                            <h4>Chanel THEME</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <!--<div class="col-xl-6">-->
                                            <!--    <div class="mb-3">-->
                                            <!--        <label class="form-label">Logo Light</label>-->
                                            <!--        <div class="input-group" id="default-daterange">-->
                                            <!--            <input type="file" class="form-control" id="exampleInputFile" name="logo">-->
                                            <!--            <label class="input-group-text"><i class="fa fa-calendar"></i></label>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <!--<div class="col-xl-6">-->
                                            <!--    <div class="mb-3">-->
                                            <!--        <img width="300px" src="<?= BASE_URL($tkuma->site('logo')); ?>" />-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <!--<hr>-->
                                            <!--<div class="col-xl-6">-->
                                            <!--    <div class="mb-3">-->
                                            <!--        <label class="form-label">Logo Dark</label>-->
                                            <!--        <div class="input-group" id="default-daterange">-->
                                            <!--            <input type="file" class="form-control" id="exampleInputFile" name="logo_dark">-->
                                            <!--            <label class="input-group-text"><i class="fa fa-calendar"></i></label>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <!--<div class="col-xl-6">-->
                                            <!--    <div class="mb-3">-->
                                            <!--        <img width="300px" src="<?= BASE_URL($tkuma->site('logo_dark')); ?>" />-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <!--<hr>-->
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Favicon</label>
                                                    <div class="input-group" id="default-daterange">
                                                        <input type="file" class="form-control" id="exampleInputFile" name="favicon">
                                                        <label class="input-group-text"><i class="fa fa-calendar"></i></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <img width="100px" src="<?= BASE_URL($tkuma->site('favicon')); ?>" />
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Ảnh bìa</label>
                                                    <div class="input-group" id="default-daterange">
                                                        <input type="file" class="form-control" id="exampleInputFile" name="anhbia">
                                                        <label class="input-group-text"><i class="fa fa-calendar"></i></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <img width="100px" src="<?= BASE_URL($tkuma->site('anhbia')); ?>" />
                                                </div>
                                            </div>
                                            <!--<hr>-->
                                            <!--<div class="col-xl-6">-->
                                            <!--    <div class="mb-3">-->
                                            <!--        <label class="form-label">Background</label>-->
                                            <!--        <div class="input-group" id="default-daterange">-->
                                            <!--            <input type="file" class="form-control" id="exampleInputFile" name="background">-->
                                            <!--            <label class="input-group-text"><i class="fa fa-calendar"></i></label>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <!--<div class="col-xl-6">-->
                                            <!--    <div class="mb-3">-->
                                            <!--        <img width="200px" src="<?= BASE_URL($tkuma->site('background')); ?>" />-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <hr>
                                           
                                            <button type="submit" name="chaneltheme" class="btn me-2 btn-primary">Lưu</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-arrow">
                                    <div class="card-arrow-top-left"></div>
                                    <div class="card-arrow-top-right"></div>
                                    <div class="card-arrow-bottom-left"></div>
                                    <div class="card-arrow-bottom-right"></div>
                                </div>
                                <div class="hljs-container">
                                    <pre><code class="xml" data-url="assets/data/form-plugins/code-2.json"></code></pre>
                                </div>
                            </div>
                        </div>

                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>Liên Hệ</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">SĐT Zalo<span class="text-danger">*</span></label>
                                                    <input name="zalo" type="text" class="form-control" id="datepicker-default" placeholder="0x54454xxxx" value="<?= $tkuma->site('zalo'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Link FaceBook <span class="text-danger">*</span></label>
                                                    <input name="facebook" type="text" class="form-control" id="datepicker-default" placeholder="https://facebook.com/adminxxxx" value="<?= $tkuma->site('facebook'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Link Telegram Admin<span class="text-danger">*</span></label>
                                                    <input name="telegram" type="text" class="form-control" id="datepicker-default" placeholder="https://t.me/Adminweb" value="<?= $tkuma->site('telegram'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Link Telegram Box<span class="text-danger">*</span></label>
                                                    <input name="telegrambox" type="text" class="form-control" id="datepicker-default" placeholder="https://t.me/boxtxxx" value="<?= $tkuma->site('telegrambox'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Link Telegram Bot MGD<span class="text-danger">*</span></label>
                                                    <input name="telegrambot" type="text" class="form-control" id="datepicker-default" placeholder="https://t.me/boxtxxx" value="<?= $tkuma->site('telegrambot'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-label" for="status_pluginchat">Status Plugin chat FaceBook</label>
                                                <select class="form-select" id="status_pluginchat" name="status_pluginchat" data-gtm-form-interact-field-id="0">
                                                    <option <?= $tkuma->site('status_pluginchat') == 1 ? 'selected' : ''; ?> value="1">ON</option>
                                                    <option <?= $tkuma->site('status_pluginchat') == 0 ? 'selected' : ''; ?> value="0"> OFF</option>
                                                </select>
                                                <i>Chọn OFF Sẽ Không Bật Plugin.</i>
                                            </div>

                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Chèn code Plugin chat FaceBook <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" rows="10" style="background-color: #000;color:#00d230;" name="pluginchat" placeholder="Chèn JS Plugin chat Facebook vào" rows="6"><?= $tkuma->site('pluginchat'); ?></textarea>
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
                        
                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>Màu Trang</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Complex mode<span class="text-danger">*</span></label>
                                                    <input type="text" value="<?= $tkuma->site('color'); ?>" class="form-control" name="color" id="colorpicker" >
                                                </div>
                                            </div>
                                            
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Color Text<span class="text-danger">*</span></label>
                                                    <input type="text" value="<?= $tkuma->site('color_text'); ?>" class="form-control" name="color_text" id="colorpicker1" >
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Color Head<span class="text-danger">*</span></label>
                                                    <input type="text" value="<?= $tkuma->site('color_head'); ?>" class="form-control" name="color_head" id="colorpicker2" >
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Color Button<span class="text-danger">*</span></label>
                                                    <input type="text" value="<?= $tkuma->site('color_button'); ?>" class="form-control" name="color_button" id="colorpicker3" >
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Color End<span class="text-danger">*</span></label>
                                                    <input type="text" value="<?= $tkuma->site('color_end'); ?>" class="form-control" name="color_end" id="colorpicker4" >
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
                            
                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>Bảo Mật Link Cron </h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Bảo Mật Link Cron<span class="text-danger">*</span></label>
                                                <input name="pin_cron" type="text" class="form-control" id="datepicker-default" placeholder="doamins" value="<?= $tkuma->site('pin_cron'); ?>">
                                            </div>

                                            <div class="alert alert-success py-2">
                                                - Link cron của bạn sẽ thêm <?= $tkuma->site('pin_cron'); ?> phía sau <br>
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
                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>Thông Báo VỀ BOX TELE</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                           
                                           
                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">THÔNG BÁO THẮNG <span class="text-danger">*</span></label>
                                                    <textarea name="notisendtele" type="text" class="form-control" id="datepicker-default" placeholder="-10018xxxx1"  rows="12"><?= $tkuma->site('notisendtele'); ?></textarea>
                                                </div>
                                                <ul>
                                                    
                                                <li><b>{domain}</b> =&gt; LINK WEB SITE.</li>
                                                <li><b>{tranid}</b> =&gt; MÃ GIAO DỊCH.</li>
                                                <li><b>{ketqua}</b> =&gt; CHIẾN THẮNG.</li>
                                                <li><b>{tienthang}</b> =&gt; TIỀN THẮNG GAME CỦA USER.</li>
                                                <li><b>{userwin}</b> =&gt; TÊN NGƯỜI THẮNG.</li>
                                                <li><b>{thoigian}</b> =&gt; THỜI GIAN CHƠI.</li>
                                                <li><b>{noidungchuyen}</b> =&gt; MÃ GAME CHƠI.</li>
                                                <li><b>{gamechoi}</b> =&gt; GAME CHƠI.</li>
                                            </ul>
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
                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>Thông Báo</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Token bot telegram<span class="text-danger">*</span></label>
                                                    <input name="token_telegram" type="text" class="form-control" id="datepicker-default" placeholder="86033495:AAEgGEPeDxxx" value="<?= $tkuma->site('token_telegram'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Nhập id chat telegram<span class="text-danger">*</span></label>
                                                    <input name="id_telegram" type="text" class="form-control" id="datepicker-default" placeholder="-10018xxxx1" value="<?= $tkuma->site('id_telegram'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <label class="form-label" for="status_randommsgnd">Status Random MSG Sai ND</label>
                                                <select class="form-select" id="status_randommsgnd" name="status_randommsgnd" data-gtm-form-interact-field-id="0">
                                                    <option <?= $tkuma->site('status_randommsgnd') == 1 ? 'selected' : ''; ?> value="1">ON</option>
                                                    <option <?= $tkuma->site('status_randommsgnd') == 0 ? 'selected' : ''; ?> value="0"> OFF</option>
                                                </select>
                                                <i>Chọn On sẽ bật chế random msg trả thưởng sai ND.</i>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Random MSG key Sai ND<span class="text-danger">*</span></label>
                                                    <textarea name="random_msgnd" type="text" class="form-control" id="datepicker-default" placeholder="-10018xxxx1"  rows="6"><?= $tkuma->site('random_msgnd'); ?></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xl-6">
                                                <label class="form-label" for="status_pluginchat">Status Random MSG</label>
                                                <select class="form-select" id="status_randommsg" name="status_randommsg" data-gtm-form-interact-field-id="0">
                                                    <option <?= $tkuma->site('status_randommsg') == 1 ? 'selected' : ''; ?> value="1">ON</option>
                                                    <option <?= $tkuma->site('status_randommsg') == 0 ? 'selected' : ''; ?> value="0"> OFF</option>
                                                </select>
                                                <i>Chọn On sẽ bật chế random msg trả thưởng.</i>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Random MSG key<span class="text-danger">*</span></label>
                                                    <textarea name="random_msg" type="text" class="form-control" id="datepicker-default" placeholder="-10018xxxx1"  rows="6"><?= $tkuma->site('random_msg'); ?></textarea>
                                                </div>
                                            </div>
    
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">MSG_GAME (Nhỏ hơn 20 kí tự)<span class="text-danger">*</span></label>
                                                    <input name="msg_game" type="text" class="form-control" id="datepicker-default" placeholder="-10018xxxx1" value="<?= $tkuma->site('msg_game'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">MSG_Event (Nhỏ hơn 20 kí tự)<span class="text-danger">*</span></label>
                                                    <input name="msg_event" type="text" class="form-control" id="datepicker-default" placeholder="-10018xxxx1" value="<?= $tkuma->site('msg_event'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">MSG_Giftcode (Nhỏ hơn 20 kí tự)<span class="text-danger">*</span></label>
                                                    <input name="msg_giftcode" type="text" class="form-control" id="datepicker-default" placeholder="-10018xxxx1" value="<?= $tkuma->site('msg_giftcode'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Band (Nhỏ hơn 20 kí tự)<span class="text-danger">*</span></label>
                                                    <input name="band" type="text" class="form-control" id="datepicker-default" placeholder="-10018xxxx1" value="<?= $tkuma->site('band'); ?>">
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
                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>Cấu Hình Websoket</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <label class="form-label" for="status_websoket">Status Websoket</label>
                                                <select class="form-select" id="status_websoket" name="status_websoket" data-gtm-form-interact-field-id="0">
                                                    <option <?= $tkuma->site('status_websoket') == 1 ? 'selected' : ''; ?> value="1">ON</option>
                                                    <option <?= $tkuma->site('status_websoket') == 0 ? 'selected' : ''; ?> value="0"> OFF</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Đ/c: Websoket <span class="text-danger">*</span></label>
                                                    <input name="websoket" type="text" class="form-control" id="datepicker-default" value="<?= $tkuma->site('websoket'); ?>">
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
                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>Cấu Hình Theme User</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <label class="form-label" for="status_themeuser">Cho phép user Chỉnh theme</label>
                                                <select class="form-select" id="status_themeuser" name="status_themeuser" data-gtm-form-interact-field-id="0">
                                                    <option <?= $tkuma->site('status_themeuser') == 1 ? 'selected' : ''; ?> value="1">ON</option>
                                                    <option <?= $tkuma->site('status_themeuser') == 0 ? 'selected' : ''; ?> value="0"> OFF</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-12">
                                                <label class="form-label" for="home_page">Theme mặc định</label>
                                                <select class="form-select" id="home_page" name="home_page" data-gtm-form-interact-field-id="0">
                                                    <option <?= $tkuma->site('home_page') == 'theme1' ? 'selected' : ''; ?> value="theme1"> Theme1</option>
                                                    <option <?= $tkuma->site('home_page') == 'theme2' ? 'selected' : ''; ?> value="theme2"> Theme2</option>
                                                    <option <?= $tkuma->site('home_page') == 'theme3' ? 'selected' : ''; ?> value="theme3"> Theme3</option>
                                                    <option <?= $tkuma->site('home_page') == 'theme4' ? 'selected' : ''; ?> value="theme4"> Theme4</option>
                                                    <option <?= $tkuma->site('home_page') == 'theme5' ? 'selected' : ''; ?> value="theme5"> Theme5</option>
                                                    <option <?= $tkuma->site('home_page') == 'theme6' ? 'selected' : ''; ?> value="theme6"> Theme6</option>
                                                    <option <?= $tkuma->site('home_page') == 'theme7' ? 'selected' : ''; ?> value="theme7"> Theme7</option>
                                                    <option <?= $tkuma->site('home_page') == 'theme8' ? 'selected' : ''; ?> value="theme8"> Theme8</option>
                                                </select>
                                                
                                            </div>
                                            <div class="mb-3"></div>
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
                        
                    <div id="bootstrapDatepicker" class="mb-5">
                            <h4>Cấu Hình Hoàn Tiền khi khách nhập sai nội dung</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <label class="form-label" for="tylehoan">Tỷ Lệ Hoàn (0% nghĩa là không hoàn lại đồng nào)</label>
                                                <select class="form-select" id="tylehoan" name="tylehoan" data-gtm-form-interact-field-id="0">
                                                    <option <?= $tkuma->site('tylehoan') == 0 ? 'selected' : ''; ?> value="0">0%</option>
                                                    <option <?= $tkuma->site('tylehoan') == 1 ? 'selected' : ''; ?> value="1">10%</option>
                                                    <option <?= $tkuma->site('tylehoan') == 2 ? 'selected' : ''; ?> value="2">20%</option>
                                                    <option <?= $tkuma->site('tylehoan') == 3 ? 'selected' : ''; ?> value="3">30%</option>
                                                    <option <?= $tkuma->site('tylehoan') == 4 ? 'selected' : ''; ?> value="4">40%</option>
                                                    <option <?= $tkuma->site('tylehoan') == 5 ? 'selected' : ''; ?> value="5">50%</option>
                                                    <option <?= $tkuma->site('tylehoan') == 6 ? 'selected' : ''; ?> value="6">60%</option>
                                                    <option <?= $tkuma->site('tylehoan') == 7 ? 'selected' : ''; ?> value="7">70%</option>
                                                    <option <?= $tkuma->site('tylehoan') == 8 ? 'selected' : ''; ?> value="8">80%</option>
                                                    <option <?= $tkuma->site('tylehoan') == 9 ? 'selected' : ''; ?> value="9">90%</option>
                                                    <option <?= $tkuma->site('tylehoan') == 10 ? 'selected' : ''; ?> value="10"> 100%</option>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3"></div>
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
  $('#colorpicker').spectrum({
    type: "component",
    showInput: true
  });
  $('#colorpicker1').spectrum({
    type: "component",
    showInput: true
  });
  $('#colorpicker2').spectrum({
    type: "component",
    showInput: true
  });
  $('#colorpicker3').spectrum({
    type: "component",
    showInput: true
  });
  $('#colorpicker4').spectrum({
    type: "component",
    showInput: true
  });
  
</script>
<script>
    CKEDITOR.replace('notification');
    CKEDITOR.replace('cachchoi');
    CKEDITOR.replace('nofication_ex');
</script>


<?php
require_once(__DIR__ . '/layout/nav.php');
require_once(__DIR__ . '/layout/footer.php');
?>