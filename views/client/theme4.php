<?php if (!defined('IN_SITE')) {
    die('The Request Not Found');
} ?>

<html class="no-js" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> <?= $tkuma->site('title'); ?></title>

    <link href="<?= $tkuma->site('logo'); ?>" rel="apple-touch-icon">
    <link href="<?= $tkuma->site('logo'); ?>" rel="shortcut icon" type="image/x-icon">
    <!-- Required Meta Tags Always Come First -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="title" content="<?= $tkuma->site('title'); ?>">
    <meta name="description" content="<?= $tkuma->site('description'); ?>">
    <meta name="keywords" content="<?= $tkuma->site('keywords'); ?>,clzl,minigamezalo,Clzl,Chan le zalo,Tài Xỉu zalo,chanlezalo,Chẵn lẻ online,Chẵn Lẻ,zalo cl,Cách Chơi chẵn lẽ zalo,chẵn lẽ zalo tự động">
    <link rel="canonical" href="/">
    <meta name="robots" content="index, follow">
    <meta property="fb:app_id" content="">
    <meta property="og:url" content="<?= $base_url; ?>">
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?= $tkuma->site('title'); ?>">
    <meta property="og:description" content="<?= $tkuma->site('description'); ?>">
    <meta name="google-site-verification" content="7CPPEU3ly_Y2_nO3_2dGrV_3oNzlQE4RA2Q-qnAJl-A" />
    <link rel="stylesheet" href="<?= BASE_URL('public/theme4/'); ?>css/custom.2.css?=<?= rand(1, 99999999); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="<?= BASE_URL('public/theme4/'); ?>css/supbankv2.css?=<?= rand(1, 99999999); ?>" rel="stylesheet" type="text/css" />
    <?= $body['header']; ?>
    <!--module-->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link href="public/theme4/css/bootstrap-select.min.css?=<?= rand(1, 99999999); ?>" rel="stylesheet">
    <link rel="stylesheet" href="public/theme4/css/jquery.bootstrap-touchspin.min.css?=<?= rand(1, 99999999); ?>">

    <link rel="stylesheet" href="<?= BASE_URL('public/theme4/'); ?>css/bootstrapb1.min.css?=<?= rand(1, 99999999); ?>">
    <!--end module-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link class="main-stylesheet" href="<?= BASE_URL('public/'); ?>cute-alert/style.css" rel="stylesheet" type="text/css">
    <script src="<?= BASE_URL('public/'); ?>cute-alert/cute-alert.js"></script>
    <!--end thong bao-->
</head>

