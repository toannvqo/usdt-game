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
if (isset($_GET['id']) && is_admin()) {
    $rowd = $tkuma->get_row(" SELECT * FROM `danh_sach_game` WHERE `id` = ?  ",[check_string2($_GET['id'])]);
    if (!$rowd) {
        msg_error("Liên kết không tồn tại", BASE_URL('admin/danhsachgame'), 500);
    }
} else {
    msg_error("Liên kết không tồn tại", BASE_URL('admin/danhsachgame'), 0);
}
?>
<button class="app-sidebar-mobile-backdrop" data-toggle-target=".app" data-toggle-class="app-sidebar-mobile-toggled"></button>


<div id="content" class="app-content">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="row">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Danh sách cách chơi <?= $rowd['ten_game']; ?></a></li>
                    </ul>
                   
                    <div class="col-lg-12">

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex fw-bold small mb-3">
                                    <span class="flex-grow-1">Danh sách cách chơi <?= $rowd['ten_game']; ?></span>
                                    <a href="#staticBackdrop" data-bs-toggle="modal" class="btn btn-outline-theme d-block">Thêm cách chơi <?= $rowd['ten_game']; ?></a>
                                </div>

                                <div class="table-responsive">
                                    <table id="datatableDefault" class="table text-nowrap w-100">
                                        <thead>
                                            <tr role="row">
                                                <th>Comment</th>
                                                <th>Tỷ lệ</th>
                                                <th>Result</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $list_mm = $tkuma->get_list(" SELECT * FROM `settings_game` WHERE `keyd` = ? ",[$rowd['ma_game']]);
                                            if ($list_mm) {
                                                foreach ($list_mm as $row) {
                                            ?>
                                                    <tr class="odd">
                                                        <td><?= $row['comment']; ?></td>
                                                        <td><?= $row['tile']; ?></td>
                                                        <td><?= $row['result']; ?></td>
                                                        
                                                        <td>
                                                            <a href="#" class="text-white" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end" data-bs-theme="light">
                                                                <a class="dropdown-item btnEdit" data-id="<?= $row['id']; ?>" data-result="<?= $row['result']; ?>" data-comment="<?= $row['comment']; ?>" data-tile="<?= $row['tile']; ?>" >Chỉnh Sửa</a>
                                                                <a class="dropdown-item" onclick="RemoveRowdvcb('<?= $row['id']; ?>')">Delete</a>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr class="odd">
                                                    <td valign="top" colspan="9" class="dataTables_empty">No data available in table</td>
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
        $("#_comment").val(btn.attr("data-comment"));
        $("#_tile").val(btn.attr("data-tile"));
        $("#_result").val(btn.attr("data-result"));
        $("#editstaticBackdrop").modal('show');
        return false;
    });
</script>
<script>
    $(document).ready(function() {
        $('#datatableDefault').DataTable();
        $('#datatableDefault2').DataTable();
    });
</script>
<script type="text/javascript">
    function RemoveRowdvcb(id) {
        cuteAlert({
            type: "question",
            title: "Xác Nhận hủy",
            message: "Bạn có chắc chắn xác nhận xóa " + id + " không ?",
            confirmText: "Đồng Ý",
            cancelText: "Hủy"
        }).then((e) => {
            if (e) {
                $.ajax({
                    url: "<?= BASE_URL("ajaxs/admin/action.php"); ?>",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        id: id,
                        action: 'xoa-cachchoi'
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

<div class="modal fade" id="editstaticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">EDIT CÁCH CHƠI </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-line">
                            <input type="hidden" id="_id" name="_id" class="form-control" required>
                            <label class="form-label" for="_comment">Comment</label>
                            <input type="text" id="_comment" name="_comment" placeholder="Mã game (Nọi dung khi khách chuyển)" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="_tile">Tỷ Lệ</label>
                            <input type="text" id="_tile" name="_tile" placeholder="Tỷ Lệ x tiền khi khách thắng (cách nhau bởi dấu . ví dụ 2.5)" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="_result">Result</label>
                            <input type="text" id="_result" name="_result" placeholder="Số cuối hoặc tổng hiệu bằng với 1 trong các result (cách nhau bằng dấu , ví dụ 2,4,6,8)" class="form-control" required>
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
				action: 'editcachchoi',
				id: $("#_id").val(),
				comment: $("#_comment").val(),
				tile: $("#_tile").val(),
				result: $("#_result").val()
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

<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">THÊM CÁCH CHƠI <?= $rowd['ten_game']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="comment">Comment</label>
                            <input type="text" id="comment" name="comment" placeholder="Mã game (Nọi dung khi khách chuyển)" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="tile">Tỷ Lệ</label>
                            <input type="text" id="tile" name="tile" placeholder="Tỷ Lệ x tiền khi khách thắng (cách nhau bởi dấu . ví dụ 2.5)" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="result">Result</label>
                            <input type="text" id="result" name="result" placeholder="Số cuối hoặc tổng hiệu bằng với 1 trong các result (cách nhau bằng dấu , ví dụ 2,4,6,8)" class="form-control" required>
                        </div>
                    </div>
                    
                    

                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnAddgame" class="btn btn-danger">Lưu ngay</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
	$("#btnAddgame").on("click", function() {
		$('#btnAddgame').html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled',
			true);
		$.ajax({
			url: "<?= base_url('ajaxs/admin/action.php'); ?>",
			method: "POST",
			dataType: "JSON",
			data: {
				action: 'Addcachchoi',
				key: <?= $rowd['id']; ?>,
				comment: $("#comment").val(),
				tile: $("#tile").val(),
				result: $("#result").val()
			},
			success: function(respone) {
				if (respone.status == 'success') {
					cuteToast({
						type: "success",
						message: respone.msg,
						timer: 5000
					});
					setTimeout(function() {location.reload();}, 100);
				// 	setTimeout("location.href = '<?= BASE_URL('admin/danhsachgame'); ?>';", 100);
				} else {
					cuteToast({
						type: "error",
						message: respone.msg,
						timer: 5000
					});
				}
				$('#btnAddgame').html('Lưu ngay').prop('disabled', false);
			},
			error: function() {
				$('#btnAddgame').html('Lưu ngay').prop('disabled', false);
				cuteToast({
					type: "error",
					message: 'Không thể xử lý',
					timer: 5000
				});
			}

		});
	});
</script>

<?php
require_once(__DIR__ . '/layout/nav.php');
require_once(__DIR__ . '/layout/footer.php');
?>