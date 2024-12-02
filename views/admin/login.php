<?php 

$body = [
	'title' => 'Đăng nhập trang quản trị',
	'desc'   => ' Hệ thống quản trị website',
	'keyword' => ''
];
$body['header'] = '
';
$body['footer'] = '
';
require_once(__DIR__ . '/layout/header.php');

$tkuma = new DB();
if($tkuma->num_rows(" SELECT * FROM `users` WHERE `id` = ? ",[id_admin]) == 0){
    header('Location: /admin/install.php');
    exit();
}
    
if ($tkuma->site('pin_admin') != '') {
    if (empty($_GET['type'])) {
        	header('Location: /views/common/404.php');
    }
    if ($_GET['type'] != $tkuma->site('pin_admin')) {
        	header('Location: /views/common/404.php');
    }
}
?>

<body class="pace-top">
	<?php

	$tkuma = new DB();
	$Mobile_Detect = new Mobile_Detect();
	use PragmaRX\Google2FAQRCode\Google2FA;
	if (isset($_POST['btnLogin'])) {
		$email = check_string($_POST['email']);
		$password = check_string($_POST['password']);

		if (empty($email = check_string($_POST['email']))) {
			msg_error("Email không được để trống", "", 1000);
		}
		if (empty($_POST['password'])) {
			msg_error("Mật khẩu không được để trống", "", 1000);
		}
		if ($tkuma->site('status_captcha') == 1) {
			$phrase = check_string($_POST['phrase']);
			if (strcasecmp($phrase, $_SESSION['phrase']) != 0) {
				msg_error("Captcha không chính xác", "", 1000);
			}
		}
		if (getLocation(myip())['country'] != 'VN') {
			msg_error("Vui lòng dùng địa chỉ IP thật để truy cập quản trị", "", 1000);
		}
		$getUser = $tkuma->get_row("SELECT * FROM `users` WHERE `email` = ? AND `id` = ? ",[$email,id_admin]);
		if (!$getUser) {
			msg_error("Thông tin đăng nhập không chính xác", "", 1000);
		}
		if (time() > $getUser['time_request']) {
			if (time() - $getUser['time_request'] < max_time_load) {
				msg_error("Bạn đang thao tác quá nhanh, vui lòng chờ", "", 1000);
			}
		}
		if ($tkuma->site('type_password') == 'bcrypt') {
			if (!password_verify($password, $getUser['password'])) {
				msg_error("Thông tin đăng nhập không chính xác", "", 1000);
			}
		} else {
			if (kuma_dec($getUser['password']) != $password) {
				msg_error("Thông tin đăng nhập không chính xác", "", 1000);
			}
		}

		if ($getUser['status_2fa'] == 1) {
			msg_error("Vui lòng xác minh 2FA để hoàn thành đăng nhập !", base_url('admin/verify/' . base64_encode($getUser['token'])), 1000);
		}
		$tkuma->insert("logs", [
			'user_id'       => $getUser['id'],
			'ip'            => myip(),
			'device'        => $Mobile_Detect->getUserAgent(),
			'createdate'    => gettime(),
			'action'        => '[Warning] Đăng nhập thành công vào hệ thống Admin'
		]);
		$new_token = random('QWERTYUIOPASDGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm0123456789', 25);
		$tkuma->update("users", [
			'ip'        => myip(),
			'token' => $new_token,
			'time_request' => time(),
			'time_session' => time(),
			'device'    => $Mobile_Detect->getUserAgent()
		], " `id` = ? ",[$getUser['id']]);
		setcookie("token", $new_token, time() + $tkuma->site('session_login'), "/");
	 session_regenerate_id(true);
		$_SESSION['admin_login'] = $new_token;
		if ($tkuma->site('keyloca') == '') {
			msg_error("verify", BASE_URL('admin/pass2'), 1000);
		}
		msg_success("Đăng nhập thành công !", BASE_URL('admin/'), 1000);
	}
	?>
	<div id="app" class="app app-full-height app-without-header">
		<div class="login">
			<div class="login-content">
				<form action="" method="POST">
					<h1 class="text-center">Sign In</h1>
					<div class="text-inverse text-opacity-50 text-center mb-4">
						For your protection, please verify your identity.
					</div>
					<div class="mb-3">
					
						<label class="form-label">Email Address <span class="text-danger">*</span></label>
						<input type="text" name="email" class="form-control form-control-lg bg-inverse bg-opacity-5" value placeholder>
					</div>
					<div class="mb-3">
						<div class="d-flex">
							<label class="form-label">Password <span class="text-danger">*</span></label>
							<a href="#" class="ms-auto text-inverse text-decoration-none text-opacity-50">Forgot
								password?</a>
						</div>
						<input type="password" name="password" class="form-control form-control-lg bg-inverse bg-opacity-5" value placeholder>
					</div>
					<div class="mb-3">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value id="customCheck1">
							<label class="form-check-label" for="customCheck1">Remember me</label>
						</div>
					</div>
					<button type="submit" name="btnLogin" class="btn btn-outline-theme btn-lg d-block w-100 fw-500 mb-3">Sign
						In</button>
					<div class="text-center text-inverse text-opacity-50">
						Don't have an account yet? <a href="/">Sign up</a>.
					</div>
				</form>
			</div>
		</div>
		<?php

		require_once(__DIR__ . '/layout/nav.php');
		require_once(__DIR__ . '/layout/footer.php');
		?>