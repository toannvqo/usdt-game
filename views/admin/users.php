<?php
if (!defined('IN_SITE')) {
    die('The Request Not Found');
}

$body = [
    'title' => 'Settings',
    'desc' => 'tkuma Panel',
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

$time_day = date('Y/m/d') . " 00:00:00";
?>

<!-- Content Wrapper. Contains page content -->
<button class="app-sidebar-mobile-backdrop" data-toggle-target=".app" data-toggle-class="app-sidebar-mobile-toggled"></button>

<div id="content" class="app-content">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex fw-bold small mb-3">
                        <span class="flex-grow-1">Thành Viên</span>
                        <a href="#" data-toggle="card-expand" class="text-inverse text-opacity-50 text-decoration-none"><i class="bi bi-fullscreen"></i></a>
                    </div>

                    <div class="table-responsive">
                        <table id="datatableDefault" class="table text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th width="5px;"><input type="checkbox" name="check_all" id="check_all" value="option1"></th>
                                    <th>Tài khoản</th>
                                    <th>Full Thời Gian</th>
                                    <th>Full Hôm Nay</th>
                                    <th>Thời gian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($tkuma->get_list("SELECT * FROM `users` ORDER BY id DESC") as $row) { ?>
                                    <tr>
                                        <td><input type="checkbox" data-id="<?= $row['id']; ?>" name="checkbox" class="checkbox" value="<?= $row['id']; ?>" /></td>
                                        <td>
                                            <ul>
                                               <!--  comment <li>Tên đăng nhập: <b><?= $row['username']; ?></b> [<b><?= $row['id']; ?></b>]</li> -->
                                                <li>Bankname: <b><?= getRowRealtime('bankcode', $row['bankid'], 'bankname'); ?></b></li>
                                               <!--   comment <li>SốTK: <?= $row['stk']; ?></li> -->
                                                <li>CTK: <?= $row['acc_name']; ?></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>Tổng chơi Full: <b style="color:yellow"><?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND `sttbot` != ? AND `partnerName` = ?", ['real', 'SAI NỘI DUNG', 'Hoàn Tiền', '1', $row['username']])['SUM(`amount_play`)']); ?></b></li>
                                                <li>Tổng Thanh Toán Full: <b style="color:yellow"><?= format_currency($tkuma->get_row("SELECT SUM(`amount_game`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND `sttbot` != ? AND `partnerName` = ?", ['real', 'SAI NỘI DUNG', 'Hoàn Tiền', '1', $row['username']])['SUM(`amount_game`)']); ?></b></li>
                                                <li>Tổng Chơi Bú: <b style="color:yellow"><?= format_currency($tkuma->get_row("SELECT SUM(`amount_game`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND `sttbot` != ? AND `partnerName` = ?", ['real', 'SAI NỘI DUNG', 'Hoàn Tiền', '1', $row['username']])['SUM(`amount_game`)'] - $tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND `sttbot` != ? AND `partnerName` = ?", ['real', 'SAI NỘI DUNG', 'Hoàn Tiền', '1', $row['username']])['SUM(`amount_play`)']); ?></b></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>Tổng Chơi Hôm Nay: <b style="color:yellow"><?= format_currency($tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND `time` >= ? AND `sttbot` != ? AND `partnerName` = ?", ['real', 'SAI NỘI DUNG', 'Hoàn Tiền', $time_day, '1', $row['username']])['SUM(`amount_play`)']); ?></b></li>
                                                <li>Tổng Thanh Toán Hôm nay: <b><?= format_currency($tkuma->get_row("SELECT SUM(`amount_game`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND `time` >= ? AND `sttbot` != ? AND `partnerName` = ?", ['real', 'SAI NỘI DUNG', 'Hoàn Tiền', $time_day, '1', $row['username']])['SUM(`amount_game`)']); ?></b></li>
                                                <li>Tổng Bú: <b style="color:yellow"><?= format_currency($tkuma->get_row("SELECT SUM(`amount_game`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND `time` >= ? AND `sttbot` != ? AND `partnerName` = ?", ['real', 'SAI NỘI DUNG', 'Hoàn Tiền', $time_day, '1', $row['username']])['SUM(`amount_game`)'] - $tkuma->get_row("SELECT SUM(`amount_play`) FROM `lich_su_choi` WHERE `type_gd` = ? AND `result_text` != ? AND `result_text` != ? AND `time` >= ? AND `sttbot` != ? AND `partnerName` = ?", ['real', 'SAI NỘI DUNG', 'Hoàn Tiền', $time_day, '1', $row['username']])['SUM(`amount_play`)']); ?></b></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <li>IP: <b><?= $row['ip']; ?></b></li>
                                                <li>Ngày tham gia: <b><?= $row['create_date']; ?></b></li>
                                                <li>Hoạt động gần đây: <b><?= $row['update_date']; ?></b></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <button style="color:white;" class="btn btn-danger btn-sm btn-icon-left m-b-10 delete" data-id="<?= $row['id']; ?>" data-name="<?= $row['username']; ?>" type="button">
                                                <i class="fas fa-trash mr-1"></i><span class="">Delete</span>
                                            </button>
                                            <button style="color:white;" class="btn btn-primary btn-sm btn-icon-left m-b-10 edit" data-id="<?= $row['id']; ?>" data-username="<?= $row['username']; ?>" data-bankid="<?= $row['bankid']; ?>" data-stk="<?= $row['stk']; ?>" data-ctk="<?= $row['acc_name']; ?>" data-create_date="<?= $row['create_date']; ?>" data-update_date="<?= $row['update_date']; ?>" type="button">
                                                <i class="fas fa-edit mr-1"></i><span class="">Edit</span>
                                            </button>
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

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <input type="hidden" id="editUserId">
                    <div class="form-group">
                        <label for="editUsername">Username</label>
                        <input type="text" class="form-control" id="editUsername">
                    </div>
                    <div class="form-group">
                        <label for="editBankId">Bank ID</label>
                        <select class="form-control select2" id="editBankId">
                           <option value="1" <?= $row['bankid'] == 1 ? 'selected' : '' ?> style="color: black;">VIETTINBANK</option>
                            <option value="2" <?= $row['bankid'] == 2 ? 'selected' : '' ?> style="color: black;">VIETCOMBANK</option>
                            <option value="3" <?= $row['bankid'] == 3 ? 'selected' : '' ?> style="color: black;">AGRIBANK</option>
                            <option value="4" <?= $row['bankid'] == 4 ? 'selected' : '' ?> style="color: black;">TPBANK</option>
                            <option value="5" <?= $row['bankid'] == 5 ? 'selected' : '' ?> style="color: black;">HDB</option>
                            <option value="6" <?= $row['bankid'] == 6 ? 'selected' : '' ?> style="color: black;">VPBANK</option>
                            <option value="7" <?= $row['bankid'] == 7 ? 'selected' : '' ?> style="color: black;">MBBANK</option>
                            <option value="8" <?= $row['bankid'] == 8 ? 'selected' : '' ?> style="color: black;">OCEANBANK</option>
                            <option value="9" <?= $row['bankid'] == 9 ? 'selected' : '' ?> style="color: black;">BIDV</option>
                            <option value="10" <?= $row['bankid'] == 10 ? 'selected' : '' ?> style="color: black;">SACOMBANK</option>
                            <option value="11" <?= $row['bankid'] == 11 ? 'selected' : '' ?> style="color: black;">ACB</option>
                            <option value="12" <?= $row['bankid'] == 12 ? 'selected' : '' ?> style="color: black;">ABBANK</option>
                            <option value="13" <?= $row['bankid'] == 13 ? 'selected' : '' ?> style="color: black;">CIMB</option>
                            <option value="14" <?= $row['bankid'] == 14 ? 'selected' : '' ?> style="color: black;">EXIMBANK</option>
                            <option value="15" <?= $row['bankid'] == 15 ? 'selected' : '' ?> style="color: black;">SEABANK</option>
                            <option value="16" <?= $row['bankid'] == 16 ? 'selected' : '' ?> style="color: black;">SCB</option>
                            <option value="17" <?= $row['bankid'] == 17 ? 'selected' : '' ?> style="color: black;">DONGABANK</option>
                            <option value="18" <?= $row['bankid'] == 18 ? 'selected' : '' ?> style="color: black;">SAIGONBANK</option>
                            <option value="19" <?= $row['bankid'] == 19 ? 'selected' : '' ?> style="color: black;">PGBANK</option>
                            <option value="20" <?= $row['bankid'] == 20 ? 'selected' : '' ?> style="color: black;">PVCOMBANK</option>
                            <option value="21" <?= $row['bankid'] == 21 ? 'selected' : '' ?> style="color: black;">KIENLONGBANK</option>
                            <option value="22" <?= $row['bankid'] == 22 ? 'selected' : '' ?> style="color: black;">VIETCAPITALBANK</option>
                            <option value="23" <?= $row['bankid'] == 23 ? 'selected' : '' ?> style="color: black;">OCB</option>
                            <option value="24" <?= $row['bankid'] == 24 ? 'selected' : '' ?> style="color: black;">MSB</option>
                            <option value="25" <?= $row['bankid'] == 25 ? 'selected' : '' ?> style="color: black;">SHB</option>
                            <option value="26" <?= $row['bankid'] == 26 ? 'selected' : '' ?> style="color: black;">VIETBANK</option>
                            <option value="27" <?= $row['bankid'] == 27 ? 'selected' : '' ?> style="color: black;">VRB</option>
                            <option value="28" <?= $row['bankid'] == 28 ? 'selected' : '' ?> style="color: black;">NAMABANK</option>
                            <option value="29" <?= $row['bankid'] == 29 ? 'selected' : '' ?> style="color: black;">VIB</option>
                            <option value="30" <?= $row['bankid'] == 30 ? 'selected' : '' ?> style="color: black;">TECHCOMBANK</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editStk">STK</label>
                        <input type="text" class="form-control" id="editStk">
                    </div>
                    <div class="form-group">
                        <label for="ctk">Chủ tài khoản nhận thưởng</label>
                        <input type="text" class="form-control" id="editCtk">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveUserChanges">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(".delete").on("click", function() {
        cuteAlert({
            type: "question",
            title: "Xác Nhận Tài Khoản",
            message: "Bạn có chắc chắn xóa tài khoản (" + $(this).data('name') + ") không ?",
            confirmText: "Đồng Ý",
            cancelText: "Hủy"
        }).then((e) => {
            if (e) {
                $.ajax({
                    url: "<?= BASE_URL("ajaxs/admin/delete.php"); ?>",
                    method: "POST",
                    dataType: "JSON",
                    data: {
                        action: 'delete-user',
                        id: $(this).data('id')
                    },
                    success: function(respone) {
                        if (respone.status == 'success') {
                            cuteToast({
                                type: "success",
                                message: respone.msg,
                                timer: 3000
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
    });

    $(".edit").on("click", function() {
        $("#editUserId").val($(this).data('id'));
        $("#editUsername").val($(this).data('username'));
        $("#editBankId").val($(this).data('bankid'));
        $("#editStk").val($(this).data('stk'));
        $("#editCtk").val($(this).data('ctk'));
        $("#editUserModal").modal('show');
    });

    $("#saveUserChanges").on("click", function() {
        $.ajax({
            url: "<?= BASE_URL("ajaxs/admin/action.php"); ?>",
            method: "POST",
            dataType: "JSON",
            data: {
                action: 'edit-user',
                id: $("#editUserId").val(),
                bankid: $("#editBankId").val(),
                stk: $("#editStk").val(),
                ctk: $("#editCtk").val(),
                username: $("#editUsername").val()
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
			},
			error: function() {
				cuteToast({
					type: "error",
					message: 'Không thể xử lý',
					timer: 5000
				});
			}
        });
    });

    $(document).ready(function() {
        $('#datatableDefault').DataTable();
    });
</script>

<?php
require_once(__DIR__ . '/layout/nav.php');
require_once(__DIR__ . '/layout/footer.php');
?>
