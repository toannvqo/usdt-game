<?php if (!defined('IN_SITE')) {
    die('The Request Not Found');
} ?>
<!DOCTYPE html>
<html class="no-js" lang="vi">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title> <?= $tkuma->site('title'); ?></title>
    
    <link href="<?= $tkuma->site('anhbia'); ?>" rel="apple-touch-icon">
    <link href="<?= $tkuma->site('anhbia'); ?>" rel="shortcut icon" type="image/x-icon">
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
    <link rel="stylesheet" href="<?= BASE_URL('public/theme3'); ?>/css/bootstrapb1.min.css?=<?= rand(1, 99999999); ?>">
    <link rel="stylesheet" href="<?= BASE_URL('public/theme3'); ?>/css/style1.css?=<?= rand(1, 99999999); ?>">
    <link rel="stylesheet" href="<?= BASE_URL('public/theme3'); ?>/css/jquery-ui-1.9.2.custom.min.css?=<?= rand(1, 99999999); ?>">
    <link rel="stylesheet" href="<?= BASE_URL('public/theme3'); ?>/css/custom.2.css?=<?= rand(1, 99999999); ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    
</head>





<div class="mainbar"><div class="navbar"><div class="container"><a href="/" class="text-left"><div><img src="<?= $tkuma->site('anhbia'); ?>" alt="Logo" style="max-height: 60px"></div></a></div></div><marquee width="100%" behavior="scroll" class="marquee-noti"><font color="white" style="text-shadow: 0 0 0.2em #ff0000, 0 0 0.2em #ff0000,  0 0 0.2em #ff0000"><b>Hiện nay có rất nhiều web lừa đảo. Các bạn chỉ nên chơi trên CLZLP.JP để tránh mất tiền oan. Chúc các bạn thắng lớn trên CLZLP.JP, nhớ giới thiệu bạn bè nhá.</b></font></marquee></div>


<div class="container"></div>

<style>
    .text-white {
        color: #ff0b0b !important;
    }
    .text-whited {
            color: #fff !important;
        }
    .d-inline-flex {
    display: -ms-inline-flexbox !important;
    display: inline-flex !important;
}

</style>

