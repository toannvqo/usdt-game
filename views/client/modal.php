<link href="<?= BASE_URL('public/style/'); ?>canvas.css?v=<?= time(); ?>" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
    integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--<link rel="stylesheet" href="<?= BASE_URL('public/theme7/'); ?>css/admin2b2f.css?v=<?= time(); ?>">-->
<?php if($tkuma->site("status_websoket") == 1){ ?>
<script type="text/javascript">
    let server = "<?= ($tkuma->site('websoket')); ?>";
    let lever = "<?= isset($_SESSION['login']) ? check_string($_SESSION['login']) : ''; ?>";
</script> 
<script src="<?= BASE_URL('public/'); ?>js/websoket.js?v=<?= time(); ?>"></script> 
<?php } ?>
<?php if($tkuma->site("status_themeuser") == 1){ ?>
  <div id="drawer" class="">
    <div>
      <div class="header-drawer">
        <p>Theme Custommer</p>
        <button id="closeDrawer" onclick="toggleDrawer('close')">X</button>

      </div>
      <div class="main-drawer">
        <div class="info-drawer">
          <div class="title-drawer">THEME</div>
          <span class="desc-drawer">Choosw Theme</span>
        </div>
        <div class="content-drawer ">
          <article class="drawer-item  active" onclick="changetheme(1)">
            <img src="/public/storage/theme1.png" alt="">
            <p>THEME 1</p>
          </article>
          <article class="drawer-item " onclick="changetheme(2)">
            <img src="/public/storage/theme2.png" alt="">
            <p>THEME 2</p>
          </article>
          <article class="drawer-item " onclick="changetheme(3)">
            <img src="/public/storage/theme3.png" alt="">
            <p>THEME 3</p>
          </article>
          <article class="drawer-item " onclick="changetheme(4)">
            <img src="/public/storage/theme4.png" alt="">
            <p>THEME 4</p>
          </article>
          <article class="drawer-item " onclick="changetheme(5)">
            <img src="/public/storage/theme5.png" alt="">
            <p>THEME 5</p>
          </article>
          <article class="drawer-item" onclick="changetheme(6)">
            <img src="/public/storage/theme6.png" alt="">
            <p>THEME 6</p>
          </article>
          <article class="drawer-item " onclick="changetheme(7)">
            <img src="/public/storage/theme7.png" alt="">
            <p>THEME 7</p>
          </article>
          <article class="drawer-item " onclick="changetheme(8)">
            <img src="/public/storage/theme8.png" alt="">
            <p>THEME 8</p>
          </article>


        </div>
      </div>
      <div class="footer-drawer ">
        <button class=" reset">Reset</button>
        <button class=" buy">Buy Now</button>
      </div>
    </div>
  </div>

  <div id="main" class="" >
    <div onclick="toggleDrawer()" class="customizer-setting">
      <div class="button-setting">
        <i class="fa-solid fa-gear"></i>
      </div>
    </div>
  </div>

  <script>
    function toggleDrawer(flag) {
      const drawer = document.getElementById('drawer');
      if (flag === "close") {
        drawer.classList.remove("active")

      }else {
          drawer.classList.toggle("active")
      }
    }
  </script>
  <?php } ?>
<style>
.btn-info {
    --vz-btn-bg: var(--vz-info);
    --vz-btn-border-color: var(--vz-info);
    --vz-btn-hover-bg: var(--vz-info-text-emphasis);
    --vz-btn-hover-border-color: var(--vz-info-text-emphasis);
    --vz-btn-focus-shadow-rgb: var(--vz-info-rgb);
    --vz-btn-active-bg: var(--vz-info-text-emphasis);
    --vz-btn-active-border-color: var(--vz-info-text-emphasis);
    --vz-btn-disabled-bg: var(--vz-info);
    --vz-btn-disabled-border-color: var(--vz-info);
}
.fs-22 {
    font-size: var(--vz-font-22)!important;
}
.mdi-cog-outline::before {
    content: "\f08bb";
}
.mdi-spin:before {
    -webkit-animation: mdi-spin 2s infinite linear;
    animation: mdi-spin 2s infinite linear;
}
.btn-icon.btn-lg {
    height: calc(1.4rem + 1.5em + 2px);
    width: calc(1.4rem + 1.5em + 2px);
}
.btn-icon {
    position: relative;
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    height: calc(1rem + 1.5em + 2px);
    width: calc(1rem + 1.5em + 2px);
    padding: 0;
}
.btn-group-lg>.btn, .btn-lg {
    --vz-btn-padding-y: 0.7rem;
    --vz-btn-padding-x: 1.2rem;
    --vz-btn-font-size: calc(var(--vz-font-base) * 1.25);
    --vz-btn-border-radius: var(--vz-border-radius-lg);
}
.customizer-setting {
    position: fixed;
    bottom: 194px;
    right: 20px;
    z-index: 1000;
}
@media (min-width: 768px)
.d-md-block {
    display: block!important;
}
    /* CSS cho modal */

