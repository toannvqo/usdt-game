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
                        <li class="breadcrumb-item"><a href="#">Lịch sử chuyển</a></li>
                    </ul>


                    <div class="col-lg-12">

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex fw-bold small mb-3">
                                    <span class="flex-grow-1">Danh Sách Chuyển Tiền</span>
                                    <a href="#staticBackdrop" data-bs-toggle="modal" class="btn btn-outline-theme d-block">Tạo lệnh chuyển</a>
                                </div>

                                <div class="table-responsive">
                                    <table id="datatableDefault" class="table text-nowrap w-100">
                                        <thead>
                                            <tr role="row">
                                                <th>Id</th>
                                                <th>DSCR</th>
                                                <th>Phone Gửi</th>
                                                <th>Mã GD</th>
                                                <th>Phone nhận</th>
                                                <th>Người nhận</th>
                                                <th>Số tiền</th>
                                                <th>Comment</th>
                                                <th>Trạng thái</th>
                                                <th>Thời gian</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($tkuma->get_list(" SELECT * FROM `chuyen_tien` ") as $rowls) {
                                            ?>
                                                <tr class="odd">
                                                    <td><?= $rowls['id']; ?></td>
                                                    <td><?= $rowls['type_gd']; ?></td>
                                                    <td><?= $rowls['ownerNumber']; ?></td>
                                                    <td><?= $rowls['tranId']; ?></td>
                                                    <td><?= $rowls['partnerId']; ?></td>
                                                    <td><?= $rowls['partnerName']; ?></td>
                                                    <td><?= format_currency($rowls['amount']); ?></td>
                                                    <td><?= $rowls['comment']; ?></td>
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
<script>
    $('.btnEdit').on('click', function(e) {
        var btn = $(this);
        $("#id").val(btn.attr("data-id"));
        $("#name").val(btn.attr("data-name"));
        $("#bank_name").val(btn.attr("data-bank_name"));
        $("#ghichu").val(btn.attr("data-ghichu"));
        $("#stk").val(btn.attr("data-stk"));
        $("#Editbank").modal('show');
        return false;
    });
</script>

<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Chuyển Tiền</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="banker">Chọn Tài Khoản</label>
                        <select class="form-select" id="phone" name="phone" data-gtm-form-interact-field-id="0">
                            <option value=""> -- Chọn Số chuyển --</option>
                            <?php
                            $result = $tkuma->get_list("SELECT * FROM `account_vcb` WHERE `status` = ? AND `type` = ? ORDER BY `id` ASC ",['success','1']);
                            foreach ($result as $sdt) {
                                $sodu = balance($sdt['token'])['SoDu'];
                            ?>
                                <option value="<?= $sdt['username']; ?>"> <?= $sdt['account_number']; ?> - Số dư : <?= $sodu ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="bankcode">Chọn Bank Nhận</label>
                        <select class="form-select" id="bankcode" name="bankcode" data-gtm-form-interact-field-id="0">
                            <option value=""> -- Chọn Bank Nhận --</option>
                            <?php foreach ($tkuma->get_list("SELECT * FROM `bankcode` ORDER BY `id` ASC ") as $bankcode) { ?>
                                <option value="<?= $bankcode['bankcode']; ?>"> <?= $bankcode['bankname']; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="sdt">Số Người Nhận *</label>
                            <input type="text" id="sdt" name="sdt" placeholder="Số Người Nhận.." class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="mony">Số Tiền *</label>
                            <input type="text" id="mony" name="mony" placeholder="Số tiền chuyển.." class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="ndchuyen">Nội Dung Chuyển *</label>
                            <input type="text" id="ndchuyen" name="ndchuyen" placeholder="Nhập số tài khoản" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="pass2">Pass 2 *</label>
                            <input type="text" id="pass2" name="pass2" placeholder="Nhập pass 2 để thực hiện chuyển tiền" class="form-control" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnchuyen" class="btn btn-danger">Lưu ngay</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
	$("#btnchuyen").on("click", function() {
		$('#btnchuyen').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled',
			true);
		$.ajax({
			url: "<?= BASE_URL('ajaxs/admin/action.php'); ?>",
			method: "POST",
			dataType: "JSON",
			data: {
				action: 'chuyentienngoai',
				sdt: $("#sdt").val(),
				bankcode: $("#bankcode").val(),
				phone: $("#phone").val(),
				ndchuyen: $("#ndchuyen").val(),
				mony: $("#mony").val(),
				pass2: $("#pass2").val()
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
							location.href = '<?= BASE_URL('admin/chuyentien'); ?>';
						}
					});
					location.href = '<?= BASE_URL('admin/chuyentien'); ?>';
				} else {
					cuteToast({
						type: "error",
						message: respone.msg,
						timer: 5000
					});
				}
				$('#btnchuyen').html('Thêm').prop('disabled', false);
			},
			error: function() {
				cuteToast({
					type: "error",
					message: 'Không thể xử lý',
					timer: 5000
				});
				$('#btnchuyen').html('Thêm').prop('disabled', false);
			}

		});
	});
</script>

<?php
require_once(__DIR__ . '/layout/nav.php');
require_once(__DIR__ . '/layout/footer.php');
?>