<?php
$herf = $_SERVER['SERVER_NAME'];
?>
<?php if (!defined('IN_SITE')) {
    die('The Request Not Found');
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="UTF-8">
    
    <link href="<?= BASE_URL($tkuma->site('favicon')); ?>" rel="apple-touch-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= BASE_URL($tkuma->site('favicon')); ?>" rel="shortcut icon" type="image/x-icon">

    <meta name="description" content="<?= $tkuma->site('description'); ?>">
    <meta name="keywords" content="<?= $tkuma->site('keywords'); ?>,clmm,minigame<?= $tkuma->site('dscr'); ?>,<?= $tkuma->site('dscr'); ?>,Chan le <?= $tkuma->site('dscr'); ?>,Tài Xỉu <?= $tkuma->site('dscr'); ?>,chanle<?= $tkuma->site('dscr'); ?>,Chẵn lẻ online,Chẵn Lẻ,<?= $tkuma->site('dscr'); ?> cl,Cách Chơi chẵn lẽ <?= $tkuma->site('dscr'); ?>,chẵn lẽ <?= $tkuma->site('dscr'); ?> tự động">
    <meta property="og:description" content="<?= $tkuma->site('description'); ?>,Chẵn Lẻ <?= $tkuma->site('dscr'); ?> - Mini game giải trí chẵn lẻ <?= $tkuma->site('dscr'); ?> uy tín và hệ thống thanh toán tự động trong 30s, kiếm Tiền Nhanh Chóng chỉ trong 1 nốt nhạc.">
    <meta property="og:image" content="<?= BASE_URL($tkuma->site('anhbia')); ?>">
    <meta property="og:url" content="<?= $herf; ?>">
    <title><?= $tkuma->site('title'); ?> | Chẳn Lẽ</title>
    <link rel="stylesheet" href="<?= BASE_URL('public/theme2'); ?>/css/app.css?v=<?= time(); ?>">
    <link rel="stylesheet" href="<?= BASE_URL('public/theme2'); ?>/plugins/notify/css/jquery.growl.css">
    <link rel="stylesheet" href="<?= BASE_URL('public/theme2'); ?>/css/richtext.css">
    <link rel="stylesheet" href="<?= BASE_URL('public/theme2'); ?>/plugins/select2/select2.min.css">
    <script src="https://cdn.rawgit.com/dankogai/js-base64/v2.1.9/base64.js"></script>
    
    <!--<script src="https://cdn.socket.io/4.0.1/socket.io.min.js"></script>-->
   
    
    </head>


<body>

    <style>
        .text-white {
            color: <?= $tkuma->site('color_text'); ?> !important;
        }
        .text-whited {
            color: #f3f6f4 !important;
        }
        .admin-navbar .nav-link {
            padding: 0.60rem 2.3rem !important;
        }

        .page-main:after {
            content: "";
            height: 260px;
            background-image: linear-gradient(to left, <?= $tkuma->site('color'); ?>, <?= $tkuma->site('color'); ?>);

            position: absolute;
            z-index: -1;
            width: 100%;
            top: 0;
        }

        .badge-primary {
            color: #fff;
            background: linear-gradient(to bottom right, <?= $tkuma->site('color_button'); ?>, <?= $tkuma->site('color_button'); ?>);
        }

        .admin-navbar .nav {
            padding: 0;
            margin: 0;
            background: <?= $tkuma->site('color_head'); ?>;
            border-radius: 5px;
        }
    </style>
    <div id="global-loader"></div>
    <div class="page">
        <div class="page-main">
            <div class="header">
                <div class="container">
                    <div class="d-flex">
                        <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                            <span class="header-toggler-icon"></span>
                        </a>
                        <a class="header-brand" href="/" style="color:#fff;font-weight:bold">
                            <i class="fab fa-opencart" style="font-size: 25px;"></i> <?= $tkuma->site('title'); ?></a>
                    </div>
                </div>
            </div>
            <div class="admin-navbar sticky" id="headerMenuCollapse">
                <div class="container">
                    <ul class="nav">
                        <li class="nav-item with-sub">
                            <a class="nav-link" href="../">
                                <i class="fas fa-home"></i>
                                <span>Trang Chủ</span>
                            </a>
                        </li>
                        <li class="nav-item with-sub">
                            <a class="nav-link scroll-to" href="#how_to_play"><i class="fa fa-gamepad"></i>
                                <span>Cách Chơi</span>
                            </a>
                        </li>
                       
                        <li class="nav-item with-sub">
                            <a class="nav-link" href data-target="#modalReJoin" data-toggle="modal" ><i class="fa fa-trophy"></i>
                                <span>Tham gia lại</span>
                            </a>
                        </li>
                       
                        <li class="nav-item with-sub">
                            <a class="nav-link" href data-target="#taonickname" data-toggle="modal" ><i class="fa fa-trophy"></i>
                                <span>Tạo Nickname</span>
                            </a>
                        </li>
    
                    </ul>
                </div>
            </div>
            <main class="container">
                <div class="mainbar"></div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="content text-center">
                            <h2>Hệ Thống Mini Game Chẳn Lẻ</h2>
                            <div class="row justify-content-center mb-3" id="list-game">
                               
                            </div>
                            <div class="row justify-content-center align-items-center">
                                <div style="padding: 5px">
                                    <a class="btn btn-outline-danger " data-toggle="modal" data-target="#modalNoti">
                                        <b><i class="fas fa-tasks mr-1"></i> Thông Báo</b>
                                    </a>
                                </div>

                                <div style="padding: 5px">
                                    <button class="btn btn-outline-info" data-toggle="modal" data-target="#code-khuyen-mai" >
                                        <b><i class="fas fa-gift mr-1"></i> GiftCode</b>
                                    </button>
                                </div>
                                <div style="padding: 5px">
                                    <button class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-kiem-tra-giao-dich">
                                        <b><i class="fas fa-file-signature mr-1"></i> Check TranID</b>
                                    </button>
                                </div>
      
                                <div style="padding: 5px">
                                    <button class="btn btn-outline-danger" data-toggle="modal" data-target="#modal-kiem-tra-no-hu" >
                                        <b><i class="fas fa-gift mr-1"></i> Nổ Hủ</b>
                                    </button>
                                </div>
                                <div style="padding: 5px" id="diem-danh-button">
                                    <button class="btn btn-outline-danger" data-toggle="modal" data-target="#diem-danh" >
                                        <b><i class="fas fa-calendar-check mr-1"></i> Điểm Danh</b>
                                    </button>
                                </div>
                                <div style="padding: 5px" id="nhiem-vu-ngay-button">
                                    <button class="btn btn-outline-danger" data-toggle="modal" data-target="#nhiem-vu-ngay" >
                                        <b><i class="far fa-calendar-alt mr-1"></i> Nhiệm Vụ Ngày</b>
                                    </button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <!--<sections id="how_to_play">-->
                        <div class="col-md-5 mb-3">
                            <div class="content h-100">
                                <h3 id="gameName">Cách Chơi</h3>
                                <!--<div class="alert alert-warning" role="alert">-->
                                <!--    <?= $tkuma->site('nofication_ex'); ?>-->
                                <!--</div>-->
                                <p id="gameNoti"></p>
                                <div class="table-responsive mb-3">
                                    <table class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                                        <thead class="badge-primary text-white">
                                            <tr>
                                                <th class="text-whited">Tối thiểu</th>
                                                <th class="text-whited">Tối đa</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr>
                                                <th class="text-white"><?= format_currency($tkuma->site('mingame')); ?></th>
                                                <th class="text-white"><?= format_currency($tkuma->site('maxgame')); ?></th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p>Chuyển tiền vào 1 trong các tài khoản <?= $tkuma->site('dscr'); ?> sau:</p>
                                <div class="table-responsive mb-3">
                                    <table class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                                        <thead class="badge-primary text-white">
                                            <tr>
                                                <th class="text-whited">TRẠNG THÁI</th>
                                                <th class="text-whited">SỐ TÀI KHOẢN</th>
                                                <th class="text-whited">BANK</th>
                                                <th class="text-whited">TÊN</th>
                                                <th class="text-whited">MÃ QR</th>

                                            </tr>
                                        </thead>
                                        <tbody id="tablePhone"></tbody>
                                    </table>
                                </div>
                                <button class="btn mb-3 mt-3 btn-warning btn-block" href data-target="#taonickname" data-toggle="modal" style="font-size: 20px;">Tạo Nickname</button>
                                 <div class="lert alert-success mt-3">
                                    <a>Bạn đã tham gia? </a>
                                    <a href data-toggle="modal" data-target="#modalReJoin">Tham gia lại</a>
                                </div>
                                <div class="table-responsive mb-3">
                                    <table class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                                        <thead class="badge-primary text-white">
                                            <tr>
                                                <th class="text-whited">Nội dung</th>
                                                <th class="text-whited">Kết quả</th>
                                                <th class="text-whited">Tỉ lệ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableReward"></tbody>
                                    </table>
                                </div>
                                <div class="text-center mb-3">
                                    <div class="d-inline-flex align-items-center justify-content-center">
                                        <h5 class="mx-2 my-0"><span class="badge badge-success">Tiền thưởng</span></h5>
                                        <b>=</b>
                                        <h5 class="mx-2 my-0"><span class="badge badge-secondary">Tiền đặt</span></h5>
                                        <b>x</b>
                                        <h5 class="mx-2 my-0"><span class="badge badge-secondary">Tỉ lệ</span></h5>
                                    </div>
                                </div>
                                <!-- <div class="alert alert-success" role="alert">-->
                                <!--        <p>Chỉ chuyển vào số tài khoản đang hiện trên web và có tình trạng là-->
                                <!--            <span class="badge badge-success">Hoạt động</span>.-->
                                <!--            Không chuyển vào số dùng để trả thưởng.-->
                                <!--        </p>-->
                                <!--</div>-->
                                <div class="alert alert-warning" role="alert">
                                    <?= $tkuma->site('cachchoi'); ?>
                                </div>
                            </div>
                        </div>
                <!--</sections>-->
                <!--<sections id="history_win">-->
                <!--    <div class="row">-->
                        <div class="col-md-7 mb-3">
                            <div class="content" style="overflow: auto;">
                                <!--<h3 class="text-center card-title">-->
                                <!--   <b>LỊCH SỬ THAM GIA</b>-->
                                <!--</h3>-->
                                <!--<div class="table-responsive" >-->
                                <!--    <table class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">-->
                                <!--        <thead class="badge-primary text-white">-->
                                <!--            <tr>-->
                                <!--                <th scope="col" class="text-whited text-center">THỜI GIAN</th>-->
                                <!--                <th scope="col" class="text-whited text-center">NGÂN HÀNG</th>-->
                                <!--                <th scope="col" class="text-whited text-center">SỐ TÀI KHOẢN</th>-->
                                <!--                <th scope="col" class="text-whited text-center">NICKNAME</th>-->
                                <!--            </tr>-->
                                <!--        </thead>-->
                                <!--        <tbody id="datahisgd"></tbody>-->
                                <!--    </table>-->
                                <!--</div>-->
                                <div class="lert alert-success mt-3"></div>
                                
                                <h3 class="text-center card-title">
                                    <img src="<?= BASE_URL('public/theme2'); ?>/images/photos/history.png" style="width: 30px"> <b>Lịch sử chơi của bạn</b>
                                </h3>
                                <div class="form-group"><div class="row gutters-xs"><div class="col"><input type="text" id="useridd" name="useridd" class="form-control" placeholder="Nhập Nickname để kiểm tra"></div><span class="col-auto"><button id="checkHistoryUserIDButton" class="btn btn-primary"><i class="fa fa-search"></i></button></span></div></div>
                                <div class="table-responsive" >
                                    <table class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                                        <thead class="badge-primary text-white">
                                            <tr>
                                                <th scope="col" class="text-whited text-center">THỜI GIAN</th>
                                                <th scope="col" class="text-whited text-center">SỐ TÀI KHOẢN</th>
                                                <th scope="col" class="text-whited text-center">MGD</th>
                                                <th scope="col" class="text-whited text-center">TIỀN CƯỢC</th>
                                                <th scope="col" class="text-whited text-center">TRÒ CHƠI</th>
                                                <th scope="col" class="text-whited text-center">CƯỢC</th>
                                                <th scope="col" class="text-whited text-center">KẾT QUẢ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="datahisuer"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <!--</div>-->
                <!--</sections>-->
                </div>
                <sections id="history_win">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="content">
                                <h3 class="text-center card-title">
                                    <img src="<?= BASE_URL('public/theme2'); ?>/images/photos/history.png" style="width: 30px"> <b>Lịch Sử
                                        Thắng</b>
                                </h3>
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                                        <thead class="badge-primary text-white">
                                            <tr>
                                                <th class="text-whited text-center">Thời gian</th>
                                                <th class="text-whited text-center">NICKNAME</th>
                                                <th class="text-whited text-center">MGD</th>
                                                <th class="text-whited text-center">TIỀN CƯỢC</th>
                                                <th class="text-whited text-center">TRÒ CHƠI</th>
                                                <th class="text-whited text-center">CƯỢC</th>
                                                <th class="text-whited text-center">KẾT QUẢ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableHistory">
                                            <tr>
                                                <td colspan="12">
                                                    <div class="text-center"><img src="<?= BASE_URL('public/theme2'); ?>/images/photos/404.png">
                                                        <p class="font-weight-bold">Không tìm thấy dữ liệu...</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </sections>
   <?php require_once(__DIR__ . '/modal.php'); ?>
               <div class="row">
                            <div class="col-md-5 mb-3">
                                <div class="content">
                                    <h3 class="text-center card-title">
                                        <img src="<?= BASE_URL('public/theme2'); ?>/images/photos/cup.png" style="width: 30px">
                                        <b>Đua Top Đại Gia Tuần</b>
                                        <img src="<?= BASE_URL('public/theme2'); ?>/images/photos/cup.png" style="width: 30px">
                                    </h3>
                                    <div class="table-responsive mb-3">
                                        <table class="table card-table table-vcenter text-nowrap table-bordered table-striped text-center">
                                            <thead class="badge-primary text-white">
                                                <tr>
                                                    <th class="text-whited">#</th>
                                                    <th class="text-whited">Số điện thoại</th>
                                                    <th class="text-whited">Tiền thắng</th>
                                                    <th class="text-whited">Phần thưởng</th>
                                                </tr>
                                            </thead>
                                            <tbody id="toptuan"></tbody>
                                        </table>
                                    </div>
                                    <div class="alert alert-secondary text-center">
                                        ̉Chẵng lẻ CLMM | Đua TOP bắt đầu từ 00h thứ 2 và chốt vào 23h59 chủ nhật cùng tuần.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 mb-3">
                            <div class="content h-100">
                                <h3>Lưu ý</h3>
                                <div class="alert alert-warning" role="alert"><?= $tkuma->site('nofication_ex'); ?></div>
      
                                <div class="text-center mb-3">
                                    <a target="_blank" href="<?= $tkuma->site('telegram'); ?>" class="badge badge-info p-2"><i class="fab fa-telegram"></i> Liên Hệ Support</a>
                                    <a target="_blank" href="<?= $tkuma->site('telegrambox'); ?>" class="badge badge-info p-2"><i class="fa fa-users"></i> Box Giao Lưu</a>
                                </div>
                                <div class="text-center mb-3">
                                    <a target="_blank" href="<?= $tkuma->site('telegrambot'); ?>" class="badge badge-primary p-2 mr-2"><i class="fa fa-users"></i> Bot Mã Giao Dịch</a>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </sections>
                <div class="mainbar"></div>
            </main>
        </div>
    </div>
    <?= $tkuma->site('html_footer'); ?>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-md-12 col-sm-12 mt-3 mt-lg-0 text-center">
                    <b><?= $tkuma->site('title'); ?></b> ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> -
                    <script>
                        document.write(new Date().getFullYear() + 2)
                    </script>
                </div>
            </div>
        </div>
    </footer>
    
    <a href="#top" id="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>
    <script src="<?= BASE_URL('public/theme2'); ?>/js/vendors/jquery-3.2.1.min.js"></script>
    <script src="<?= BASE_URL('public/theme2'); ?>/js/vendors/popper.min.js"></script>
    <script src="<?= BASE_URL('public/theme2'); ?>/js/vendors/bootstrap.min.js"></script>
    <script src="<?= BASE_URL('public/theme2'); ?>/js/vendors/jquery.sparkline.min.js"></script>
    <script src="<?= BASE_URL('public/theme2'); ?>/js/sticky.js"></script>
    <script src="<?= BASE_URL('public/theme2'); ?>/js/clipboard.js"></script>
    <script src="<?= BASE_URL('public/theme2'); ?>/js/jquery.mousewheel.min.js"></script>
    <script src="<?= BASE_URL('public/theme2'); ?>/plugins/notify/js/rainbow.js"></script>
    <script src="<?= BASE_URL('public/theme2'); ?>/plugins/notify/js/jquery.growl.js"></script>
    <script src="<?= BASE_URL('public/theme2'); ?>/js/jquery.richtext.js"></script>
    <script src="<?= BASE_URL('public/theme2'); ?>/plugins/select2/select2.full.min.js"></script>
    <script src="<?= BASE_URL('public/theme2'); ?>/plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="<?= BASE_URL('public/theme2'); ?>/plugins/datatable/dataTables.bootstrap4.min.js"></script>

    <link href="<?= base_url('public/cute-alert/sweetalert2/sweetalert2.min.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('public/cute-alert/sweetalert2/sweetalert2.min.js'); ?>"></script>

    <script src="<?= BASE_URL('public/theme2'); ?>/js/app.js?v=<?= time(); ?>"></script>
    <script src="<?= BASE_URL('public/theme2'); ?>/js/love.js"></script>
    <script src="<?= BASE_URL('public/'); ?>js/kuma.js?v=<?= time(); ?>"></script>
    <script src="<?= BASE_URL('public/'); ?>js/custom.js?v=<?= time(); ?>"></script>


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
                    let now = Date.now();
                    localStorage.setItem('isRead', now + 3600 * 1000)
                })
            })
            
        </script>

    <?php } ?>
    

