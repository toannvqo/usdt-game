<?php if (!defined('IN_SITE')) {
    die('The Request Not Found');
} ?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from kubank.net/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jan 2024 07:19:08 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= BASE_URL('public/theme7/'); ?>css/bootstrap.min.css">
    <link rel='stylesheet' href="<?= BASE_URL('public/theme7/'); ?>css/animate.min.css">
    <link rel="stylesheet" href="<?= BASE_URL('public/theme7/'); ?>css/slimselect.css">
    <link rel="stylesheet" href="<?= BASE_URL('public/theme7/'); ?>css/admin2b2f.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL('public/theme7/'); ?>css/customtheme7.css?v=<?= time(); ?>">
    <script src="<?= BASE_URL('public/theme7/'); ?>js/jquery.min.js"></script>

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="<?= BASE_URL('') . $tkuma->site("favicon"); ?>">
    <link rel="apple-touch-icon" href="<?= BASE_URL('') . $tkuma->site("favicon"); ?>">
   <!-- <script src="https://cdn.rawgit.com/dankogai/js-base64/v2.1.9/base64.js"></script> -->
    <meta name="description" content="Hệ thống chẵn lẻ bank MB Bank, Vietcombank (VCB), Techcombank (TCB), Vietinbank (VTB), BIDV, chẵn lẻ zalopay, chẵn lẻ momo thanh to&#225;n tự động chỉ trong 3 gi&#226;y.">
    <meta name="keywords" content="chẵn lẻ bank, chan le bank, clmm, clzp, chẵn lẻ momo, chẵn lẻ zalopay, chẵn lẻ mb bank, t&#224;i xỉu momo, t&#224;i xỉu zalopay">
    <meta name="author" content="KuBank Ltd">
    <title>CHẴN LẺ BANK</title>
    <?= $body['header']; ?>
       <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
   
    
    <script src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
    
    <!-- Google tag (gtag.js) 
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0G86F7VVWD"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-0G86F7VVWD');
    </script>

    <script src="<?= BASE_URL('public/'); ?>js/custom.js?v=<?= time(); ?>"></script>
            <script type="text/javascript">
            let server = "wss://wss.bankvip.top";
            let lever = "";
        </script> 
        <script src="https://bankvip.top/public/js/websoket.js?v=1715445017"></script> 
    </head>
    -->

