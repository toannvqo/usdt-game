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
    <script src="https://cdn.rawgit.com/dankogai/js-base64/v2.1.9/base64.js"></script>
    <meta name="description" content="Hệ thống chẵn lẻ bank MB Bank, Vietcombank (VCB), Techcombank (TCB), Vietinbank (VTB), BIDV, chẵn lẻ zalopay, chẵn lẻ momo thanh to&#225;n tự động chỉ trong 3 gi&#226;y.">
    <meta name="keywords" content="chẵn lẻ bank, chan le bank, clmm, clzp, chẵn lẻ momo, chẵn lẻ zalopay, chẵn lẻ mb bank, t&#224;i xỉu momo, t&#224;i xỉu zalopay">
    <meta name="author" content="KuBank Ltd">
    <title>CHẴN LẺ BANK</title>
    <?= $body['header']; ?>
</head>

<body>
    <div class="sign section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <form class="sign__form" method="post" autocomplete="off">
                            <a href="/" class="sign__logo">
                                <img src="<?= base_url($tkuma->site('anhbia')); ?>" alt="">
                            </a>
                            <div class="sign__group">
                                <p class="text-center err" id="err-msg"></p>
                            </div>
                            <div class="sign__group">
                                <input autocomplete="new-password" autofocus="autofocus" class="sign__input"
                                    id="usernicknamelog" name="usernicknamelog" placeholder="Nickname" type="text" value="" />
                            </div>
                            <div class="sign__group">
                                 <input autocomplete="new-password" autofocus="autofocus" class="sign__input"
                                    id="pass" name="pass" placeholder="PassWord" type="password" value="" />
                                <span class="toggle-password" onclick="togglePasswordVisibility()"><i class="fas fa-eye"></i></span>
                            </div>

                            <button type="submit" class="sign__btn" id="loginbutton"><span>ĐĂNG NHẬP</span></button>
                            

                            <span class="sign__text">Chưa có tài khoản? <a href="/client/dangki">Đăng ký!</a></span>
  
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
        function togglePasswordVisibility() {
                                    var passwordInput = document.getElementById("pass");
                                    var eyeIcon = document.querySelector(".toggle-password i");

                                    if (passwordInput.type === "password") {
                                        passwordInput.type = "text";
                                        eyeIcon.classList.remove("fa-eye");
                                        eyeIcon.classList.add("fa-eye-slash");
                                    } else {
                                        passwordInput.type = "password";
                                        eyeIcon.classList.remove("fa-eye-slash");
                                        eyeIcon.classList.add("fa-eye");
                                    }
                                }
