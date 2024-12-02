<?php if (!defined('IN_SITE')) {
    die('The Request Not Found');
} ?>

<!DOCTYPE html>
<!-- saved from url=(0019)https://kubank.net/ -->
<html lang="en">

<head>
    
    <title>Hệ Thống Chẵn Lẻ Bank Trả Thưởng Uy Tín</title>
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

    <style id="smooth-scrollbar-style">
        [data-scrollbar] {
            display: block;
            position: relative;
        }

        .scroll-content {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
        }

        .scrollbar-track {
            position: absolute;
            opacity: 0;
            z-index: 1;
            background: rgba(222, 222, 222, .75);
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-transition: opacity 0.5s 0.5s ease-out;
            transition: opacity 0.5s 0.5s ease-out;
        }

        .scrollbar-track.show,
        .scrollbar-track:hover {
            opacity: 1;
            -webkit-transition-delay: 0s;
            transition-delay: 0s;
        }

        .scrollbar-track-x {
            bottom: 0;
            left: 0;
            width: 100%;
            height: 8px;
        }

        .scrollbar-track-y {
            top: 0;
            right: 0;
            width: 8px;
            height: 100%;
        }

        .scrollbar-thumb {
            position: absolute;
            top: 0;
            left: 0;
            width: 8px;
            height: 8px;
            background: rgba(0, 0, 0, .5);
            border-radius: 4px;
        }
    </style>
    
</head>

