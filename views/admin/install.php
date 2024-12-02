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

if($tkuma->num_rows(" SELECT * FROM `users` WHERE `id` = ? ",[id_admin]) != 0){
    header('Location: /');
}
?>

<body class="pace-top">
	<?php

	$tkuma = new DB();
	$Mobile_Detect = new Mobile_Detect();
	use PragmaRX\Google2FAQRCode\Google2FA;
	if (isset($_POST['btnLogin'])) {
		$email =  check_string($_POST['email']);
		$username =  check_string2($_POST['username']);
        $password = check_string($_POST['password']);
        if (empty($username)) {
            die(json_encode(['status' => 'error', 'msg' => 'Username không được để trống']));
        }
        if (empty($email)) {
            die(json_encode(['status' => 'error', 'msg' => 'Email không được để trống']));
        }
        if ($tkuma->num_rows("SELECT * FROM `users` WHERE `username` = ? ",[$username]) > 0) {
            die(json_encode(['status' => 'error','msg' => 'Tên đăng nhập đã tồn tại trong hệ thống']));
        }
        if ($tkuma->num_rows("SELECT * FROM `users` WHERE `email` = ? ",[$email]) > 0) {
            die(json_encode(['status' => 'error','msg' => 'Email đã tồn tại trong hệ thống']));
        }
        if ($tkuma->num_rows("SELECT * FROM `users` WHERE `ip` = ? ",[myip()]) >= 5) {
            die(json_encode(['status' => 'error', 'msg' => 'IP của bạn đã đạt giới hạn tạo tài khoản cho phép']));
        }
		$getUser = $tkuma->get_row("SELECT * FROM `users` WHERE `id` = ? ",[id_admin]);
		if ($getUser) {
			msg_error("Tài khoản admin đã tồn tại", "", 1000);
		}
		$tkuma->insert("logs", [
			'user_id'       => id_admin,
			'ip'            => myip(),
			'device'        => $Mobile_Detect->getUserAgent(),
			'createdate'    => gettime(),
			'action'        => '[Warning] Tạo tài khoản ADMIN thành công'
		]);
		$new_token = random('QWERTYUIOPASDGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm0123456789', 25);
		$isCreate = $tkuma->insertins("users", [
		    'id'         => 1,
            'token'         => $new_token,
            'username'      => $username,
            'email'         => $email,
            'bankid'      => 1,
            'stk'            => 1,
            'password'      => TypePassword($password),
            'ip'            => myip(),
            'device'        => $Mobile_Detect->getUserAgent(),
            'create_date'   => gettime(),
            'update_date'   => gettime(),
            'time_session'  => time(),
            'SecretKey_2fa' => '0',
            'ctv' => '0'
        ]);
		$tkuma->update("settings", array( 'value' => base64_encode(check_string2($_POST['pass2']))), " `name` = ? ",['keyloca']);
		setcookie("token", $new_token, time() + $tkuma->site('session_login'), "/");
		$_SESSION['admin_login'] = $new_token;
		msg_success("Tạo thành công !", BASE_URL('admin/'), 1000);
	}
	?>
	<div id="app" class="app app-full-height app-without-header">
		<div class="login">
			<div class="login-content">
				<form action="" method="POST">
					<h1 class="text-center">Tạo Tài Khoản ADMIN</h1>
					<div class="text-inverse text-opacity-50 text-center mb-4">
						For your protection, please verify your identity.
					</div>
					<div class="mb-3">
						<label class="form-label">Username <span class="text-danger">*</span></label>
						<input type="text" name="username" class="form-control form-control-lg bg-inverse bg-opacity-5" value placeholder>
					</div>
					<div class="mb-3">
						<label class="form-label">Email Address <span class="text-danger">*</span></label>
						<input type="text" name="email" class="form-control form-control-lg bg-inverse bg-opacity-5" value placeholder>
					</div>
					<div class="mb-3">
						<label class="form-label">Password <span class="text-danger">*</span></label>
						<input type="password" name="password" class="form-control form-control-lg bg-inverse bg-opacity-5" value placeholder>
					</div>
					<div class="mb-3">
						<label class="form-label">Nhập Lại Password <span class="text-danger">*</span></label>
						<input type="password" name="repassword" class="form-control form-control-lg bg-inverse bg-opacity-5" value placeholder>
					</div>
					<div class="mb-3">
						<label class="form-label">Mật Khẩu chuyển tiền <span class="text-danger">*</span></label>
						<input type="password" name="pass2" class="form-control form-control-lg bg-inverse bg-opacity-5" placeholder="Đùng để xác nhận chuyển tiền trong admin" value placeholder>
					</div>
					<button type="submit" name="btnLogin" class="btn btn-outline-theme btn-lg d-block w-100 fw-500 mb-3">Tạo Ngay</button>
				</form>
			</div>
		</div>
		<?php

		require_once(__DIR__ . '/layout/nav.php');
		require_once(__DIR__ . '/layout/footer.php');
		?>