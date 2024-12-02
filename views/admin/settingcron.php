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

<?php

if(isset($_POST['btnThemNganHang']) && is_admin()) 
{
    if ($tkuma->site('status_demo') != 0) {
        msg_error("Không được dùng chức năng này vì đây là trang web demo.", BASE_URL(''), 1000);
    }
    $isInsert = $tkuma->insert("bank", array(
        'name' => check_string($_POST['nameb']),
        'stk' => check_string($_POST['stkb']),
        'bank_name' => check_string($_POST['bank_namec']),
        'ghichu' => check_string($_POST['ghichud'])
    ));
    if($isInsert)
    {
        msg_success("Thêm thành công", '', 1000);
    }
}

if(isset($_POST['btnSave']) && is_admin()) 
{
    if ($tkuma->site('status_demo') != 0) {
        msg_error("Không được dùng chức năng này vì đây là trang web demo.", BASE_URL(''), 1000);
    }
    $tkuma->update("bank", array(
        'name' => check_string($_POST['name']),
        'stk' => check_string($_POST['stk']),
        'logo' => check_string($_POST['logo']),
        'bank_name' => check_string($_POST['bank_name']),
        'ghichu' => check_string($_POST['ghichu'])
    ), " `id` = ? ",[check_string($_POST['id'])]);
    msg_success("Lưu thành công", '', 1000);
}

if(isset($_POST['btnSaveOption']) && is_admin())
{
    if ($tkuma->site('status_demo') != 0) {
        msg_error("Không được dùng chức năng này vì đây là trang web demo.", BASE_URL(''), 1000);
    }
    foreach ($_POST as $key => $value)
    {
        $tkuma->update("settings", array(
            'value' => $value
        ), " `name` = ? ",[$key]);
    }
    msg_success('Lưu thành công', '', 500);
}
?>




<button class="app-sidebar-mobile-backdrop" data-toggle-target=".app" data-toggle-class="app-sidebar-mobile-toggled"></button>


<div id="content" class="app-content">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">SETTING BANK</a></li>
                    </ul>
   
                    <div class="col-lg-12">

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex fw-bold small mb-3">
                                    <span class="flex-grow-1">Danh Sách Cron</span>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatableDefault" class="table text-nowrap w-100">
                                        <thead>
                                            <tr role="row">
                                            <th>STT</th>
                                            <th>Tên Cron</th>
                                            <th>Trạng Thái</th>
                                            <th>Cập Nhật</th>
                                            <th>Time Cron</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($tkuma->get_list(" SELECT * FROM `cronjobsact` ORDER BY id DESC ") as $row) {
                                            ?>
                                                <tr>
                                                    <tr class="odd">
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $row['name']; ?></td>
                                                    <td><?= display_cron($row['status']); ?></td>
                                                    <td><?= $row['update_time']; ?></td>
                                                    <td><?= ($row['time']+1)*5; ?> s</td>
                                                   
                                                    <td>
                                                        <a href="#" class="text-white" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-end" data-bs-theme="light">
                                                             <a class="dropdown-item btnEdit" data-id="<?= $row['id']; ?>" data-time="<?= $row['time']; ?>" >Chỉnh Sửa</a>
                                                             <?php if( $row['status'] == '1' ) { ?>
                                                                <a class="dropdown-item" onclick="Tatso('<?= $row['id']; ?>')">Tắt</a>
                                                                <?php } else { ?>
                                                                <a class="dropdown-item" onclick="Batso('<?= $row['id']; ?>')">Bật</a>
                                                                <?php } ?>
                                            
                                                        </div>
                                                    </td>
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
        </div>
    </div>
</div>
<script>
    $('.btnEdit').on('click', function(e) {
        var btn = $(this);
        $("#_id").val(btn.attr("data-id"));
        $("#_time").val(btn.attr("data-time"));
        $("#editstaticBackdrop").modal('show');
        return false;
    });
</script>
<div class="modal fade" id="editstaticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">EDIT TIME CRON </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-line">
                            <input type="hidden" id="_id" name="_id" class="form-control" required>
                            <label class="form-label" for="_time">Thời gian cron</label>
                            <input type="text" id="_time" name="_time" placeholder="Mã game (Nọi dung khi khách chuyển)" class="form-control" required>
                            <div class="alert alert-success py-2">
                                - Mặc định 0 là 5s - 1 là 10s - 2 là 15s... <br>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnSave" class="btn btn-danger">Lưu ngay</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
	$("#btnSave").on("click", function() {
		$('#btnSave').html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled',
			true);
		$.ajax({
			url: "<?= base_url('ajaxs/admin/action.php'); ?>",
			method: "POST",
			dataType: "JSON",
			data: {
				action: 'editcron',
				id: $("#_id").val(),
				time: $("#_time").val()
			},
			success: function(respone) {
				if (respone.status == 'success') {
					cuteToast({
						type: "success",
						message: respone.msg,
						timer: 5000
					});
					setTimeout(function() {location.reload();}, 100);
				} else {
					cuteToast({
						type: "error",
						message: respone.msg,
						timer: 5000
					});
				}
				$('#btnSave').html('Lưu ngay').prop('disabled', false);
			},
			error: function() {
				$('#btnSave').html('Lưu ngay').prop('disabled', false);
				cuteToast({
					type: "error",
					message: 'Không thể xử lý',
					timer: 5000
				});
			}

		});
	});
</script>
<script type="text/javascript">
    function Tatso(sdt) {
        cuteAlert({
            type: "question",
            title: "Xác Nhận Tắt",
            message: "Bạn có chắc chắn xác nhận Tắt " + sdt + " không ?",
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
                        action: 'tatcron'
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
    function Batso(sdt) {
        cuteAlert({
            type: "question",
            title: "Xác Nhận Bật",
            message: "Bạn có chắc chắn xác nhận Bật " + sdt + " không ?",
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
                        action: 'batcron'
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




<script>
    CKEDITOR.replace('ghichud');
</script>


<?php
require_once(__DIR__ . '/layout/nav.php');
require_once(__DIR__ . '/layout/footer.php');
?>