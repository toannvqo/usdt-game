<?php if (!defined('IN_SITE')) {
	die('The Request Not Found');
} ?>

<body>

    <div id="app" class="app">

        <div id="header" class="app-header">

            <div class="desktop-toggler">
                <button type="button" class="menu-toggler" data-toggle-class="app-sidebar-collapsed" data-dismiss-class="app-sidebar-toggled" data-toggle-target=".app">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </div>


            <div class="mobile-toggler">
                <button type="button" class="menu-toggler" data-toggle-class="app-sidebar-mobile-toggled" data-toggle-target=".app">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </div>


            <div class="brand">
                <a href="/" class="brand-logo">
                    <span class="brand-img">
                        <span class="brand-img-text text-theme">B</span>
                    </span>
                    <span class="brand-text">WIN32</span>
                </a>
            </div>


            <div class="menu">
                <!--<div class="menu-item dropdown">-->
                <!--    <a href="#" data-toggle-class="app-header-menu-search-toggled" data-toggle-target=".app" class="menu-link">-->
                <!--        <div class="menu-icon"><i class="bi bi-search nav-icon"></i></div>-->
                <!--    </a>-->
                <!--</div>-->
                <!--<div class="menu-item dropdown dropdown-mobile-full">-->
                <!--    <a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">-->
                <!--        <div class="menu-icon"><i class="bi bi-grid-3x3-gap nav-icon"></i></div>-->
                <!--    </a>-->
                <!--    <div class="dropdown-menu fade dropdown-menu-end w-300px text-center p-0 mt-1">-->
                <!--        <div class="row row-grid gx-0">-->
                <!--            <div class="col-4">-->
                <!--                <a href="/" class="dropdown-item text-decoration-none p-3 bg-none">-->
                <!--                    <div class="position-relative">-->
                <!--                        <i class="bi bi-circle-fill position-absolute text-theme top-0 mt-n2 me-n2 fs-6px d-block text-center w-100"></i>-->
                <!--                        <i class="bi bi-envelope h2 opacity-5 d-block my-1"></i>-->
                <!--                    </div>-->
                <!--                    <div class="fw-500 fs-10px text-inverse">INBOX</div>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="col-4">-->
                <!--                <a href="/" target="_blank" class="dropdown-item text-decoration-none p-3 bg-none">-->
                <!--                    <div><i class="bi bi-hdd-network h2 opacity-5 d-block my-1"></i></div>-->
                <!--                    <div class="fw-500 fs-10px text-inverse">POS SYSTEM</div>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="col-4">-->
                <!--                <a href="/" class="dropdown-item text-decoration-none p-3 bg-none">-->
                <!--                    <div><i class="bi bi-calendar4 h2 opacity-5 d-block my-1"></i></div>-->
                <!--                    <div class="fw-500 fs-10px text-inverse">CALENDAR</div>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--        <div class="row row-grid gx-0">-->
                <!--            <div class="col-4">-->
                <!--                <a href="/" class="dropdown-item text-decoration-none p-3 bg-none">-->
                <!--                    <div><i class="bi bi-terminal h2 opacity-5 d-block my-1"></i></div>-->
                <!--                    <div class="fw-500 fs-10px text-inverse">HELPER</div>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="col-4">-->
                <!--                <a href="/" class="dropdown-item text-decoration-none p-3 bg-none">-->
                <!--                    <div class="position-relative">-->
                <!--                        <i class="bi bi-circle-fill position-absolute text-theme top-0 mt-n2 me-n2 fs-6px d-block text-center w-100"></i>-->
                <!--                        <i class="bi bi-sliders h2 opacity-5 d-block my-1"></i>-->
                <!--                    </div>-->
                <!--                    <div class="fw-500 fs-10px text-inverse">SETTINGS</div>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--            <div class="col-4">-->
                <!--                <a href="/" class="dropdown-item text-decoration-none p-3 bg-none">-->
                <!--                    <div><i class="bi bi-collection-play h2 opacity-5 d-block my-1"></i></div>-->
                <!--                    <div class="fw-500 fs-10px text-inverse">WIDGETS</div>-->
                <!--                </a>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="menu-item dropdown dropdown-mobile-full">-->
                <!--    <a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">-->
                <!--        <div class="menu-icon"><i class="bi bi-bell nav-icon"></i></div>-->
                <!--        <div class="menu-badge bg-theme"></div>-->
                <!--    </a>-->
                <!--    <div class="dropdown-menu dropdown-menu-end mt-1 w-300px fs-11px pt-1">-->
                <!--        <h6 class="dropdown-header fs-10px mb-1">NOTIFICATIONS</h6>-->
                <!--        <div class="dropdown-divider mt-1"></div>-->
                <!--        <a href="#" class="d-flex align-items-center py-10px dropdown-item text-wrap fw-semibold">-->
                <!--            <div class="fs-20px">-->
                <!--                <i class="bi bi-bag text-theme"></i>-->
                <!--            </div>-->
                <!--            <div class="flex-1 flex-wrap ps-3">-->
                <!--                <div class="mb-1 text-inverse">NEW ORDER RECEIVED ($1,299)</div>-->
                <!--                <div class="small text-inverse text-opacity-50">JUST NOW</div>-->
                <!--            </div>-->
                <!--            <div class="ps-2 fs-16px">-->
                <!--                <i class="bi bi-chevron-right"></i>-->
                <!--            </div>-->
                <!--        </a>-->
                <!--        <a href="#" class="d-flex align-items-center py-10px dropdown-item text-wrap fw-semibold">-->
                <!--            <div class="fs-20px w-20px">-->
                <!--                <i class="bi bi-person-circle text-theme"></i>-->
                <!--            </div>-->
                <!--            <div class="flex-1 flex-wrap ps-3">-->
                <!--                <div class="mb-1 text-inverse">3 NEW ACCOUNT CREATED</div>-->
                <!--                <div class="small text-inverse text-opacity-50">2 MINUTES AGO</div>-->
                <!--            </div>-->
                <!--            <div class="ps-2 fs-16px">-->
                <!--                <i class="bi bi-chevron-right"></i>-->
                <!--            </div>-->
                <!--        </a>-->
                <!--        <a href="#" class="d-flex align-items-center py-10px dropdown-item text-wrap fw-semibold">-->
                <!--            <div class="fs-20px w-20px">-->
                <!--                <i class="bi bi-gear text-theme"></i>-->
                <!--            </div>-->
                <!--            <div class="flex-1 flex-wrap ps-3">-->
                <!--                <div class="mb-1 text-inverse">SETUP COMPLETED</div>-->
                <!--                <div class="small text-inverse text-opacity-50">3 MINUTES AGO</div>-->
                <!--            </div>-->
                <!--            <div class="ps-2 fs-16px">-->
                <!--                <i class="bi bi-chevron-right"></i>-->
                <!--            </div>-->
                <!--        </a>-->
                <!--        <a href="#" class="d-flex align-items-center py-10px dropdown-item text-wrap fw-semibold">-->
                <!--            <div class="fs-20px w-20px">-->
                <!--                <i class="bi bi-grid text-theme"></i>-->
                <!--            </div>-->
                <!--            <div class="flex-1 flex-wrap ps-3">-->
                <!--                <div class="mb-1 text-inverse">WIDGET INSTALLATION DONE</div>-->
                <!--                <div class="small text-inverse text-opacity-50">5 MINUTES AGO</div>-->
                <!--            </div>-->
                <!--            <div class="ps-2 fs-16px">-->
                <!--                <i class="bi bi-chevron-right"></i>-->
                <!--            </div>-->
                <!--        </a>-->
                <!--        <a href="#" class="d-flex align-items-center py-10px dropdown-item text-wrap fw-semibold">-->
                <!--            <div class="fs-20px w-20px">-->
                <!--                <i class="bi bi-credit-card text-theme"></i>-->
                <!--            </div>-->
                <!--            <div class="flex-1 flex-wrap ps-3">-->
                <!--                <div class="mb-1 text-inverse">PAYMENT METHOD ENABLED</div>-->
                <!--                <div class="small text-inverse text-opacity-50">10 MINUTES AGO</div>-->
                <!--            </div>-->
                <!--            <div class="ps-2 fs-16px">-->
                <!--                <i class="bi bi-chevron-right"></i>-->
                <!--            </div>-->
                <!--        </a>-->
                <!--        <hr class="my-0">-->
                <!--        <div class="py-10px mb-n2 text-center">-->
                <!--            <a href="#" class="text-decoration-none fw-bold">SEE ALL</a>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="menu-item dropdown dropdown-mobile-full">
                    <a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link">
                        <div class="menu-img online">
                            <img src="<?= BASE_URL(''); ?>assets/img/avt.jpg" alt="Profile" height="60">
                        </div>
                        <div class="menu-text d-sm-block d-none w-170px"><span class="__cf_email__" data-cfemail="98edebfdeaf6f9f5fdd8f9fbfbf7edf6ecb6fbf7f5">ADMIN</span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end me-lg-3 fs-11px mt-1">
                        <!--<a class="dropdown-item d-flex align-items-center" href="/">PROFILE <i class="bi bi-person-circle ms-auto text-theme fs-16px my-n1"></i></a>-->
                        <!--<a class="dropdown-item d-flex align-items-center" href="/">INBOX <i class="bi bi-envelope ms-auto text-theme fs-16px my-n1"></i></a>-->
                        
                        <a class="dropdown-item d-flex align-items-center fixgetotp" >FIX Lỗi Get OTP<i class="bi bi-envelope ms-auto text-theme fs-16px my-n1"></i></a>
                        <div class="dropdown-divider"></div><!--<a class="dropdown-item d-flex align-items-center" href="/">CALENDAR <i class="bi bi-calendar ms-auto text-theme fs-16px my-n1"></i></a>-->
                        <a class="dropdown-item d-flex align-items-center" href="#doimatkhuane" data-bs-toggle="modal">ĐỔI MẬT KHẨU<i class="bi bi-gear ms-auto text-theme fs-16px my-n1"></i></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item d-flex align-items-center" href="views/admin/layout/out_log.php">ĐĂNG XUẤT<i class="bi bi-toggle-off ms-auto text-theme fs-16px my-n1"></i></a>
                    </div>
                </div>
            </div>


            <form class="menu-search" method="POST" name="header_search_form">
                <div class="menu-search-container">
                    <div class="menu-search-icon"><i class="bi bi-search"></i></div>
                    <div class="menu-search-input">
                        <input type="text" class="form-control form-control-lg" placeholder="Search menu...">
                    </div>
                    <div class="menu-search-icon">
                        <a href="#" data-toggle-class="app-header-menu-search-toggled" data-toggle-target=".app"><i class="bi bi-x-lg"></i></a>
                    </div>
                </div>
            </form>

        </div>
        