<body cz-shortcut-listen="true">
    <!-- header -->
    <header class="header">
        <div class="header__content">
            <!-- header logo -->
            <a href="/" class="header__logo">
                <img src="<?= base_url($tkuma->site('anhbia')); ?>" alt="">
            </a>
            <!-- end header logo -->
            <!-- header menu btn -->
            <button class="header__btn" type="button">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <!-- end header menu btn -->
        </div>
    </header>
    <!-- end header -->
    <!-- sidebar -->
    <div class="sidebar">
        <!-- sidebar logo -->
        <a href="/" class="sidebar__logo">
            <img src="<?= base_url($tkuma->site('anhbia')); ?>" alt="">
        </a>

        <div class="sidebar__user" id="altsibaer">

        </div>
        <!-- end sidebar logo -->
        <!-- sidebar nav -->
        <!-- end sidebar logo -->
                <!-- sidebar nav -->
                                             <ul class="sidebar__nav actsibar">
            <li class="sidebar__nav-item">
                <div class="sidebar__user">
        <div class="sidebar__user-title">
                                            <?php if (isset($_SESSION['login'])) { ?>
                            <div class="dropdown"><button onclick="dropbtn()" class="sidebar__nav-linkk" >Xin chào:  <?= $tkuma->get_row(" SELECT * FROM `users` WHERE `token` = ? ",[$_SESSION['login']])['username'];?>
                                <div id="mydrop" class="sidebar__nav-link" >
                                    
        <a class="sidebar__user-btn" type="button" href="<?= BASE_URL('client/logout'); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M4,12a1,1,0,0,0,1,1h7.59l-2.3,2.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l4-4a1,1,0,0,0,.21-.33,1,1,0,0,0,0-.76,1,1,0,0,0-.21-.33l-4-4a1,1,0,1,0-1.42,1.42L12.59,11H5A1,1,0,0,0,4,12ZM17,2H7A3,3,0,0,0,4,5V8A1,1,0,0,0,6,8V5A1,1,0,0,1,7,4H17a1,1,0,0,1,1,1V19a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V16a1,1,0,0,0-2,0v3a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V5A3,3,0,0,0,17,2Z"></path></svg>
        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                    </li>
                    </button>
            <li class="sidebar__nav-item">
                <a href="/" class="sidebar__nav-link"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10,13H3a1,1,0,0,0-1,1v7a1,1,0,0,0,1,1h7a1,1,0,0,0,1-1V14A1,1,0,0,0,10,13ZM9,20H4V15H9ZM21,2H14a1,1,0,0,0-1,1v7a1,1,0,0,0,1,1h7a1,1,0,0,0,1-1V3A1,1,0,0,0,21,2ZM20,9H15V4h5Zm1,4H14a1,1,0,0,0-1,1v7a1,1,0,0,0,1,1h7a1,1,0,0,0,1-1V14A1,1,0,0,0,21,13Zm-1,7H15V15h5ZM10,2H3A1,1,0,0,0,2,3v7a1,1,0,0,0,1,1h7a1,1,0,0,0,1-1V3A1,1,0,0,0,10,2ZM9,9H4V4H9Z" />
                    </svg> TRANG CHỦ</a>
           <li class="sidebar__nav-item">
               <a href="/client/giftcode" class="sidebar__nav-link"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5354 2.87868C16.3638 1.70711 14.4644 1.70711 13.2928 2.87868L11.8786 4.29289C11.8183 4.35317 11.7611 4.41538 11.707 4.47931C11.653 4.41539 11.5958 4.3532 11.5355 4.29293L10.1213 2.87871C8.94975 1.70714 7.05025 1.70714 5.87868 2.87871C4.70711 4.05029 4.70711 5.94978 5.87868 7.12136L6.75732 8H1V14H3V22H21V14H23V8H16.6567L17.5354 7.12132C18.707 5.94975 18.707 4.05025 17.5354 2.87868ZM14.707 7.12132L16.1212 5.70711C16.5117 5.31658 16.5117 4.68342 16.1212 4.29289C15.7307 3.90237 15.0975 3.90237 14.707 4.29289L13.2928 5.70711C12.9023 6.09763 12.9023 6.7308 13.2928 7.12132C13.6833 7.51184 14.3165 7.51184 14.707 7.12132ZM10.1213 5.70714L8.70711 4.29293C8.31658 3.9024 7.68342 3.9024 7.29289 4.29293C6.90237 4.68345 6.90237 5.31662 7.29289 5.70714L8.70711 7.12136C9.09763 7.51188 9.7308 7.51188 10.1213 7.12136C10.5118 6.73083 10.5118 6.09767 10.1213 5.70714ZM21 10V12H3V10H21ZM12.9167 14H19V20H12.9167V14ZM11.0834 14V20H5V14H11.0834Z" fill="currentColor" />
                    </svg> GIFTCODE</a>
            </li>

           <li class="sidebar__nav-item">
                     <a href="/client/nhiem-vu-ngay" class="sidebar__nav-link"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 9C7.44772 9 7 9.44771 7 10C7 10.5523 7.44772 11 8 11H16C16.5523 11 17 10.5523 17 10C17 9.44771 16.5523 9 16 9H8Z" fill="currentColor" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M6 3C4.34315 3 3 4.34315 3 6V18C3 19.6569 4.34315 21 6 21H18C19.6569 21 21 19.6569 21 18V6C21 4.34315 19.6569 3 18 3H6ZM5 18V7H19V18C19 18.5523 18.5523 19 18 19H6C5.44772 19 5 18.5523 5 18Z" fill="currentColor" />
                    </svg> NHIỆM VỤ NGÀY</a>
            </li>
            <li class="sidebar__nav-item">
               <a href="/client/nohu" class="sidebar__nav-link"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935zM3.504 1c.007.517.026 1.006.056 1.469.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.501.501 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667.03-.463.049-.952.056-1.469H3.504z"></path>
                    </svg> NỔ HŨ</a>
                </li>
            <?php if (!isset($_SESSION['login'])) { ?>
                <li class="sidebar__nav-item">
                     <a href="/client/dangki" class="sidebar__nav-link"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"></path>
                            <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"></path>
                        </svg> ĐĂNG KÍ</a>
                </li>
   <li class="sidebar__nav-item">
         <a href="/client/dangnhap" class="sidebar__nav-link"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">  <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"></path>  <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"></path></svg> ĐĂNG NHẬP</a>
                </li>
                <?php } ?>
                <li class="sidebar__nav-item">
                    <a href="<?= $tkuma->site("telegrambox") ?>" class="sidebar__nav-link"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M20.61,19.19A7,7,0,0,0,17.87,8.62,8,8,0,1,0,3.68,14.91L2.29,16.29a1,1,0,0,0-.21,1.09A1,1,0,0,0,3,18H8.69A7,7,0,0,0,15,22h6a1,1,0,0,0,.92-.62,1,1,0,0,0-.21-1.09ZM8,15a6.63,6.63,0,0,0,.08,1H5.41l.35-.34a1,1,0,0,0,0-1.42A5.93,5.93,0,0,1,4,10a6,6,0,0,1,6-6,5.94,5.94,0,0,1,5.65,4c-.22,0-.43,0-.65,0A7,7,0,0,0,8,15ZM18.54,20l.05.05H15a5,5,0,1,1,3.54-1.46,1,1,0,0,0-.3.7A1,1,0,0,0,18.54,20Z" />
                        </svg> BOX CHAT</a>
                </li>

        </ul>
        <!-- end sidebar nav -->
        <!-- sidebar copyright -->
        <div class="sidebar__copyright">© chanlebank.xyz, 2018—2023. <br>Create by chanlebank.xyz.</div>
        <!-- end sidebar copyright -->
    </div>
    <!-- end sidebar -->
    <!-- main content -->
    <main class="main">
        <div class="container-fluid">
            <div class="row " id="wrapper-content">
                <!-- profile -->
                <div class="col-12">
                    <div class="profile__content">
                        <!-- profile tabs nav -->
                        <ul class="nav nav-tabs profile__tabs list-game-custom" id="list-game" role="tablist">
                        </ul>
                        <!-- end profile tabs nav -->
                    </div>
                </div>
                </div>
                <!-- end profile -->
                }