</script>
<div class="modal fade" id="modal-notes" tabindex="-1" aria-labelledby="modal-view" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal__content modal__content--view">
                <div class="comments__autor">
                    <img class="comments__avatar" src="<?= base_url($tkuma->site('anhbia')); ?>" alt="">
                    <span class="comments__name">CHẴN LẺ BANK - TXBANK - CLBANK UY TÍN NHẤT VN Thông Báo</span>
                </div>
                <p class="comments__text"></p>
                <div class="modal__btns">
                    <button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal" aria-label="Close"><span>Đóng</span></button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .preloader {
    width: 100%;
    height: 100%;
    background: #28282d <img src="<?= base_url($tkuma->site('anhbia')); ?>" alt=""> no-repeat center center;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 9999;
    text-align: center;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    opacity:0.8;
}
</style>
<div class="modal bounceIn animated" id="modal-win" tabindex="-1" aria-labelledby="modal-view" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal__content modal__content--view">
                <div class="comments__autor">
                    <img class="comments__avatar" src="<?= base_url($tkuma->site('anhbia')); ?>" alt="">
                    <span class="comments__name">CHẴN LẺ BANK - TXBANK - CLBANK UY TÍN NHẤT VN Thông Báo</span>
                </div>
                <div class="comments__text vnm-confetti-button">
                    <div class="wintext">
                            <span class="wt wt-plus"></span>
                            <span class="wt wt-2"></span>
                            <span class="wt wt-3"></span>
                            <span class="wt wt-9"></span>
                            <span class="wt wt-0"></span>
                            <span class="wt wt-0"></span>
                    </div>
                <span class="vnm-confetti"><span class="confetto" style="background-color: rgb(255, 85, 102); transform: translate(-119px, 146px) rotate(22deg) scale(0.6); animation-duration: 1.46s; animation-delay: -0.6132s;"></span><span class="confetto" style="background-color: rgb(46, 204, 113); transform: translate(112px, 99px) rotate(28deg) scale(1.9); animation-duration: 1.78s; animation-delay: -0.1246s;"></span><span class="confetto" style="background-color: rgb(46, 191, 246); transform: translate(-128px, -142px) rotate(73deg) scale(2.1); animation-duration: 1.86s; animation-delay: -1.1346s;"></span><span class="confetto" style="background-color: rgb(255, 255, 255); transform: translate(114px, 60px) rotate(41deg) scale(1.4); animation-duration: 1.67s; animation-delay: -0.9853s;"></span><span class="confetto" style="background-color: rgb(46, 191, 246); transform: translate(-46px, -101px) rotate(42deg) scale(0.6); animation-duration: 1.67s; animation-delay: -0.7682s;"></span><span class="confetto" style="background-color: rgb(255, 85, 102); transform: translate(95px, -168px) rotate(24deg) scale(2.6); animation-duration: 1.41s; animation-delay: -0.7473s;"></span><span class="confetto" style="background-color: rgb(46, 191, 246); transform: translate(135px, -58px) rotate(61deg) scale(3.2); animation-duration: 1.23s; animation-delay: -0.8487s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(-188px, 89px) rotate(35deg) scale(2.7); animation-duration: 1.46s; animation-delay: -0.5256s;"></span><span class="confetto" style="background-color: rgb(255, 85, 102); transform: translate(-86px, -117px) rotate(89deg) scale(0.8); animation-duration: 1.97s; animation-delay: -0.9259s;"></span><span class="confetto" style="background-color: rgb(255, 255, 255); transform: translate(186px, 190px) rotate(75deg) scale(0.9); animation-duration: 1.37s; animation-delay: -0.9453s;"></span><span class="confetto" style="background-color: rgb(46, 191, 246); transform: translate(60px, -43px) rotate(64deg) scale(2.6); animation-duration: 1.45s; animation-delay: -0.7975s;"></span><span class="confetto" style="background-color: rgb(46, 204, 113); transform: translate(76px, 115px) rotate(58deg) scale(2.3); animation-duration: 1.13s; animation-delay: -0.0339s;"></span><span class="confetto" style="background-color: rgb(46, 204, 113); transform: translate(-36px, -65px) rotate(57deg) scale(1.8); animation-duration: 1.77s; animation-delay: -0.354s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(-96px, -198px) rotate(83deg) scale(2.3); animation-duration: 1.06s; animation-delay: -0.1696s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(193px, -79px) rotate(19deg) scale(0.3); animation-duration: 1.85s; animation-delay: -1.4615s;"></span><span class="confetto" style="background-color: rgb(46, 204, 113); transform: translate(155px, -143px) rotate(33deg) scale(3.2); animation-duration: 1.54s; animation-delay: -1.1396s;"></span><span class="confetto" style="background-color: rgb(255, 255, 255); transform: translate(75px, -47px) rotate(42deg) scale(0.6); animation-duration: 1.48s; animation-delay: -0.6808s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(178px, 52px) rotate(16deg) scale(1.2); animation-duration: 1.58s; animation-delay: -0.8216s;"></span><span class="confetto" style="background-color: rgb(255, 255, 255); transform: translate(125px, -191px) rotate(80deg) scale(3.6); animation-duration: 1.02s; animation-delay: -0.7956s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(75px, -88px) rotate(72deg) scale(2.4); animation-duration: 1.31s; animation-delay: -0.655s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(102px, 88px) rotate(69deg) scale(1.8); animation-duration: 1.56s; animation-delay: -0.2496s;"></span><span class="confetto" style="background-color: rgb(46, 204, 113); transform: translate(-39px, 95px) rotate(11deg) scale(3.7); animation-duration: 1.3s; animation-delay: -0.572s;"></span><span class="confetto" style="background-color: rgb(46, 191, 246); transform: translate(-41px, -108px) rotate(14deg) scale(3.1); animation-duration: 1.76s; animation-delay: -1.0912s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(186px, 54px) rotate(54deg) scale(1.7); animation-duration: 1.9s; animation-delay: -0.133s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(36px, 68px) rotate(69deg) scale(3.9); animation-duration: 1.17s; animation-delay: -0.6786s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(41px, 150px) rotate(69deg) scale(3.1); animation-duration: 1.06s; animation-delay: -1.0176s;"></span><span class="confetto" style="background-color: rgb(255, 85, 102); transform: translate(-38px, 161px) rotate(26deg) scale(3.2); animation-duration: 1.71s; animation-delay: -1.3167s;"></span><span class="confetto" style="background-color: rgb(255, 255, 255); transform: translate(-93px, 199px) rotate(72deg) scale(3.2); animation-duration: 1.51s; animation-delay: -1.3741s;"></span><span class="confetto" style="background-color: rgb(255, 255, 255); transform: translate(-194px, 156px) rotate(1deg) scale(0.8); animation-duration: 1s; animation-delay: -0.07s;"></span><span class="confetto" style="background-color: rgb(46, 191, 246); transform: translate(-49px, -190px) rotate(69deg) scale(1.3); animation-duration: 1.61s; animation-delay: -1.2558s;"></span><span class="confetto" style="background-color: rgb(255, 85, 102); transform: translate(49px, -65px) rotate(35deg) scale(3.7); animation-duration: 1.04s; animation-delay: -0.9568s;"></span><span class="confetto" style="background-color: rgb(255, 85, 102); transform: translate(138px, -33px) rotate(26deg) scale(2); animation-duration: 1.83s; animation-delay: -1.6104s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(-135px, 31px) rotate(51deg) scale(3.9); animation-duration: 1.4s; animation-delay: -0.084s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(-194px, -31px) rotate(69deg) scale(0.6); animation-duration: 1.16s; animation-delay: -0.7192s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(106px, 127px) rotate(41deg) scale(2.9); animation-duration: 1.33s; animation-delay: -0.3192s;"></span><span class="confetto" style="background-color: rgb(46, 204, 113); transform: translate(-82px, 185px) rotate(43deg) scale(2.7); animation-duration: 1.59s; animation-delay: -1.4628s;"></span><span class="confetto" style="background-color: rgb(46, 204, 113); transform: translate(-169px, 196px) rotate(88deg) scale(3.1); animation-duration: 1.68s; animation-delay: -0.8232s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(162px, -47px) rotate(46deg) scale(3.6); animation-duration: 1.33s; animation-delay: -1.2236s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(-131px, 117px) rotate(31deg) scale(3.5); animation-duration: 1.47s; animation-delay: -1.176s;"></span><span class="confetto" style="background-color: rgb(255, 255, 255); transform: translate(-199px, 86px) rotate(39deg) scale(1.4); animation-duration: 1.28s; animation-delay: -0.768s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(-129px, -176px) rotate(81deg) scale(0.9); animation-duration: 1.92s; animation-delay: -1.0752s;"></span><span class="confetto" style="background-color: rgb(46, 204, 113); transform: translate(-121px, -162px) rotate(47deg) scale(1.9); animation-duration: 1.7s; animation-delay: -1.547s;"></span><span class="confetto" style="background-color: rgb(255, 255, 255); transform: translate(-145px, -72px) rotate(66deg) scale(2.5); animation-duration: 1.17s; animation-delay: -0.8073s;"></span><span class="confetto" style="background-color: rgb(255, 85, 102); transform: translate(-51px, -130px) rotate(36deg) scale(2.1); animation-duration: 1.94s; animation-delay: -0.485s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(71px, -189px) rotate(55deg) scale(1.4); animation-duration: 1.89s; animation-delay: -0.6993s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(159px, -100px) rotate(15deg) scale(2.4); animation-duration: 1.89s; animation-delay: -1.7955s;"></span><span class="confetto" style="background-color: rgb(255, 255, 255); transform: translate(190px, -195px) rotate(72deg) scale(1.8); animation-duration: 1.19s; animation-delay: -0.9996s;"></span><span class="confetto" style="background-color: rgb(46, 191, 246); transform: translate(89px, 45px) rotate(48deg) scale(3.1); animation-duration: 1.28s; animation-delay: -0.0384s;"></span><span class="confetto" style="background-color: rgb(255, 85, 102); transform: translate(59px, 100px) rotate(76deg) scale(2.7); animation-duration: 1.48s; animation-delay: -1.2432s;"></span><span class="confetto" style="background-color: rgb(255, 85, 102); transform: translate(199px, 79px) rotate(88deg) scale(1.6); animation-duration: 1.55s; animation-delay: -0.7905s;"></span><span class="confetto" style="background-color: rgb(46, 204, 113); transform: translate(-84px, 133px) rotate(27deg) scale(2.7); animation-duration: 1.63s; animation-delay: -1.1899s;"></span><span class="confetto" style="background-color: rgb(46, 204, 113); transform: translate(-57px, -64px) rotate(25deg) scale(2.6); animation-duration: 1.78s; animation-delay: -0.3738s;"></span><span class="confetto" style="background-color: rgb(255, 85, 102); transform: translate(-100px, 198px) rotate(59deg) scale(0.8); animation-duration: 1.56s; animation-delay: -0.3744s;"></span><span class="confetto" style="background-color: rgb(46, 191, 246); transform: translate(194px, -113px) rotate(49deg) scale(1); animation-duration: 1.05s; animation-delay: -0.2205s;"></span><span class="confetto" style="background-color: rgb(46, 204, 113); transform: translate(-194px, -191px) rotate(4deg) scale(2.5); animation-duration: 1.89s; animation-delay: -1.323s;"></span><span class="confetto" style="background-color: rgb(46, 191, 246); transform: translate(60px, 68px) rotate(16deg) scale(0.5); animation-duration: 1.17s; animation-delay: -1.1583s;"></span><span class="confetto" style="background-color: rgb(255, 85, 102); transform: translate(-54px, 171px) rotate(1deg) scale(2.7); animation-duration: 1.51s; animation-delay: -0.4983s;"></span><span class="confetto" style="background-color: rgb(255, 255, 255); transform: translate(-84px, -46px) rotate(13deg) scale(2.1); animation-duration: 1.62s; animation-delay: -1.6038s;"></span><span class="confetto" style="background-color: rgb(46, 191, 246); transform: translate(155px, 152px) rotate(19deg) scale(2.9); animation-duration: 1.15s; animation-delay: -0.5405s;"></span><span class="confetto" style="background-color: rgb(241, 196, 15); transform: translate(-56px, -87px) rotate(86deg) scale(2.9); animation-duration: 1.56s; animation-delay: -0.1716s;"></span></span></div>
                <div class="modal__btns">
                    <button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal" aria-label="Close"><span>Đóng</span></button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ifr-bill-panel">
    <div class="bill-frame">
        <div class="bill-header">
            <span class="header-bill-text">CHẴN LẺ BANK - TXBANK - CLBANK UY TÍN NHẤT VN SAO KÊ</span>
            <a href="javascript:void(0);" class="close-bill-frame">ĐÓNG</a>
        </div>
        <iframe id="show-bill-ifr" src="about:blank" onload="resizeIframe(this)"></iframe>
    </div>
</div>

    <!-- JS -->
        <!-- JS -->
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

    </script>


</body>
</html>