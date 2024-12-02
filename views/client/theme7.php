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
    <meta name="author" content="CHANLEBANK.XYZ">
    <title>CHẴN LẺ BANK - Clbank Uy Tín</title>
    <?= $body['header']; ?>
</head>

<body>
    <div class="preloader"></div>
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
            </li>

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
                        </svg>GROUP TELEGRAM NHẬN CODE</a>
                </li>
                            <li class="sidebar__nav-item">
                    <a href="<?= $tkuma->site("telegram") ?>" class="sidebar__nav-link"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M20.61,19.19A7,7,0,0,0,17.87,8.62,8,8,0,1,0,3.68,14.91L2.29,16.29a1,1,0,0,0-.21,1.09A1,1,0,0,0,3,18H8.69A7,7,0,0,0,15,22h6a1,1,0,0,0,.92-.62,1,1,0,0,0-.21-1.09ZM8,15a6.63,6.63,0,0,0,.08,1H5.41l.35-.34a1,1,0,0,0,0-1.42A5.93,5.93,0,0,1,4,10a6,6,0,0,1,6-6,5.94,5.94,0,0,1,5.65,4c-.22,0-.43,0-.65,0A7,7,0,0,0,8,15ZM18.54,20l.05.05H15a5,5,0,1,1,3.54-1.46,1,1,0,0,0-.3.7A1,1,0,0,0,18.54,20Z" />
                        </svg> ADMIN HỖ TRỢ</a>
                </li>
        </ul>
        <!-- end sidebar nav -->
        <!-- sidebar copyright -->
        <div class="sidebar__copyright">©  2018—2024. <br>Create by  Ltd.</div>
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
                <div class="row" id="content-main">
                    <!-- end profile -->

                    <!-- dashbox -->
                    <div class="col-12 col-xl-6">
                        <div class="dashbox game-list">
                            <div class="game-details active">
                                <div class="dashbox__title">
                                    <h3>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dice-5-fill" viewBox="0 0 16 16">
                                            <path d="M3 0a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V3a3 3 0 0 0-3-3H3zm2.5 4a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm8 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zM12 13.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM5.5 12a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zM8 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z">
                                            </path>
                                        </svg> <b id="gameName"></b>
                                    </h3>
                                </div>

                                <div class="dashbox__table-wrap dashbox__table-wrap--1">
                                    <table class="dashbox__table">
                                        <thead>
                                            <tr class="text-center">
                                                <th>TÊN GAME</th>
                                                <th>MÃ GAME</th>
                                                <th>NỘI DUNG</th>
                                                <th>SỐ CUỐI</th>
                                                <th>TỶ LỆ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableReward"></tbody>
                                    </table>
                                    <div class="subpage-wrapper"  id="gameNoti">
                                       
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end dashbox -->
                    <!-- dashbox -->
                    <div id="bank-infos" class="col-12 col-xl-6">

                        <div class="dashbox dashbox-custom">
                            <div class="dashbox__title">
                                <h3><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bank2" viewBox="0 0 16 16">
                                        <path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916l-7.5-5zM12.375 6v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2zM.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1H.5z">
                                        </path>
                                    </svg> THÔNG TIN BANK NHẬN</h3>
                            </div>
                            <div class="dashbox__table-wrap dashbox__table-wrap--111" >
                                <table class="dashbox__table">
                                    <thead>
                                        <tr>
                                            <th class="text-whited text-center">CƯỢC MIN</th>
                                            <th class="text-whited text-center">CƯỢC MAX</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-white text-center"><?= format_currency($tkuma->site('mingame')); ?></td>
                                            <td class="text-white text-center"><?= format_currency($tkuma->site('maxgame')); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="dashbox__table-wrap dashbox__table-wrap--11" id="tablePhonetitle">
                                <?php if (isset($_SESSION['login'])) { ?>
                                    <table class="dashbox__table">
                                        <thead>
                                            <tr>
                                                <th class="text-center text-whited">TRẠNG THÁI</th>
                                                
                                                <th class="text-center text-whited">SỐ TÀI KHOẢN</th>
                                                <th class="text-center text-whited">NGÂN HÀNG</th>
                                                <th class="text-center text-whited">TÊN CTK</th>
                                                <!--<th class="text-whited">CƯỢC MIN</th>-->
                                                <!--<th class="text-whited">CƯỢC MAX</th>-->
                                                <th class="text-whited">MÃ QR</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablePhone"></tbody>
                                    </table>
                                    <?php }else { ?>
                                   <div class="text-center">
                <p>ĐỂ LẤY THÔNG TIN BANK CHUYỂN KHOẢN, VUI LÒNG <a href="/client/dangnhap">ĐĂNG NHẬP</a> HOẶC <a href="/client/dangki">ĐĂNG KÝ NHANH</a></p>
            </div>
                                <?php } ?>
                            </div>
                        </div>

                    </div>

                    <!-- end dashbox -->


                    <!-- dashbox -->
                    <div class="col-12">
                        <div class="dashbox dashbox-custom">
                            <div class="dashbox__title">
                                <h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z">
                                        </path>
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z">
                                        </path>
                                    </svg> LỊCH SỬ CHƠI GẦN ĐÂY
                                </h3>
                            </div>

                            <div class="dashbox__table-wrap dashbox__table-wrap--2" id="datahisgdtitle">
                                <table class="dashbox__table text-center ">
                                    <thead>
                                        <tr>
                                            <th>THỜI GIAN</th>
                                            <th>TÀI KHOẢN</th>
                                            <th>MÃ GIAO DỊCH</th>
                                            <th>SỐ TIỀN</th>
                                            <th>ĐÃ CHỌN</th>
                                            <th>KẾT QUẢ</th>
                                            <th>THỜI GIAN</th>
                                            <th>TRẠNG THÁI</th>
                                        </tr>
                                    </thead>
                                    <tbody id="datahisuer"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end dashbox -->
                    <!-- dashbox -->
                    <div class="col-12" id="recently-win-game">
                        <div class="dashbox dashbox-custom">
                            <div class="dashbox__title">
                                <h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z">
                                        </path>
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z">
                                        </path>
                                    </svg> LỊCH SỬ THAM GIA
                                </h3>
                            </div>
                            <div class="dashbox__table-wrap dashbox__table-wrap-win-games">
                                <table class="dashbox__table text-center ">
                                    <thead>
                                        <tr>
                                            <th>THỜI GIAN</th>
                                            <th>NGƯỜI CHƠI</th>
                                            <th>MÃ GIAO DỊCH</th>
                                            <th>SỐ TIỀN</th>
                                            <th>TRÒ CHƠI</th>
                                            <th>KẾT QUẢ</th>
                                            <th>TRẠNG THÁI</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableHistory">
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end dashbox -->
                    <!-- dashbox -->
                    <div class="col-12 col-xl-6">
                        <div class="dashbox top-week">
                            <div class="dashbox__title">
                                <h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award-fill" viewBox="0 0 16 16">
                                        <path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864 8 0z">
                                        </path>
                                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z">
                                        </path>
                                    </svg> ĐẠI GIA TUẦN 
                                </h3>
                            </div>

                            <div class="dashbox__table-wrap dashbox__table-wrap--4 top-weekly-players">
                                <table class="dashbox__table text-center ">
                                    <thead>
                                        <tr>
                                            <th>HẠNG</th>
                                            <th>NICKNAME</th>
                                            <th>TỔNG CƯỢC</th>
                                            <th>PHẦN THƯỞNG</th>
                                        </tr>
                                    </thead>
                                    <tbody id="toptuan"></tbody>
                                </table>
                                <div class="text-center mt-4">
                                    <p>
                                        - PHẦN THƯỞNG TOP SẼ ĐƯỢC TRAO VÀO 0:00 THỨ 2 TUẦN TIẾP THEO.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end dashbox -->
                    <!-- dashbox -->
                    <!--<div class="col-12 col-xl-6">
                        <div class="dashbox ongoing-events">
                            <div class="dashbox__title">
                                <h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49a68.14 68.14 0 0 0-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 74.663 74.663 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199V2.5zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0zm-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233c.18.01.359.022.537.036 2.568.189 5.093.744 7.463 1.993V3.85zm-9 6.215v-4.13a95.09 95.09 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A60.49 60.49 0 0 1 4 10.065zm-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68.019 68.019 0 0 0-1.722-.082z" />
                                    </svg> SỰ KIỆN ĐANG DIỄN RA
                                </h3>
                            </div>
                            <div class="dashbox__table-wrap dashbox__table-wrap--4">
                                <?= $tkuma->site('sukien'); ?>
                            </div>
                        </div>
                    </div>
                    -->
                    
                    <div class="col-12 col-xl-6">
                        <div class="dashbox ongoing-events">
                            <div class="dashbox__title">
                                <h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49a68.14 68.14 0 0 0-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 74.663 74.663 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199V2.5zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0zm-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233c.18.01.359.022.537.036 2.568.189 5.093.744 7.463 1.993V3.85zm-9 6.215v-4.13a95.09 95.09 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A60.49 60.49 0 0 1 4 10.065zm-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68.019 68.019 0 0 0-1.722-.082z" />
                                    </svg> HƯỚNG DẪN CHƠI
                                </h3>
                            </div>
                            <div class="dashbox__table-wrap dashbox__table-wrap--4" style="padding:61.57% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/1013229278?badge=0&amp;autopause=0&amp;player_id=0&amp;app_id=58479" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;" title="Hướng dẫn chơi chẵn lẻ mobile"></iframe></div><script src="https://player.vimeo.com/api/player.js"></script>
                        </div>
                    </div>
                    
                    <!-- end dashbox -->
                    <!-- dashbox -->
                    <div class="col-12">
                        <div class="dashbox play-rules">
                            <div class="dashbox__title">
                                <h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
                                        <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5zm0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065l.087-.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8 4.617 4.322zm.344 7.646.087.065-.087-.065z">
                                        </path>
                                    </svg> QUY ĐỊNH LUẬT CHƠI
                                </h3>
                            </div>

                            <div class="dashbox__table-wrap dashbox__table-wrap--4">
                                <?= $tkuma->site('cachchoi'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- end dashbox -->
                    <!-- dashbox -->
                    <div class="col-12">
                        <div class="dashbox play-rules">
                            <div class="dashbox__title">
                                <h3>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
                                        <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434l.071-.286zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5zm0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78h4.723zM5.048 3.967c-.03.021-.058.043-.087.065l.087-.065zm-.431.355A4.984 4.984 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8 4.617 4.322zm.344 7.646.087.065-.087-.065z">
                                        </path>
                                    </svg> CHẴN LẺ BANK LÀ GÌ?
                                </h3>
                            </div>

                            <div class="dashbox__table-wrap dashbox__table-wrap--4">
                                <?= $tkuma->site('nofication_ex'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- end dashbox -->
                     <!-- dashbox -->
                   


                </div>
                <div class="row" id="content-thaythe">
                    <div class="col-12">
                        <div class="dashbox">
                            <div class="dashbox__title">
                                <h3 style="margin:0 auto;" id="namethay">

                                </h3>
                            </div>
                            <div class="subpage-wrapper" id="contanerbox">
                            </div>
                        </div>
                    </div>
                </div>



                <!--<div class="toast toast-ctv">-->
                <!--    <div class="toast-body text-center">-->
                <!--        <p>LOA LOA!!! NHẬN <span class="code-num">HOÀN CƯỢC</span> LÊN TỚI <span class="code-num">60%-->
                <!--                BẤT KỂ THẮNG THUA</span>. ƯU ĐÃI CHỈ DÀNH RIÊNG CHO BẠN TRONG NGÀY HÔM NAY!!!</p>-->
                <!--        <div class="mt-3 pt-3 border-top">-->
                <!--            <a href="hoancuoc.html" class="lnk__btn">THAM GIA</a>-->
                <!--            <button type="button" class="close-tctv">ĐÓNG</button>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!-- view modal -->
                <div class="modal fade" id="modalNoti" tabindex="-1" aria-labelledby="modal-view" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
                        <div class="modal-content">
                            <div class="modal__content modal__content--view">
                                <div class="comments__autor">
                                    <img class="comments__avatar" src="<?= BASE_URL('') . $tkuma->site("favicon"); ?>" alt="">
                                    <span class="comments__name"><?= $tkuma->site('title'); ?> Thông Báo</span>
                                </div>
                                <div class="modal-body">
                                    <?= $tkuma->site('notification'); ?>
                                </div>
                                <div class="modal__btns">
                                    <button class="modal__btn modal__btn--dismiss" type="button" data-bs-dismiss="modal" aria-label="Close"><span>Đóng</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end view modal -->
                <!-- view modal -->
                <div class="modal fade" id="modal-qr" tabindex="-1" aria-labelledby="modal-view" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
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
                                <!--    <div class="row">
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
                                        -->
                                    </div>
                                    <p class="qr-notes"><span>- Số tiền chuyển khoản: nếu đặt </span><span style="color:#e67e22">50.000</span> kèo chẵn hãy chuyển <span style="color:#e67e22">50.002</span> (<span style="color:#e67e22">02</span> là Mã game)</p>
                                    <p class="qr-notes">- Nội dung chuyển khoản:<span style="color:#e67e22"> <?= $tkuma->get_row(" SELECT * FROM `users` WHERE `token` = ? ",[$_SESSION['login']])['username'];?></span> (là tên đăng nhập của bạn)</p>
                                    
                                    <!--  <p class="qr-notes">- Nội dung chuyển khoản: <?= $tkuma->get_row(" SELECT * FROM `users` WHERE `token` = ? ",[$_SESSION['login']])['username'];?> <span class="badge badge-info copy-text" data-clipboard-text="<?= $tkuma->get_row(" SELECT * FROM `users` WHERE `token` = ? ",[$_SESSION['login']])['username'];?>"><i class="fa fa-copy"></i></span></p>
                                    -->
                                    <button class="modal__btn modal__btn--dismiss btn-close-qr" type="button"
                                        data-dismiss="modal" aria-label="Close"><span>Đóng</span></button>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                     
                </div>
               
                <!-- end view modal -->
                <div class="hidden">
                    <input type="hidden" name="Account" id="_account" />
                    <input type="hidden" name="HLog" value="" id="_hlog" />
                </div>

            </div>
        </div>
    </main>
    <!-- end main content -->
    <!-- view modal -->
    <script type="text/javascript">
        $(document).ready(function() {

            let isRead = localStorage.getItem('isRead');

            if (isRead) {
                let now = Date.now();

                if (now >= isRead) {
                    localStorage.clear('isRead');
                    isRead = null;
                }
            }

            if (!isRead) {
                $('#modalNoti').modal('show')
            }

            $('.btn-read').click(function(e) {
                let now = Date.now();
                localStorage.setItem('isRead', now + 3600 * 1000)
            })
        })
    </script>
    <script>
        function resizeIframe(obj) {
            var fh = obj.contentWindow.document.body.scrollHeight;
            obj.style.height = Math.min(screen.height, fh) + 'px';
        }
    </script>
    <?php require_once(__DIR__ . '/modal.php'); ?>
    <div id="ifr-bill-panel">
        <div class="bill-frame">
            <div class="bill-header">
                <span class="header-bill-text">TxBank SAO KÊ</span>
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



    <noscript><a href="https://www.livechat.com/chat-with/14584032/" rel="nofollow">Chat with us</a>, powered by <a href="https://www.livechat.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a></noscript>
    <!-- End of LiveChat code -->
</body>

<!-- Mirrored from kubank.net/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 24 Jan 2024 07:19:15 GMT -->

</html>