<div class="dashbox__title">
            <h3 style="margin:0 auto;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trophy" viewBox="0 0 16 16">  <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935zM3.504 1c.007.517.026 1.006.056 1.469.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.501.501 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667.03-.463.049-.952.056-1.469H3.504z"></path></svg>NÔ HŨ - JACKPOT
            </h3>
        </div>

        <div class="dashbox">   
        <div class="dashbox__title">
        <div class="subpage-wrapper">
                    <form id="checkNoHu" method="post">
                        <p class="text-center err" id="err-msg"></p>
                        <div class="mb-3">
                            <label for="tran_id" class="form-label text-dark"><font color="#fff">Nhập mã giao dịch</font></label>
                            <input type="number" class="sign__input" id="tran_id" name="transId" placeholder="Mã giao dịch: Ví dụ xxxxxxx5555" aria-describedby="tran_id">
                        </div>
                        <p><button class="sign__btn" type="button" id="exploding"><span>NHẬN THƯỞNG</span></button></p>

                     <p>- Đuôi Tam Hoa 3 Số nhận: <?= format_currency($tkuma->get_row("SELECT * FROM `event` WHERE `keyd` = 'no-hu' ")['thuong3']); ?></p>
 <p>- Đuôi Tứ Quý 4 Số nhận: <?= format_currency($tkuma->get_row("SELECT * FROM `event` WHERE `keyd` = 'no-hu' ")['thuong4']); ?></p>

 <p>- Đuôi Ngũ Quý 5 Số nhận: <?= format_currency($tkuma->get_row("SELECT * FROM `event` WHERE `keyd` = 'no-hu' ")['thuong5']); ?></p>

⛔️ <font color="#fff">LƯU Ý : Sự kiện không phân biệt thắng/thua, chỉ áp dụng với các mã giao dịch từ 20K trở lên.</font><br/>
            
        </div>
    </div>
</div>



            </div>
        </div>
    </main>
    
    <!-- end main content -->
    <!-- view modal -->

    <script>
        function resizeIframe(obj) {
            var fh = obj.contentWindow.document.body.scrollHeight;
            obj.style.height = Math.min(screen.height, fh) + 'px';
        }
    </script>
    <div id="ifr-bill-panel">
        <div class="bill-frame">
            <div class="bill-header">
                <span class="header-bill-text">KUBANK SAO KÊ</span>
                <a href="javascript:void(0);" class="close-bill-frame">ĐÓNG</a>
            </div>
            <iframe id="show-bill-ifr" src="about:blank" onload="resizeIframe(this)"></iframe>
        </div>
    </div>
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

        $(document).ready(function() {
            setTimeout(function() {
                $('.toast-ctv').show();
            }, 2000);
            $('.close-tctv').click(function() {
                $('.toast-ctv').hide();
            });
        });
    </script>

    <!-- End of LiveChat code -->
</body>

<!-- Mirrored from kubank.net/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jan 2024 07:19:15 GMT -->

</html>