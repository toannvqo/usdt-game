<?php

    define("IN_SITE", true);
    require_once(__DIR__ . '/libs/config.php');
    require_once(__DIR__ . '/libs/db.php');
    require_once(__DIR__ . '/libs/helper.php');

    $tkuma = new DB();    
 
    function insert_options($name, $value){
        global $tkuma;
        if (!$tkuma->get_row("SELECT * FROM `settings` WHERE `name` = ? ",[$name])) {
            $tkuma->insert("settings", [
                'name'  => $name,
                'value' => $value
            ]);
        }
    }
    
    $tkuma->query(" CREATE TABLE `account_bidv` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `username` TEXT NULL , `account_number` TEXT NULL , `password` TEXT NULL , `name` TEXT NULL , `sessionId` TEXT NULL , `mobileId` TEXT NULL , `clientId` TEXT NULL , `cif` TEXT NULL , `E` TEXT NULL , `accessToken` TEXT NULL , `authToken` TEXT NULL, `otp` TEXT NULL, `time` TEXT NULL, `BALANCE` TEXT NULL, `status` TEXT NULL, `type` TEXT NULL, `token` VARCHAR(255) NULL DEFAULT NULL , `msg` TEXT NULL, PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `account_mbbank` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `username` TEXT NULL , `phone` TEXT NULL , `stk` TEXT NULL , `name` TEXT NULL , `password` TEXT NULL , `sessionId` TEXT NULL , `deviceId` TEXT NULL , `token` TEXT NULL , `time` INT(11) NOT NULL DEFAULT '0' , `status` TEXT NULL , `BALANCE` TEXT NULL, PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `account_vcb` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `username` TEXT NULL , `account_number` TEXT NULL , `password` TEXT NULL , `name` TEXT NULL , `sessionId` TEXT NULL , `mobileId` TEXT NULL , `clientId` TEXT NULL , `cif` TEXT NULL , `E` TEXT NULL , `res` TEXT NULL , `tranId` TEXT NULL, `browserToken` TEXT NULL, `browserId` TEXT NULL, `otp` TEXT NULL, `time` TEXT NULL, `BALANCE` TEXT NULL, `status` TEXT NULL, `type` TEXT NULL, `typech` INT(11) NOT NULL DEFAULT '0', `token` VARCHAR(255) NULL DEFAULT NULL, `msg` TEXT NULL, PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `bankcode` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `desc2` TEXT NULL , `bankname` TEXT NULL , `bankcode` INT(11) NOT NULL DEFAULT '0', PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `chuyen_tien` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `type_gd` TEXT NULL , `momo_id` VARCHAR(255) NULL DEFAULT NULL , `tranId` VARCHAR(255) NULL DEFAULT NULL, `partnerId` VARCHAR(255) NULL DEFAULT NULL, `partnerName` TEXT NULL , `amount` INT(11) NOT NULL DEFAULT '0' , `comment` TEXT NULL, `time` TEXT NULL, `date_time` DATETIME NOT NULL, `status` VARCHAR(255) NULL DEFAULT NULL, `message` TEXT NULL, `balance` VARCHAR(255) NULL DEFAULT NULL, `ownerNumber` VARCHAR(255) NULL DEFAULT NULL, `ownerName` VARCHAR(255) NULL DEFAULT NULL, `data` TEXT NULL, `type` INT(11) NOT NULL DEFAULT '1', PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `cronjobsact` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NULL DEFAULT NULL , `url` VARCHAR(255) NULL DEFAULT NULL, `status` INT(11) NOT NULL DEFAULT '0', `dataend` TEXT NULL , `user_id` INT(11) NOT NULL DEFAULT '0' , `time` INT(11) NOT NULL DEFAULT '0' , `method` VARCHAR(255) NULL DEFAULT NULL, `maxload` INT(11) NOT NULL DEFAULT '0', `timeload` INT(11) NOT NULL DEFAULT '0', `get_time` INT(11) NOT NULL DEFAULT '0', `update_time` VARCHAR(255) NULL DEFAULT NULL, PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `danh_sach_game` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `mo_ta` TEXT NULL , `status` TEXT NULL, `ten_game` TEXT NULL, `ma_game` TEXT NULL , `type` TEXT NULL , `dscrtype` TEXT NULL, `time` TEXT NULL, PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `diemdanh_win` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `phien_thang` TEXT NULL , `trangthai` VARCHAR(255) NULL DEFAULT NULL, `sdt` TEXT NULL, `tien_nhan` TEXT NULL , `time` TEXT NULL, PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `event` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `keyd` TEXT NULL , `game` VARCHAR(255) NULL DEFAULT NULL, `mota` TEXT NULL, `moc1` VARCHAR(255) NULL DEFAULT NULL , `thuong1` VARCHAR(255) NULL DEFAULT NULL, `moc2` VARCHAR(255) NULL DEFAULT NULL, `thuong2` VARCHAR(255) NULL DEFAULT NULL, `moc3` VARCHAR(255) NULL DEFAULT NULL, `thuong3` VARCHAR(255) NULL DEFAULT NULL, `moc4` VARCHAR(255) NULL DEFAULT NULL, `thuong4` VARCHAR(255) NULL DEFAULT NULL, `moc5` VARCHAR(255) NULL DEFAULT NULL, `thuong5` VARCHAR(255) NULL DEFAULT NULL, `toithieu` TEXT NULL, `trangthai` VARCHAR(255) NULL DEFAULT NULL, PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `giftcode` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `giftcode` TEXT NULL , `money` INT(11) NOT NULL DEFAULT '0', `gioi_han` INT(11) NOT NULL DEFAULT '0', `da_nhap` INT(11) NOT NULL DEFAULT '0' , `time` TEXT NULL, `min` INT(11) NOT NULL DEFAULT '0',PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `lich_su_choi` ( `id` bigint(20) NOT NULL AUTO_INCREMENT , `phone` VARCHAR(255) NULL DEFAULT NULL , `phone_nhan` VARCHAR(255) NULL DEFAULT NULL, `tranId` VARCHAR(255) NULL DEFAULT NULL,`tranid2` VARCHAR(255) NOT NULL DEFAULT '0', `partnerName` TEXT NULL, `id_momo` TEXT NULL, `amount_play` VARCHAR(255) NULL DEFAULT NULL, `amount_game` TEXT NULL, `comment` TEXT NULL, `game` TEXT NULL, `ma_game` TEXT NULL, `result` TEXT NULL , `result_text` TEXT NULL , `msg_send` TEXT NULL, `type_gd` TEXT NULL, `status` TEXT NULL, `result_number` TEXT NULL, `time_tran` TEXT NULL, `time` TEXT NULL,`sttbot` INT(11) NOT NULL DEFAULT '0', `databill` TEXT NULL, `md5bill` TEXT NULL, PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `logs` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `user_id` INT(11) NOT NULL DEFAULT '0' , `ip` VARCHAR(255) NULL DEFAULT NULL, `device` VARCHAR(255) NULL DEFAULT NULL, `createdate`  DATETIME NOT NULL, `action` TEXT NULL,PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `momo_band` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `sdt` TEXT NULL , `status` TEXT NULL, `createdate`  DATETIME NOT NULL,PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `phiendiemdanh` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `phien` VARCHAR(255) NULL DEFAULT NULL , `timephien` TEXT NULL, `phiennext` TEXT NULL,PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `phone` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `phone` TEXT NULL , `namebank` TEXT NULL, `ctk` TEXT NULL, `status` TEXT NULL,PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `settings` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NULL DEFAULT NULL , `value` TEXT NULL ,PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `settings_game` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `keyd` VARCHAR(255) NULL DEFAULT NULL , `comment` TEXT NULL, `tile` TEXT NULL , `result` VARCHAR(255) NULL DEFAULT NULL, `type` TEXT NULL, `phan_game` TEXT NULL,PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `tb_pusher` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `pusher_app_id` VARCHAR(255) NULL DEFAULT NULL , `pusher_cluster` VARCHAR(255) NULL DEFAULT NULL, `pusher_key` VARCHAR(255) NULL DEFAULT NULL, `pusher_secret` VARCHAR(255) NULL DEFAULT NULL ,PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `theme` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NULL DEFAULT NULL ,PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `users` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NULL DEFAULT NULL, `password` VARCHAR(255) NULL DEFAULT NULL , `email` VARCHAR(255) NULL DEFAULT NULL, `bankname` TEXT NULL, `bankid` VARCHAR(255) NULL DEFAULT NULL, `stk` TEXT NULL, `website` VARCHAR(255) NULL DEFAULT NULL, `admin` INT(11) NOT NULL DEFAULT '0', `ctv` INT(11) NOT NULL DEFAULT '0', `banned` INT(11) NOT NULL DEFAULT '0', `create_date` DATETIME NOT NULL , `update_date` DATETIME NOT NULL, `time_session` INT(11) NOT NULL DEFAULT '0', `time_request` INT(11) NOT NULL DEFAULT '0' , `ip` VARCHAR(255) NULL DEFAULT NULL, `token` VARCHAR(255) NULL DEFAULT NULL, `money` INT(11) NOT NULL DEFAULT '0', `total_money` INT(11) NOT NULL DEFAULT '0', `rankings` INT(11) NOT NULL DEFAULT '0', `icon_ranking` TEXT NULL, `gender` VARCHAR(255) NULL DEFAULT NULL, `device` TEXT NULL, `avatar` TEXT NULL, `about` TEXT NULL, `status_2fa` INT(11) NOT NULL DEFAULT '0', `SecretKey_2fa` VARCHAR(255) NULL DEFAULT NULL, `chietkhau` FLOAT NOT NULL DEFAULT '0', `spin` INT(11) NOT NULL DEFAULT '0', `code_mail` INT(11) NOT NULL DEFAULT '0', `very` TEXT NULL,PRIMARY KEY (`id`), UNIQUE (`username`), UNIQUE (`token`) ) ");
    $tkuma->query(" CREATE TABLE `user_diemdanh` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `phone` TEXT NULL , `phiendiemdanh` TEXT NULL, `status` TEXT NULL, `amount` TEXT NULL, `time` TEXT NULL ,PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `user_giftcode` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `phone` TEXT NULL , `giftcode` TEXT NULL, `amount` TEXT NULL, `time` TEXT NULL , `status` INT(11) NOT NULL DEFAULT '0',PRIMARY KEY (`id`) ) ");
    $tkuma->query(" CREATE TABLE `user_nvn` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `phone` TEXT NULL , `mocthuong` TEXT NULL, `amount` TEXT NULL, `time` TEXT NULL, `status` INT(11) NOT NULL DEFAULT '0' ,PRIMARY KEY (`id`) ) ");
    
    $tkuma->insertins("bankcode", ['id' => 1,'desc2'  => 'VIETINBANK','bankname' => 'VIETINBANK', 'bankcode'  => '970415']);
    $tkuma->insertins("bankcode", ['id' => 2,'desc2'  => 'VIETCOMBANK','bankname' => 'VIETCOMBANK', 'bankcode'  => '970436']);
    $tkuma->insertins("bankcode", ['id' => 3,'desc2'  => 'AGRIBANK','bankname' => 'AGRIBANK', 'bankcode'  => '970405']);
    $tkuma->insertins("bankcode", ['id' => 4,'desc2'  => 'TPBANK','bankname' => 'TPBANK', 'bankcode'  => '970423']);
    $tkuma->insertins("bankcode", ['id' => 5,'desc2'  => 'HDB','bankname' => 'HDB', 'bankcode'  => '970437']);
    $tkuma->insertins("bankcode", ['id' => 6,'desc2'  => 'VPBANK','bankname' => 'VPBANK', 'bankcode'  => '970432']);
    $tkuma->insertins("bankcode", ['id' => 7,'desc2'  => 'MBBANK','bankname' => 'MBBANK', 'bankcode'  => '970422']);
    $tkuma->insertins("bankcode", ['id' => 8,'desc2'  => 'OCEANBANK','bankname' => 'OCEANBANK', 'bankcode'  => '970414']);
    $tkuma->insertins("bankcode", ['id' => 9,'desc2'  => 'BIDV','bankname' => 'BIDV', 'bankcode'  => '970418']);
    $tkuma->insertins("bankcode", ['id' => 10,'desc2'  => 'SACOMBANK','bankname' => 'SACOMBANK', 'bankcode'  => '970403']);
    $tkuma->insertins("bankcode", ['id' => 11,'desc2'  => 'ACB','bankname' => 'ACB', 'bankcode'  => '970416']);
    $tkuma->insertins("bankcode", ['id' => 12,'desc2'  => 'ABBANK','bankname' => 'ABBANK', 'bankcode'  => '970425']);
    $tkuma->insertins("bankcode", ['id' => 13,'desc2'  => 'CIMB','bankname' => 'CIMB', 'bankcode'  => '422589']);
    $tkuma->insertins("bankcode", ['id' => 14,'desc2'  => 'EXIMBANK','bankname' => 'EXIMBANK', 'bankcode'  => '970431']);
    $tkuma->insertins("bankcode", ['id' => 15,'desc2'  => 'SEABANK','bankname' => 'SEABANK', 'bankcode'  => '970440']);
    $tkuma->insertins("bankcode", ['id' => 16,'desc2'  => 'SCB','bankname' => 'SCB', 'bankcode'  => '970429']);
    $tkuma->insertins("bankcode", ['id' => 17,'desc2'  => 'DONGABANK','bankname' => 'DONGABANK', 'bankcode'  => '970406']);
    $tkuma->insertins("bankcode", ['id' => 18,'desc2'  => 'SAIGONBANK','bankname' => 'SAIGONBANK', 'bankcode'  => '970400']);
    $tkuma->insertins("bankcode", ['id' => 19,'desc2'  => 'PGBANK','bankname' => 'PG BANK', 'bankcode'  => '970430']);
    $tkuma->insertins("bankcode", ['id' => 20,'desc2'  => 'PVCOMBANK','bankname' => 'PVCOMBANK', 'bankcode'  => '970412']);
    $tkuma->insertins("bankcode", ['id' => 21,'desc2'  => 'KIENLONGBANK','bankname' => 'KIENLONGBANK', 'bankcode'  => '970452']);
    $tkuma->insertins("bankcode", ['id' => 22,'desc2'  => 'VIETCAPITALBANK','bankname' => 'VIETCAPITAL BANK', 'bankcode'  => '970454']);
    $tkuma->insertins("bankcode", ['id' => 23,'desc2'  => 'OCB','bankname' => 'OCB', 'bankcode'  => '970448']);
    $tkuma->insertins("bankcode", ['id' => 24,'desc2'  => 'MSB','bankname' => 'MSB', 'bankcode'  => '970426']);
    $tkuma->insertins("bankcode", ['id' => 25,'desc2'  => 'SHB','bankname' => 'SHB', 'bankcode'  => '970443']);
    $tkuma->insertins("bankcode", ['id' => 26,'desc2'  => 'VIETBANK','bankname' => 'VIETBANK', 'bankcode'  => '970433']);
    $tkuma->insertins("bankcode", ['id' => 27,'desc2'  => 'VRB','bankname' => 'VietNam - Russia Bank', 'bankcode'  => '970421']);
    $tkuma->insertins("bankcode", ['id' => 28,'desc2'  => 'NAMABANK','bankname' => 'NAMA BANK', 'bankcode'  => '970428']);
    $tkuma->insertins("bankcode", ['id' => 29,'desc2'  => 'VIB','bankname' => 'VIB BANK', 'bankcode'  => '970441']);
    $tkuma->insertins("bankcode", ['id' => 30,'desc2'  => 'TECHCOMBANK','bankname' => 'TECHCOMBANK', 'bankcode'  => '970407']);
    
    insert_options('status_demo', 0);
    insert_options('type_password', 'bcrypt');
    insert_options('title', 'CODE BANK');
    insert_options('description', 'CLMM CLZL TECH - Chẵn Lẻ Zalo Online -  Chẵn Lẻ Momo Online - Hệ thống trò chơi Chẵn lẻ Zalo,Chẵn lẻ Momo giao dịch hoàn toàn tự động 24/7');
    insert_options('keywords', '');
    insert_options('favicon', 'assets/storage/theme/Y2HRNV.png');
    insert_options('anhbia', 'assets/storage/theme/YLR7BT.png');
    insert_options('author', 'tkuma');
    insert_options('color', '#16537e');
    insert_options('color_head', 'rgba(14, 72, 101, 0.91)');
    insert_options('color_end', '#6aa84f');
    insert_options('color_button', '#c90076');
    insert_options('color_text', 'black');
    insert_options('status', 1);
    insert_options('session_login', 10000000);
    insert_options('facebook', '');
    insert_options('zalo', '');
    insert_options('currency', 'VND');
    insert_options('nofication_ex', '');
    insert_options('notification', '');
    insert_options('token_telegram', '');
    insert_options('id_telegram', '');
    insert_options('telegram', '');
    insert_options('script', 'tkuma');
    insert_options('license_key', '89ef2fdc5edbdb8d636f066fe9040a');
    insert_options('home_page', 'theme1');
    insert_options('status_captcha', '0');
    insert_options('status_randommsg', 1);
    insert_options('random_msg', 'Thanh Toán Lương,Thanh Toán Học Phí,Thanh Toán Dầu,Mua Vé Xem Phim,Mã Vé Tàu,Thanh Toán Vé Tàu,Mua Vé Số,Ga Tàu Số,Chi Trả Lương,Lương Số Phiếu,Mã Phiếu Siêu Thị,Mã Số Tàu');
    insert_options('msg_game', 'CHÚC MỪNG BẠN x');
    insert_options('msg_event', 'TẶNG BẠN EVENT');
    insert_options('msg_giftcode', 'TẶNG BẠN GIFTCODE');
    insert_options('dscr', 'Bank');
    insert_options('status_randommsgnd', 1);
    insert_options('band', '40');
    insert_options('themex', 'index');
    insert_options('telegrambot', '');
    insert_options('telegrambox', '');
    insert_options('status_del', 0);
    insert_options('time_del', '259200');
    insert_options('random_msgnd', '1Thanh Toán Lương,Thanh Toán Học Phí,Thanh Toán Dầu,Mua Vé Xem Phim,Mã Vé Tàu,Thanh Toán Vé Tàu,Mua Vé Số,Ga Tàu Số,Chi Trả Lương,Lương Số Phiếu,Mã Phiếu Siêu Thị,Mã Số Tàu');
    insert_options('status_bot', 1);
    insert_options('time_bot', 0);
    insert_options('status_lst', 0);
    insert_options('statusweb', 1);
    insert_options('status_nd', 1);
    insert_options('cachchoi', '<p><strong>lưu &yacute; : kh&ocirc;ng nhận giao dịch tạo bằng web ng&acirc;n h&agrave;ng .&nbsp;</strong>kh&ocirc;ng hỗ trợ bill sai hoặc thiếu nội dung, sai hạn mức.<br /><strong>- chơi c&ugrave;ng bank sẽ d&ugrave;ng m&atilde; b&ecirc;n gửi . chơi kh&aacute;c bank sẽ d&ugrave;ng m&atilde; b&ecirc;n nhận.<br /> - ri&ecirc;ng VCB phải chơi c&ugrave;ng bank ( kh&aacute;c bank sẽ kh&ocirc;ng nhận - bảo tr&igrave; từ 23h đ&ecirc;m đến 6h s&aacute;ng h&ocirc;m sau )<br />-&nbsp; bidv + vietinbank ( BẢO TR&Igrave; từ 23h đến 6h s&aacute;ng h&ocirc;m sau ) m&atilde; giao dịch l&agrave; chữ n&ecirc;n sẽ quy đổi th&agrave;nh số, chi tiết xem tại nh&oacute;m th&ocirc;ng b&aacute;o.<br />- chơi v&agrave;o những bank trong thời gian quy định BẢO TR&Igrave; sẽ kh&ocirc;ng được t&iacute;nh kh&ocirc;ng được ho&agrave;n.</strong><br />&nbsp;CHUYỂN LI&Ecirc;N BANK NỘI DUNG C&Oacute; THỂ BỊ NG&Acirc;N H&Agrave;NG TH&Ecirc;M THẮT HOẶC THAY ĐỔI. HT T&Iacute;NH THEO NỘI DUNG BANK HT NHẬN ĐƯỢC.</p>');
    insert_options('status_noti', 0);
    insert_options('keyloca', '');
    insert_options('phonebot', '0569108017,0568047321,0562416610,0968144427,0568023523,0567508971,0563300799,0562416610,0706553035,0862946765,0395327964,0918241756,0366784935,0704567183');
    insert_options('monybot', '16000,14000,12000,17000,22000,24000,26000,29000,34000,36000,37000,41000,45000,48000,56000,55000,10000,15000,30000,20000,50000,111000,130000,150000,160000,180000,190000,100000,200000,1500000,300000,500000,1000000,2000000,5000000,3000000,4000000,3500000,2500000,1500000,1110000,1600000,160000,1111000,80000,198000,19000');
    insert_options('maxbot', '40');
    insert_options('randomnamebot', 'Nguyễn Phương,Phương Đại,Lều Việt, Việt Sơn,Đỗ Cao ,Cao Thọ,Nguyễn Quang , Quang Quy,Lâm Vinh ,Vinh Quốc,Huỳnh Tấn ,Tấn Tài,Thị Mỹ ,Mỹ Hai,Trần Kiến,Kiến Đức,Nguyễn Vĩnh ,Vĩnh Thạch,Nguyễn Khánh ,Khánh Luân,Lư Hà,Gia Bảo, Trần Kiến ,Kiến Đức,Vũ Đăng ,Đăng Tùng');
    insert_options('pin_cron', 'domain');
    insert_options('ndnaptien', 'testned');
    insert_options('ipserver', '');
    insert_options('pin_admin', 'domain');
    insert_options('mingame', '10000');
    insert_options('maxgame', '1000000');
    insert_options('status_footercustom', '');
    insert_options('html_footer', '');
    insert_options('pluginchat', '');
    insert_options('status_pluginchat', '');
    insert_options('status_facetop', '0');
    insert_options('toptuan1', '');
    insert_options('toptuan2', '');
    insert_options('toptuan3', '');
    insert_options('toptuan4', '');
    insert_options('toptuan5', '');
    insert_options('usertuan1', '');
    insert_options('usertuan2', '');
    insert_options('usertuan3', '');
    insert_options('usertuan4', '');
    insert_options('usertuan5', '');
    insert_options('noti_gift', '');
    insert_options('status_websoket', '0');
    insert_options('websoket', '');
    insert_options('status_themeuser', '1');
    insert_options('notisendtele', '┏━━━━━━━━━━━━━┓
┣➤ MGD: {tranid}
┣➤ Kết Quả: {ketqua}
┣➤ Tiền Thắng: {tienthang}
┣➤ Người Chơi:  {userwin}
┣➤Thời gian:  {thoigian}
┗━━━━━━━━━━━━━┓
┏━━━━━━━━━━━━━┛
┣ NỘI DUNG: {noidungchuyen}   ({gamechoi})
┗━━━━━━━━━━━━━┛');
    insert_options('server_captcha', '1');
    insert_options('status_bipmbbank', '0');
    insert_options('status_bipvcb', '1');
    insert_options('status_bipbidv', '0');
    insert_options('tylethua', '7');



    $tkuma->insertins("cronjobsact", [ 'id' => 2,'name' => 'Cron BIDV',  'url' => 'ajaxs/cron/bidv.php', 'status'   => 1, 'dataend' => '30', 'user_id'  => 1,'time' => 1, 'method' => 'GET', 'maxload' => 10,'timeload'  => '1705718817','get_time' => 1,'update_time' => '2023/07/17 14:36:35' ]);
    $tkuma->insertins("cronjobsact", [ 'id' => 3,'name' => 'Cron Điểm danh',  'url' => 'ajaxs/cron/crondiemdanh.php', 'status'   => 1, 'dataend' => '30', 'user_id'  => 1,'time' => 1, 'method' => 'GET', 'maxload' => 10,'timeload'  => '1705718817','get_time' => 1,'update_time' => '2023/07/17 14:36:35' ]);
    $tkuma->insertins("cronjobsact", [ 'id' => 4,'name' => 'Cron Trả Thưởng',  'url' => 'ajaxs/cron/crontrathuong.php', 'status'   => 1, 'dataend' => '30', 'user_id'  => 1,'time' => 1, 'method' => 'GET', 'maxload' => 10,'timeload'  => '1705718817','get_time' => 1,'update_time' => '2023/07/17 14:36:35' ]);
    $tkuma->insertins("cronjobsact", [ 'id' => 5,'name' => 'Cron MBbank',  'url' => 'ajaxs/cron/mbbank.php', 'status'   => 1, 'dataend' => '30', 'user_id'  => 1,'time' => 1, 'method' => 'GET', 'maxload' => 10,'timeload'  => '1705718817','get_time' => 1,'update_time' => '2023/07/17 14:36:35' ]);
    $tkuma->insertins("cronjobsact", [ 'id' => 6,'name' => 'Cron VCB',  'url' => 'ajaxs/cron/vcbank.php', 'status'   => 1, 'dataend' => '30', 'user_id'  => 1,'time' => 1, 'method' => 'GET', 'maxload' => 10,'timeload'  => '1705718817','get_time' => 1,'update_time' => '2023/07/17 14:36:35' ]);
    $tkuma->insertins("cronjobsact", [ 'id' => 7,'name' => 'Cron BOT',  'url' => 'ajaxs/cron/botauto.php', 'status'   => 1, 'dataend' => '30', 'user_id'  => 1,'time' => 1, 'method' => 'GET', 'maxload' => 10,'timeload'  => '1705718817','get_time' => 1,'update_time' => '2023/07/17 14:36:35' ]);
    $tkuma->insertins("cronjobsact", [ 'id' => 8,'name' => 'Cron Quét Nhiệm Vụ Ngày',  'url' => 'ajaxs/cron/nhienvungayauto.php', 'status'   => 1, 'dataend' => '30', 'user_id'  => 1,'time' => 5, 'method' => 'GET', 'maxload' => 10,'timeload'  => '1705718817','get_time' => 44,'update_time' => '2023/07/17 14:36:35' ]);
    $tkuma->insertins("cronjobsact", [ 'id' => 9,'name' => 'Cron MBbank doanh nghiệp',  'url' => 'ajaxs/cron/mbbank2.php', 'status'   => 1, 'dataend' => '30', 'user_id'  => 1,'time' => 1, 'method' => 'GET', 'maxload' => 10,'timeload'  => '1705718817','get_time' => 1,'update_time' => '2023/07/17 14:36:35' ]);
    
    
    

    $tkuma->insertins("danh_sach_game", [ 'id' => 2,'mo_ta' => 'Chẵn lẻ là game tính thưởng bằng số cuối mã GD','status' => 'run','ten_game'   => 'Chẵn lẻ','ma_game' => 'chan-le','type'  => 'socuoi','dscrtype' => '1','time' => '2022-06-07 00:08:31']);
    $tkuma->insertins("danh_sach_game", [ 'id' => 3,'mo_ta' => 'Chẵn lẻ 2 là game tính thưởng bằng số cuối mã GD','status' => 'run','ten_game'   => 'Chẵn lẻ 2','ma_game' => 'chan-le-2','type'  => 'socuoi','dscrtype' => '1','time' => '2022-06-07 00:08:31']);
    $tkuma->insertins("danh_sach_game", [ 'id' => 4,'mo_ta' => 'Tài xỉu là game tính thưởng bằng số cuối mã GD','status' => 'run','ten_game'   => 'Tài xỉu','ma_game' => 'tai-xiu','type'  => 'socuoi','dscrtype' => '1','time' => '2022-06-07 00:08:31']);
    $tkuma->insertins("danh_sach_game", [ 'id' => 5,'mo_ta' => 'Tài xỉu 2 là game tính thưởng bằng số cuối mã GD','status' => 'run','ten_game'   => 'Tài xỉu 2','ma_game' => 'tai-xiu-2','type'  => 'socuoi','dscrtype' => '1','time' => '2022-06-07 00:08:31']);
    $tkuma->insertins("danh_sach_game", [ 'id' => 6,'mo_ta' => '1 phần 3 là game tính thưởng bằng số cuối mã GD','status' => 'run','ten_game'   => '1 phần 3','ma_game' => '1-phan-3','type'  => 'socuoi','dscrtype' => '1','time' => '2022-06-07 00:08:31']);
    $tkuma->insertins("danh_sach_game", [ 'id' => 7,'mo_ta' => 'MMH3 là game tính thưởng bằng số cuối mã GD','status' => 'run','ten_game'   => 'MMH3','ma_game' => 'h3','type'  => 'hieu','dscrtype' => '2','time' => '2022-06-07 00:08:31']);
    $tkuma->insertins("danh_sach_game", [ 'id' => 10,'mo_ta' => 'Nội dung chuyển tiền CX - LT - LX - CT','status' => 'off','ten_game'   => 'Xiên','ma_game' => 'xien','type'  => 'socuoi','dscrtype' => '1','time' => '2022-06-07 00:08:31']);
    $tkuma->insertins("danh_sach_game", [ 'id' => 11,'mo_ta' => 'là một game vô cùng dễ, tính kết quả bằng 2 hoặc 3...','status' => 'run','ten_game'   => 'Lô','ma_game' => 'lo','type'  => 'socuoi','dscrtype' => '2','time' => '2022-06-07 00:08:31']);


    $tkuma->insertins("event", [ 'id' => 1,'keyd' => 'nhiem-vu-ngay', 'game' => 'Nhiệm Vụ Ngày', 'mota' => '<p>- Thật tuyệt vời ! Mỗi ng&agrave;y chỉ cần chơi...',  'moc1' => '500000', 'thuong1' => '40000','moc2'  => '1000000', 'thuong2'   => '80000', 'moc3'  => '2000000','thuong3'   => '160000','moc4'  => '5000000','thuong4' => '400000','moc5'  => '10000000','thuong5' => '800000','toithieu' => '','trangthai' => 'run']);
    $tkuma->insertins("event", [ 'id' => 2,'keyd' => 'diem-danh', 'game' => 'Điểm Danh', 'mota' => '<p>- Thật tuyệt vời ! Mỗi ng&agrave;y chỉ cần chơi...',  'moc1' => '1000', 'thuong1' => '','moc2'  => '20000', 'thuong2'   => '', 'moc3'  => '','thuong3'   => '','moc4'  => '','thuong4' => '','moc5'  => '','thuong5' => '','toithieu' => '10000','trangthai' => 'run']);
    $tkuma->insertins("event", [ 'id' => 3,'keyd' => 'top-tuan', 'game' => 'TOP TUẦN', 'mota' => '<p>- Thật tuyệt vời! Mỗi ngày chỉ cần chơi trên website của chúng tôi thì bạn chắc chắn bạn sẽ nhận được tiền thưởng.</p><p>- Nhập vào số điện thoại của bạn để kiểm tra số tiền đã chơi.</p><p>- Hãy nhập số điện thoại của bạn vào mục bên trên để kiểm tra đã chơi bao nhiêu nhé.</p><p>- Chú ý : Phải nhập sdt là số cũ vd: 082xxx -> 0129xxx , 03xxx -> 016...</p><p>- Khi chơi đủ mốc tiền, các bạn ấn vào nhận thưởng để nhận được các mốc như sau:</p>',  'moc1' => '', 'thuong1' => '200000','moc2'  => '', 'thuong2'   => '100000', 'moc3'  => '','thuong3'   => '70000','moc4'  => '','thuong4' => '50000','moc5'  => '','thuong5' => '20000','toithieu' => '','trangthai' => 'run']);
    $tkuma->insertins("event", [ 'id' => 4,'keyd' => 'no-hu', 'game' => 'Hủ Sảnh', 'mota' => '<p>⛔️ LƯU &Yacute; : Sự kiện kh&ocirc;ng ph&acirc;n biệt thắng/thua, chỉ &aacute;p dụng với c&aacute;c m&atilde; giao dịch từ 20K trở l&ecirc;n.</p>',  'moc1' => '', 'thuong1' => '','moc2'  => '', 'thuong2'   => '', 'moc3'  => '','thuong3'   => '33333','moc4'  => '','thuong4' => '44444','moc5'  => '','thuong5' => '55555','toithieu' => '','trangthai' => 'run']);
    
     $tkuma->insertins("phiendiemdanh", ['id'   => 1,'phien' => '11371','timephien' => '2023-08-23 22:59:35','phiennext' => '2023-08-23 22:59:35']);

    $tkuma->insertins("settings_game", ['id'   => 1,'keyd' => 'chan-le','comment' => 'L','tile' => '2.5', 'result' => '1,3,5,7', 'type' => '1', 'phan_game' => 'comment_1']);
    $tkuma->insertins("settings_game", ['id'   => 2,'keyd' => 'chan-le','comment' => 'C','tile' => '2.5', 'result' => '2,4,6,8', 'type' => '1', 'phan_game' => 'comment_2']);
    $tkuma->insertins("settings_game", ['id'   => 3,'keyd' => 'chan-le-2','comment' => 'L2','tile' => '1.98', 'result' => '1,3,5,7,9', 'type' => '1', 'phan_game' => 'comment_1']);
    $tkuma->insertins("settings_game", ['id'   => 4,'keyd' => 'chan-le-2','comment' => 'C2','tile' => '1.98', 'result' => '0,2,4,6,8', 'type' => '1', 'phan_game' => 'comment_2']);
    $tkuma->insertins("settings_game", ['id'   => 5,'keyd' => 'tai-xiu','comment' => 'T','tile' => '2.5', 'result' => '1,2,3,4', 'type' => '1', 'phan_game' => 'comment_1']);
    $tkuma->insertins("settings_game", ['id'   => 6,'keyd' => 'tai-xiu','comment' => 'X','tile' => '2.5', 'result' => '5,6,7,8', 'type' => '1', 'phan_game' => 'comment_2']);
    $tkuma->insertins("settings_game", ['id'   => 7,'keyd' => 'tai-xiu-2','comment' => 'T2','tile' => '1.98', 'result' => '0,1,2,3,4', 'type' => '1', 'phan_game' => 'comment_1']);
    $tkuma->insertins("settings_game", ['id'   => 8,'keyd' => 'tai-xiu-2','comment' => 'X2','tile' => '1.98', 'result' => '5,6,7,8,9', 'type' => '1', 'phan_game' => 'comment_2']);
    $tkuma->insertins("settings_game", ['id'   => 9,'keyd' => '1-phan-3','comment' => 'N0','tile' => '7', 'result' => '0', 'type' => '1', 'phan_game' => 'comment_1']);
    $tkuma->insertins("settings_game", ['id'   => 10,'keyd' => '1-phan-3','comment' => 'N1','tile' => '3', 'result' => '1,2,3', 'type' => '1', 'phan_game' => 'comment_2']);
    $tkuma->insertins("settings_game", ['id'   => 11,'keyd' => '1-phan-3','comment' => 'N2','tile' => '3', 'result' => '4,5,6', 'type' => '1', 'phan_game' => 'comment_3']);
    $tkuma->insertins("settings_game", ['id'   => 12,'keyd' => '1-phan-3','comment' => 'N3','tile' => '3', 'result' => '7,8,9', 'type' => '1', 'phan_game' => 'comment_4']);
    $tkuma->insertins("settings_game", ['id'   => 13,'keyd' => 'h3','comment' => 'MMH1','tile' => '3', 'result' => '9', 'type' => '2', 'phan_game' => 'comment_1']);
    $tkuma->insertins("settings_game", ['id'   => 14,'keyd' => 'h3','comment' => 'MMH2','tile' => '3', 'result' => '7', 'type' => '2', 'phan_game' => 'comment_2']);
    $tkuma->insertins("settings_game", ['id'   => 15,'keyd' => 'h3','comment' => 'MMH3','tile' => '3', 'result' => '5', 'type' => '2', 'phan_game' => 'comment_3']);
    $tkuma->insertins("settings_game", ['id'   => 16,'keyd' => 'h3','comment' => 'MMH4','tile' => '3', 'result' => '3', 'type' => '2', 'phan_game' => 'comment_4']);
    $tkuma->insertins("settings_game", ['id'   => 17,'keyd' => 'xien','comment' => 'CX','tile' => '3.3', 'result' => '0,2,4', 'type' => '1', 'phan_game' => 'comment_2']);
    $tkuma->insertins("settings_game", ['id'   => 18,'keyd' => 'xien','comment' => 'LT','tile' => '3.3', 'result' => '5,7,9', 'type' => '1', 'phan_game' => 'comment_3']);
    $tkuma->insertins("settings_game", ['id'   => 19,'keyd' => 'xien','comment' => 'CT','tile' => '3.7', 'result' => '6,8', 'type' => '1', 'phan_game' => 'comment_4']);
    $tkuma->insertins("settings_game", ['id'   => 20,'keyd' => 'xien','comment' => 'LX','tile' => '3.7', 'result' => '1,3', 'type' => '1', 'phan_game' => 'comment_1']);
    $tkuma->insertins("settings_game", ['id'   => 21,'keyd' => 'lo','comment' => 'LL1','tile' => '3', 'result' => '23,43,64', 'type' => '2', 'phan_game' => 'comment_1']);
    $tkuma->insertins("settings_game", ['id'   => 22,'keyd' => 'lo','comment' => 'LL2','tile' => '3', 'result' => '10,12,29,25,28,24,31,31,33,47,44,49,59,71,76,72,77,85,87,92,95', 'type' => '2', 'phan_game' => 'comment_2']);
    

    $tkuma->insertins("theme", [ 'id'  => 1,'name'  => 'theme1']);
    $tkuma->insertins("theme", [ 'id'  => 2,'name'  => 'theme2']);
    $tkuma->insertins("theme", [ 'id'  => 3,'name'  => 'theme3']);
    $tkuma->insertins("theme", [ 'id'  => 4,'name'  => 'theme4']);
    $tkuma->insertins("theme", [ 'id'  => 5,'name'  => 'theme5']);
    $tkuma->insertins("theme", [ 'id'  => 6,'name'  => 'theme6']);
    $tkuma->insertins("theme", [ 'id'  => 7,'name'  => 'theme7']);
    $tkuma->insertins("theme", [ 'id'  => 8,'name'  => 'theme8']);
    
    if($tkuma->num_rows(" SELECT * FROM `users` WHERE `id` = ? ",[id_admin]) == 0){
        header('Location: /admin/install.php');
        exit();
    } else {
        die('Success!');
    }