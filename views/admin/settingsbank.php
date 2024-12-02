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
if (isset($_POST['btnSaveOption']) && is_admin()) {
    if ($tkuma->site('status_demo') != 0) {
        msg_error("Không được dùng chức năng này vì đây là trang web demo.", BASE_URL(''), 1000);
    }
    foreach ($_POST as $key => $value) {
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
                    <div class="col-xl-6">
                        <hr class="mb-4">

                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>Nọi Dung Nạp {trước nickname}</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Nọi Dung Nạp<span class="text-danger">*</span></label>
                                                <input name="ndnaptien" type="text" class="form-control" id="datepicker-default" placeholder="doamins" value="<?= $tkuma->site('ndnaptien'); ?>">

                                            </div>

                                            <button type="submit" name="btnSaveOption" class="btn me-2 btn-primary">Lưu</button>
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
                            <h4>Địa chỉ domain ngork</h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Domain ngork<span class="text-danger">*</span></label>
                                                <input name="ipserver" type="text" class="form-control" id="datepicker-default" placeholder="ipserver" value="<?= $tkuma->site('ipserver'); ?>">

                                            </div>

                                            <button type="submit" name="btnSaveOption" class="btn me-2 btn-primary">Lưu</button>
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

                        <div id="bootstrapDatepicker" class="mb-5">
                            <h4>Min Max chơi </h4>
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label class="form-label">Min Chơi<span class="text-danger">*</span></label>
                                                <input name="mingame" type="text" class="form-control" id="datepicker-default" placeholder="doamins" value="<?= $tkuma->site('mingame'); ?>">
                                            </div>

                                            <div class="alert alert-success py-2">
                                                - chơi tối thiểu <?= format_currency($tkuma->site('mingame')); ?> <br>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Max Chơi<span class="text-danger">*</span></label>
                                                <input name="maxgame" type="text" class="form-control" id="datepicker-default" placeholder="doamins" value="<?= $tkuma->site('maxgame'); ?>">
                                            </div>

                                            <div class="alert alert-success py-2">
                                                 - chơi tối đa <?= format_currency($tkuma->site('maxgame')); ?> <br>
                                            </div>
                                            <button type="submit" name="btnSaveOption" class="btn me-2 btn-primary">Lưu</button>
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
                                    <span class="flex-grow-1">Danh Sách Bank</span>
                                    <a href="#staticBackdrop" data-bs-toggle="modal" class="btn btn-outline-theme d-block">Thêm Ngân Hàng</a>
                                </div>

                                <div class="table-responsive">
                                    <table id="datatableDefault" class="table text-nowrap w-100">
                                        <thead>
                                            <tr role="row">
                                                <th>Số Điện Thoại</th>
                                                <th>STK</th>
                                                <th>NAME</th>
                                                <th>Số Dư</th>
                                                <th>Trạng Thái</th>
                                                <th>Loại Bank</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $list_mm = $tkuma->get_list(" SELECT * FROM `account_bidv` ");
                                            if ($list_mm) {
                                                foreach ($list_mm as $row) {
                                            ?>
                                                    <tr class="odd">
                                                        <td><?= $row['username']; ?></td>
                                                        <td><?= $row['account_number']; ?></td>
                                                        <td><?= getRowRealtime2('phone', 'phone',$row['account_number'], 'ctk'); ?></td>
                                                        <td><?= format_currency(balancebidv($row['id'])['SoDu']); ?></td>
                                                        <td><?= $row['status']; ?></td>
                                                        <td>BIDV</td>
                                                        <td>
                                                            <a href="#" class="text-white" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end" data-bs-theme="light">
                                                                <?php if( $row['status'] == 'success' ) { ?>
                                                                <a class="dropdown-item battatbank" data-status="off" data-id="<?= $row['id']; ?>" data-bank="bidv" >Tắt</a>
                                                                <?php } else { ?>
                                                                <a class="dropdown-item battatbank" data-status="success" data-id="<?= $row['id']; ?>" data-bank="bidv" >Bật</a>
                                                                <?php } ?>
                                                                <a class="dropdown-item btnEdit" data-id="<?= $row['id']; ?>" data-bank="bidv" data-name="<?= getRowRealtime2('phone', 'phone',$row['account_number'], 'ctk'); ?>" >Edit</a>
                                                                <a class="dropdown-item removebank" data-id="<?= $row['id']; ?>" data-bank="bidv" >Delete</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr class="odd">
                                                    <td valign="top" colspan="9" class="dataTables_empty">No data available in table</td>
                                                </tr>
                                            <?php } ?>
                                            <?php
                                            $list_mm = $tkuma->get_list(" SELECT * FROM `account_vcb` ");
                                            if ($list_mm) {
                                                foreach ($list_mm as $row) {
                                            ?>
                                                    <tr class="odd">
                                                        <td><?= $row['username']; ?></td>
                                                        <td><?= $row['account_number']; ?></td>
                                                        <td><?= getRowRealtime2('phone', 'phone',$row['account_number'], 'ctk'); ?></td>
                                                        <td><?= format_currency(balance($row['token'])['SoDu']); ?></td>
                                                        <td><ul><li>
                                                            Trạng Thái Chuyển: <?= $row['status']; ?>
                                                        </li>
                                                        <li>Trạng Thái Nhận: <?= getRowRealtime2('phone', 'phone',$row['account_number'], 'status'); ?> </li></ul></td>
                                                        <td>VCB</td>
                                                        <td>
                                                            
                                                            <a href="#" class="text-white" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end" data-bs-theme="light">
                                                                <?php if(getRowRealtime2('phone','phone', $row['account_number'], 'status') == 'success' ) { ?>
                                                                <a class="dropdown-item" onclick="Tatsonhanvcb('<?= $row['account_number']; ?>')">Tắt Nhận tiền</a>
                                                                <?php } else { ?>
                                                                <a class="dropdown-item" onclick="Batsonhanvcb('<?= $row['account_number']; ?>')">Bật Nhận tiền</a>
                                                                <?php } ?>
                                                                <?php if( $row['status'] == 'success' ) { ?>
                                                                <a class="dropdown-item battatbank" data-status="off" data-id="<?= $row['id']; ?>" data-bank="vcb" >Tắt</a>
                                                                <?php } else { ?>
                                                                <a class="dropdown-item battatbank" data-status="success" data-id="<?= $row['id']; ?>" data-bank="vcb" >Bật</a>
                                                                <?php } ?>
                                                                <a class="dropdown-item btnEdit" data-id="<?= $row['id']; ?>" data-bank="vcb" data-name="<?= getRowRealtime2('phone', 'phone',$row['account_number'], 'ctk'); ?>" >Edit</a>
                                                                <a class="dropdown-item removebank" data-id="<?= $row['id']; ?>" data-bank="vcb" > Delete</a>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                                                <tr class="odd">
                                                    <td valign="top" colspan="9" class="dataTables_empty">No data available in table</td>
                                                </tr>
                                            <?php } ?>
                                            
                                            <?php
                                            $list_mm2 = $tkuma->get_list(" SELECT * FROM `account_mbbank` ");

                                            if ($list_mm2) {
                                                foreach ($list_mm2 as $row2) {
                                            ?>
                                                    <tr class="odd">
                                                        <td><?= $row2['phone']; ?></td>
                                                        <td><?= $row2['stk']; ?></td>
                                                        <td><?= getRowRealtime2('phone', 'phone',$row2['stk'], 'ctk'); ?></td>
                                                        <td><?= format_currency(balancemb($row2['token'])['SoDu']); ?></td>
                                                        <td><?= $row2['status']; ?></td>
                                                        <td>MBBank</td>
                                                        <td>
                                                            <a href="#" class="text-white" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end" data-bs-theme="light">
                                                                <?php if( $row2['status'] == 'success' ) { ?>
                                                                <a class="dropdown-item battatbank" data-status="off" data-id="<?= $row2['id']; ?>" data-bank="mbbank" >Tắt</a>
                                                                <?php } else { ?>
                                                                <a class="dropdown-item battatbank" data-status="success" data-id="<?= $row2['id']; ?>" data-bank="mbbank" >Bật</a>
                                                                <?php } ?>

                                                                <a class="dropdown-item btnEdit" data-id="<?= $row2['id']; ?>" data-bank="mbbank" data-name="<?= getRowRealtime2('phone', 'phone',$row2['stk'], 'ctk'); ?>" >Edit</a>
                                                                <a class="dropdown-item removebank" data-id="<?= $row2['id']; ?>" data-bank="mbbank" >Delete</a>
                                                            </div>


                                                        </td>
                                                    </tr>
                                                <?php }
                                            } else { ?>
                         
                                                <tr class="odd">
                                                    <td valign="top" colspan="9" class="dataTables_empty">No data available in table</td>
                                                </tr>
                                            <?php } ?>
                                            
                                            <?php
                                            $list_mm2 = $tkuma->get_list(" SELECT * FROM `account_mbbank2` ");

                                            if ($list_mm2) {
                                                foreach ($list_mm2 as $row2) {
                                            ?>
                                                    <tr class="odd">
                                                        <td><?= $row2['phone']; ?></td>
                                                        <td><?= $row2['stk']; ?></td>
                                                        <td><?= getRowRealtime2('phone', 'phone',$row2['stk'], 'ctk'); ?></td>
                                                        <td><?= format_currency(balancemb($row2['token'])['SoDu']); ?></td>
                                                        <td><?= $row2['status']; ?></td>
                                                        <td>MBBank</td>
                                                        <td>
                                                            <a href="#" class="text-white" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end" data-bs-theme="light">
                                                                <?php if( $row2['status'] == 'success' ) { ?>
                                                                <a class="dropdown-item battatbank" data-status="off" data-id="<?= $row2['id']; ?>" data-bank="mbbank2" >Tắt</a>
                                                                <?php } else { ?>
                                                                <a class="dropdown-item battatbank" data-status="success" data-id="<?= $row2['id']; ?>" data-bank="mbbank2" >Bật</a>
                                                                <?php } ?>

                                                                <a class="dropdown-item btnEdit" data-id="<?= $row2['id']; ?>" data-bank="mbbank2" data-name="<?= getRowRealtime2('phone', 'phone',$row2['stk'], 'ctk'); ?>" >Edit</a>
                                                                <a class="dropdown-item removebank" data-id="<?= $row2['id']; ?>" data-bank="mbbank2" >Delete</a>
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
        $("#_name").val(btn.attr("data-name"));
        $("#_bank").val(btn.attr("data-bank"));
        $("#editstaticBackdrop").modal('show');
        return false;
    });
</script>
<div class="modal fade" id="editstaticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">EDIT BANK </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-line">
                            <input type="hidden" id="_id" name="_id" class="form-control" required>
                            <input type="hidden" id="_bank" name="_bank" class="form-control" required>
                            <label class="form-label" for="_name">Chỉnh sửa name</label>
                            <input type="text" id="_name" name="_name" placeholder="Mã game (Nọi dung khi khách chuyển)" class="form-control" required>
                            
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
	$(".removebank").on("click", function() {
	    var btn = $(this);
		$('.removebank').html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled',
			true);
		$.ajax({
			url: "<?= base_url('ajaxs/admin/action.php'); ?>",
			method: "POST",
			dataType: "JSON",
			data: {
				action: 'removebank',
				id: btn.attr("data-id"),
				bank: btn.attr("data-bank")
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
				$('.removebank').prop('disabled', false);
			},
			error: function() {
				$('.removebank').prop('disabled', false);
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
	$(".battatbank").on("click", function() {
	    var btn = $(this);
		$('.battatbank').html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled',
			true);
		$.ajax({
			url: "<?= base_url('ajaxs/admin/action.php'); ?>",
			method: "POST",
			dataType: "JSON",
			data: {
				action: 'battatbank',
				id: btn.attr("data-id"),
				bank: btn.attr("data-bank"),
				status: btn.attr("data-status")
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
				$('.battatbank').prop('disabled', false);
			},
			error: function() {
				$('.battatbank').prop('disabled', false);
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
	$("#btnSave").on("click", function() {
		$('#btnSave').html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled',
			true);
		$.ajax({
			url: "<?= base_url('ajaxs/admin/action.php'); ?>",
			method: "POST",
			dataType: "JSON",
			data: {
				action: 'editbank',
				id: $("#_id").val(),
				name: $("#_name").val(),
				bank: $("#_bank").val()
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
				$('#btnSave').prop('disabled', false);
			},
			error: function() {
				$('#btnSave').prop('disabled', false);
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
    function Tatsonhanvcb(sdt) {
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
                        action: 'tatsonhanvcb'
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
    function Batsonhanvcb(sdt) {
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
                        action: 'batsonhanvcb'
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


<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">THÊM NGÂN HÀNG</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="banker">Chọn Bank</label>
                        <select class="form-select" id="banker" name="banker" data-gtm-form-interact-field-id="0" onchange="handleBankChange()">
                            <option value="">--Chọn Bank--</option>
                            <option value="BIDV"> BIDV</option>
                            <option value="VCB"> VIETCOMBANK</option>
                            <option value="MBBANK"> MBBank</option>
                            <option value="MBBANK2"> MBBank Doanh Ngiệp</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="form-group mb-0 small" style="display:none" id="vcbchuyenotp">
                            <div class="collapse show" id="dddddddddd">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="loginotpvcb" id="loginotpvcb" >
                                    <label class="form-check-label" for="handleimgddd">Login VCB lần đầu tại hệ thống</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="display:none" id="corpid1">
                        <div class="mb-3">
                            <div class="form-line">
                                <label class="form-label" for="corpid">Mã công ty</label>
                                <input type="text" id="corpid" name="corpid" placeholder="Nhập Mã công ty" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="sdt">Số Điện Thoại</label>
                            <input type="text" id="sdt" name="sdt" placeholder="Nhập Số Điện Thoại đăng nhập" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="pass">Mật Khẩu Ví</label>
                            <input type="text" id="pass" name="pass" placeholder="Mật Khẩu Ví" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="stkb">SỐ TÀI KHOẢN</label>
                            <input type="text" id="accountNumber" name="accountNumber" placeholder="Nhập số tài khoản" class="form-control" required>
                        </div>
                    </div>
                    <div class="row" style="display:none" id="otp1">
                        <div class="mb-3">
                            <div class="form-line">
                                <label class="form-label" for="stkb">OTP</label>
                                <input type="text" id="token" name="token" placeholder="Nhập số tài khoản" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-line">
                                <button type="submit" id="GetOTP" class="btn btn-danger">Lấy Mã OTP</button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-group mb-0 small" style="display:none" id="vcbchuyen">
                            <div class="collapse show" id="todoBoardchangiad">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="handleimgd" id="handleimgd">
                                    <label class="form-check-label" for="handleimgd">Thêm số này làm số chuyển</label>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnAdd" class="btn btn-danger" >Lưu ngay</button>
                    <button type="submit" id="btnAddvcb" class="btn btn-danger" style="display:none">Lưu ngay</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $('#dddddddddd').click(function(){
            // Kiểm tra xem checkbox có được chọn hay không
            if ($('#loginotpvcb').is(':checked')) {
                // Nếu được chọn, ẩn nút "Lưu ngay" và hiển thị nút "Lưu ngay (VCB)"
                
                $('#btnAdd').show();
                $('#otp1').show();
                $('#btnAddvcb').hide();
            } else {
                // Nếu không được chọn, hiển thị nút "Lưu ngay" và ẩn nút "Lưu ngay (VCB)"
                $('#btnAdd').hide();
                $('#otp1').hide();
                $('#btnAddvcb').show();
            }
        });
    function handleBankChange() {
        var selectElement = document.getElementById("banker");
        var selectedValue = selectElement.value;
        if (selectedValue === "VCB") {
            document.getElementById("otp1").style.display = 'none';
            document.getElementById("vcbchuyen").style.display = 'block';
            document.getElementById("vcbchuyenotp").style.display = 'block';
            $('#btnAdd').hide();
            $('#btnAddvcb').show();
             $('#corpid1').hide();
        } else if (selectedValue === "MBBANK" ) {
             $('#corpid1').hide();
            document.getElementById("otp1").style.display = 'none';
            document.getElementById("vcbchuyen").style.display = 'none';
            document.getElementById("vcbchuyenotp").style.display = 'none';
        }else if ( selectedValue === "MBBANK2") {
            $('#corpid1').show();
            document.getElementById("otp1").style.display = 'none';
            document.getElementById("vcbchuyen").style.display = 'none';
            document.getElementById("vcbchuyenotp").style.display = 'none';
        } else {
            $('#corpid1').hide();
            document.getElementById("otp1").style.display = 'block';
            document.getElementById("vcbchuyen").style.display = 'none';
            document.getElementById("vcbchuyenotp").style.display = 'none';
        }
    }
</script>
<script type="text/javascript">
    $("#GetOTP").on("click", function() {
        $('#GetOTP').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled',
            true);
        
        var actionValue = 'GETOTP' + $("#banker").val();
        $.ajax({
            url: "<?= BASE_URL('ajaxs/admin/action.php'); ?>",
            method: "POST",
            dataType: "JSON",
            data: {
                action: actionValue,
                sdt: $("#sdt").val(),
                pass: $("#pass").val(),
                accountNumber: $("#accountNumber").val()
            },
            success: function(respone) {
                if (respone.status == 'success') {
                    Swal.fire({
                        title: 'Thành công !',
                        text: respone.msg,
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                } else {
                    cuteToast({
                        type: "error",
                        message: respone.msg,
                        timer: 5000
                    });
                }
                $('#GetOTP').html('Lấy Mã OTP').prop('disabled', false);
            },
            error: function() {
                cuteToast({
                    type: "error",
                    message: 'Không thể xử lý',
                    timer: 5000
                });
                $('#GetOTP').html('Lấy Mã OTP').prop('disabled', false);
            }

        });
    });
    $("#btnAdd").on("click", function() {
        $('#btnAdd').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled',
            true);
        var checkbox = document.getElementById("handleimgd");
        var value = checkbox.checked ? 1 : 0;
        var actionValue2 = 'them_sdt' + $("#banker").val();
        $.ajax({
            url: "<?= BASE_URL('ajaxs/admin/action.php'); ?>",
            method: "POST",
            dataType: "JSON",
            data: {
                action: actionValue2,
                sdt: $("#sdt").val(),
                pass: $("#pass").val(),
                token: $("#token").val(),
                corpid: $("#corpid").val(),
                accountNumber: $("#accountNumber").val(),
                sochuyen: value
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
                            location.href = '<?= BASE_URL('admin/settingsbank'); ?>';
                        }
                    });
                    location.href = '<?= BASE_URL('admin/settingsbank'); ?>';
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
    $("#btnAddvcb").on("click", function() {
        $('#btnAddvcb').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...').prop('disabled',
            true);
        var checkbox = document.getElementById("handleimgd");
        var value = checkbox.checked ? 1 : 0;
        var actionValue2 = 'them_sdtv2' + $("#banker").val();
        $.ajax({
            url: "<?= BASE_URL('ajaxs/admin/action.php'); ?>",
            method: "POST",
            dataType: "JSON",
            data: {
                action: actionValue2,
                sdt: $("#sdt").val(),
                pass: $("#pass").val(),
                accountNumber: $("#accountNumber").val(),
                sochuyen: value
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
                            location.href = '<?= BASE_URL('admin/settingsbank'); ?>';
                        }
                    });
                    location.href = '<?= BASE_URL('admin/settingsbank'); ?>';
                } else {
                    cuteToast({
                        type: "error",
                        message: respone.msg,
                        timer: 5000
                    });
                }
                $('#btnAddvcb').html('Thêm').prop('disabled', false);
            },
            error: function() {
                cuteToast({
                    type: "error",
                    message: 'Không thể xử lý',
                    timer: 5000
                });
                $('#btnAddvcb').html('Thêm').prop('disabled', false);
            }

        });
    });
</script>

<?php
require_once(__DIR__ . '/layout/nav.php');
require_once(__DIR__ . '/layout/footer.php');
?>