<body style="background-color:#e6e6e6;">
    <p style="padding: 10px 0;background-color:#6d2f0f;text-align:center;text-transform:uppercase;font-size:13px;max-width:900px;margin:auto;">
        <a href="/" style="color:white;display:inline-block;line-height:normal;text-decoration:none;">trang chủ</a><span>&nbsp;&nbsp;</span>
        <?php if (isset($_SESSION['login'])) { ?>
            <a style="color:white;display:inline-block;line-height:normal;text-decoration:none;" data-target="#modalReJoin" data-toggle="modal">đăng nhập</a><span>&nbsp;&nbsp;</span>
        <?php } else { ?>
            <a data-target="#modalReJoin" data-toggle="modal" style="color:white;display:inline-block;line-height:normal;text-decoration:none;">đăng nhập</a><span>&nbsp;&nbsp;</span>
            <a data-target="#taonickname" data-toggle="modal" style="color:white;display:inline-block;line-height:normal;text-decoration:none;">Đăng Ký</a><span>&nbsp;&nbsp;</span>
        <?php } ?>
        <a href="<?= $tkuma->site('telegram'); ?>" target="_blank" style="color:white;display:inline-block;line-height:normal;text-decoration:none;">HỖ TRỢ TELEGRAM</a><span>&nbsp;&nbsp;</span>
        <a href="<?= $tkuma->site('telegrambox'); ?>" target="_blank" style="color:white;display:inline-block;line-height:normal;text-decoration:none;">BOX THÔNG BÁO</a>
    </p>
    <div style="margin: auto; padding: 5px 0; max-width: 900px;">
        <img src="<?= $tkuma->site('anhbia'); ?>" alt="CHẴN LẺ LIÊN BANK THANH TOÁN SIÊU TỐC" style="width:100%;height:auto;vertical-align: middle;
    display: block;">
    </div>
    <style>
        .text-white {
            color: #0a0a0a !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .d-inline-flex {
            margin: auto;
            display: block;
        }

        .justify-content-center {
            -ms-flex-pack: center !important;
            justify-content: center !important;
            margin: auto;
        }

        .d-ccga {
            display: -ms-inline-flexbox !important;
            display: inline-flex !important;
            margin: auto;

        }

        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -0.75rem;
            margin-left: -0.75rem;
        }

        .alert-info {
            background-color: #dff0d8;
            border-color: #d6e9c6;
            color: #3c763d;
        }
    </style>

    <p style="padding: 10px 0;background-color:#6d2f0f;text-align:center;text-transform:uppercase;font-size:13px;max-width:900px;margin:auto;">
    <div class="row justify-content-center mb-3 d-inline-flex" id="list-game">
    </div>
    <div class="row justify-content-center mb-3 d-inline-flex">
        <button class="btn btn-info btn-info mt-1 " style="position: relative;margin-right: 10px;" data-target="#code-khuyen-mai" data-toggle="modal">
            Nhập CODE Khuyến Mãi
        </button>
        <button class="btn btn-info btn-info mt-1 " style="position: relative;margin-right: 10px;"  data-target="#modal-kiem-tra-giao-dich" data-toggle="modal">
            Check TranID
        </button>
        <button class="btn btn-info btn-info mt-1 " style="position: relative;margin-right: 10px;" data-target="#modal-kiem-tra-no-hu" data-toggle="modal">
            Nổ Hủ
        </button>
        <button class="btn btn-info btn-info mt-1 " style="position: relative;margin-right: 10px;" data-target="#diem-danh" data-toggle="modal">
            Điểm Danh
        </button>
        <button class="btn btn-info btn-info mt-1 " style="position: relative;margin-right: 10px;" data-target="#nhiem-vu-ngay" data-toggle="modal">
            Nhiệm Vụ Ngày
        </button>

    </div>

    </p>
    <div style="padding-top:5px"></div>
    <div class="panel-body" style="padding-top: 0px;">
        <div style="border: 1px solid rgb(173, 65, 5); max-width: 900px; margin: auto; background-color: white; display: block;">
            <div style="background-color: #ad4105;padding:10px 0;text-align:center;color:white;font-size:14px;font-weight:bold;">XIêN - CÁCH CHƠI</div>
            <div style="padding:10px 5px;overflow-x: scroll;">
                <table class="gtbl rp">
                    <thead>
                        <tr role="row" class="bg-primary">
                            <th scope="col" class="text-center text-white">Nội dung</th>
                            <th scope="col" class="text-center text-white">Số cuối mã GD</th>
                            <th scope="col" class="text-center text-white">Tỉ lệ</th>
                        </tr>
                    </thead>
                    <tbody id="tableReward"></tbody>
                </table>
                <p><strong><em>d dddd</em></strong></p>
            </div>
        </div>
    </div>

    <div id="bank-infos" style="border:1px solid #ad4105;max-width:900px;margin:auto;background-color:white;">
        <div style="background-color: #ad4105;padding:10px 0;text-align:center;color:white;font-size:14px;font-weight:bold;">THÔNG TIN BANK NHẬN</div>
        <div style="padding:10px 5px;overflow-x: scroll;">
            <table class="gtbl rp">
                <thead>
                    <tr role="row" class="bg-primary">
                        <th scope="col" class="text-center text-whited">TRẠNG THÁI</th>
                        <th scope="col" class="text-center text-whited">SỐ TÀI KHOẢN</th>
                        <th scope="col" class="text-center text-whited">BANK</th>
                        <th scope="col" class="text-center text-whited">TÊN</th>
                        <th scope="col" class="text-center text-whited">MÃ QR</th>
                    </tr>
                </thead>
                
                <tbody id="tablePhone"></tbody>
            </table>
            
            <table class="gtbl rp">
                <thead>
                    <tr role="row" class="bg-primary">
                        <th scope="col" class="text-center text-whited">Chơi Tối thiểu</th>
                        <th scope="col" class="text-center text-whited">Chơi Tối đa</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th class="text-center text-whited"><?= format_currency($tkuma->site('mingame')); ?></th>
                        <th class="text-center text-whited"><?= format_currency($tkuma->site('maxgame')); ?></th>
                    </tr>
                </thead>
            </table>
            
        </div>
    </div>
    
    <div  style="border:1px solid #ad4105;max-width:900px;margin:auto;background-color:white;" id="tabtoryuser">
        <div style="background-color: #ad4105;padding:10px 0;text-align:center;color:white;font-size:14px;font-weight:bold;">LỊCH SỬ CHƠI CỦA BẠN</div>
        <div style="padding:10px 5px;overflow-x: scroll;">
            <table class="gtbl rp" style="color:#333333;">
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr role="row" class="bg-primary">
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
            </table>
        </div>
    </div>

    <div id="recently-win-game" style="border:1px solid #ad4105;max-width:900px;margin:auto;background-color:white;">
        <div style="background-color: #ad4105;padding:10px 0;text-align:center;color:white;font-size:14px;font-weight:bold;">LỊCH SỬ THAM GIA</div>
        <div style="padding:10px 5px;overflow-x: scroll;">
            <table class="gtbl rp" style="color:#333333;">
                <thead class="table-dark">
                    <tr role="row" class="bg-primary">
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
    <div id="recently-win-game" style="border:1px solid #ad4105;max-width:900px;margin:auto;background-color:white;">

        <div class="panel panel-primary">
            <div class="panel-heading text-center font-weight-bold">
                LIÊN HỆ
            </div>
            <div class="alert alert-danger">
                <p><span style="color:#ff0000"><strong><em><?= $tkuma->site('nofication_ex'); ?> </em></strong></span>
                </p>
            </div>
            <div id="contact" class=" d-ccga">
                <?php if ($tkuma->site('telegram')) { ?>
                    <p style="margin-right: 10px;">
                        <a class="text-white" href="<?= $tkuma->site('telegram'); ?>" target="_blank">
                            <span class="btn btn-info">TELEGRAM HỖ TRỢ</span></a>
                    </p>
                <?php } ?>
                <?php if ($tkuma->site('telegrambox')) { ?>
                    <p style="margin-right: 10px;">
                        <a class="text-white" href="<?= $tkuma->site('telegrambox'); ?>" target="_blank">
                            <span class="btn btn-danger">BOX PHÁT LỘC</span></a>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    <div id="recently-win-game" style="border:1px solid #ad4105;max-width:900px;margin:auto;background-color:white;">
        <div style="background-color: #ad4105;padding:10px 0;text-align:center;color:white;font-size:14px;font-weight:bold;">TOP ĐẠI GIA TUẦN</div>
        <div style="padding:10px 5px;overflow-x: scroll;">
            <table class="gtbl rp">
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
            <p style="text-align:center;padding-top: 10px;color:rgb(218, 56, 7);text-transform:uppercase;">- PHẦN THƯỞNG TOP SẼ ĐƯỢC TRAO VÀO 0:00 THỨ 2 TUẦN TIẾP THEO. <br>- VUI LÒNG KIỂM TRA LỊCH SỬ GIAO DỊCH 'THUONGTOP' ĐỂ TRẢ THƯỞNG.</p>
        </div>
    </div>

    <div id="play-rules" style="border:1px solid #ad4105;max-width:900px;margin:auto;background-color:white;">
        <div style="background-color: #ad4105;padding:10px 0;text-align:center;color:white;font-size:14px;font-weight:bold;">LUẬT CHƠI</div>
        <div style="padding:10px 5px">
            <?= $tkuma->site('notification'); ?>
        </div>
    </div>

    <div style="padding-top:30px;text-align:center;">
        <p><a href="/">CHẴN LẺ LÀ GÌ</a> <span>
                <>
            </span> <a href="/">TÀI XỈU LÀ GÌ</a> <span>
                <>
            </span> <a href="/">CHẴN LẺ BANK</a></p>
    </div>
    <p>&nbsp;</p>
    <p>&nbsp;</p>



    <!--<script src="/giaodien/assets/js/stylev22.js"></script>-->




    <?php require_once(__DIR__ . '/modal.php'); ?>

    <script src="<?= base_url('public/js/jquery-3.6.0.js'); ?>"></script>
    <script src="<?= BASE_URL('public/theme3'); ?>/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="<?= BASE_URL('public/theme3'); ?>/js/jquery.validate.min.js"></script>
    <script src="<?= BASE_URL('public/theme3'); ?>/js/bootstrap.min.js"></script>


    <script src="<?= BASE_URL('public'); ?>/js/clipboard.js"></script>
    <link href="<?= base_url('public/cute-alert/sweetalert2/sweetalert2.min.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('public/cute-alert/sweetalert2/sweetalert2.min.js'); ?>"></script>
    <script src="<?= BASE_URL('public/'); ?>js/kuma.js?v=<?= time(); ?>"></script>
    <script src="<?= BASE_URL('public/'); ?>js/custom.js?v=<?= time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

</body>
<!-- nạp tiền -->

</html>