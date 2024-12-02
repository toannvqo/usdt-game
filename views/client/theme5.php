<?php if (!defined('IN_SITE')) {
	die('The Request Not Found');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

	<link href="<?= $tkuma->site('anhbia'); ?>" rel="apple-touch-icon">
    <link href="<?= $tkuma->site('anhbia'); ?>" rel="shortcut icon" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="title" content="<?= $tkuma->site('title'); ?>">
    <meta name="description" content="<?= $tkuma->site('description'); ?>">
    <meta name="keywords" content="<?= $tkuma->site('keywords'); ?>,clzl,minigamezalo,Clzl,Chan le zalo,Tài Xỉu zalo,chanlezalo,Chẵn lẻ online,Chẵn Lẻ,zalo cl,Cách Chơi chẵn lẽ zalo,chẵn lẽ zalo tự động">
	<meta name="og:title" content="<?= $tkuma->site('title'); ?>">
	<meta property="og:description" content="<?= $tkuma->site('description'); ?>">
	<meta property="og:image" content="<?= $tkuma->site('anhbia'); ?>">
	<link rel="shortcut icon" href="<?= BASE_URL('public/theme5/'); ?>assets/images/logo.png" type="image/x-icon">
	<title>Game Chẳn Lẻ Bank - Uy Tín - Tự Động 24/7 </title>
	<!-- Google Web Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000&family=Roboto:wght@100&display=swap" rel="stylesheet">
	<!-- Icon Font Stylesheet -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
	<!-- Libraries Stylesheet -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/5.3.4/css/jquery.mmenu.all.min.css" rel="stylesheet">
	<link href="<?= BASE_URL('public/theme5/'); ?>css/animate.min.css" rel="stylesheet">
	<!-- Customized Bootstrap Stylesheet -->
	<link href="<?= BASE_URL('public/theme5/'); ?>css/bootstrap.min.css?v=<?= time(); ?>" rel="stylesheet">
	<!-- Template Stylesheet -->
	<link href="<?= BASE_URL('public/theme5/'); ?>css/style.css?v=2" rel="stylesheet">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" >
	
</head>

<body>
	<div id="page">
		<!-- Spinner -->
		<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
			<div class="spinner-grow text-primary" role="status"></div>
		</div>
		<!-- /Spinner -->
		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg fixed-top p-2">
			<div class="container">
				<a href="/" class="navbar-brand d-flex align-items-center">
					<h2 class="m-0 text-primary">
						<img class="img-fluid me-2 logo" src="<?= $tkuma->site('anhbia'); ?>" alt="" style="width: 230px;" />
					</h2>
				</a>
				<div class="collapse navbar-collapse" id="navbarCollapse">
					<div class="navbar-nav ms-auto py-4 py-lg-0">
						<a href="#gioi-thieu" class="nav-item nav-link active">GIỚI THIỆU</a>
						<a href="#trang-thai-momo" class="nav-item nav-link">DANH SÁCH BANK</a>
						<a href="#lich-su-tham-gia" class="nav-item nav-link">LỊCH SỬ THAM GIA</a>
						<a href="#top-thang-tuan" class="nav-item nav-link">ĐUA TOP NGÀY</a>
					</div>
				</div>
				<a href="#menuMobile" class="btn-menu-mobile">
					<img src="<?= BASE_URL('public/theme5/'); ?>img/arrows_hamburger.svg" />
				</a>
			</div>
		</nav>
		<!-- /Navbar -->
		<main class="main-content">
			<!-- Header -->
			<!-- Header -->
			<div class="container py-3">
				<div class="row">
					<div class="col-12 col-md-10 mx-auto">
						<div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s">
							<h1 class="text-uppercase heading-pink"><?= $tkuma->site('title'); ?></h1>
							<p class="text-gradient-cyan-coral typing-text mb-5">UY TÍN - XANH CHÍN - TỰ ĐỘNG 24/7</p>
							<div class="row-button-header">
								<button type="button" class="buttonEffect buttonEffect-glow py-3 px-3 m-1 animated slideInDown" onclick="location.href='<?= $tkuma->site('telegrambox'); ?>'">
									Tham Gia Chat
								</button>
								<button type="button" class="buttonEffect bg-success buttonEffect-glow border-success py-3 px-3 m-1 animated slideInDown" onclick="location.href='<?= $tkuma->site('telegram'); ?>'">
									Bạn Cần Hỗ Trợ?
								</button>
							</div>
							<button type="button" class="buttonEffect buttonEffect-glow py-3 px-3 m-1 animated slideInDown" data-bs-toggle="modal" data-bs-target="#modal-xem-luu-y" id="xem-luu-y">Xem Lưu Ý</button>
							
							<button type="button" class="buttonEffect bg-success buttonEffect-glow border-success py-3 px-3 m-1 animated slideInDown" data-toggle="modal" data-target="#modal-kiem-tra-giao-dich" >Kiểm tra giao dịch</button>
						</div>
						<div class="row align-items-center mt-5 row-button-header">
							<div class="col-md-4">
								<button type="button" class='one' data-toggle="modal" data-target="#diem-danh" id="diem-danh-button">Điểm Danh</button>
							</div>
							<div class="col-md-4">
								<button type="button" class='two' data-toggle="modal" data-target="#nhiem-vu-ngay">NV
									ngày</button>
							</div>
							<div class="col-md-4">
								<button type="button" class='five' data-target="#code-khuyen-mai" data-toggle="modal">Gift Code
									</button>
							</div>
							<div class="col-md-6">
								<button type="button" class='five' data-target="#taonickname" data-toggle="modal">TẠO NITNAME
									</button>
							</div>
							<div class="col-md-6">
								<button type="button" class='five' data-target="#modalReJoin" data-toggle="modal">THAM GIA LẠI
									</button>
							</div>
						</div>
<style>
    .d-inline-flex {
    display: -ms-inline-flexbox !important;
    display: inline-flex !important;
}
.justify-center {
    -ms-flex-pack: center !important;
    justify-content: center !important;
}
</style>
						    <div class="nav nav-tabs justify-center" id="list-game">
                            </div>
					</div>
				</div>
			</div>
			<!-- Header -->
			<style>
				@media only screen and (max-device-width: 480px) {
					/* styles for mobile browsers smaller than 480px; (iPhone) */
					.row-button-header {
						display: none;
					}
				}
			</style>
			<!-- Header -->

			<!-- /Tab Container -->
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
			<link href="https://cdn.datatables.net/v/bs4/dt-1.13.2/datatables.min.css" />
			<style>
				@media only screen and (max-width: 600px) {
					.btn-action {
						display: flex;
						gap: 12px;
					}

					.btn-action button {
						width: 110px;
						font-size: 12px;
					}
				}
			</style>
			<div class="container mt-5">
				<div class="row">
					<div class="col-12 col-md-10 mx-auto">
						<div class="card bg-pink border-effect">
							<div class="card-header text-center">
								<h3 class="text-uppercase heading-pink" >
									CÁCH CHƠI 
								</h3>
							</div>
							<div class="card-body">
								<div class="row justify-content-md-center mt-2">
									<div class="col-12 mx-auto">
										<div class="table-responsive bg-table-pink">
											<table class="table table-bordered mb-0 text-white text-center">
												<thead>
                                                    <tr>
                                                        <th scope="col" >Nội dung</th>
                                                        <th scope="col" >Số cuối mã GD</th>
                                                        <th scope="col" >Tỉ lệ</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableReward"></tbody>
											</table>
										</div>
									</div>
									<p id="gameNoti"></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container mt-5">
				<div class="row">
					<div class="col-12 col-md-10 mx-auto">
						<div class="card bg-pink border-effect">
							<div class="card-header text-center">
								<h3 class="text-uppercase heading-pink">
									DANH SÁCH SỐ
								</h3>
							</div>
							<div class="card-body">
								<div class="row justify-content-md-center mt-2">
									<div class="col-12 mx-auto">
										<div class="table-responsive bg-table-pink">
										    <table class="table table-bordered mb-0 text-white text-center">
												<thead>
                                                    <tr >
                                                        <th scope="col" >Chơi Tối thiểu</th>
                                                        <th scope="col" >Chơi Tối đa</th>
                                                    </tr>
                                                </thead>
                                                <thead>
                                                    <tr>
                                                        <th ><?= format_currency($tkuma->site('mingame')); ?></th>
                                                        <th ><?= format_currency($tkuma->site('maxgame')); ?></th>
                                                    </tr>
                                                </thead>
											</table>
											</div>
											<hr>
											<div class="table-responsive bg-table-pink">
											<table class="table table-bordered mb-0 text-white text-center">
												<thead>
                                                    <tr>
                                                        <th scope="col" >TRẠNG THÁI</th>
                                                        <th scope="col" >SỐ TÀI KHOẢN</th>
                                                        <th scope="col" >BANK</th>
                                                        <th scope="col" >TÊN</th>
                                                        <th scope="col">MÃ QR</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tablePhone"></tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="container mt-5" id="tabtoryuser">
				<div class="row">
					<div class="col-12 col-md-10 mx-auto">
						<div class="card bg-pink py-4 border-effect">
							<div class="card-header text-center">
								<h3 class="text-uppercase heading-pink">
									Giao Dịch Của Bạn
								</h3>
							</div>
							<div class="card-body">
								<div class="row justify-content-md-center">
									<div class="col-12  mx-auto">
										<div class="table-responsive mb-0 text-white">
											<table class="table table-bordered" width="100%" style="width:100%">
											    <thead>
                                                    <tr>
                                                        <th scope="col" class="text-white text-center">THỜI GIAN</th>
                                                        <th scope="col" class="text-white text-center">SỐ TÀI KHOẢN</th>
                                                        <th scope="col" class="text-white text-center">MGD</th>
                                                        <th scope="col" class="text-white text-center">TIỀN CƯỢC</th>
                                                        <th scope="col" class="text-white text-center">TRÒ CHƠI</th>
                                                        <th scope="col" class="text-white text-center">CƯỢC</th>
                                                        <th scope="col" class="text-white text-center">KẾT QUẢ</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="datahisuer"></tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- End History Play Game -->
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Optional JavaScript -->
			<!-- Modal -->
			<div class="modal fade thongbaoPlayGame" id="modal_frame" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header border-bottom-0">
							<h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
						</div>
						<div class="modal-body">
							Kết quả giao dịch của bạn là #<span id="trandId"></span>
							<div class="form-group col-md-12  mt-4">
								<button type="button" data-bs-dismiss="modal" class="buttonEffect buttonEffect-glow py-3 px-4 m-2 animated slideInDown close nextGame">Chơi Tiếp</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- jQuery first, then Popper.js, then Bootstrap JS -->
			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
			<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
			<script src="https://cdn.datatables.net/v/bs4/dt-1.13.2/datatables.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
			<!-- Lich Su Tham Gia -->
			<div class="container mt-5" id="lich-su-tham-gia">
				<div class="row">
					<div class="col-12 col-md-10 mx-auto">
						<div class="card bg-pink py-4 border-effect">
							<div class="card-header text-center mb-3">
								<h3 class="text-uppercase heading-pink">
									Người Chơi Thắng
								</h3>
							</div>
							<div class="card-body">
								<center class="" style="width: 76%;margin: auto;">
									<marquee>
										<b id="msg_history_hu"></b>
									</marquee>
								</center>
								<div class="table-responsive bg-table-pink">
									<table class="table table-bordered mb-0 text-white text-center">
										<thead>
											<tr role="row">
												<th class="heading-table-pink">Thời gian</th>
                                                <th class="heading-table-pink">NICKNAME</th>
                                                <th class="heading-table-pink">MGD</th>
                                                <th class="heading-table-pink">TIỀN CƯỢC</th>
                                                <th class="heading-table-pink">TRÒ CHƠI</th>
                                                <th class="heading-table-pink">CƯỢC</th>
                                                <th class="heading-table-pink">KẾT QUẢ</th>
											</tr>
										</thead>
										<tbody id="tableHistory"></tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Lich Su Tham Gia -->
			<!-- /Lich Su Tham Gia -->
			<!-- Top Thang Tuan -->
			<!-- Top Thang Tuan -->
			<div class="container mt-5" id="top-thang-tuan">
				<div class="row">
					<div class="col-12 col-md-10 mx-auto">
						<div class="card bg-pink py-4 border-effect">
							<div class="card-header text-center mb-3">
								<h3 class="text-uppercase heading-pink">
									TOP ĐẠI GIA HÔM NAY
								</h3>
							</div>
							<div class="card-body">
								<div class="table-responsive bg-table-pink">
									<table class="table table-bordered mb-0 text-white week_top">
										<thead>
											<tr role="row" class="bg-primary">
												<th class="heading-table-pink text-center text-white">TOP</th>
												<th class="heading-table-pink text-center text-white">Số Điện Thoại</th>
												<th class="heading-table-pink text-center text-white">Tổng Cược</th>
												<th class="heading-table-pink text-center text-white">Phần thưởng</th>
											</tr>
										</thead>
										<tbody id="toptuan"></tbody>
									</table>
									<div class="text-center py-3">
										<b class="text-gradient-cyan-coral">Đua TOP bắt đầu từ 0h00 mỗi ngày và trả thưởng lúc 23h30 cùng ngày.</b>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Top Thang Tuan -->
			<!-- Giới Thiệu -->
			<div class="container mt-5" id="gioi-thieu">
				<div class="row">
					<div class="col-12 col-md-10 mx-auto">
						<div class="card bg-pink py-4 border-effect">
							<div class="card-header text-center mb-3">
								<h3 class="text-uppercase heading-pink">
									LƯU Ý KHI CHƠI
								</h3>
							</div>
							<div class="card-body text-white">
								<div class="col-xs-12">
										<?= $tkuma->site('nofication_ex'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Giới Thiệu -->
			<!-- Footer Start -->
			<div class="container-fluid footer wow fadeIn border-top" data-wow-delay="0.1s">
				<div class="container-fluid copyright">
					<div class="container">
						<div class="row">
							<div class="col-md-12 text-center text-white">
								Bản Quyền Thuộc Về <a style="color: white;" href=""><?= strtoupper($_SERVER['SERVER_NAME']); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top">
				<i class="bi bi-arrow-up"></i>
			</a>
	        
	        <?php require_once(__DIR__ . '/modal.php'); ?>

			<!-- /Modal Note -->
			<!-- Modal Xem Luu Y -->
			<div class="modal fade" id="modal-xem-luu-y" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" style="max-width: 600px;">
					<div class="modal-content">
						<div class="modal-header text-center">
							<h5 class="modal-title">
								<b class="text-primary">Thông Báo <?= $tkuma->site('title'); ?> !!</b>
							</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<p>Chào mừng bạn đến với <b style="color:#d65cad;"> Hệ Thống Chẵn Lẻ Bank Uy Tín - Đẳng Cấp TOP 1 VN</b></p>
							<br>
							<?= $tkuma->site('notification'); ?>
							<p style="color:blue;"><b class="text-dark">ĐÓNG THÔNG BÁO</b> đồng nghĩa với việc
								bạn đã
								đồng ý với điều
								khoản
								của chúng tôi!
							</p>
							<br>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
						</div>
					</div>
				</div>
			</div>




		</main>
		<!-- /Main -->
		<!-- The menu -->
		<!-- The menu mobile-->
		<nav id="menuMobile">
			<ul>
				<li class="p-3">
					<button type="button" class="buttonEffect buttonEffect-glow my-2 py-2 w-100 animated slideInDown" onclick="location.href='<?= $tkuma->site('telegrambox'); ?>'">
						Tham Gia Nhóm Chat
					</button>
				</li>
				<li class="p-3">
					<button type="button" class="buttonEffect bg-success buttonEffect-glow border-success my-2 py-2 w-100 animated slideInDown" onclick="location.href='<?= $tkuma->site('telegram'); ?>'">
						Bạn Cần Hỗ Trợ?
					</button>
				</li>
				<li class="p-3">
					<button type="button" class='five click_modalSp' data-target="#taonickname" data-toggle="modal" >TẠO NITNAME</button>
				</li>
				<li class="p-3">
					<button type="button" class='five click_modalSp' data-target="#modalReJoin" data-toggle="modal" >THAM GIA LẠI</button>
				</li>
				<li class="p-3">
					<button type="button" class='five click_modalSp' data-target="#code-khuyen-mai" data-toggle="modal" >Code
						khuyến mãi</button>
				</li>
				<li class="p-3">
					<button type="button" class='five click_modalSp' data-target="#diem-danh" data-toggle="modal" >Điểm Danh</button>
				</li>
				<li class="p-3">
					<button type="button" class='five click_modalSp' data-target="#nhiem-vu-ngay" data-toggle="modal" >NV
									ngày</button>
				</li>
				<li><a href="#gioi-thieu">GIỚI THIỆU</a></li>
				<li><a href="#trang-thai-momo">TRẠNG THÁI BANK</a></li>
				<li><a href="#lich-su-tham-gia">LỊCH SỬ THAM GIA</a></li>
				<li><a href="#top-thang-tuan">ĐẠI GIA TOP NGÀY</a></li>
			</ul>
		</nav>
		<!-- /The menu mobile -->
		<!-- Modal Video Fixed -->
		<div class="modal fade" id="video-intro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" style="max-width: 600px;">
				<div class="modal-content">
					<div class="modal-header text-center">
						<h5 class="modal-title">
							<b class="text-primary">Giới thiệu</b>
						</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<video class="w-100" id="video-intro-player" height="400" controls>
							<source src="<?= BASE_URL('public/theme5/'); ?>img/movie.mp4" type="video/mp4">
							<source src="<?= BASE_URL('public/theme5/'); ?>img/movie.ogg" type="video/ogg">
						</video>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" id="close_video_intro" data-bs-dismiss="modal">Đóng</button>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal Video Fixed -->
	</div>

	<div style="width: 50px;position: fixed;bottom: 50px;left: 20px;">
		<a data-bs-toggle="modal" data-target="#modal-kiem-tra-no-hu" data-toggle="modal" >
			<img src="public/storage/hutamhoa.gif" style="width: 100px;" />
		</a>
	</div>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/5.3.4/js/jquery.mmenu.min.all.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>


	<script src="<?= BASE_URL('public/theme5/'); ?>js/wow.min.js?v=2"></script>
	<script src="<?= BASE_URL('public/theme5/'); ?>js/easing.min.js"></script>
	<script src="<?= BASE_URL('public/theme5/'); ?>js/notify.js?v=3"></script>
	<script src="<?= BASE_URL('public/theme5/'); ?>js/rainbow.js"></script>
	<script src="<?= BASE_URL('public/theme5/'); ?>js/jquery.growl.js"></script>
	<script src="<?= BASE_URL('public/theme5/'); ?>js/jquery.richtext.js"></script>
	<script src="<?= BASE_URL('public/theme5/'); ?>js/select2.full.min.js"></script>
	<script src="<?= BASE_URL('public/theme5/'); ?>js/main.js?v=2008"></script>
	<script src="<?= BASE_URL('public/theme5/'); ?>js/jquery.dataTables.min.js"></script>
	<script src="<?= BASE_URL('public/theme5/'); ?>js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>


	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-11087336767"></script>
	
	<script src="<?= BASE_URL('public/theme2'); ?>/js/clipboard.js"></script>
    <link href="<?= base_url('public/cute-alert/sweetalert2/sweetalert2.min.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('public/cute-alert/sweetalert2/sweetalert2.min.js'); ?>"></script>
    <script src="<?= BASE_URL('public/'); ?>js/kuma.js?v=<?= time(); ?>"></script>
    <script src="<?= BASE_URL('public/'); ?>js/custom.js?v=<?= time(); ?>"></script>

</html>