</style>

<style>
    .modal-content {
        position: relative;
        background-color: #fff;
        margin: 10% auto;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
    /* CSS */
    .avatar-container {
        position: fixed;
        top: 60px;
        right: 50px;
        /* Thay đổi từ "left" thành "right" */
        display: flex;
        flex-direction: column;
         /*transform: translate(-50%, -50%);*/
        /* Thêm thuộc tính flex-direction */
        align-items: center;
        position: fixed;
        z-index: 9999;
        cursor: pointer;
        /* Thêm thuộc tính cursor để biểu thị là clickable */
    }

    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        margin-bottom: 10px;
        
    }

    .avatar img {
        width: 100%;
        height: auto;
    }

    .user-name {
        font-size: 18px;
        font-weight: bold;
    }

    .menux {
        display: none;
        background-color: #000000;
        /* Đặt màu nền là màu trắng */
        padding: 20px;
        /* Thêm padding để tạo khoảng cách xung quanh các mục */
        border-radius: 5px;
        /* Đặt bo góc cho menu */

    }
    .menu2 {
        display: none;
        background-color: #000000;
        /* Đặt màu nền là màu trắng */
        padding: 20px;
        /* Thêm padding để tạo khoảng cách xung quanh các mục */
        border-radius: 5px;
        /* Đặt bo góc cho menu */

    }

    .submenu {
        display: none;
    }

    .menu-item {
        margin: 15px 0;
        color: #ffffff;
        /* Đặt màu chữ là màu đen */
    }
    

    .menu-item:hover {
        background-color: #e9ecef;
        /* Màu nền thay đổi khi di chuột vào */
        cursor: pointer;
        /* Con trỏ chuột thay đổi khi di chuột vào */
        color: #000000;
        /* Màu chữ thay đổi khi di chuột vào */
    }

    .module {
        display: none;
        /* Ẩn module ban đầu */
    }
    .menu2 {
        display: none;
        /* Ẩn module ban đầu */
    }
 

</style>
<!--<link href="assets/vendor/fontawesome/css/all.min.css" rel="stylesheet">-->
<style>

