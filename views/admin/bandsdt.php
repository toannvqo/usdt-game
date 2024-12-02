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

<button class="app-sidebar-mobile-backdrop" data-toggle-target=".app" data-toggle-class="app-sidebar-mobile-toggled"></button>


<div id="content" class="app-content">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">BAND STK CHƠI</a></li>
                    </ul>
    
                    <div class="col-xl-12">
                        <hr class="mb-4">

                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>Thêm stk band khỏi hệ thống</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Thêm stk band khỏi hệ thống<span class="text-danger">*</span></label>
                                                <input name="pin_cron" type="text" class="form-control" id="sdt" placeholder="Thêm stk band khỏi hệ thống..." >
                                            </div>

                                            <div class="alert alert-success py-2">
                                                - Link cron của bạn sẽ thêm phía sau <br>
                                            </div>
                                            <button type="submit" id="btnAdd" class="btn me-2 btn-primary">Lưu</button>
                                            
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
                    <div class="col-lg-12">

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex fw-bold small mb-3">
                                    <span class="flex-grow-1">Danh Sách VCB Bank</span>
                                    
                                </div>

                                <div class="table-responsive">
                                    <table id="datatableDefault" class="table text-nowrap w-100">
                                        <thead>
                                            <tr role="row">
                                        <th>Id</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>createdate</th>
                                        <th>Thao Tác</th>                                       
                                    </tr>
                                        </thead>
                                        <tbody>
                                   <?php
                                   foreach($tkuma->get_list(" SELECT * FROM `momo_band` ") as $rowls){
                                   ?>
                                    <tr class="odd">
                                       <td><?=$rowls['id'];?></td>
                                       <td><?=$rowls['sdt'];?></td>
                                       <td><?=$rowls['status'];?></td>
                                       <td><?=$rowls['createdate'];?></td>
                                       <td><a onclick="RemoveRowd('<?= $rowls['sdt']; ?>')" ><button class="btn btn-primary">Xóa</button></a></td>
                                    </tr>
                                    <?php }?>
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
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatableDefault').DataTable();
        $('#datatableDefault2').DataTable();
    });
</script>
<script type="text/javascript">
    function RemoveRowd(sdt) {
        cuteAlert({
            type: "question",
            title: "Xác Nhận Xóa",
            message: "Bạn có chắc chắn xác xóa Band " + sdt + " không ?",
            confirmText: "Đồng Ý",
            cancelText: "Hủy"
        }).then((e) => {
            if (e) {
                $.ajax({
                    url: "<?= BASE_URL("ajaxs/admin/action.php"); ?>",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        sdt: sdt,
                        action: 'xoaband'
                    },
                    success: function(respone) {
                        if (respone.status == 'success') {
                            cuteToast({
                                type: "success",
                                message: respone.msg,
                                timer: 5000
                            });
                            location.reload();
                        } else {
                            cuteAlert({
                                type: "error",
                                title: "Error",
                                message: respone.msg,
                                buttonText: "Okay"
                            });
                        }
                    },
                    error: function() {
                        alert(html(response));
                        location.reload();
                    }
                });
            }
        })
    }
</script>

<script type="text/javascript">
    $("#btnAdd").on("click", function() {
        $('#btnAdd').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled',
            true);
        $.ajax({
            url: "<?= BASE_URL('ajaxs/admin/action.php'); ?>",
            method: "POST",
            dataType: "JSON",
            data: {
                action: 'band',
                sdt: $("#sdt").val()
            },
            success: function(respone) {
                if (respone.status == 'success') {
                    Swal.fire({
                        title: 'Thành công !',
                        text: respone.msg,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = '<?= BASE_URL('admin/bandsdt'); ?>';
                        }
                    });
                    location.href = '<?= BASE_URL('admin/bandsdt'); ?>';
                } else {
                    cuteToast({
                        type: "error",
                        message: respone.msg,
                        timer: 5000
                    });
                }
                $('#btnAdd').html('Thêm').prop('disabled', false);
            },
            error: function() {
                cuteToast({
                    type: "error",
                    message: 'Không thể xử lý',
                    timer: 5000
                });
                $('#btnAdd').html('Thêm').prop('disabled', false);
            }

        });
    });
</script>



<?php
require_once(__DIR__ . '/layout/nav.php');
require_once(__DIR__ . '/layout/footer.php');
?>