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
<?php
if (isset($_POST['SaveSettings']) && is_admin()) {
    if ($tkuma->site('status_demo') != 0) {
        msg_error("Không được dùng chức năng này vì đây là trang web demo.", BASE_URL(''), 1000);
    }
    foreach ($_POST as $key => $value) {
        $tkuma->update("settings", array(
            'value' => base64_encode($value)
        ), " `name` = ? ",[$key]);
    }
    msg_success("Lưu thành công", '', 1000);
} ?>
<!-- /.content-header -->

<button class="app-sidebar-mobile-backdrop" data-toggle-target=".app" data-toggle-class="app-sidebar-mobile-toggled"></button>


<div id="content" class="app-content">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="row">
                    
                    <div class="col-xl-5">


                       

                        <div id="bootstrapDatepicker" class="mb-5">
                            <div class="card">
                                <div class="card-body pb-2">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Thông Báo GIFT<span class="text-danger">*</span></label>
                                                    <textarea name="noti_gift" class="summernote" id="noti_gift" title="Contents"><?= base64_decode($tkuma->site('noti_gift')) ; ?></textarea>
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
                    <div class="col-lg-7">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex fw-bold small mb-3">
                                    <span class="flex-grow-1">Danh Sách Giftcode</span>
                                    <a href="#staticBackdrop" data-bs-toggle="modal" class="btn btn-outline-theme d-block">Thêm Giftcode</a>
                                    <button id="deleteSelected" class="btn btn-danger">Delete Selected</button>
                                <button id="copySelected" class="btn btn-primary">Copy Selected Giftcodes</button>
                                </div>

                                <div class="table-responsive">
                                    <table id="datatableDefault" class="table text-nowrap w-100">
                                        <thead>
                                            <tr role="row">
                                                <th><input type="checkbox" id="selectAll"></th>
                                                <th>Thông Tin</th>
                                                <th>Số Tiền</th>
                                                <th>Min Chơi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $check_code = $tkuma->get_list(" SELECT * FROM `giftcode` ");
                                            foreach ($check_code as $row_code) {
                                            ?>
                                                <tr class="odd">
                                                    <td><input type="checkbox" class="selectRow" value="<?= $row_code['id']; ?>"></td>
                                                    <td><ul>
                                                        <li>Tên Giftcode: <?= $row_code['giftcode']; ?></li>
                                                        <li>Ngày Tạo: <?= $row_code['time']; ?></li>
                                                    </ul></td>
                                                    <td><?= format_currency($row_code['money']); ?></td>
                                                    <td><ul>
                                                        <li>Min chơi có thể nhận:  <?= format_currency($row_code['min']); ?></li>
                                                        <li>Giới Hạn: <?= $row_code['gioi_han']; ?> lần</li>
                                                        <li>Đã Nhập: <?= $row_code['da_nhap']; ?> lần</li>
                                                    </ul></td>
                                                    <td>
                                                        <button style="color:white;" onclick="RemoveRowd('<?= $row_code['id']; ?>')" class="btn btn-danger btn-sm btn-icon-left m-b-10" type="button">
                                                            <i class="fas fa-trash mr-1"></i><span class="">Delete</span>
                                                        </button>
                                                        <button style="color:white;" onclick="copyGiftcode('<?= $row_code['giftcode']; ?>')" class="btn btn-primary btn-sm btn-icon-left m-b-10" type="button">
                                                            <i class="fas fa-copy mr-1"></i><span class="">Copy</span>
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
                    
                    <div class="col-lg-12">

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex fw-bold small mb-3">
                                    <span class="flex-grow-1">Danh Sách Sử dụng Giftcode</span>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatableDefault2" class="table text-nowrap w-100">
                                        <thead>
                                            <tr role="row">
                                                <th>Tên Giftcode</th>
                                                <th>Số Tiền</th>
                                                <th>NICKNAME</th>
                                                <th>Phone nhận</th>
                                                <th>Thời gian</th>
                                                <th>MSG SEND</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $check_code = $tkuma->get_list(" SELECT * FROM `lich_su_choi` WHERE `type_gd` = ? ",['giftcode']);
                                            foreach ($check_code as $row_coded) {
                                            ?>
                                                <tr class="odd">
                                                    <td><?= $row_coded['comment']; ?></td>
                                                    <td><?= format_currency($row_coded['amount_game']); ?></td>
                                                    <td><?= $row_coded['partnerName']; ?></td>
                                                    <td><?= $row_coded['phone']; ?></td>
                                                    <td><?= $row_coded['time']; ?></td>
                                                    <td><?= $row_coded['msg_send']; ?></td>
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

<div class="modal fade" id="staticBackdrop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Thêm Giftcode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <!--<div class="mb-3">-->
                    <!--    <label class="form-label" for="banker">Chọn Bank</label>-->
                    <!--    <select class="form-select" id="banker" name="banker" data-gtm-form-interact-field-id="0" onchange="handleBankChange()">-->
                    <!--        <option value="BIDV"> BIDV</option>-->
                    <!--        <option value="VCB"> VIETCOMBANK</option>-->
                    <!--        <option value="MBBANK"> MBBank</option>-->
                    <!--    </select>-->
                    <!--</div>-->
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="giftcode">Tên Giftcode</label>
                            <input type="text" id="giftcode" name="giftcode" placeholder="Mã code cần thêm...." class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="money">Số Tiền</label>
                            <input type="text" id="money" name="money" placeholder="Số Tiền" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="limit">Giới Hạn Số Có Thể Nhập Giftcode *</label>
                            <input type="text" id="limit" name="limit" placeholder="Giới Hạn Số Có Thể Nhập Giftcode *" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="min">Giới Hạn Số Tiền Chơi Có Thể Nhập Giftcode </label>
                            <input type="text" id="min" name="min" placeholder="Giới Hạn Số Tiền Chơi Có Thể Nhập Giftcode " class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="giftcount">Số lượng Giftcode</label>
                            <input type="text" id="giftcount" name="giftcount" placeholder="Để thêm nhiều Giftcode, hãy nhập số lượng muốn tạo..." class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnAdd" class="btn btn-danger">Lưu ngay</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('noti_gift');
</script>

<script type="text/javascript">
    function RemoveRowd(id) {
        cuteAlert({
            type: "question",
            title: "Xác Nhận Xóa",
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
                        action: 'xoa-giftcode'
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
                action: 'giftcode',
                giftcode: $("#giftcode").val(),
                min: $("#min").val(),
                money: $("#money").val(),
                limit: $("#limit").val(),
                giftcount: $("#giftcount").val()
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
                            location.href = '<?= BASE_URL('admin/giftcode'); ?>';
                        }
                    });
                    location.href = '<?= BASE_URL('admin/giftcode'); ?>';
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

<script>
    document.getElementById('selectAll').addEventListener('click', function() {
        let checkboxes = document.querySelectorAll('.selectRow');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = this.checked;
        });
    });

    document.getElementById('deleteSelected').addEventListener('click', function() {
        let selected = [];
        let checkboxes = document.querySelectorAll('.selectRow:checked');
        checkboxes.forEach((checkbox) => {
            selected.push(checkbox.value);
        });
        if (selected.length > 0) {
            // Call your delete function here with selected IDs
            cuteAlert({
            type: "question",
            title: "Xác Nhận Xóa",
            message: "Bạn có chắc chắn xác nhận xóa " + selected.length + " GiftCode không ?",
            confirmText: "Đồng Ý",
            cancelText: "Hủy"
            }).then((e) => {
                if (e) {
                    $.ajax({
                url: "<?= BASE_URL('ajaxs/admin/action.php'); ?>",
                method: "POST",
                dataType: "JSON",
                data: {
                    ids: selected.join(','),
                    action: 'deletemultiple-giftcode'
                },
                success: function(response) {
                    if (response.status == 'success') {
                        cuteToast({
                            type: "success",
                            message: response.msg.join('<br>'),
                            timer: 5000
                        });
                        location.reload();
                    } else {
                        cuteAlert({
                            type: "error",
                            title: "Error",
                            message: response.msg.join('<br>'),
                            buttonText: "Okay"
                        });
                    }
                },
                error: function() {
                    cuteAlert({
                        type: "error",
                        title: "Error",
                        message: "Có lỗi xảy ra khi xóa giftcode",
                        buttonText: "Okay"
                    });
                    location.reload();
                }
            });
                }
            })
        } else {
            cuteToast({
                    type: "error",
                    message: 'Không có GiftCode nào được chọn',
                    timer: 5000
                });
        }
    });

    document.getElementById('copySelected').addEventListener('click', function() {
        let selectedGiftcodes = [];
        let checkboxes = document.querySelectorAll('.selectRow:checked');
        checkboxes.forEach((checkbox) => {
            let giftcode = checkbox.closest('tr').querySelector('li').textContent.split(': ')[1];
            selectedGiftcodes.push(giftcode);
        });
        if (selectedGiftcodes.length > 0) {
            let giftcodesText = selectedGiftcodes.join('\n');
            navigator.clipboard.writeText(giftcodesText).then(() => {
                cuteToast({
                    type: "success",
                    message: 'Đã coppy ' + selectedGiftcodes.length + ' GiftCode',
                    timer: 5000
                });
            }).catch(err => {
                cuteToast({
                    type: "error",
                    message: err,
                    timer: 5000
                });
            });
        } else {
            cuteToast({
                    type: "error",
                    message: 'Không có GiftCode nào được chọn',
                    timer: 5000
                });
        }
    });

    function copyGiftcode(giftcode) {
        navigator.clipboard.writeText(giftcode).then(() => {
            cuteToast({
                    type: "success",
                    message: 'Copied to clipboard',
                    timer: 5000
                });
        }).catch(err => {
            console.error('Could not copy text: ', err);
            cuteToast({
                    type: "error",
                    message: err,
                    timer: 5000
                });
        });
    }
</script>
<?php
require_once(__DIR__ . '/layout/nav.php');
require_once(__DIR__ . '/layout/footer.php');
?>