.mb-0 {
    margin-bottom: 0 !important;
}
.profile-area .profile-content ul li a i {
    color: #027335;
    font-size: 16px;
    margin-right: 8px;
    opacity: 0.8;
}
.profile-area .profile-content ul li a {
    position: relative;
    display: flex;
    align-items: center;
    color: #6d898f;
    font-size: 14px;
    font-weight: 600;
}
.profile-area .profile-content ul li {
    padding: 15px;
    margin: 0 -15px;
    border-bottom: 1px solid #E8EFF3;
}
.profile-area {
    padding-top: 0;
}
.media img {
     width: 100%; 
     min-width: 100%; 
     height: 100%; 
     object-fit: cover; 
}
.me-3 {
    margin-right: 1rem !important;
}
.media-70 {
    width: 70px;
    min-width: 70px;
    height: 70px;
}
.mb-3 {
    margin-bottom: 1rem !important;
}
.align-items-center {
    align-items: center !important;
}
.d-flex {
    display: flex !important;
}
.profile-area .profile .media {
    border-radius: 12px;
    background-color: #fff;
    padding: 2px;
    box-shadow: 0 10px 10px -6px rgba(0, 0, 0, 0.41);
}
.profile-area .profile .location-box .location {
    font-size: 20px;
    color: #fff;
    background-color: #027335;
    margin-right: 20px;
    width: 40px;
    height: 40px;
    min-width: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
}
.fa-solid, .fas {
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
}
.profile-area .profile .location-box .change-btn {
    border: 1px solid #E8EFF3;
    padding: 5px 10px;
    color: #fff;
    border-radius: 8px;
}
.profile-area .profile .location-box {
    display: flex;
    align-items: center;
    padding: 10px 10px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    box-shadow: 0 10px 10px -10px rgba(78, 73, 73, 0.17);
}
.flex-1 {
    flex: 1;
}
    .profile-area .profile {
    position: relative;
    background: linear-gradient(228.99deg, #027335 26.74%, #5fa980 109.9%);
    box-shadow: 0px 4px 6px 0px rgba(62, 73, 84, 0.04);
    margin: 0 -15px 15px;
    padding: 15px 15px;
}
.profile-area .profile .edit-profile {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 22px;
    color: #fff;
}
</style>


<style>
    .modal-body {
    position: relative;
    flex: 1 1 auto;
    padding: 1rem;
}
.g-3, .gx-3 {
    --bs-gutter-x: 1rem;
}
.g-3, .gy-3 {
    --bs-gutter-y: 1rem;
}
.col-9 {
    flex: 0 0 auto;
    width: 75%;
}
.col-3 {
    flex: 0 0 auto;
    width: 25%;
}
.comments__avatar {
    position: absolute;
    top: 0;
    left: 0;
    width: 46px;
}
.comments__autor {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    position: relative;
    padding-left: 60px;
    margin-bottom: 15px;
    height: 48px;
}
.comments__name {
    display: block;
    width: auto;
    color: #fef142;
    font-weight: 500;
    font-size: 18px;
    line-height: 100%;
    height: 20px;
    margin-bottom: 0;
    background-image: linear-gradient(90deg, #fe5b09 0%, #fef9a6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
#canvasQr {
    border: 1px solid rgba(255,255,255,0.05);
    padding: 20px 0;
}
.btn-close-qr, .mg-auto {
    margin: 0 auto;
}
.modal__btn--dismiss {
    background-color: rgba(255,255,255,0.05);
    box-shadow: 0 0 20px 0 rgba(0,0,0,0.05);
}
.lnk__btn {
    border-radius: 8px;
    background: linear-gradient(90deg, #fe5b09 0%, #fef9a6 100%);
    box-shadow: 0 0 16px 0 rgb(254 155 33 / 30%);
    position: relative;
    color: #000;
    padding: 5px 15px;
    justify-content: center;
}
.modal__btns {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    margin-top: 30px;
}
.row.canvasQr {
    /*display: -ms-flexbox;*/
    display: inline-flex;
    /*-ms-flex-wrap: wrap;*/
    /*flex-wrap: wrap;*/
    /*margin-right: -0.75rem;*/
    /*margin-left: -0.75rem;*/
}
</style>

<div class="modal fade" id="modal-qr" tabindex="-1" aria-labelledby="modal-view" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
        <div class="modal-content">
            <div class="modal__content modal__content--view">
                <div class="comments__autor">
                    <img class="comments__avatar" src="<?= BASE_URL('').$tkuma->site("favicon"); ?>" alt="">
                    <span class="comments__name"><?= $tkuma->site('title'); ?> QR-Code</span>
                </div>
                <div class="text-center" id="canvasQr">
                    <canvas width="200" height="200"></canvas>
                </div>
                
                <div class="text-center mt-3">
                    <div class="row canvasQr">
                        <div class="mb-3">
                           <select class="form-control" id="noidungchoi" name="noidungchoi">
    							<option value=""> -- Chọn Game Chơi --</option>
    							<?php foreach ($tkuma->get_list("SELECT * FROM `danh_sach_game` WHERE `status` = ? ORDER BY `id` ASC ",['run']) as $bankcode2) { ?>
    							<?php foreach ($tkuma->get_list("SELECT * FROM `settings_game` WHERE `keyd` = ? ORDER BY `id` ASC ",[$bankcode2['ma_game']]) as $bankcode3) { ?>
    								<option value="<?= $bankcode3['comment']; ?>">Game: <?= $bankcode2['ten_game']; ?> | Nd: <?= $bankcode3['comment']; ?> | TỷLệ: <?= $bankcode3['tile']; ?>  </option>
    							<?php } ?>
    							<?php } ?>
    						</select>
    						<br>
                            <select class="form-control" id="dabankname" name="dabankname">
    							<option value=""> -- Chọn Bank Nhận --</option>
    							<?php foreach ($tkuma->get_list("SELECT * FROM `phone` WHERE `status` = ? ORDER BY `id` ASC ",['success']) as $bankcoded) { ?>
    							<?php $optionValue = $bankcoded['namebank'] . '|' . $bankcoded['phone'];?>
    								<option value="<?= htmlspecialchars($optionValue); ?>"> <?= $bankcoded['namebank']; ?> - <?= $bankcoded['phone']; ?> </option>
    							<?php } ?>
    						</select>
                        </div>
                    </div>
                    <p class="qr-notes"><i>(lưu ý VUi lòng thêm nôi dung và số tiền)</i></p>
                    <p class="text-center mt-2 mb-1"><button id="qr-reg" class="lnk__btn" mobile-device="0" data-content="">Tạo Qr Mới</button></p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" data-dismiss="modal">Đóng</button>
    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="nhiem-vu-ngay" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"  aria-hidden="true">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title">
                    <b class="text-primary">Nhiệm Vụ Ngày</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" data-minigame="day_mission" id="day_mission">
                <div class="text-center">
                    <div class="form-group form-group-custom occard" id="osdt" style="display: block;">
                        <form class="row g-2 form-check-custom form-check-custom-1" id="checkMission">
                            <div class="col-12">
                                <button type="button" class="btn btn-success w-100 button-check-custom button-check-custom-nv" >
                                    Tổng tiền bạn đã chơi hôm nay : <b class="money-day" style="color: blue;"><?= 
                                    format_currency($tkuma->get_row("SELECT SUM(`amount_play`) AS totalAmount FROM `lich_su_choi` WHERE `type_gd` = ? AND `partnerName` = ? AND `time` >= ?", ['real', $_SESSION['username'], date("Y/m/d 00:00:00")])['totalAmount']);?></b>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-4" id="fghdh">
                    <div class="alert alert-primary" role="alert">
                        <?= $tkuma->get_row("SELECT * FROM `event` WHERE `keyd` = ? ",['nhiem-vu-ngay'])['mota']; ?>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover text-center mt-4">
                            <thead>
                                <tr role="row" class="bg-primary">
                                    <th class="heading-table-pink text-center text-white">Mốc chơi</th>
                                    <th class="heading-table-pink text-center text-white">Thưởng</th>
                                </tr>
                            </thead>
                            <tbody id="nhiemvungay"> </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span class="btn btn-gray" data-dismiss="modal">Đóng</span>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="code-khuyen-mai" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"  aria-hidden="true">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title">
                    <b class="text-primary">GIFTCODE KHUYẾN MÃI</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group bg-warning" id="day_mission_querying" style="display: none;">
                    Đang kiểm tra...xin chờ nhé!
                </div>
                <form>
                    <div class="mb-3">
                        <label for="giftcode" class="form-label text-dark">Mã CODE:</label>
                        <input type="text" class="form-control" id="giftcode" placeholder="ABCXYZ" aria-describedby="emailHelp" name="giftcode">
                    </div>
                    <div class="mb-3">
                        <label for="phoneCode" class="form-label text-dark">Nickname của bạn:</label>
                        <input type="text" class="form-control" placeholder="Nitnaxxxxxxx" id="phoneCode" name="phoneCode">
                    </div>
                    <div class="alert alert-danger mt-3" role="alert">
                        Nhập nickname của bạn để kiểm tra và nhận thưởng.
                    </div>
                </form>
                <div class="alert alert-success mt-3" role="alert">
                    <?= base64_decode($tkuma->site('noti_gift')); ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="check-giftCode">Kiểm tra</button>
                <span class="btn btn-gray" data-dismiss="modal">Đóng</span>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="taonickname" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title">
                    <b class="text-primary">ĐĂNG KÍ</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="alert alert-danger mt-3" role="alert">
                        VUI LÒNG KT ĐÃ ĐÚNG STK VÀ NGÂN HÀNG CHƯA NHÉ . TRƯỜNG HỢP TẠO SAI AD SẼ KHÔNG CHỊU TRÁCH NHIỆM .
                    </div>
                    <div class="mb-3">
                        <label for="nickbankcode" class="form-label">Ngân hàng nhận thưởng:</label>
                        <select class="form-control" id="nickbankcode" name="nickbankcode">
							<option value=""> -- Chọn Bank Nhận --</option>
							<?php foreach ($tkuma->get_list("SELECT * FROM `bankcode` ORDER BY `id` ASC ") as $bankcode) { ?>
								<option value="<?= $bankcode['id']; ?>"> <?= $bankcode['bankname']; ?> </option>
							<?php } ?>
						</select>
                    </div>
                    <div class="mb-3">
                        <label for="nickstk" class="form-label text-dark">Số tải khoản nhận thưởng:</label>
                        <input type="text" class="form-control" placeholder="Số tải khoản nhận thưở......" id="nickstk" name="nickstk">
                    </div>
                    <div class="mb-3">
                        <label for="usernickname" class="form-label text-dark">Tài Khoản Muốn Tạo:</label>
                        <input type="text" class="form-control" placeholder="Tài khoản muốn tạo....." id="usernickname" name="usernickname">
                    </div>
                    
                    <div class="lert alert-success mt-3">
                        <a>Bạn đã tham gia? </a>
                        <a href data-toggle="modal" data-target="#modalReJoin">Đăng nhập</a>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="Registerbutton">Thêm Ngay</button>
                <span class="btn btn-gray" data-dismiss="modal">Đóng</span>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalReJoin" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title">
                    <b class="text-primary">Tham Gia Lại</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="mb-3">
                        <label for="usernicknamelog" class="form-label text-dark">Nickname đã tạo:</label>
                        <input type="text" class="form-control" placeholder="Nickname đã tạo....." id="usernicknamelog" name="usernicknamelog">
                    </div>
                    <div class="lert alert-success mt-3">
                        <a>Bạn chưa tham gia? </a>
                        <a href data-toggle="modal" data-target="#taonickname">Tạo Nickname</a>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="loginbutton">Thêm Ngay</button>
                <span class="btn btn-gray" data-dismiss="modal">Đóng</span>
            </div>
        </div>
    </div>
</div>
<!-- Modal Kiem Tra Giao Dich -->
<div class="modal fade" id="modal-kiem-tra-giao-dich" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form id="checkByTrans">
        <div class="modal-dialog" style="max-width: 600px;">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title">
                        <b class="text-primary">KIỂM TRA MÃ GIAO DỊCH</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="form_kiemtragiaodich">
                        <div class="alert alert-info" role="alert">
                            Nếu quá 15 phút chưa nhận được tiền vui lòng dán mã vào đây để kiểm tra.
                        </div>
                        <!-- <form id="checkByTrans"> -->
                        <div class="mb-3">
                            <label for="tran_id" class="form-label text-dark">Nhập mã giao dịch</label>
                            <input type="number" class="form-control" id="tran_id" name="transId" placeholder="Mã giao dịch: Ví dụ 11223344556" aria-describedby="tran_id">
                        </div>
                        <div id="detailTransId" style="margin-top: 5px;"></div>
                        <div id="tableDetails" style="margin-top: 5px;"></div>
                        <a class="text-white" href="<?= $tkuma->site('telegram'); ?>" target="_blank">
                            <img class="img-fluid" src="<?= BASE_URL('public/storage'); ?>/support.png" alt="ho tro" style="max-width: 100%;height: auto;">
                        </a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="checkByTransidd" class="btn btn-primary">Kiểm tra</button>
                    <span class="btn btn-gray" data-dismiss="modal">Đóng</span>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="modal-kiem-tra-no-hu" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <form id="checkNoHu">
        <div class="modal-dialog" style="max-width: 600px;">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title">
                        <b class="text-primary">KIỂM TRA HŨ TAM TỨ SẢNH</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
               
                <div class="modal-body">
                    <div class="form_kiemtragiaodich">
                        <div class="alert alert-info" role="alert">
                            <p>- Đuôi Tam Hoa, Sảnh Tiến 3 Số nhận: <?= format_currency($tkuma->get_row("SELECT * FROM `event` WHERE `keyd` = 'no-hu' ")['thuong3']); ?></p>
                            <p>- Đuôi Tứ Quý, Sảnh Tiến 4 Số nhận: <?= format_currency($tkuma->get_row("SELECT * FROM `event` WHERE `keyd` = 'no-hu' ")['thuong4']); ?></p>
                            <p>- Đuôi Ngũ Quý, Sảnh Rồng 5 Số nhận: <?= format_currency($tkuma->get_row("SELECT * FROM `event` WHERE `keyd` = 'no-hu' ")['thuong5']); ?></p>
                            <?= $tkuma->get_row("SELECT * FROM `event` WHERE `keyd` = ? ",['no-hu'])['mota']; ?>
                        </div>
                        <div class="mb-3">
                            <label for="tran_id" class="form-label text-dark">Nhập mã giao dịch</label>
                            <input type="number" class="form-control" id="tran_id" name="transId" placeholder="Mã giao dịch: Ví dụ 11223344556" aria-describedby="tran_id">
                        </div>
                        <div id="detailNoHu" style="margin-top: 5px;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="exploding">Kiểm tra</button>
                    <span class="btn btn-gray" data-dismiss="modal">Đóng</span>
                </div>
            </div>
        </div>
    </form>
</div>

<!--Modal Diem Danh Nhan Qua -->
<div class="modal fade" id="diem-danh" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title">
                    <b class="text-primary">Điểm Danh Nhận Quà Miễn Phí</b>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body" data-minigame="diemdanh" id="diemdanh">
                <!-- /Modal Diem Danh Nhan Qua -->
                <div class="modal-body">
                    <div class="text-center">
                        <p class="text-primary">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                            <span>Mã quà: <b class="text-success">12,532</b></span>
                        </p>
                        <p class="text-primary">
                            <i class="fa fa-usd" aria-hidden="true"></i>
                            <span>
                                <span style="width: 16px">&nbsp;</span>
                                Giá trị: <b class="text-success">5.000 ~100.000 VNĐ</b>
                            </span>
                        </p>
                        <p class="text-primary">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span><b>10 ~ 100</b> người</span>
                        </p>
                        <p class="text-primary">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <span>Quay thưởng sau: <b class="text-success" id="diemdanh_thoigian">905</b> giây</span>
                        </p>
                    </div>
                    <form class="row form-check-custom">
                        <div class="col-9 text-start">
                            <!--<label for="phone" class="visually-hidden">Số điện thoại:</label>-->
                            <input type="text" class="form-control" name="phoneMuster" id="phoneMuster" placeholder="Nhập Nickname đã tham gia của bạn để điểm danh.">
                        </div>
                        <div class="col-3">
                            <button type="button " class="btn btn-success w-100 button-check-custom" data-toggle="modal" data-target="#modalDiemDanh" id="btnMuster">
                                Kiểm Tra
                            </button>
                        </div>
                    </form>
                    <!-- Tabs with diem danh -->
                    <div class="card mt-2 shadow-none bg-light">
                        <div class="card-header border-bottom">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item my-2" role="presentation">

                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tab-cach-choi" role="tabpanel" aria-labelledby="tab-1" tabindex="0">
                                    <div class="alert alert-info" role="alert">
                                        - Mỗi phiên quà các bạn có 10 phút để điểm danh. <br>
                                        - Số điện thoại điểm danh phải chơi [ <?= $tkuma->site('title'); ?> ] Chơi Chẵn Lẻ Trên Momo Auto 3s Trả Thưởng
                                        ít
                                        nhất 01 lần trong ngày. Không giới hạn số lần điểm
                                        danh trong ngày. <br>
                                        - Khi hết thời gian, người may mắn sẽ nhận được số tiền của phiên đó. <br>
                                        - Game <b>Điểm danh miễn phí</b> chỉ hoạt động từ <b>7h sáng</b> đến 1h đêm
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-lich-su" role="tabpanel" aria-labelledby="tab-2" tabindex="0">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center mt-4">
                                            <thead>
                                                <tr role="row" class="bg-primary">
                                                    <th class="heading-table-pink text-center text-white">Mã</th>
                                                    <th class="heading-table-pink text-center text-white">Tổng</th>
                                                    <th class="heading-table-pink text-center text-white">SĐT</th>
                                                    <th class="heading-table-pink text-center text-white">VNĐ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-primary fw-bold"><small>1</small></td>
                                                    <td class="text-primary fw-bold"><small>1</small></td>
                                                    <td class="text-primary fw-bold">0976***111</td>
                                                    <td class="text-primary fw-bold">10,000</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-danh-sach" role="tabpanel" aria-labelledby="tab-3" tabindex="0">
                                    <div class="alert alert-success" role="alert">
                                        0921***037, 0866***236, 0166***2003, 0902***057, 0935***809, 0969***523, 0902***573,
                                        0968***784
                                    </div>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Tabs diem danh -->
                </div>
                <script>
                    setInterval(() => {
                        countSeccond();
                    }, 1000);

                    function countSeccond() {
                        var send = Number(diemdanh_thoigian.innerHTML);
                        if (send <= 0) {
                            return;
                        }
                        $("#diemdanh_thoigian").text(send - 1);
                        $("#diemdanh_time").text(send - 1);
                    }
                </script>
            </div>
            <div class="modal-footer">
                <span class="btn btn-gray" data-dismiss="modal">Đóng</span>
            </div>
        </div>
    </div>
</div> <!-- /Modal Diem Danh Nhan Qua -->