<div class="container">
    <div class="content">
        <div class="content-container">
            <div class="py-5" style="min-height:80px !important;">
                <div class="output" id="output">
                    <h3 class=""></h3>
                    <h4 class="cursor"></h4>
                </div>
            </div>
            <div class="text-center mt-5">
                <div class="d-inline-flex list-game-custom" id="list-game">
                </div>
                <br>

                <button class="btn btn-warning btn-warning mt-1" style="position: relative;" href="" data-target="#nhiem-vu-ngay" data-toggle="modal">
                    Nhiệm Vụ Ngày
                </button>
                <button class="btn btn-info btn-info mt-1" style="position: relative;" href="" data-target="#modal-kiem-tra-giao-dich" data-toggle="modal">
                    Check TranID
                </button>
                <button class="btn btn-info btn-info mt-1" style="position: relative;"  href="" data-target="#code-khuyen-mai" data-toggle="modal">
                    Nhập CODE Khuyến Mãi
                </button>
                <button class="btn btn-info btn-info mt-1" style="position: relative;"  href="" data-target="#modal-kiem-tra-no-hu" data-toggle="modal" style="position: relative;" >
                    Nổ Hủ
                </button>
                <button class="btn btn-info btn-info mt-1" style="position: relative;"  href="" data-target="#diem-danh" data-toggle="modal" style="position: relative;" >
                     Điểm Danh
                </button>
                <button class="btn btn-info btn-info mt-1" style="position: relative;"  href="" data-target="#taonickname" data-toggle="modal" style="position: relative;" >
                     Tạo Nickname
                </button>
                
            </div>
            <div class="row justify-content-md-center box-cl">
                <div class="col-md-6 mt-3 cl">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center font-weight-bold"> ❌ CÁCH CHƠI ❌ </div>
                        <div style="padding-top: 0px;">
                            - Nội dung chuyển bên dưới + số duôi của số tiền :
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover text-center">
                                    <thead>
                                        <tr role="row" class="bg-primary">
                                            <th scope="col" class="text-center text-whited">Nội dung</th>
                                            <th scope="col" class="text-center text-whited">Số cuối mã GD</th>
                                            <th scope="col" class="text-center text-whited">Tỉ lệ</th>
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
                            <div class="alert alert-success" role="alert">
                                        <p>Chỉ chuyển vào số tài khoản đang hiện trên web và có tình trạng là
                                            <span class="badge badge-success">Hoạt động</span>.
                                            Không chuyển vào số dùng để trả thưởng.
                                        </p>
                            </div>
                        </div>
                        <div class="panel-body turn" style="padding-top: 0px" turn-tab="789789">
                        </div>
                    </div>
                </div>


                <div class="col-md-3 mt-3 cl">
                    <div class="panel panel-primary">
                        <div class="panel-heading text-center font-weight-bold"> ❌ CÁCH CHƠI ❌ </div>
                        <div style="padding-top: 0px;">
                            - Cách chơi vô cùng đơn giản : <br>
                            - Chuyển tiền vào một trong các tài khoản ở <a href=""><code> danh sách số</code></a> bên
                            dưới<p></p>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead >
                                        <tr role="row" class="bg-primary">
                                            <th class="text-center text-whited">Tối thiểu</th>
                                            <th class="text-center text-whited">Tối đa</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <tr>
                                            <th class="text-center text-white"><?= format_currency($tkuma->site('mingame')); ?></th>
                                            <th class="text-center text-white"><?= format_currency($tkuma->site('maxgame')); ?></th>
                                        
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover text-center">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5 text-center panel panel-primary" id="tabtoryuser">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="text-center mb-3">
                        <h3 class="text-uppercase">
                            Lịch sử chơi của bạn
                        </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover text-center">
                            <thead>
                                <tr class="bg-primary" role="row">
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
        </div>
        <hr style="margin-top: 25px; margin-bottom: 25px;">
        <div class="mt-5 text-center panel panel-primary">
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="text-center mb-3">
                        <h3 class="text-uppercase">
                            LỊCH SỬ THẮNG
                        </h3>
                    </div>
                    <div class="text-center font-weight-bold">
                        <b>Làm mới sau <span class="text-danger coundown-time">15</span> s</b>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover text-center">
                            <thead>
                                <tr class="bg-primary" role="row">
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr style="margin-top: 25px; margin-bottom: 25px;">
        <div class="row" id="list">
            <div class="col-md-8 mt-3 text-center cl">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center font-weight-bold">
                        LIÊN HỆ
                    </div>
                    <div class="alert alert-danger">
                        <p><span style="color:#ff0000"><strong><em><?= $tkuma->site('nofication_ex'); ?> </em></strong></span>
                        </p>
                    </div>
                    <div id="contact" class="mt-5 d-inline-flex">
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
                        <?php if ($tkuma->site('telegrambot')) { ?>
                            <p style="margin-right: 10px;">
                                <a class="text-white" href="<?= $tkuma->site('telegrambot'); ?>" target="_blank">
                                    <span class="btn btn-danger">BOT MÃ GD</span></a>
                            </p>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <div class="row">
                            <div>
                                <h4>
                                    TOP THẮNG TUẦN
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover text-center">
                                <thead>
                                    <tr role="row" class="bg-primary">
                                        <th class="text-center text-whited">TOP</th>
                                        <th class="text-center text-whited">Số điện thoại</th>
                                        <th class="text-center text-whited">Số tiền</th>
                                        <th class="text-center text-whited">Thưởng</th>
                                    </tr>
                                </thead>
                                <tbody id="toptuan"></tbody>
                            </table>
                            <b class="text-danger">Phần thưởng TOP sẽ được trao vào 12:00 Chủ Nhật hàng tuần.</b>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>




<footer class="footer bg-grad-1">
    <div class="container text-center">
        <div class="row">
            <div class="col-xs-12">
                <img src="<?= $tkuma->site('anhbia'); ?>" alt="logo-footer" width="150px">
            </div>
            <div class="col-xs-12 text-white ">
                Copyright 2024 © <a style="color: white;" href=""><?= strtoupper($_SERVER['SERVER_NAME']); ?></a>
            </div>
        </div>
    </div>
</footer>

<?php require_once(__DIR__ . '/modal.php'); ?>


<script src="<?= BASE_URL('public'); ?>/js/clipboard.js"></script>
<link href="<?= base_url('public/cute-alert/sweetalert2/sweetalert2.min.css'); ?>" rel="stylesheet" type="text/css" />
<script src="<?= base_url('public/cute-alert/sweetalert2/sweetalert2.min.js'); ?>"></script>
<link href="<?= base_url('public/style/style.css'); ?>?v=<?= time(); ?>" rel="stylesheet" type="text/css" />
<script src="<?= base_url('public/js/jquery-3.6.0.js'); ?>"></script>
<script src="<?= BASE_URL('public/theme3'); ?>/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="<?= BASE_URL('public/theme3'); ?>/js/jquery.validate.min.js"></script>
<script src="<?= BASE_URL('public/theme3'); ?>/js/bootstrap.min.js"></script>
<script src="<?= BASE_URL('public/'); ?>js/kuma.js?v=<?= time(); ?>"></script>
<script src="<?= BASE_URL('public/'); ?>js/custom.js?v=<?= time(); ?>"></script>


<?php if ($tkuma->site('notification') != '') { ?>
    <div class="modal fade" id="noticeModal" tabindex="-1" role="dialog" aria-labelledby="noticeModal" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Thông báo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= $tkuma->site('notification'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>



<script>
    $(document).ready(function() {
        function isJsonString(str) {
            try {
                JSON.parse(str);
            } catch (e) {
                return false;
            }
            return true;
        }

        $('button[server-action=change]').click(function() {
            let button = $(this);
            let id = button.attr('server-id');
            selection_server = id;
            selection_rate = button.attr('server-rate');
            $('.turn').removeClass('active');
            $(`.turn[turn-tab=${id}]`).addClass('active');
            $('button[server-action=change]').attr('class', 'btn btn-default');
            button.attr('class', 'btn btn-primary');
        });
        $('button[bot-action=change]').click(function() {
            let button = $(this);
            let id = button.attr('bot-id');
            $('.bot').removeClass('active');
            $(`.bot[bot-tab=${id}]`).addClass('active');
            $('button[bot-action=change]').attr('class', 'btn btn-default');
            button.attr('class', 'btn btn-primary');
        });
        $('button[server-id=1]').click();
    });
    var i = 0,
        a = 0,
        isBackspacing = false,
        isParagraph = false;
    var textArray = ["Hệ Thống Chẵn Lẻ Tài Xỉu MB Bank | Uy Tín, Giao Dịch Tự Động 24/7 - Bank 5s !"];
    var speedForward = 0,
        speedWait = 30000,
        speedBetweenLines = 10,
        speedBackspace = 0;
    typeWriter("output", textArray);

    function typeWriter(id, ar) {
        var element = $("#" + id),
            aString = ar[a],
            eHeader = element.children("h3"),
            eParagraph = element.children("h4");
        if (!isBackspacing) {
            if (i < aString.length) {
                if (aString.charAt(i) == "|") {
                    isParagraph = true;
                    eHeader.removeClass("cursor");
                    eParagraph.addClass("cursor");
                    i++;
                    setTimeout(function() {
                        typeWriter(id, ar);
                    }, speedBetweenLines);
                } else {
                    if (!isParagraph) {
                        eHeader.text(eHeader.text() + aString.charAt(i));
                    } else {
                        eParagraph.text(eParagraph.text() + aString.charAt(i));
                    }
                    i++;
                    setTimeout(function() {
                        typeWriter(id, ar);
                    }, speedForward);
                }
            } else if (i == aString.length) {
                isBackspacing = true;
                setTimeout(function() {
                    typeWriter(id, ar);
                }, speedWait);
            }
        } else {
            if (eHeader.text().length > 0 || eParagraph.text().length > 0) {
                if (eParagraph.text().length > 0) {
                    eParagraph.text(eParagraph.text().substring(0, eParagraph.text().length - 1));
                } else if (eHeader.text().length > 0) {
                    eParagraph.removeClass("cursor");
                    eHeader.addClass("cursor");
                    eHeader.text(eHeader.text().substring(0, eHeader.text().length - 1));
                }
                setTimeout(function() {
                    typeWriter(id, ar);
                }, speedBackspace);
            } else {
                isBackspacing = false;
                i = 0;
                isParagraph = false;
                a = (a + 1) % ar.length;
                setTimeout(function() {
                    typeWriter(id, ar);
                }, 50);
            }
        }
    }
</script>


</body>
<div id="smartyContainer" style="position: absolute; bottom: 0px; left: 0px; line-height: initial; z-index: 2147483647; width: auto; font-size: initial;"></div>
<style>
    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active,
    .btn-primary.active,
    .open .dropdown-toggle.btn-primary {
        color: #fff;
        background-color: <?= $tkuma->site('color_button'); ?>;
        border-color: <?= $tkuma->site('color_button'); ?>;
    }

    .btn-default {
        color: #fff;
        background-color: <?= $tkuma->site('color_button'); ?>;
        border-color: <?= $tkuma->site('color_button'); ?>
    }

    .footer {
        background: <?= $tkuma->site('color_end'); ?>;
        border-top: 7px solid <?= $tkuma->site('color_head'); ?>
    }

    .mainbar {
        background: <?= $tkuma->site('color_head'); ?>;
    }

    .navbar {
        background-color: <?= $tkuma->site('color'); ?>;
    }

    .panel-primary {
        border-color: <?= $tkuma->site('color'); ?>
    }

    .panel-primary>.panel-heading {
        color: #fff;
        background-color: <?= $tkuma->site('color'); ?>;
        border-color: <?= $tkuma->site('color'); ?>
    }

    .panel-primary>.panel-heading+.panel-collapse .panel-body {
        border-top-color: <?= $tkuma->site('color'); ?>
    }

    .panel-primary>.panel-footer+.panel-collapse .panel-body {
        border-bottom-color: <?= $tkuma->site('color'); ?>
    }

    .aa:hover,
    .aa:focus {
        background: <?= $tkuma->site('color'); ?>;
        border-radius: 5px
    }

    .bg-primary {
        color: #fff;
        background-color: <?= $tkuma->site('color'); ?> !important;
    }

    .coffer-box {
        display: block;
        position: fixed;
        bottom: 90px;
        right: 15px;
        width: 15%;
        z-index: 1000;
        cursor: pointer;
        /*background: #ad410569;*/
        border-radius: 10px;
        text-align: center;
        padding: 15px;
    }

    @media (max-width: 767px) {
        .coffer-box {
            background: unset;
            width: 50%;
            bottom: 20px;
        }
    }

    .mb-0 {
        margin-bottom: 0;
    }

    .dot-text-1 {
        color: #f0ad4e
    }

    .dot-text-2 {
        color: #5bc0de
    }

    .dot-text-3 {
        color: #5cb85c
    }

    .dot-text-4 {
        color: #d9534f
    }

    .dot-text-6 {
        color: #5bc0de
    }

    .dot-text-7 {
        color: #5cb85c
    }

    .dot-text-8 {
        color: #d9534f
    }

    .dot-text-9 {
        color: #f0ad4e
    }

    .dot-text-11 {
        color: #5cb85c
    }

    .dot-text-12 {
        color: #d9534f
    }

    .dot-text-13 {
        color: #f0ad4e
    }

    .dot-text-14 {
        color: #5bc0de
    }

    .dot-text-16 {
        color: #d9534f
    }

    .dot-text-17 {
        color: #f0ad4e
    }

    .dot-text-18 {
        color: #5bc0de
    }

    .dot-text-19 {
        color: #5cb85c
    }

    .container {
        margin-right: auto;
        margin-left: auto;
        padding-left: 15px;
        padding-right: 15px;
    }


</style>

</html>