<div class="modal fade" id="doimatkhuane" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 900px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">DỔI MẬT KHẨU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="old_password">MẬT KHẨU CỦ</label>
                            <input type="text" id="old_password" name="old_password" placeholder="Nhập lại mật khẩu của bạn" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="new_password">Mật Khẩu mới</label>
                            <input type="text" id="new_password" name="new_password" placeholder="Mật Khẩu Ví" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-line">
                            <label class="form-label" for="renew_password">NHẬP LẠI MẬT KHẨU MỚI</label>
                            <input type="text" id="renew_password" name="renew_password" placeholder="Nhập lại mật khẩu mới" class="form-control" required>
                        </div>
                    </div>
                  
                </div>
                <div class="modal-footer">
                    <button type="submit" id="doimatkhau" class="btn btn-danger">Lưu ngay</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
	$("#doimatkhau").on("click", function() {
		$('#doimatkhau').html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled',
			true);
		$.ajax({
			url: "<?= base_url('ajaxs/admin/action.php'); ?>",
			method: "POST",
			dataType: "JSON",
			data: {
				action: 'doi-mat-khau',
				old_password: $("#old_password").val(),
				new_password: $("#new_password").val(),
				renew_password: $("#renew_password").val()
			},
			success: function(respone) {
				if (respone.status == 'success') {
					cuteToast({
						type: "success",
						message: respone.msg,
						timer: 5000
					});
					setTimeout("location.href = '<?= BASE_URL('admin/'); ?>';", 100);
				} else if (respone.status == 'verify') {
                cuteToast({
                    type: "warning",
                    message: respone.msg,
                    timer: 5000
                });
                setTimeout("location.href = '" + respone.url + "';", 1000);
                } else {
					cuteToast({
						type: "error",
						message: respone.msg,
						timer: 5000
					});
				}
				$('#doimatkhau').html('Login').prop('disabled', false);
			},
			error: function() {
				$('#btnLogin').html('Login').prop('disabled', false);
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
	$(".fixgetotp").on("click", function() {
		$('.fixgetotp').html('<i class="fa fa-spinner fa-spin"></i> Loading...').prop('disabled',
			true);
		$.ajax({
			url: "<?= base_url('ajaxs/admin/action.php'); ?>",
			method: "POST",
			dataType: "JSON",
			data: {
				action: 'fixgetotp'
			},
			success: function(respone) {
				if (respone.status == 'success') {
					cuteToast({
						type: "success",
						message: respone.msg,
						timer: 5000
					});
					setTimeout("location.href = '<?= BASE_URL('admin/'); ?>';", 100);
				} else {
					cuteToast({
						type: "error",
						message: respone.msg,
						timer: 5000
					});
				}
				$('.fixgetotp').html('FIX Lỗi Get OTP').prop('disabled', false);
			},
			error: function() {
				$('.fixgetotp').html('FIX Lỗi Get OTP').prop('disabled', false);
				cuteToast({
					type: "error",
					message: 'Không thể xử lý',
					timer: 5000
				});
			}

		});
	});
</script>