<?php if (!defined('IN_SITE')) {
    die('The Request Not Found');
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $tkuma->site('title'); ?></title>
   
    <link href="<?= $tkuma->site('logo'); ?>" rel="apple-touch-icon">
    <link href="<?= $tkuma->site('logo'); ?>" rel="shortcut icon" type="image/x-icon">
    <meta name="description" content="<?= isset($body['description']) ? $body['description'] : $tkuma->site('description'); ?>">
    <meta name="keywords" content="<?= isset($body['keywords']) ? $body['keywords'] : $tkuma->site('keywords'); ?>"> 
    <meta name="copyright" content="<?= $tkuma->site('author'); ?>" />
    <meta name="author" content="<?= $tkuma->site('author'); ?>" />
    <meta property="og:url" content="<?= base_url(''); ?>">
    <meta property="og:site_name" content="<?= base_url(); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="<?= BASE_URL($tkuma->site('logo')); ?>" />
    <meta property="og:image:secure" content="<?= BASE_URL($tkuma->site('anhbia')); ?>" />
    <meta name="twitter:title" content="<?= $tkuma->site('title'); ?>" />
    <meta name="twitter:image" content="<?= BASE_URL($tkuma->site('logo')); ?>" />
    <meta name="twitter:image:alt" content="<?= $tkuma->site('anhbia'); ?>" />
    <link class="main-stylesheet" href="<?= BASE_URL('public/'); ?>cute-alert/style.css" rel="stylesheet" type="text/css">
    
    <script src="<?= BASE_URL('public/'); ?>cute-alert/cute-alert.js"></script>
    <!-- jQuery -->
    <script src="<?= base_url('public/js/jquery-3.6.0.js'); ?>"></script>

    <meta name="format-detection" content="telephone=no">


    <link href="public/theme1/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/theme1/css/jquery.bootstrap-touchspin.min.css">
    <link rel="stylesheet" href="public/theme1/css/swiper-bundle.min.css">

    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="public/theme1/css/style.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body data-theme-color="color-primary">
    <div class="page-wraper">

        <!-- Preloader -->
        <div id="preloader">
            <div class="loader">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <!-- Preloader end-->

        <!-- Header -->
        <header class="header">
            <div class="main-bar">
                <div class="container">
                    <div class="header-content">
                        <div class="left-content">
                            <a href="javascript:void(0);" class="menu-toggler me-2">
                                <!-- <i class="fa-solid fa-bars font-16"></i> -->
                                <svg class="text-dark" xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 0 24 24" width="30px" fill="#000000">
                                    <path d="M13 14v6c0 .55.45 1 1 1h6c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1zm-9 7h6c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1zM3 4v6c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1zm12.95-1.6L11.7 6.64c-.39.39-.39 1.02 0 1.41l4.25 4.25c.39.39 1.02.39 1.41 0l4.25-4.25c.39-.39.39-1.02 0-1.41L17.37 2.4c-.39-.39-1.03-.39-1.42 0z">
                                    </path>
                                </svg>
                            </a>
                            <h5 class="title mb-0 text-nowrap">Grocery</h5>
                        </div>
                        <div class="mid-content"></div>
                        <div class="right-content">
                            <a href="javascript:void(0);" class="theme-color" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
                                <svg class="color-plate" xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 0 24 24" width="30px" fill="#000000">
                                    <path d="M12 3c-4.97 0-9 4.03-9 9s4.03 9 9 9c.83 0 1.5-.67 1.5-1.5 0-.39-.15-.74-.39-1.01-.23-.26-.38-.61-.38-.99 0-.83.67-1.5 1.5-1.5H16c2.76 0 5-2.24 5-5 0-4.42-4.03-8-9-8zm-5.5 9c-.83 0-1.5-.67-1.5-1.5S5.67 9 6.5 9 8 9.67 8 10.5 7.33 12 6.5 12zm3-4C8.67 8 8 7.33 8 6.5S8.67 5 9.5 5s1.5.67 1.5 1.5S10.33 8 9.5 8zm5 0c-.83 0-1.5-.67-1.5-1.5S13.67 5 14.5 5s1.5.67 1.5 1.5S15.33 8 14.5 8zm3 4c-.83 0-1.5-.67-1.5-1.5S16.67 9 17.5 9s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" />
                                </svg>
                            </a>
                            <a href="javascript:void(0);" class="theme-btn">
                                <svg class="dark" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                    <path d="M11.57,2.3c2.38-0.59,4.68-0.27,6.63,0.64c0.35,0.16,0.41,0.64,0.1,0.86C15.7,5.6,14,8.6,14,12s1.7,6.4,4.3,8.2 c0.32,0.22,0.26,0.7-0.09,0.86C16.93,21.66,15.5,22,14,22c-6.05,0-10.85-5.38-9.87-11.6C4.74,6.48,7.72,3.24,11.57,2.3z" />
                                </svg>
                                <svg class="light" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                    <rect fill="none" height="24" width="24" />
                                    <path d="M12,7c-2.76,0-5,2.24-5,5s2.24,5,5,5s5-2.24,5-5S14.76,7,12,7L12,7z M2,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0 c-0.55,0-1,0.45-1,1S1.45,13,2,13z M20,13l2,0c0.55,0,1-0.45,1-1s-0.45-1-1-1l-2,0c-0.55,0-1,0.45-1,1S19.45,13,20,13z M11,2v2 c0,0.55,0.45,1,1,1s1-0.45,1-1V2c0-0.55-0.45-1-1-1S11,1.45,11,2z M11,20v2c0,0.55,0.45,1,1,1s1-0.45,1-1v-2c0-0.55-0.45-1-1-1 C11.45,19,11,19.45,11,20z M5.99,4.58c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41l1.06,1.06 c0.39,0.39,1.03,0.39,1.41,0s0.39-1.03,0-1.41L5.99,4.58z M18.36,16.95c-0.39-0.39-1.03-0.39-1.41,0c-0.39,0.39-0.39,1.03,0,1.41 l1.06,1.06c0.39,0.39,1.03,0.39,1.41,0c0.39-0.39,0.39-1.03,0-1.41L18.36,16.95z M19.42,5.99c0.39-0.39,0.39-1.03,0-1.41 c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L19.42,5.99z M7.05,18.36 c0.39-0.39,0.39-1.03,0-1.41c-0.39-0.39-1.03-0.39-1.41,0l-1.06,1.06c-0.39,0.39-0.39,1.03,0,1.41s1.03,0.39,1.41,0L7.05,18.36z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header -->

        <!-- Sidebar -->



        <div class="dark-overlay"></div>
        <div class="sidebar style-2">
            <a href="/" class="side-menu-logo">
                <img src="<?= $tkuma->site('logo'); ?>" alt="logo">
            </a>
            <ul class="nav navbar-nav">
                <li class="nav-label">Main Menu</li>
                <li>
                    <a class="nav-link" href="/">
                        <span class="dz-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                <path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z" />
                            </svg>
                        </span>
                        <span>Trang Chủ</span>
                    </a>
                </li>

                <?php if(isset($_SESSION['login'])){ ?>
                <li><a class="nav-link" href="client/logout">
                        <span class="dz-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                <g></g>
                                <g>
                                    <g>
                                        <path d="M5,5h6c0.55,0,1-0.45,1-1v0c0-0.55-0.45-1-1-1H5C3.9,3,3,3.9,3,5v14c0,1.1,0.9,2,2,2h6c0.55,0,1-0.45,1-1v0 c0-0.55-0.45-1-1-1H5V5z" />
                                        <path d="M20.65,11.65l-2.79-2.79C17.54,8.54,17,8.76,17,9.21V11h-7c-0.55,0-1,0.45-1,1v0c0,0.55,0.45,1,1,1h7v1.79 c0,0.45,0.54,0.67,0.85,0.35l2.79-2.79C20.84,12.16,20.84,11.84,20.65,11.65z" />
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <span>Logout</span>
                </a></li>
                <?php } else { ?>
                <li><a class="nav-link" href data-toggle="modal" data-target="#modalReJoin">
                         <span class="dz-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </span>
                        <span>Đăng Nhập</span>
                </a></li>
                 <li><a class="nav-link" href data-target="#taonickname" data-toggle="modal">
                         <span class="dz-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </span>
                        <span>Đăng Ký</span>
                </a></li>
                <?php } ?>
                <li class="nav-label">Settings</li>
                <li class="nav-color" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
                    <a href="javascript:void(0);" class="nav-link">
                        <span class="dz-icon">
                            <svg class="color-plate" xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 0 24 24" width="30px" fill="#000000">
                                <path d="M12 3c-4.97 0-9 4.03-9 9s4.03 9 9 9c.83 0 1.5-.67 1.5-1.5 0-.39-.15-.74-.39-1.01-.23-.26-.38-.61-.38-.99 0-.83.67-1.5 1.5-1.5H16c2.76 0 5-2.24 5-5 0-4.42-4.03-8-9-8zm-5.5 9c-.83 0-1.5-.67-1.5-1.5S5.67 9 6.5 9 8 9.67 8 10.5 7.33 12 6.5 12zm3-4C8.67 8 8 7.33 8 6.5S8.67 5 9.5 5s1.5.67 1.5 1.5S10.33 8 9.5 8zm5 0c-.83 0-1.5-.67-1.5-1.5S13.67 5 14.5 5s1.5.67 1.5 1.5S15.33 8 14.5 8zm3 4c-.83 0-1.5-.67-1.5-1.5S16.67 9 17.5 9s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z" />
                            </svg>
                        </span>
                        <span>Color Theme</span>
                    </a>
                </li>
                <li>
                    <div class="mode">
                        <span class="dz-icon">
                            <svg class="dark" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
                                <g></g>
                                <g>
                                    <g>
                                        <g>
                                            <path d="M11.57,2.3c2.38-0.59,4.68-0.27,6.63,0.64c0.35,0.16,0.41,0.64,0.1,0.86C15.7,5.6,14,8.6,14,12s1.7,6.4,4.3,8.2 c0.32,0.22,0.26,0.7-0.09,0.86C16.93,21.66,15.5,22,14,22c-6.05,0-10.85-5.38-9.87-11.6C4.74,6.48,7.72,3.24,11.57,2.3z" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <span class="text-dark">Dark Mode</span>
                        <div class="custom-switch">
                            <input type="checkbox" class="switch-input theme-btn" id="toggle-dark-menu">
                            <label class="custom-switch-label" for="toggle-dark-menu"></label>
                        </div>
                    </div>
                </li>
            </ul>
            <a href="javascript:void(0);" onclick="deleteAllCookie()" class="btn btn-primary btn-sm cookie-btn">Delete
                Cookie</a>
            <div class="sidebar-bottom d-none">
                <h6 class="name">W3Grocery - Multipurpose App</h6>
                <span class="ver-info">App Version 1.0</span>
            </div>
            <div class="author-box mt-auto mb-0">
                <div class="dz-media">
                    <img src="public/theme1/images/avatar/5.jpg" alt="author-image">
                </div>
                <div class="dz-info">
                    <h5 class="name">Login</h5>
                </div>
            </div>
        </div>
        <!-- Sidebar End -->

        <!-- Banner -->
        <div class="author-notification">
            <div class="container inner-wrapper">
                <div class="dz-info">
                    <span class="text-dark d-block">Good Morning</span>
                    <h2 class="name mb-0 title">Louis A. 👋</h2>
                </div>
                <a href="notification.html" class="notify-cart">
                    <span class="font-18 font-w600 text-dark">6</span>
                    <div class="badge">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.8574 17.4858C20.0734 14.5109 19 13.212 19 9.99997C18.9982 8.31756 18.3909 6.692 17.2892 5.42046C16.1876 4.14893 14.665 3.31636 13 3.07497V2.99997C13 2.73475 12.8947 2.4804 12.7071 2.29286C12.5196 2.10533 12.2653 1.99997 12 1.99997C11.7348 1.99997 11.4805 2.10533 11.2929 2.29286C11.1054 2.4804 11 2.73475 11 2.99997V3.07917C9.32471 3.39641 7.81116 4.28459 6.71715 5.59244C5.62313 6.9003 5.01632 8.54695 5.00004 10.252C5.00004 13.212 3.73804 14.826 2.14264 17.4859C2.05169 17.6376 2.00263 17.8107 2.00044 17.9876C1.99826 18.1645 2.04303 18.3388 2.1302 18.4927C2.21737 18.6467 2.3438 18.7747 2.49661 18.8638C2.64943 18.9529 2.82314 18.9999 3.00004 19H21C21.1769 18.9999 21.3507 18.9529 21.5035 18.8638C21.6563 18.7747 21.7828 18.6466 21.8699 18.4927C21.9571 18.3388 22.0019 18.1644 21.9997 17.9875C21.9975 17.8106 21.9484 17.6375 21.8574 17.4858Z" fill="white" />
                            <path d="M14 20H10C9.73478 20 9.48043 20.1054 9.29289 20.2929C9.10536 20.4804 9 20.7348 9 21C9 21.2652 9.10536 21.5196 9.29289 21.7071C9.48043 21.8947 9.73478 22 10 22H14C14.2652 22 14.5196 21.8947 14.7071 21.7071C14.8946 21.5196 15 21.2652 15 21C15 20.7348 14.8946 20.4804 14.7071 20.2929C14.5196 20.1054 14.2652 20 14 20Z" fill="white" />
                        </svg>
                    </div>
                </a>
            </div>
        </div>
        <!-- Banner End -->

        <!-- Page Content -->
        <div class="page-content">
            <div class="content-inner pt-0">
                <div class="container p-b30">
                    <!-- Search -->

                    <!-- Dashboard Area -->
                    <div class="dashboard-area">
                        <!-- Recent -->
                        <div class="m-b10">
                            <div class="swiper-btn-center-lr">
                                <div class="swiper tag-group mt-4 recomand-swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="card add-banner" style="background-image: url(public/theme1/images/background/bg2.png);">
                                                <div class="circle-1"></div>
                                                <div class="circle-2"></div>
                                                <div class="card-body">
                                                    <div class="card-info">
                                                        <span class="font-12 font-w500 text-dark">Happy Weekend</span>
                                                        <h1 data-text="20% OFF" class="title mb-2">20% OFF</h1>
                                                        <small>*for All Menus</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="card add-banner" style="background-image: url(public/theme1/images/background/bg3.png);">
                                                <div class="circle-1"></div>
                                                <div class="circle-2"></div>
                                                <div class="card-body">
                                                    <div class="card-info">
                                                        <span class="font-12 font-w500 text-dark">Happy Weekend</span>
                                                        <h1 data-text="25% OFF" class="title mb-2">25% OFF</h1>
                                                        <small>*for All Menus</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="card add-banner" style="background-image: url(public/theme1/images/background/bg4.png);">
                                                <div class="circle-1"></div>
                                                <div class="circle-2"></div>
                                                <div class="card-body">
                                                    <div class="card-info">
                                                        <span class="font-12 font-w500 text-dark">Happy Weekend</span>
                                                        <h1 data-text="15% OFF" class="title mb-2">15% OFF</h1>
                                                        <small>*for All Menus</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Recent -->
                        <!-- Recomended Start -->
                        <div class="title-bar">
                            <span class="title mb-0 font-18">Popular Deals</span>
                        </div>
                        <style>
                            .justify-center {
    -ms-flex-pack: center !important;
    justify-content: center !important;
}
                        </style>
                        <div class="col-12">
                            <ul class="nav nav-tabs justify-center" id="list-game">
                            </ul>
                        </div>
        
                            <div class="col-12">
                                <div class="card bg-primary">
                                    <div class="card-header">
                                        <h5 class="title text-white" id="gameName">Cách chơi 🔥</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="dz-tab tab-color">
                                            <div class="tab-content" id="myTabContent2">
                                                <div class="tab-pane fade active show" id="TAIXIU-tab-pane2" role="tabpanel" aria-labelledby="TAIXIU-tab" tabindex="0">
                                                    <div class="text-white">
                                                        <p id="gameNoti"></p>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped text-center">
                                                            <thead class="table-dark">
                                                                <tr>
                                                                    <th scope="col" class="text-white">Nội dung</th>
                                                                    <th scope="col" class="text-white">Số cuối mã GD</th>
                                                                    <th scope="col" class="text-white">Tỉ lệ</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tableReward"></tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                      
                        <div class="col-12">
                            <div class="card bg-primary">
                                <div class="card-header">
                                    <h5 class="title text-white">Danh Sách Số 🔥</h5>
                                </div>
                                <div class="card-body">
                                    <div class="dz-tab tab-color">
                                        <div class="tab-content" id="myTabContent2">
                                            <div class="tab-pane fade active show" id="TAIXIU-tab-pane2" role="tabpanel" aria-labelledby="TAIXIU-tab" tabindex="0">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped text-center">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th scope="col" class="text-white">Tối thiểu</th>
                                                                <th scope="col" class="text-white">Tối đa</th>
                                                            </tr>
                                                        </thead>
                                                       <thead>
                                                            <tr>
                                                                <th class="text-white"><?= format_currency($tkuma->site('mingame')); ?></th>
                                                                <th class="text-white"><?= format_currency($tkuma->site('maxgame')); ?></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                   
                                                </div>
                                                
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped text-center">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th scope="col" class="text-white">TRẠNG THÁI</th>
                                                                <th scope="col" class="text-white">SỐ TÀI KHOẢN</th>
                                                                <th scope="col" class="text-white">BANK</th>
                                                                <th scope="col" class="text-white">TÊN</th>
                                                                <th scope="col" class="text-white">MÃ QR</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tablePhone"></tbody>
                                                    </table>
                                                    <div class="text-white text-center">
                                                        <?= $tkuma->site('nofication_ex'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" id="tabtoryuser">
                            <div class="card bg-primary">
                                <div class="card-header">
                                    <h5 class="title text-white" id="gameName">Lịch sử chơi của bạn 🔥</h5>
                                </div>
                                <div class="card-body">
                                    <div class="dz-tab tab-color">
                                        <div class="tab-content" id="myTabContent2">
                                            <div class="tab-pane fade active show" id="TAIXIU-tab-pane2" role="tabpanel" aria-labelledby="TAIXIU-tab" tabindex="0">
                                                <div class="text-white">
                                                    <p id="gameNoti"></p>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped text-center">
                                                        <thead class="table-dark">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card bg-primary">
                                <div class="card-header">
                                    <h5 class="title text-white">Lịch sử thắng 🔥</h5>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead class="table-dark">
                                            <tr>
                                                <th class="text-white text-center">Thời gian</th>
                                                <th class="text-white text-center">NICKNAME</th>
                                                <th class="text-white text-center">MGD</th>
                                                <th class="text-white text-center">TIỀN CƯỢC</th>
                                                <th class="text-white text-center">TRÒ CHƠI</th>
                                                <th class="text-white text-center">CƯỢC</th>
                                                <th class="text-white text-center">KẾT QUẢ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableHistory"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Recomended Start -->
                    </div>

                    <?php require_once(__DIR__ . '/modal.php'); ?>
                    <!-- Other Package -->
                    <div class="col-12">
                        <div class="card bg-primary">
                            <div class="card-header">
                                <h5 class="title text-white">TOP thắng tuần 🔥</h5>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-white text-center">TOP</th>
                                            <th class="text-white text-center">Mã định danh</th>
                                            <th class="text-white text-center">Số tiền</th>
                                            <th class="text-white text-center">Phần thưởng</th>
                                        </tr>
                                    </thead>
                                   <tbody id="toptuan"></tbody>
                                </table>
                                <div class="text-white text-center">Phần thưởng TOP sẽ dược trao vào 23:50 Chủ Nhật
                                    hàng tuần.</div>
                            </div>
                        </div>
                    </div>
                    <h6 class="title-head mb-3">Other Login w3Grocery package</h6>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="package-box box-1">
                                <div class="media media-70">
                                    <img src="public/theme1/images/package/shop.svg" alt="image">
                                </div>
                                <h6 class="title-head">Gift Code</h6>
                                <p class="sub-title">Continue With Vendor</p>
                                <button href="" data-target="#code-khuyen-mai" data-toggle="modal" class="btn package-btn">Click Now
                                    <i class="fa-solid fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>  
                        <div class="col-6">
                            <div class="package-box box-2">
                                <div class="media media-70">
                                    <img src="public/theme1/images/package/boy.svg" alt="image">
                                </div>
                                <h6 class="title-head">Check TranID</h6>
                                <p class="sub-title">Continue With Driver</p>
                                <a data-target="#code-khuyen-mai" data-toggle="modal" class="btn package-btn">Click Now
                                    <i class="fa-solid fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="package-box box-2">
                                <div class="media media-70">
                                    <img src="public/theme1/images/package/boy.svg" alt="image">
                                </div>
                                <h6 class="title-head">Nổ Hủ</h6>
                                <a data-toggle="modal" data-target="#modal-kiem-tra-no-hu" class="btn package-btn">Click Now
                                    <i class="fa-solid fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="package-box box-1" id="diem-danh-button">
                                <div class="media media-70">
                                    <img src="public/theme1/images/package/shop.svg" alt="image">
                                </div>  
                                <h6 class="title-head">Điểm Danh</h6>
                                <a data-toggle="modal" data-target="#diem-danh" class="btn package-btn">Click Now
                                    <i class="fa-solid fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-4" id="nhiem-vu-ngay-button">
                            <div class="package-box box-1">
                                <div class="media media-70">
                                    <img src="public/theme1/images/package/boy.svg" alt="image">
                                </div>  
                                <h6 class="title-head">Nhiệm Vụ Ngày</h6>
                                <a data-toggle="modal" data-target="#nhiem-vu-ngay" class="btn package-btn">Click Now
                                    <i class="fa-solid fa-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Other Package -->
                </div>
            </div>

        </div>
        <!-- Page Content End-->

        <!-- Menubar -->
        <div class="menubar-area style-2 footer-fixed border-top rounded-0">
            <div class="toolbar-inner menubar-nav">
                <a href="/" class="nav-link active">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.14373 20.7821V17.7152C9.14372 16.9381 9.77567 16.3067 10.5584 16.3018H13.4326C14.2189 16.3018 14.8563 16.9346 14.8563 17.7152V20.7732C14.8562 21.4473 15.404 21.9951 16.0829 22H18.0438C18.9596 22.0023 19.8388 21.6428 20.4872 21.0007C21.1356 20.3586 21.5 19.4868 21.5 18.5775V9.86585C21.5 9.13139 21.1721 8.43471 20.6046 7.9635L13.943 2.67427C12.7785 1.74912 11.1154 1.77901 9.98539 2.74538L3.46701 7.9635C2.87274 8.42082 2.51755 9.11956 2.5 9.86585V18.5686C2.5 20.4637 4.04738 22 5.95617 22H7.87229C8.19917 22.0023 8.51349 21.8751 8.74547 21.6464C8.97746 21.4178 9.10793 21.1067 9.10792 20.7821H9.14373Z" fill="#130F26"></path>
                    </svg>
                </a>
                <a href="/" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path d="M23.561 6.622L19.5 10.683c-.293.293-.677.439-1.061.439s-.768-.146-1.061-.439a1.5 1.5 0 0 1 0-2.121l1.5-1.5H3.153a1.5 1.5 0 1 1 0-3h15.726l-1.5-1.5a1.5 1.5 0 0 1 0-2.121 1.5 1.5 0 0 1 2.121 0l4.061 4.061a1.5 1.5 0 0 1 0 2.121zm-3.533 10.317H5.122l1.5-1.5a1.5 1.5 0 0 0-2.121-2.121L.44 17.378a1.5 1.5 0 0 0 0 2.121l4.061 4.061c.293.293.677.439 1.061.439s.768-.146 1.061-.439a1.5 1.5 0 0 0 0-2.121l-1.5-1.5h14.906a1.5 1.5 0 1 0 0-3z" fill="#7d8fab" />
                    </svg>
                </a>
                <a href="/" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 456.569 456.569">
                        <path d="M345.805 339.465c-29.323-.028-53.117 23.72-53.146 53.043s23.72 53.117 53.043 53.146 53.117-23.72 53.146-53.043v-.051c-.028-29.292-23.752-53.038-53.043-53.095zm94.171-254.244a20.44 20.44 0 0 0-3.855-.373H112.845l-5.12-34.253c-3.19-22.748-22.648-39.673-45.619-39.68H20.48C9.169 10.915 0 20.084 0 31.395s9.169 20.48 20.48 20.48h41.677a5.12 5.12 0 0 1 5.12 4.506l31.539 216.166c4.324 27.468 27.951 47.732 55.757 47.821h213.043c26.771.035 49.866-18.78 55.245-45.005l33.331-166.144c2.149-11.105-5.111-21.849-16.216-23.998zM215.737 390.286c-1.247-28.463-24.737-50.869-53.228-50.77h0c-29.299 1.184-52.091 25.896-50.907 55.195 1.136 28.113 24.005 50.458 52.136 50.943h1.28c29.295-1.284 52.002-26.073 50.719-55.368z" />
                    </svg>
                </a>
                <a href="/" class="nav-link">
                    <svg enable-background="new 0 0 512.001 512.001" height="512" viewBox="0 0 512.001 512.001" width="512" xmlns="http://www.w3.org/2000/svg">
                        <path d="m256.001 477.407c-2.59 0-5.179-.669-7.499-2.009-2.52-1.454-62.391-36.216-123.121-88.594-35.994-31.043-64.726-61.833-85.396-91.513-26.748-38.406-40.199-75.348-39.982-109.801.254-40.09 14.613-77.792 40.435-106.162 26.258-28.848 61.3-44.734 98.673-44.734 47.897 0 91.688 26.83 116.891 69.332 25.203-42.501 68.994-69.332 116.891-69.332 35.308 0 68.995 14.334 94.859 40.362 28.384 28.563 44.511 68.921 44.247 110.724-.218 34.393-13.921 71.279-40.728 109.632-20.734 29.665-49.426 60.441-85.279 91.475-60.508 52.373-119.949 87.134-122.45 88.588-2.331 1.354-4.937 2.032-7.541 2.032z" />
                    </svg>
                </a>
                <a href="/" class="nav-link">
                    <div class="media media-25 rounded-circle mx-auto">
                        <img src="public/theme1/images/avatar/9.jpg" alt="/">
                    </div>
                </a>
            </div>
        </div>
        <!-- Menubar -->

        <div class="offcanvas offcanvas-bottom m-3 rounded" tabindex="-1" id="offcanvasBottom">
            <div class="offcanvas-body small">
                <ul class="theme-color-settings">
                    <li>
                        <input class="filled-in" id="primary_color_8" name="theme_color" type="radio" value="color-primary">
                        <label for="primary_color_8"></label>
                        <span>Default</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_2" name="theme_color" type="radio" value="color-green">
                        <label for="primary_color_2"></label>
                        <span>Green</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_3" name="theme_color" type="radio" value="color-blue">
                        <label for="primary_color_3"></label>
                        <span>Blue</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_4" name="theme_color" type="radio" value="color-pink">
                        <label for="primary_color_4"></label>
                        <span>Pink</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_5" name="theme_color" type="radio" value="color-yellow">
                        <label for="primary_color_5"></label>
                        <span>Yellow</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_6" name="theme_color" type="radio" value="color-orange">
                        <label for="primary_color_6"></label>
                        <span>Orange</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_7" name="theme_color" type="radio" value="color-purple">
                        <label for="primary_color_7"></label>
                        <span>Purple</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_1" name="theme_color" type="radio" value="color-red">
                        <label for="primary_color_1"></label>
                        <span>Red</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_9" name="theme_color" type="radio" value="color-lightblue">
                        <label for="primary_color_9"></label>
                        <span>Lightblue</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_10" name="theme_color" type="radio" value="color-teal">
                        <label for="primary_color_10"></label>
                        <span>Teal</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_11" name="theme_color" type="radio" value="color-lime">
                        <label for="primary_color_11"></label>
                        <span>Lime</span>
                    </li>
                    <li>
                        <input class="filled-in" id="primary_color_12" name="theme_color" type="radio" value="color-deeporange">
                        <label for="primary_color_12"></label>
                        <span>Deeporange</span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Theme Color Settings End -->
        <!-- PWA Offcanvas -->


        <!-- PWA Offcanvas End -->
    </div>
    <!--**********************************
    Scripts
    ***********************************-->

    <script src="public/theme1/js/jquery.js"></script>
    <script src="public/theme1/js/bootstrap.bundle.min.js"></script>
    <script src="public/theme1/js/swiper-bundle.min.js"></script><!-- Swiper -->
    <script src="public/theme1/js/jquery.bootstrap-touchspin.min.js"></script><!-- Swiper -->
    <script src="public/theme1/js/dz.carousel.js"></script><!-- Swiper -->
    <script src="public/theme1/js/settings.js"></script>
    <script src="public/theme1/js/custom.js"></script>

    <script src="<?= BASE_URL('public'); ?>/js/clipboard.js"></script>
    <link href="<?= base_url('public/cute-alert/sweetalert2/sweetalert2.min.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('public/cute-alert/sweetalert2/sweetalert2.min.js'); ?>"></script>
    <script src="<?= BASE_URL('public/'); ?>js/kuma.js?v=<?= time(); ?>"></script>
    <script src="<?= BASE_URL('public/'); ?>js/custom.js?v=<?= time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    
        <?php if ($tkuma->site('notification') != '') { ?>
        <!-- Modal Notification -->
        
        <div class="modal fade" id="modalNoti" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thông báo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= $tkuma->site('notification'); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-block btn-read" data-dismiss="modal">Đã đọc</button>
                    </div>
                </div>
            </div>
        </div>
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
                    $('#modalNoti').modal('hide')
                    let now = Date.now();
                    localStorage.setItem('isRead', now + 3600 * 1000)
                })
            })
            
        </script>

    <?php } ?>
</body>

</html>