<body>
    <div class="sign section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <!-- authorization form -->
                        <form class="sign__form" method="post" autocomplete="off">
                            <a href="/" class="sign__logo">
                               <img src="<?= base_url($tkuma->site('anhbia')); ?>" alt="">
                            </a>
                            <div class="sign__group">
                                <p class="text-center err" id="err-msg"></p>
                            </div>
                            <div class="sign__group">
                                <input autocomplete="new-password" autofocus="autofocus" class="sign__input"
                                    id="usernickname" name="usernickname" placeholder="Số điện thoại" type="text" value="" />
                            </div>
                            <div class="sign__group">
                                <input autocomplete="new-password" autofocus="autofocus" class="sign__input"
                                    id="pass" name="pass" placeholder="Mật khẩu" type="password" value="" />
                            </div>
                            <div class="sign__group">
                                <input autocomplete="new-password" autofocus="autofocus" class="sign__input"
                                    id="confirmPass" name="confirm_pass" placeholder="Nhập lại mật khẩu" type="password" value="" />
                            </div>
                           
                            <div class="mb-3">
                                <label for="nickbankcode" class="form-label">Ngân hàng nhận thưởng:</label>
                                <select class="form-control" id="nickbankcode" name="nickbankcode">
        							<option value=""> -- Chọn Bank Nhận --</option>
        							        								<option value="1"> VIETINBANK </option>
        							        								<option value="2"> VIETCOMBANK </option>
        							        								<option value="3"> AGRIBANK </option>
        							        								<option value="4"> TPBANK </option>
        							        								<option value="5"> HDB </option>
        							        								<option value="6"> VPBANK </option>
        							        								<option value="7"> MBBANK </option>
        							        								<option value="8"> OCEANBANK </option>
        							        								<option value="9"> BIDV </option>
        							        								<option value="10"> SACOMBANK </option>
        							        								<option value="11"> ACB </option>
        							        								<option value="12"> ABBANK </option>
        							        								<option value="13"> CIMB </option>
        							        								<option value="14"> EXIMBANK </option>
        							        								<option value="15"> SEABANK </option>
        							        								<option value="16"> SCB </option>
        							        								<option value="17"> DONGABANK </option>
        							        								<option value="18"> SAIGONBANK </option>
        							        								<option value="19"> PG BANK </option>
        							        								<option value="20"> PVCOMBANK </option>
        							        								<option value="21"> KIENLONGBANK </option>
        							        								<option value="22"> VIETCAPITAL BANK </option>
        							        								<option value="23"> OCB </option>
        							        								<option value="24"> MSB </option>
        							        								<option value="25"> SHB </option>
        							        								<option value="26"> VIETBANK </option>
        							        								<option value="27"> VietNam - Russia Bank </option>
        							        								<option value="28"> NAMA BANK </option>
        							        								<option value="29"> VIB BANK </option>
        							        								<option value="30"> TECHCOMBANK </option>
        							        						</select>
                            </div>
                            <div class="sign__group">
                                <input autocomplete="new-password" class="sign__input" id="nickstk" name="nickstk"
                                    placeholder="Số tài khoản nhận thưởng" type="text" />
                            </div>
                             <div class="sign__group">
                                <input autocomplete="acc-name" class="sign__input" id="accName" name="accName"
                                    placeholder="Tên tài khoản nhận thưởng" type="text" />
                            </div>
                              <div class="sign__group">
                                <input autocomplete="acc-name" class="sign__input" id="agentCode" name="agentCode"
                                    placeholder="Mã giới thiệu" type="text" />
                            </div>
                            <button class="sign__btn" type="button" id="Registerbutton"><span>ĐĂNG KÝ</span></button>

                            <span class="sign__text">Đã có tài khoản? <a href="https://chanle3s.com/client/dangnhap">Đăng nhập!</a></span>
                        </form>
                        <!-- end authorization form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
    .wintext{
    padding: 15px 5px;
    white-space: nowrap;
}
</style>

<script>
    function resizeIframe(obj) {
        var fh = obj.contentWindow.document.body.scrollHeight;
        obj.style.height = Math.min(screen.height, fh) + 'px';
    }
</script>

    <script src="<?= BASE_URL('public/theme7/'); ?>js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL('public/theme7/'); ?>js/smooth-scrollbar.js"></script>
    <script src="<?= BASE_URL('public/theme7/'); ?>js/slimselect.min.js"></script>
    <script src="<?= BASE_URL('public/theme7/'); ?>js/admin4b88.js?v=<?= time(); ?>"></script>

    <link rel="stylesheet" href="<?= BASE_URL('public/theme7/'); ?>css/jquery.vnm.confettiButton.css">
    <link href="<?= base_url('public/cute-alert/sweetalert2/sweetalert2.min.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('public/cute-alert/sweetalert2/sweetalert2.min.js'); ?>"></script>
    <script src="<?= BASE_URL('public'); ?>/js/clipboard.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="<?= BASE_URL('public/'); ?>js/kuma.js?v=<?= time(); ?>"></script>
    <script src="<?= BASE_URL('public/'); ?>js/custom.js?v=<?= time(); ?>"></script>
    <script type="text/javascript">
        var ismob = false;
        var ag = '#cltx';

        $(document).ready(function () {
            setTimeout(function () {
                $('.toast-ctv').show();
            }, 2000);
            $('.close-tctv').click(function () {
                $('.toast-ctv').hide();
            });
        });
        
         document.getElementById('accName').addEventListener('input', function (event) {
    event.target.value = event.target.value.toUpperCase();
  });
  // Extract 'ref' parameter from URL and set it to 'agentCode' input
    const urlParams = new URLSearchParams(window.location.search);
    const ref = urlParams.get('ref');
    if (ref) {
        document.getElementById('agentCode').value = ref;
    }
    </script>


    <!-- End of LiveChat code -->
</body>


</html>