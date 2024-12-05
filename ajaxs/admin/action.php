<?php

define("IN_SITE", true);
require_once(__DIR__ . "/../../libs/config.php");
require_once(__DIR__ . "/../../libs/db.php");
require_once(__DIR__ . "/../../libs/helper.php");
require_once(__DIR__ . "/../../libs/class/VietCombank.php");
require_once(__DIR__ . "/../../libs/class/MBB2.php");
require_once(__DIR__ . "/../../libs/class/bidv.php");
require_once(__DIR__ . "/../../libs/class/GateIO.php");

$tkuma = new DB();
// $Mobile_Detect = new Mobile_Detect();


use PragmaRX\Google2FAQRCode\Google2FA;


if (isset($_POST['action'])) {
    if ($tkuma->site('status_demo') != 0) {
			$data = json_encode([
				'status'    => 'error',
				'msg'       => 'Không được dùng chức năng này vì đây là trang web demo'
			]);
			die($data);
	}

	//Tạm comment để bỏ check quyền admin
	//  if (empty($_SESSION['admin_login'])) {
	//  		die(json_encode(['status' => 'error', 'msg' => 'Bạn không có quyền này !']));
	//  	}
	//  	if (!$getadmin = $tkuma->get_row("SELECT * FROM `users` WHERE `token` = ? ",[$_SESSION['admin_login']])) {
	//  	die(json_encode(['status' => 'error', 'msg' => 'Bạn không có quyền này !']));
	//  }
	//  if (myip() != $getadmin['ip']) {
	//  	die(json_encode(['status' => 'error', 'msg' => 'Bạn không có quyền này !']));
	//  }
	//  if (is_admin() == false) {
	//  	die(json_encode(['status' => 'error', 'msg' => 'Bạn không có quyền này !']));
	//  }
	if ($_POST['action'] == "chuyentienmbbank") {

		if (empty(check_string($_POST['pass2']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Bạn không có quyền này !']));
		}
		$pass2 = check_string($_POST['pass2']);
		if ($pass2 != base64_decode($tkuma->site('keyloca'))) {
			die(json_encode(['status' => 'error', 'msg' => 'Bạn không có quyền này !']));
		}
		$commet = check_string($_POST['commet']);
		if (empty($commet)) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		}
	    $amount = check_string($_POST['amount']);
	    if (empty($amount)) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		}
		$bankout = check_string($_POST['bankout']);
		if (empty($bankout)) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		}
		$bankcode = check_string($_POST['bankcode']);
		if (empty($bankcode)) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		}
		$name = check_string($_POST['name']);
		if (empty($name)) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		}
		$authrlist = check_string($_POST['authrlist']);
		if (empty($authrlist)) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		}
		$code = check_string($_POST['code']);
		if (empty($code)) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		}
		$sdt = check_string($_POST['username']);
		if (empty($sdt)) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		}
		$transacid = check_string($_POST['transacid']);
		if (empty($transacid)) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		}
		if (!$rows = $tkuma->get_row("SELECT * FROM `account_mbbank` WHERE `phone` = ?",[$sdt])) {
			die(json_encode(['status' => 'error', 'msg' => 'Bank không tồn tại trên hệ thống !']));
		}
		$mbbank = new MBB($rows['phone'], $rows['password'], $rows['stk']);
		$result_pay = $mbbank->makeTransfer($bankcode,$bankout,$amount,$commet,$name,$authrlist,$code,$transacid);
		if ($result_pay->result->responseCode == '00') {
			$SEND_BILL = $tkuma->insert("chuyen_tien", [
				'type_gd' => 'chuyentien',
				'tranId' => $result_pay->ftId,
				'partnerId' => $bankout,
				'partnerName' => $name,
				'amount' => $result_pay->amount,
				'comment' => $result_pay->message,
				'status' => $result_pay->result->responseCode,
				'message' => 'success',
				'data' => json_encode($result_pay),
				'balance' => '',
				'ownerNumber' => $rows['phone'],
				'ownerName' => $result_pay->srcAccountName,
				'type' => 1,
				'date_time' => gettime(),
				'time' => gettime()
			]);
			die(json_encode(['status' => 'success', 'msg' => 'Thêm thành công !']));
		} else {
			die(json_encode(['status' => 'error', 'msg' => $result_pay->result->message]));
		}
	}
	if ($_POST['action'] == "GETCHUYENMB") {
		
	
		$commet = check_string($_POST['commet']);
		if (empty($commet)) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		}
	    $amount = check_string($_POST['amount']);
	    if (empty($amount)) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		}
		$bankout = check_string($_POST['bankout']);
		if (empty($bankout)) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		}
		$bankcode = check_string($_POST['bankcode']);
		if (empty($bankcode)) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		}
		if (empty(check_string($_POST['username']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$sdt = check_string($_POST['username']);
			if (!$rows = $tkuma->get_row("SELECT * FROM `account_mbbank` WHERE `phone` = ? ",[$sdt])) {
				die(json_encode(['status' => 'error', 'msg' => 'Bank không tồn tại trên hệ thống !']));
			} else {
			    $mbbank = new MBB($rows['phone'], $rows['password'], $rows['stk']);
			     $gethistt = $mbbank->createTransactionAuthen($bankcode,$bankout,$amount,$commet);
				if ($gethistt['status'] == 'success') {
					die(json_encode($gethistt));
				} else {
					die(json_encode(['status' => 'error', 'msg' => $gethistt['status']]));
				}
			}
		}
	}
	if ($_POST['action'] == "fixgetotp") {
		$tkuma->update("lich_su_choi", ['status' => 'pending',], " status = ? ",['getotp']);
		$update1 = $tkuma->update("account_vcb", ['typech' => '0',], " typech = ? ",['1']);
		if ($update1) {
			die(json_encode(['status' => 'success', 'msg' => 'Bật thành công !']));
		} else {
			die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
		}
	}
	if ($_POST['action'] == "editcron") {
		
		if (empty(check_string($_POST['id']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$id = check_string($_POST['id']);
			$time = check_string($_POST['time']);
			if ($tkuma->num_rows("SELECT * FROM `cronjobsact` WHERE `id` = ? ",[$id]) == 0) {
				die(json_encode(['status' => 'error', 'msg' => 'Cron không tồn tại trên hệ thống !']));
			} else {
				$update1 = $tkuma->update("cronjobsact", ['time' => $time,], " `id` = ? ",[$id]);
				if ($update1) {
					die(json_encode(['status' => 'success', 'msg' => 'Chỉnh sử thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
				}
			}
		}
	}
	if ($_POST['action'] == "Addgame") {
		$ten_game    = check_string($_POST['ten_game']);
		$type   = check_string2($_POST['type']);
		$dscrtype   = check_string2($_POST['dscrtype']);
		$mo_ta   = check_string3($_POST['mo_ta']);
		$ma_game =  xoadaucham($ten_game);
		$check_code = $tkuma->get_row(" SELECT * FROM `danh_sach_game` WHERE `ma_game` = ?  ",[$ma_game]);
		if ($check_code) {
			die(json_encode(['status' => 'error', 'msg' => 'Đã tồn tại game này !']));
		}
		$insert = $tkuma->insert("danh_sach_game", [
			'ten_game' => $ten_game,
			'type'          => $type,
			'dscrtype'            => $dscrtype,
			'status'          => 'run',
			'time'          => gettime(),
			'mo_ta'          => $mo_ta,
			'ma_game'          => $ma_game,
		]);
		if ($insert) {
			die(json_encode(['status' => 'success', 'msg' => 'Thêm game thành công !']));
		} else {
			die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps !']));
		}
	}
	if ($_POST['action'] == "Addcachchoi") {
	    
		$keyd    = check_string($_POST['key']);
		$check_code = $tkuma->get_row(" SELECT * FROM `danh_sach_game` WHERE `id` = '$keyd'  ");
		$tile   = check_string($_POST['tile']);
		$comment   = check_string($_POST['comment']);
		$result   = $_POST['result'];
        $tongcach = $tkuma->get_row("SELECT COUNT(id) FROM `settings_game` WHERE `keyd` = ? ",[$check_code['ma_game']])['COUNT(id)'];
		
		$type   = $check_code['dscrtype'];
		$tongcach = $tongcach + 1;
		if (!$check_code) {
			die(json_encode(['status' => 'error', 'msg' => 'Đã tồn tại game này !']));
		}
		$insert = $tkuma->insert("settings_game", [
			'keyd' => $check_code['ma_game'],
			'comment'          => $comment,
			'tile'            => $tile,
			'result'          => $result,
			'type'          => $type,
			'phan_game'          => 'comment_'.$tongcach
		]);
		if ($insert) {
			die(json_encode(['status' => 'success', 'msg' => 'Thêm game thành công !']));
		} else {
			die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps !']));
		}
	}
	if ($_POST['action'] == "xoa-giftcode") {
		$giftcode    = check_string2($_POST['id']);
		$check_code = $tkuma->get_row(" SELECT * FROM `giftcode` WHERE `id` = ?  ",[$giftcode]);
		if (!$check_code) {
			die(json_encode(['status' => 'error', 'msg' => 'Không tồn tại giftcode này !']));
		}
		$DEL = $tkuma->remove("giftcode", "`id` = ? ",[$giftcode]);
		if ($DEL) {
			die(json_encode(['status' => 'success', 'msg' => 'Xóa giftcode thành công !']));
		} else {
			die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps !']));
		}
	}
	if ($_POST['action'] == "deletemultiple-giftcode") {
		$giftcodes = $_POST['ids'];
		$giftcodesArray = explode(',', $giftcodes);
		$errors = [];
		$success = [];
	
		foreach ($giftcodesArray as $giftcode) {
			$giftcode = check_string2($giftcode);
			$check_code = $tkuma->get_row("SELECT * FROM `giftcode` WHERE `id` = ?", [$giftcode]);
			if (!$check_code) {
				$errors[] = "Không tồn tại giftcode với ID: $giftcode";
				continue;
			}
			$DEL = $tkuma->remove("giftcode", "`id` = ?", [$giftcode]);
			if ($DEL) {
				$success[] = "Xóa giftcode với ID: $giftcode thành công!";
			} else {
				$errors[] = "Lỗi thực hiện khi xóa giftcode với ID: $giftcode";
			}
		}
	
		if (count($errors) > 0) {
			die(json_encode(['status' => 'error', 'msg' => $errors]));
		} else {
			die(json_encode(['status' => 'success', 'msg' => $success]));
		}
	}
	if ($_POST['action'] == "xoa-game") {
		$id    = check_string2($_POST['id']);
		$check_code = $tkuma->get_row(" SELECT * FROM `danh_sach_game` WHERE `id` = ?  ",[$id]);
		if (!$check_code) {
			die(json_encode(['status' => 'error', 'msg' => 'Không tồn tại game này !']));
		}
		$check_dsgame = $tkuma->get_list(" SELECT * FROM `settings_game` WHERE `keyd` = ? ",[$check_code['ma_game']]);
		if ($check_dsgame){
		    foreach ($check_dsgame as $rding) {
		        $tkuma->remove("settings_game", "`id` = ? ",[$rding['id']]);
		    }
		}
		$DEL = $tkuma->remove("danh_sach_game", "`id` = ? ",[$id]);
		if ($DEL) {
			die(json_encode(['status' => 'success', 'msg' => 'Xóa giftcode thành công !']));
		} else {
			die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps !']));
		}
	}
	if ($_POST['action'] == "xoa-cachchoi") {
		$id    = check_string2($_POST['id']);
		$check_code = $tkuma->get_row(" SELECT * FROM `settings_game` WHERE `id` = ?  ",[$id]);
		if (!$check_code) {
			die(json_encode(['status' => 'error', 'msg' => 'Không tồn tại game này !']));
		}
		$DEL = $tkuma->remove("settings_game", "`id` = ? ",[$id]);
		if ($DEL) {
			die(json_encode(['status' => 'success', 'msg' => 'Xóa cách chơi thành công !']));
		} else {
			die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps !']));
		}
	}
	if ($_POST['action'] == "batgame") {
		
		if (empty(check_string($_POST['id']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$id = check_string($_POST['id']);
			if ($tkuma->num_rows("SELECT * FROM `danh_sach_game` WHERE `id` = ? ",[$id]) == 0) {
				die(json_encode(['status' => 'error', 'msg' => 'game không tồn tại trên hệ thống !']));
			} else {
				$update1 = $tkuma->update("danh_sach_game", ['status' => 'run',], " `id` = ? ",[$id]);
				if ($update1) {
					die(json_encode(['status' => 'success', 'msg' => 'Bật thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
				}
			}
		}
	}
	if ($_POST['action'] == "tatgame") {
		if (empty(check_string($_POST['id']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$id = check_string($_POST['id']);
			if ($tkuma->num_rows("SELECT * FROM `danh_sach_game` WHERE `id` = ?",[$id]) == 0) {
				die(json_encode(['status' => 'error', 'msg' => 'game không tồn tại trên hệ thống !']));
			} else {
				$update1 = $tkuma->update("danh_sach_game", [
					'status' => 'off',
				], " `id` = ? ",[$id]);
				if ($update1) {
					die(json_encode(['status' => 'success', 'msg' => 'Tắt game thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
				}
			}
		}
	}
	if ($_POST['action'] == "editgame") {
		if (empty(check_string($_POST['id']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$id = check_string($_POST['id']);
			$ten_gamed = check_string($_POST['ten_gamed']);
			$mota = check_string3($_POST['mota']);
			if ($tkuma->num_rows("SELECT * FROM `danh_sach_game` WHERE `id` = ?",[$id]) == 0) {
				die(json_encode(['status' => 'error', 'msg' => 'game không tồn tại trên hệ thống !']));
			} else {
				$update1 = $tkuma->update("danh_sach_game", [
					'ten_game' => $ten_gamed,
					'mo_ta' => $mota,
				], " `id` = ? ",[$id]);
				if ($update1) {
					die(json_encode(['status' => 'success', 'msg' => 'Tắt game thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
				}
			}
		}
	}
	if ($_POST['action'] == "editcachchoi") {
		
		if (empty(check_string($_POST['id']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$id = check_string($_POST['id']);
			$comment = check_string($_POST['comment']);
			$tile = check_string($_POST['tile']);
			$result = check_string($_POST['result']);
			if ($tkuma->num_rows("SELECT * FROM `settings_game` WHERE `id` = ?",[$id]) == 0) {
				die(json_encode(['status' => 'error', 'msg' => 'game không tồn tại trên hệ thống !']));
			} else {
				$update1 = $tkuma->update("settings_game", [
					'comment' => $comment,
					'tile' => $tile,
					'result' => $result,
				], " `id` = ? ",[$id]);
				if ($update1) {
				    // if($tkuma->site("status_websoket") == 1){pingtile();}
					die(json_encode(['status' => 'success', 'msg' => 'Lưu thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
				}
			}
		}
	}
	if ($_POST['action'] == "xoaband") {
		$sdt    = check_string2($_POST['sdt']);
		$check_code = $tkuma->get_row(" SELECT * FROM `momo_band` WHERE `sdt` = ? ",[$sdt]);
		if (!$check_code) {
			die(json_encode(['status' => 'error', 'msg' => 'Không tồn tại SĐT này !']));
		}
		$DEL = $tkuma->remove("momo_band", "`sdt` = ? ",[$sdt]);
		if ($DEL) {
			die(json_encode(['status' => 'success', 'msg' => 'Xóa Band thành công !']));
		} else {
			die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps !']));
		}
	}

	if ($_POST['action'] == "doi-mat-khau") {
		$old_password  = check_string2($_POST['old_password']);
		$new_password = check_string2($_POST['new_password']);
		$renew_password = check_string2($_POST['renew_password']);
		$check_admin = $tkuma->get_row(" SELECT * FROM `users` WHERE `token` = ?  ",[$_SESSION['admin_login']]);
		if ($new_password != $renew_password) {
			die(json_encode(['status' => 'error', 'msg' => 'Mật khẩu mới không giống nhau !']));
		}
		if (strlen(check_string($_POST['renew_password'])) < 6 || strlen(check_string($_POST['renew_password'])) > 32) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập mật khẩu từ 6 đến 32 ký tự !']));
		}
		if ($tkuma->site('type_password') == 'bcrypt') {
			if (!password_verify($old_password, $check_admin['password'])) {
				die(json_encode([
					'status'    => 'error',
					'msg'       => 'Thông tin đăng nhập không chính xác'
				]));
			}
		} else {
			if ($check_admin['password'] != TypePassword($password)) {
				die(json_encode([
					'status'    => 'error',
					'msg'       => 'Thông tin đăng nhập không chính xác'
				]));
			}
		}
		$update = $tkuma->update("users", [
			'password' => TypePassword($new_password),
			'time_session' => time(),
		], " `email` = ? ",[$check_admin['email']]);
		if ($update) {
			die(json_encode(['status' => 'success', 'msg' => 'Đổi thành công !']));
		} else {
			die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps !']));
		}
	}
	if ($_POST['action'] == "giftcode") {
		$giftcode = check_string2($_POST['giftcode']);
		$money = check_string2($_POST['money']);
		$min = check_string2($_POST['min']);
		$limit = check_string2($_POST['limit']);
		$giftcount = isset($_POST['giftcount']) ? check_string2($_POST['giftcount']) : null;
	    sendMessTelegramNew('giftcount: ' . $giftcount);
		if ($giftcount !== null && $giftcount !== '') {
			// Kiểm tra nếu giftcount được nhập và là số
			if (!is_numeric($giftcount) || $giftcount <= 0) {
				die(json_encode(['status' => 'error', 'msg' => 'Số lượng giftcode phải là một số dương!']));
			}
	
			for ($i = 0; $i < $giftcount; $i++) {
				// Sinh mã giftcode ngẫu nhiên và đảm bảo không trùng lặp
				$giftcode = generateUniqueGiftcode();
	
				// Chèn giftcode mới vào cơ sở dữ liệu
				$insert = $tkuma->insert("giftcode", [
					'giftcode' => $giftcode,
					'money' => $money,
					'gioi_han' => $limit,
					'da_nhap' => 0,
					'time' => gettime(),
					'min' => $min,
				]);
	
				if (!$insert) {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps cho giftcode: ' . $giftcode]));
				}
			}
	
			die(json_encode(['status' => 'success', 'msg' => 'Thêm giftcode thành công!']));
		} else {
			//Check giftcode
			if (empty($giftcode)) {
				$giftcode = generateUniqueGiftcode();
			}
			// Logic cũ nếu không nhập giftcount
			$check_code = $tkuma->get_row("SELECT * FROM `giftcode` WHERE `giftcode` = ?", [$giftcode]);
			if ($check_code) {
				die(json_encode(['status' => 'error', 'msg' => 'Đã tồn tại giftcode này!']));
			}
			$insert = $tkuma->insert("giftcode", [
				'giftcode' => $giftcode,
				'money' => $money,
				'gioi_han' => $limit,
				'da_nhap' => 0,
				'time' => gettime(),
				'min' => $min,
			]);
			if ($insert) {
				die(json_encode(['status' => 'success', 'msg' => 'Thêm giftcode thành công!']));
			} else {
				die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps!']));
			}
		}
	}
	if ($_POST['action'] == "band") {
		
		$sdt    = check_string2($_POST['sdt']);
		$check_code = $tkuma->get_row(" SELECT * FROM `momo_band` WHERE `sdt` = ?  ",[$sdt]);
		if ($check_code) {
			die(json_encode(['status' => 'error', 'msg' => 'Đã tồn tại SĐT này !']));
		}
		$insert = $tkuma->insert("momo_band", [
			'sdt' => $sdt,
			'status'          => 'pending',
			'createdate'          => gettime(),
		]);
		if ($insert) {
			die(json_encode(['status' => 'success', 'msg' => 'Band thành công !']));
		} else {
			die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps !']));
		}
	}
	if ($_POST['action'] == "thanhtoantt") {
		
		$id = check_string2($_POST['id']);
		if (empty($id)) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng F5 !']));
		} else {
			$GET_B = $tkuma->get_row(" SELECT * FROM `lich_su_choi` WHERE `result` = ? AND `status` = ? AND `id` = ? ",['success','Thất Bại',$id]);
			if (!$GET_B) {
				die(json_encode(['status' => 'error', 'msg' => 'Không có mã giao dịch này !']));
			}
			if ($GET_B['status'] == "success") {
				die(json_encode(['status' => 'error', 'msg' => 'Đơn đã được trả thưởng !']));
			}
			$TTB = $tkuma->update(	"lich_su_choi",	[	'status' => 'pending',	'msg_send' => 'Thêm vào hàng chờ thanh toán lại'	]," `id` = ?  ",[$id]);
				if ($TTB) {
				die(json_encode(['status' => 'success', 'msg' => 'Thêm hàng chờ thành công  !']));
			}

		}
	}
	if ($_POST['action'] == "tttay") {
		
		$id = check_string2($_POST['id']);
		if (empty($id)) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng F5 !']));
		} else {
			$GET_B = $tkuma->get_row(" SELECT * FROM `lich_su_choi` WHERE `result` = ? AND `status` = ? AND `id` = ? ",['success','Thất Bại',$id]);
			$partnerID = $GET_B['phone'];
			$tien_nhan = $GET_B['amount_game'];
			$msg_send = "TT MÃ GD: " . $GET_B['tranId'];
			$tranId = $GET_B['tranId'];
			if (!$GET_B) {
				die(json_encode(['status' => 'error', 'msg' => 'Không có mã giao dịch này !']));
			}
			if ($GET_B['status'] == "success") {
				die(json_encode(['status' => 'error', 'msg' => 'Đơn đã được trả thưởng !']));
			}
			if ($GET_B) {
				$TTB = $tkuma->update(	"lich_su_choi",	[	'status' => 'success',	'msg_send' => 'Thành công'	],	" `id` = ? ",[$id]);
				$SEND_BILL = $tkuma->insert("chuyen_tien", [
					'type_gd' => 'tttay',
					'tranId' => $GET_B['tranId'],
					'partnerId' =>   $GET_B['phone'],
					'partnerName' => $GET_B['partnerName'],
					'amount' => $GET_B['amount_game'],
					'comment' => 'Thanh Toán Biul Lỗi',
					'status' => '200',
					'message' => 'success',
					'data' => 'Thanh toán thành công !',
					'balance' => $GET_B['amount_game'],
					'ownerNumber' => $GET_B['phone'],
					'ownerName' => $GET_B['partnerName'],
					'type' => 1,
					'date_time' => gettime(),
					'time' => gettime()
				]);
				die(json_encode(['status' => 'success', 'msg' => 'Thanh toán thành công !']));
			}
		}
	}

	if ($_POST['action'] == "chuyentien") {
		
		if (empty(check_string2($_POST['pass2']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Bạn không có quyền này !']));
		}
		$pass2 = check_string2($_POST['pass2']);
		if ($pass2 != base64_decode($tkuma->site('keyloca'))) {
			die(json_encode(['status' => 'error', 'msg' => 'Bạn không có quyền này !']));
		}
		$msg_send = check_string2($_POST['ndchuyen']);
		$sdt = check_string2($_POST['sdt']);
		$phone = check_string2($_POST['phone']);
		$mony = check_string2($_POST['mony']);
		$chuyen = $tkuma->get_row(" SELECT * FROM `account_vcb` WHERE `username` = ? ",[$phone]);
		$result_pay = chuyentien($chuyen['username'], $mony, $chuyen['password'], $msg_send, $sdt, $pass2);
		if ($result_pay['status'] == 200) {
		
			$SEND_BILL = $tkuma->insert("chuyen_tien", [
				'type_gd' => 'chuyentien',
				'tranId' => $result_pay['tranId'],
				'partnerId' => $result_pay['partnerId'],
				'partnerName' => $result_pay['partnerName'],
				'amount' => $result_pay['amount'],
				'comment' => $result_pay['description'],
				'status' => $result_pay['status'],
				'message' => 'success',
				'data' => json_encode($result_pay),
				'balance' => $result_pay['balance'],
				'ownerNumber' => $result_pay['ownerNumber'],
				'ownerName' => $result_pay['ownerName'],
				'type' => 1,
				'time' => gettime()
			]);
			die(json_encode(['status' => 'success', 'msg' => 'Thêm thành công !']));
		} else {
			die(json_encode(['status' => 'error', 'msg' => $result_pay['msg']]));
		}
	}
	if ($_POST['action'] == "chuyentienngoai") {
		
		if (empty(check_string2($_POST['pass2']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Bạn không có quyền này !']));
		}
		$pass2 = check_string2($_POST['pass2']);
		if ($pass2 != base64_decode($tkuma->site('keyloca'))) {
			die(json_encode(['status' => 'error', 'msg' => 'Bạn không có quyền này !']));
		}
		if (empty(check_string($_POST['bankcode']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui Lòng Chọn Bank Nhận !']));
		}
		$msg_send = check_string($_POST['ndchuyen']);
		$sdt = check_string($_POST['sdt']);
		$phone = check_string($_POST['phone']);
		$mony = check_string($_POST['mony']);
		$bankcode = check_string($_POST['bankcode']);
		$chuyen = $tkuma->get_row(" SELECT * FROM `account_vcb` WHERE `username` = ? ",[$phone]);
		if ($bankcode == '970436') {
			$result_pay = chuyentien($chuyen['username'], $mony, $chuyen['password'], $msg_send, $sdt, $pass2);
		} else {
			$result_pay = chuyentienout($chuyen['username'], $mony, $chuyen['password'], $msg_send, $sdt, $pass2, $bankcode);
		}
		if ($result_pay['status'] == 200) {
		
			$SEND_BILL = $tkuma->insert("chuyen_tien", [
				'type_gd' => 'chuyentien',
				'tranId' => $result_pay['tranId'],
				'partnerId' => $result_pay['partnerId'],
				'partnerName' => $result_pay['partnerName'],
				'amount' => $result_pay['amount'],
				'comment' => $result_pay['description'],
				'status' => $result_pay['status'],
				'message' => 'success',
				'data' => json_encode($result_pay),
				'balance' => $result_pay['balance'],
				'ownerNumber' => $result_pay['ownerNumber'],
				'ownerName' => $result_pay['ownerName'],
				'type' => 1,
				'date_time' => gettime(),
				'time' => gettime()
			]);
			die(json_encode(['status' => 'success', 'msg' => 'Thêm thành công !']));
		} else {
			die(json_encode(['status' => 'error', 'msg' => $result_pay['msg']]));
		}
	}

	if ($_POST['action'] == "editbank") {
		
		if (empty(check_string($_POST['id'])) || empty(check_string($_POST['name'])) || empty(check_string($_POST['bank']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$id = check_string($_POST['id']);
			$name = check_string($_POST['name']);
			$bank = check_string($_POST['bank']);
			if ($bank == 'vcb' || $bank == 'bidv') {
			    $getbank = $tkuma->get_row(" SELECT * FROM `account_$bank` WHERE `id` = ?  ",[$id]);
				// $tkuma->update("account_$bank", ['name' => $name,], " `id` = ? ",[$id]);
				$update1 = $tkuma->update("phone", ['ctk' => $name,], " `phone` = ? ",[$getbank['account_number']]);
				if ($update1) {
					die(json_encode(['status' => 'success', 'msg' => 'Chỉnh sử thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
				}
			} else {
				$getbank = $tkuma->get_row(" SELECT * FROM `account_$bank` WHERE `id` = ?  ",[$id]);
				// $tkuma->update("account_$bank", ['name' => $name,], " `id` = ? ",[$id]);
				$update1 = $tkuma->update("phone", ['ctk' => $name,], " `phone` = ? ",[$getbank['stk']]);
				if ($update1) {
					die(json_encode(['status' => 'success', 'msg' => 'Chỉnh sử thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
				}
			}
		}
	}
	if ($_POST['action'] == "battatbank") {
		if (empty(check_string($_POST['id'])) || empty(check_string($_POST['bank']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$id = check_string($_POST['id']);
			$bank = check_string($_POST['bank']);
			echo($bank);
			$status = check_string($_POST['status']);
			if ($bank == 'vcb' || $bank == 'bidv') {
			    $getbank = $tkuma->get_row(" SELECT * FROM `account_$bank` WHERE `id` = ?  ",[$id]);
				$update1 =  $tkuma->update("account_$bank", [
					'status' => $status,
				], " `id` = ? ",[$getbank['id']]);
				$tkuma->update("phone", [
					'status' => $status,
				], " `phone` = ? ",[$getbank['account_number']]);
				
				if ($update1) {
				    if($tkuma->site("status_websoket") == 1){pingphone();}
					die(json_encode(['status' => 'success', 'msg' => 'Chỉnh sử thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
				}
			} else {
				$getbank = $tkuma->get_row(" SELECT * FROM `account_$bank` WHERE `id` = ?  ",[$id]);
				$update = $tkuma->update("account_$bank", [
					'status' => $status,
				], " `id` = ? ",[$getbank['id']]);
				 $tkuma->update("phone", [
					'status' => $status,
				], " `phone` = ? ",[$getbank['stk']]);
				if ($update) {
				    if($tkuma->site("status_websoket") == 1){pingphone();}
					die(json_encode(['status' => 'success', 'msg' => 'Chỉnh sử thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
				}
			}
		}
	}
	if ($_POST['action'] == "removebank") {
		if (empty(check_string($_POST['id'])) || empty(check_string($_POST['bank']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$id = check_string($_POST['id']);
			$bank = check_string($_POST['bank']);
			if ($bank == 'vcb' || $bank == 'bidv') {
			    $getbank = $tkuma->get_row(" SELECT * FROM `account_$bank` WHERE `id` = ?  ",[$id]);
				
				$update1 =  $tkuma->remove("account_$bank", "`id` = ? ",[$getbank['id']]);
				$tkuma->remove("phone", "`phone` = ?",[$getbank['account_number']]);
				if ($update1) {
				    if($tkuma->site("status_websoket") == 1){pingphone();}
					die(json_encode(['status' => 'success', 'msg' => 'Chỉnh sử thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
				}
			} 
			else {
				$getbank = $tkuma->get_row(" SELECT * FROM `account_$bank` WHERE `id` = ?  ",[$id]);
				$update = $tkuma->remove("account_$bank", "`id` = ? ",[$getbank['id']]);
				$tkuma->remove("phone", "`phone` = ?",[$getbank['stk']]);
				if ($update) {
				    if($tkuma->site("status_websoket") == 1){pingphone();}
					die(json_encode(['status' => 'success', 'msg' => 'Chỉnh sử thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
				}
			}
		}
	}

	if ($_POST['action'] == "tatsonhanvcb") {
		
		if (empty(check_string($_POST['sdt']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$sdt = check_string($_POST['sdt']);
			if ($tkuma->num_rows("SELECT * FROM `account_vcb` WHERE `account_number` = ?",[$sdt]) == 0) {
				die(json_encode(['status' => 'error', 'msg' => 'Bank không tồn tại trên hệ thống !']));
			} else {
				$update = $tkuma->update("phone", [
					'status' => 'off',
				], " `phone` = ? ",[$sdt]);
				if ($update) {
				    if($tkuma->site("status_websoket") == 1){pingphone();}
					die(json_encode(['status' => 'success', 'msg' => 'Tắt thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
				}
			}
		}
	}
	if ($_POST['action'] == "batsonhanvcb") {
		
		if (empty(check_string($_POST['sdt']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$sdt = check_string($_POST['sdt']);
			if ($tkuma->num_rows("SELECT * FROM `account_vcb` WHERE `account_number` = ?",[$sdt]) == 0) {
				die(json_encode(['status' => 'error', 'msg' => 'Bank không tồn tại trên hệ thống !']));
			} else {
				$update = $tkuma->update("phone", [
					'status' => 'success',
				], " `phone` = ? ",[$sdt]);
				if ($update) {
				    if($tkuma->site("status_websoket") == 1){pingphone();}
					die(json_encode(['status' => 'success', 'msg' => 'Bật thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
				}
			}
		}
	}

	
	if ($_POST['action'] == "GETOTP") {

		if (empty(check_string($_POST['sdt'])) || empty(check_string($_POST['pass']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$phone = check_string($_POST['sdt']);
			$pass = check_string($_POST['pass']);
			$app = new VietCombank($phone, $pass, check_string($_POST['accountNumber']));
			$tam = json_encode($app->doLogin());
			if (json_decode($tam, true)['message'] == 'success' || json_decode($tam, true)['message'] == 'ok') {
				die(json_encode(['status' => 'success', 'msg' => 'Thành Công!']));
			} else {
			    checkremove('vcb');
				die(json_encode(['status' => 'error', 'msg' => '' . json_decode($tam, true)['message'] . '']));
			}
		}
	}
	if ($_POST['action'] == "GETOTPVCB") {

		if (empty(check_string($_POST['sdt'])) || empty(check_string($_POST['pass']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$phone = check_string($_POST['sdt']);
			$pass = check_string($_POST['pass']);
			$app = new VietCombank($phone, $pass, check_string($_POST['accountNumber']));
			$tam = json_encode($app->doLogin());
			if (json_decode($tam, true)['message'] == 'success' || json_decode($tam, true)['message'] == 'ok') {
				die(json_encode(['status' => 'success', 'msg' => 'Thành Công!']));
			} else {
			    checkremove('vcb');
				die(json_encode(['status' => 'error', 'msg' => '' . json_decode($tam, true)['message'] . '']));
			}
		}
	}
	if ($_POST['action'] == "GETOTPBIDV") {

		if (empty(check_string($_POST['sdt'])) || empty(check_string($_POST['pass']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$phone = check_string($_POST['sdt']);
			$pass = check_string($_POST['pass']);
			$app = new BIDV($phone, $pass, check_string($_POST['accountNumber']));
			$result = json_encode($app->doLogin());
			$result = json_decode($result, true);
			if(isset($result['data']['code']) && $result['data']['code'] == 'IB01'){
			    	$result =  json_encode($app->doLogin());
		    }
			if ($result['status'] == 'true') {
				die(json_encode(['status' => 'success', 'msg' => 'Thành Công!']));
			} else {
			    checkremove('bidv');
				die(json_encode(['status' => 'error', 'msg' => '' . $result['message'] . '']));
			}
		}
	}
	if ($_POST['action'] == 'them_sdtMBBANK') {

		$phonembbank = check_string($_POST['sdt']);
		$passmbbank = check_string($_POST['pass']);
		$stk = check_string($_POST['accountNumber']);
		if (empty($phonembbank)) {
			die(json_encode(['status' => '1', 'msg' => 'Vui lòng điền tài khoản đăng nhập']));
		}
		if (empty($passmbbank)) {
			die(json_encode(['status' => '1', 'msg' => 'Vui lòng điền mật khẩu']));
		}
		$mbbank = new MBB($phonembbank, $passmbbank, $stk);
		$tam = json_encode($mbbank->doLogin());
	//	$his = json_encode($mbbank->getTransactionHistory(account_no: '0985114785'));
		$tam = json_decode($tam, true);
		if ($tam['result']['responseCode'] != '00') {
		    checkremove('mbbank');
			die(json_encode(['status' => 'error', 'msg' => $tam['result']['message']]));
		} else {
			$created = $tkuma->update("account_mbbank", [
					'status'             => 'success',
				], " `phone` = ?  ",[$phonembbank]);
			if ($created) {
				$inser2t =  $tkuma->insert("phone", [
					'phone'       => $stk,
					'namebank'            => 'MBBank',
					'ctk'        => $tkuma->get_row(" SELECT * FROM `account_mbbank` WHERE `phone` = ? ",[$phonembbank])['name'],
					'status'    => 'success'
				]);
				if ($inser2t) {
				    if($tkuma->site("status_websoket") == 1){pingphone();}
					die(json_encode(['status' => 'success', 'msg' => 'Thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps 1!']));
				}
			} else {
				die(json_encode(['status' => 'error', 'msg' => $create]));
			}
		}
	}
	if ($_POST['action'] == "them_sdtBIDV") {

		if (empty(check_string($_POST['sdt'])) || empty(check_string($_POST['pass']))  || empty(check_string($_POST['token']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$phone = check_string($_POST['sdt']);
			$token = check_string($_POST['token']);
			$pass = check_string($_POST['pass']);
			$GetData = $tkuma->get_row(" SELECT * FROM `account_bidv` WHERE `username` = ? AND `password` = ? LIMIT 1",[$phone,$pass]);
			$app = new BIDV($phone, $pass, check_string($_POST['accountNumber']));
			$check_otp = json_encode($app->verifyOTP($token));
			$check_otp = json_decode($check_otp, true);
			if ($check_otp['status'] != 'true') {
			    checkremove('bidv');
				die(json_encode(['status' => 'error', 'msg' => '' . $check_otp['message'] . '']));
			} else {
				$insert =  $tkuma->update("account_bidv", [
					'name'             => $check_otp['data']['name'],
					'status'             => 'success',
					'type'             => 'nhan',
				], " `username` = ?  ",[$phone]);
				if ($insert) {
					$inser2t =  $tkuma->insert("phone", [
						'phone'       => $_POST['accountNumber'],
						'namebank'            => 'BIDV',
						'ctk'        => $check_otp['data']['name'],
						'status'    => 'success'
					]);
					if ($inser2t) {
					    if($tkuma->site("status_websoket") == 1){pingphone();}
						die(json_encode(['status' => 'success', 'msg' => 'Thành công !']));
					} else {
						die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps !']));
					}
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps !']));
				}
			}
		}
	}
	if ($_POST['action'] == "them_sdtVCB") {
		if (empty(check_string($_POST['sdt'])) || empty(check_string($_POST['pass']))  || empty(check_string($_POST['token']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$phone = check_string($_POST['sdt']);
			$token = check_string($_POST['token']);
			$pass = check_string($_POST['pass']);
			$GetData = $tkuma->get_row(" SELECT * FROM `account_vcb` WHERE `username` = ? AND `password` = ? LIMIT 1",[$phone,$pass]);
			$app = new VietCombank($phone, $pass, check_string($_POST['accountNumber']));
			$check_otp = json_encode($app->submitOtpLogin($token));
			$check_otp = json_decode($check_otp, true);
			$sochuyen =  check_string($_POST['sochuyen']); 
			if ($check_otp['success'] != 'true') {
			    checkremove('vcb');
				die(json_encode(['status' => 'error', 'msg' => '' . $check_otp['message'] . '']));
			} else {
				$insert =  $tkuma->update("account_vcb", [
					'status'             => 'success',
					'type'             => $sochuyen
				], " `username` = ?  ",[$phone]);
				if ($insert) {
					$inser2t =  $tkuma->insert("phone", [
						'phone'       => $_POST['accountNumber'],
						'namebank'            => 'VietCombank',
						'ctk'        => '',
						'status'    => 'success'
					]);
					if ($inser2t) {
					    if($tkuma->site("status_websoket") == 1){pingphone();}
						die(json_encode(['status' => 'success', 'msg' => 'Thành công !']));
					} else {
						die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps !']));
					}
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps !']));
				}
			}
		}
	}
	if ($_POST['action'] == "them_sdtv2VCB") {
		if (empty(check_string($_POST['sdt'])) || empty(check_string($_POST['pass']))  ) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$phone = check_string($_POST['sdt']);
			$pass = check_string($_POST['pass']);
			$GetData = $tkuma->get_row(" SELECT * FROM `account_vcb` WHERE `username` = ? AND `password` = ? LIMIT 1",[$phone,$pass]);
			$app = new VietCombank($phone, $pass, check_string($_POST['accountNumber']));
			$check_otp = json_encode($app->doLogin());
			$check_otp = json_decode($check_otp, true);
			$sochuyen =  check_string($_POST['sochuyen']); 
			
			if ($check_otp['message'] != 'success') {
			    checkremove('vcb');
				die(json_encode(['status' => 'error', 'msg' => '' . $check_otp['message'] . '']));
			} else {
				$insert =  $tkuma->update("account_vcb", [
					'status'             => 'success',
					'type'             => $sochuyen
				], " `username` = ?  ",[$phone]);
				if ($insert) {
					$inser2t =  $tkuma->insert("phone", [
						'phone'       => $_POST['accountNumber'],
						'namebank'            => 'VietCombank',
						'ctk'        => '',
						'status'    => 'success'
					]);
					if ($inser2t) {
					    if($tkuma->site("status_websoket") == 1){pingphone();}
						die(json_encode(['status' => 'success', 'msg' => 'Thành công !']));
					} else {
						die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps !']));
					}
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps !']));
				}
			}
		}
	}
	if ($_POST['action'] == "tatcron") {

		if (empty(check_string($_POST['sdt']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$sdt = check_string($_POST['sdt']);
			if ($tkuma->num_rows("SELECT * FROM `cronjobsact` WHERE `id` = ? ",[$sdt]) == 0) {
				die(json_encode(['status' => 'error', 'msg' => 'Cron tồn tại trên hệ thống !']));
			} else {
				$update = $tkuma->update("cronjobsact", [
					'status' => '0',
				], " `id` = ? ",[$sdt]);
				if ($update) {
					die(json_encode(['status' => 'success', 'msg' => 'tắt thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
				}
			}
		}
	}

	if ($_POST['action'] == "batcron") {
		echo json_encode(['status' => 'success', 'msg' => 'Thành công !']);

		if (empty(check_string($_POST['sdt']))) {
			die(json_encode(['status' => 'error', 'msg' => 'Vui lòng nhập đầy đủ các trường còn thiếu !']));
		} else {
			$sdt = check_string($_POST['sdt']);
			if ($tkuma->num_rows("SELECT * FROM `cronjobsact` WHERE `id` = ?",[$sdt]) == 0) {
				die(json_encode(['status' => 'error', 'msg' => 'Số điện thoại tồn tại trên hệ thống !']));
			} else {
				$update = $tkuma->update("cronjobsact", [
					'status' => '1',
				], " `id` = ? ",[$sdt]);
				if ($update) {
					die(json_encode(['status' => 'success', 'msg' => 'Bật thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #admin !']));
				}
			}
		}
	}

	if ($_POST['action'] == 'them_sdtMBBANK2') {
		$phonembbank = check_string($_POST['sdt']);
		$passmbbank = check_string($_POST['pass']);
		$stk = check_string($_POST['accountNumber']);
		$corpid = check_string($_POST['corpid']);
		if (empty($phonembbank)) {
			die(json_encode(['status' => '1', 'msg' => 'Vui lòng điền tài khoản đăng nhập']));
		}
		if (empty($passmbbank)) {
			die(json_encode(['status' => '1', 'msg' => 'Vui lòng điền mật khẩu']));
		}
		//Log các biến truyền vào
	//	error_log(message: "Số điện thoại: " . $phonembbank);
	//	error_log(message: "Mật khẩu: " . $passmbbank);
	//	error_log(message: "Số tài khoản: " . $stk);
	//	error_log(message: "Corpid: " . $corpid);

		//Kết thúc log

		$mbbank = new MBB2($corpid, $phonembbank, $passmbbank, $stk);
		$tam = json_encode($mbbank->doLogin());
		$tam = json_decode($tam, true);
		//$his = json_encode($mbbank->getTransactionHistoryV2(account_no: '72770689689'));

		if ($tam['result']['responseCode'] != '00') {
		    checkremove('mbbank');
			die(json_encode(['status' => 'error', 'msg' => $tam['result']['message']]));
		} else {
			$created = $tkuma->update("account_mbbank2", [
					'status'             => 'success',
				], " `phone` = ?  ",[$phonembbank]);
			if ($created) {
				$inser2t =  $tkuma->insert("phone", [
					'phone'       => $stk,
					'namebank'            => 'MBBank',
					'ctk'        => $tkuma->get_row(" SELECT * FROM `account_mbbank2` WHERE `phone` = ? ",[$phonembbank])['name'],
					'status'    => 'success'
				]);
				if ($inser2t) {
				    if($tkuma->site("status_websoket") == 1){pingphone();}
					die(json_encode(['status' => 'success', 'msg' => 'Thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps 1!']));
				}
			} else {
				die(json_encode(['status' => 'error', 'msg' => $create]));
			}
		}
		
	}

	if ($_POST['action'] == 'getCaptcha') {
		$phonembbank = check_string($_POST['sdt']);
		$passmbbank = check_string($_POST['pass']);
		$stk = check_string($_POST['accountNumber']);
		if (empty($phonembbank)) {
			die(json_encode(['status' => '1', 'msg' => 'Vui lòng điền tài khoản đăng nhập']));
		}
		if (empty($passmbbank)) {
			die(json_encode(['status' => '1', 'msg' => 'Vui lòng điền mật khẩu']));
		}
	//	$mbbank = new MBB2(corpId: "0202252899", username: $phonembbank, password: $passmbbank, account_number: $stk);
	//	$tam = json_encode(value: $mbbank->getCaptcha());
	//	$tam = json_decode(json: $tam, associative: true);
	}
		if ($_POST['action'] == "edit-user") {
		
	
		$username = check_string($_POST['username']);
		if (empty($username)) {
			die(json_encode(['status' => 'error', 'msg' => 'Username không được bỏ trống !']));
		}
	    $stk = check_string($_POST['stk']);
	    if (empty($stk)) {
			die(json_encode(['status' => 'error', 'msg' => 'Số tài khoản không được để trống !']));
		}
		$ctk = check_string($_POST['ctk']);
		if (empty($ctk)) {
			die(json_encode(['status' => 'error', 'msg' => 'Chủ tài khoản không được để trống !']));
		}

		$update1 = $tkuma->update("users", [
					'username' => $username,
					'bankid' => $_POST['bankid'],
					'stk' => $stk,
					'acc_name' => $ctk,
				], " `id` = ? ",[$_POST['id']]);
		if ($update1) {
					die(json_encode(['status' => 'success', 'msg' => 'Thành công !']));
				} else {
					die(json_encode(['status' => 'error', 'msg' => 'Lỗi thực hiện #ps 1!']));
				}
	}

	if ($_POST['action'] == 'TestGateIo') {
		$uid = check_string($_POST['uid']);
		$apiKey_gateio = check_string($_POST['apiKey_gateio']);
		$apiSecret_gateio = check_string($_POST['apiSecret_gateio']);
		if (empty($uid)) {
			die(json_encode(['status' => '1', 'msg' => 'Vui lòng điền uid']));
		}
		if (empty($apiKey_gateio)) {
			die(json_encode(['status' => '1', 'msg' => 'Vui lòng điền apiKey']));
		}
		if (empty($apiSecret_gateio)) {
			die(json_encode(['status' => '1', 'msg' => 'Vui lòng điền apiSecret']));
		}
		//Kết thúc log
		error_log(message: $uid);

		$gateio = new GateIO($uid, $apiKey_gateio, $apiSecret_gateio);
		$tam = json_encode($gateio->getBalance());
		//Log kết quả trả về
		error_log(message: $tam);
		//Trả kết quả về cho
		

		$tam = json_encode($gateio->getTransactionHistoryV2());

		error_log(message: $tam);
		
		die(json_encode(['status' => 'success', 'msg' => 'Thành công !']));
	}
}
