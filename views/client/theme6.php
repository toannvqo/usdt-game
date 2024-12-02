<?php if (!defined('IN_SITE')) {
	die('The Request Not Found');
}
?>
<html lang="vi">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?= $tkuma->site('title'); ?> </title>
    <meta name="robots" content="index, follow">
    <!--    <meta property="og:type" content="article">-->
    <meta property="og:site_name" content="chẵn lẻ zalopay">
    <meta property="og:type" content="article">
    <meta property="og:locale" content="vi_VN">
    <link rel="canonical" href="https://clzl.biz">
    <meta property="og:url" itemprop="url" content="https://clzl.biz">
    <meta property="og:description" content="Chơi chẵn lẻ tài xỉu trên app Zalopay tự động trong 15s">
    <meta name="description" content="Chơi chẵn lẻ tài xỉu trên app Zalopay tự động trong 15s">
    <link href="/assets/clmm/images/zlplogo.png" rel="apple-touch-icon">
    <link href="/assets/clmm/images/zlplogo.png" rel="shortcut icon" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=yes">
    <meta name="keywords" itemprop="keywords" content="clzl, clzlp, chan le zalopay, tai xiu zalopay,cl zalopay, xoc dia zalopay">

    <!--begin::Global Theme Styles(used by all pages)-->
    <link rel="stylesheet" href="<?= BASE_URL('public/theme6/css'); ?>/bootstrap.min.css?v=<?= time(); ?>">

    <link rel="stylesheet" href="<?= BASE_URL('public/theme6/css'); ?>/style.css?v=1.2.4">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.css">
    <link rel="stylesheet" href="<?= BASE_URL('public/theme6/css'); ?>/custom.1.css?v=1.2.4">
    <link rel="stylesheet" href="<?= BASE_URL('public/theme6/css'); ?>/box.css">
    <link rel="stylesheet" href="<?= BASE_URL('public/theme6/css'); ?>/css?family=Trirong">
    <link rel="stylesheet" href="<?= BASE_URL('public/theme6/css'); ?>/actcus.css?v=<?= time(); ?>">
    <script src="<?= base_url('public/js/jquery-3.6.0.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
   


    <!--<link href="<?= BASE_URL('public/style/'); ?>canvas.css?v=<?= time(); ?>" rel="stylesheet">-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>-->

</head>

<body>
    <div class="starter-template">
        <h1 style="color: white;"><?= $tkuma->site('title'); ?> </h1>
    </div>
    <div class="app-container">

        <div class="container" style="width: 100%; font-weight: normal; !important; ">
            <div class="content">
                <div class="content-container text-center">
                    <div class="py-5">
                        <div class="output flash" style="margin-bottom: -10px;"><br>
                            <h1 style="font-size: 28px; color: yellow; margin-top: -20px; margin-bottom: 0px"><strong><?= $tkuma->site('title'); ?></strong><br></h1>
                            <a style="color: #ff0000;font-size: 18px; font-weight: bold;">C</a>
                            <a style="color: #ff4000;font-size: 18px; font-weight: bold;">h</a>
                            <a style="color: #ff8000;font-size: 18px; font-weight: bold;">ẵ</a>
                            <a style="color: #ffbf00;font-size: 18px; font-weight: bold;">n </a>
                            <a style="color: #ffff00;font-size: 18px; font-weight: bold;"> l</a>
                            <a style="color: #bfff00;font-size: 18px; font-weight: bold;">ẻ </a>
                            <a style="color: #80ff00;font-size: 18px; font-weight: bold;"> - </a>
                            <a style="color: #40ff00;font-size: 18px; font-weight: bold;">T</a>
                            <a style="color: #00ff00;font-size: 18px; font-weight: bold;">à</a>
                            <a style="color: #00ff40;font-size: 18px; font-weight: bold;">i </a>
                            <a style="color: #00ff80;font-size: 18px; font-weight: bold;"> x</a>
                            <a style="color: #00ffbf;font-size: 18px; font-weight: bold;">ỉ</a>
                            <a style="color: #00ffff;font-size: 18px; font-weight: bold;">u </a>
                            <a style="color: #0040ff;font-size: 18px; font-weight: bold;"> - </a>
                            <a style="color: #0000ff;font-size: 18px; font-weight: bold;">B</a>
                            <a style="color: #4000ff;font-size: 18px; font-weight: bold;">a</a>
                            <a style="color: #8000ff;font-size: 18px; font-weight: bold;">n</a>
                            <a style="color: #bf00ff;font-size: 18px; font-weight: bold;">k</a>
                            <a style="color: #ff00ff;font-size: 18px; font-weight: bold;">i</a>
                            <a style="color: #ff00bf;font-size: 18px; font-weight: bold;">n</a>
                            <a style="color: #bf00ff;font-size: 18px; font-weight: bold;">g</a>
                        </div>
                    </div>
                
                    <div class="justify-content-md-center box-cl">
                        <div class="col-md-3 mt-3 text-center cl">
                            <div class="panel panel-primary">

                                <div class="panel-heading text-center">
                                    <h4 style="color: white; font-weight: normal; font-size: large">DANH SÁCH TK</h4>
                                </div>
                                <div class="table-responsive" style="width: 100%; font-size:14px; margin-top:5px; margin-bottom:5px" `="">
                                    <div class="text-center font-weight-normal" style="margin-bottom:5px;">
                                        <span style="color: #7cfc00;">Chuyển tiền vào 1 trong các TK Bank dưới đây:</span><br>
                                        <span style="color: #7cfc00;font-size:11.5px;">Ấn nút "copy" bên cạnh số tài khoản để lấy số.</span>
                                    </div>
                                    <!--<div class="text-center font-weight-bold" style="padding-bottom: 0px;padding-top: 0px">-->
                                    <!--    <span style="color: white">Làm mới sau <span class="text-danger coundown-time">0</span> giây</span>-->
                                    <!--</div>-->
                                    <table class="table table-striped table-bordered table-hover text-center box">
                                        <thead>
                                            <tr role="row" class="bg-primary red">
                                                <th class="text-center text-white" style="font-size:14px; font-weight: normal;!important;">TRẠNG THÁI</th>
                                                <th class="text-center text-white" style="font-size:14px; font-weight: normal;!important;">SỐ TÀI KHOẢN</th>
                                                <th class="text-center text-white" style="font-size:14px; font-weight: normal;!important;">BANK</th>
                                                <th class="text-center text-white" style="font-size:14px; font-weight: normal;!important;">TÊN</th>
                                                <th class="text-center text-white" style="font-size:14px; font-weight: normal;!important;">MÃ QR</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablePhone"></tbody>
                                    </table>
                                    
                                </div>
                                <!--<span style="color: yellow; font-size: 14px;">- HIỆN TẠI CHÚNG TÔI ĐANG BẢO TRÌ HỆ THỐNG ĐỂ PHỤC VỤ NGHỈ LỄ -</span><br/>-->
                                <!--<span style="color: yellow; font-size: 14px;">- CÁC MÃ TỒN SẼ TT ĐẦY ĐỦ TRONG TGIAN SỚM NHẤT -</span><br/>-->
                                <span style="color: yellow; font-size: 14px;">- DS TÀI KHOẢN SẼ CẬP NHẬT LIÊN TỤC -</span><br>
                                <div class="table-responsive" style="width: 100%; font-size:14px; margin-top:5px; margin-bottom:5px" `="">
                                <table class="table table-striped table-bordered table-hover text-center box">
                                        <thead>
                                            <tr role="row" class="bg-primary red">
                                                <th class="text-center text-white" style="font-size:14px; font-weight: normal;!important;">Chơi Tối thiểu</th>
                                                <th class="text-center text-white" style="font-size:14px; font-weight: normal;!important;">Chơi Tối đa</th>
 
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr role="row" class="bg-primary text-center text-white">
                                                <th class="text-center text-white" style="font-size:14px; font-weight: normal;!important;"><?= format_currency($tkuma->site('mingame')); ?></th>
                                                <th class="text-center text-white" style="font-size:14px; font-weight: normal;!important;"><?= format_currency($tkuma->site('maxgame')); ?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                    </div>
                                <span style="color:#7cfc00;">* * *</span>
                                <br>
                                <div class="panel-heading text-center" style="margin-bottom:5px">
                                    <h4 style="color: white; font-weight: normal; font-size: large">CÁCH CHƠI</h4>
                                </div>
                                <div class="row d-inline-flex list-game-custom" id="list-game">
                                </div>
                                <!--</div>-->

                                <div class=" turn active" turn-tab="62ba32d3e923fe6fbb3c59e4" style="color:#7cfc00; width: 100%; font-size: 14px;">
                                    <h3 id="gameName">Cách Chơi</h3>
                                    <p id="gameNoti"></p>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover text-center box">
                                            <thead>
                                                <tr role="row" class="bg-primary red">
                                                    <th class="text-center text-white" style="font-size:15px; font-weight: normal;!important;">Mã game</th>
                                                    <th class="text-center text-white" style="font-size:15px; font-weight: normal;!important;">Số tương ứng</th>
                                                    <th class="text-center text-white" style="font-size:15px; font-weight: normal;!important;">Rate</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableReward"></tbody>
                                        </table>
                                    </div>

                                    <div class="alert alert-info text-left" style="padding: 10px 5px; border: 2px solid red;!important;background-color: #ffffff12;color: white;">
                                        <h4 style="text-align: center; margin-bottom: 10px;">Lưu Ý:</h4>
                                        <?= $tkuma->site('cachchoi'); ?>
                                    </div>
                                    <div class="alert alert-danger" style="color: yellow; border: 2px solid red;!important; background-color: #ffffff12;">TOP ĐẠI GIA TUẦN
                                        <table class="table table-striped table-bordered table-hover text-center box">
                                        <thead>
                                            <tr role="row" class="bg-primary red">
                                                <th class="text-center text-white" style="font-size:14px; font-weight: normal;!important;">#</th>
                                                <th class="text-center text-white" style="font-size:14px; font-weight: normal;!important;">Số điện thoại</th>
                                                <th class="text-center text-white" style="font-size:14px; font-weight: normal;!important;">Tiền thắng</th>
                                                <th class="text-center text-white" style="font-size:14px; font-weight: normal;!important;">Phần thưởng</th>
                                            </tr>
                                        </thead>
                                        <tbody id="toptuan"></tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-md-3 mt-3 text-center cl">
                            <div class="panel panel-primary">
                                <div class="panel-heading text-center" style="border-color: white">
                                    <h4 style="color: white; font-weight: normal; font-size: large">Lịch Sử Thắng</h4>
                                </div>
                                <!--<div class="panel-body occho">-->
                                <div class="table-responsive">
                                    <div class="text-center font-weight-normal">
                                        <p style="color:lawngreen;">- Danh sách người chơi trúng thưởng mới nhất.</p>
                                        <p style="color: white;">Làm mới sau <span class="text-danger coundown-time">12</span> s </p>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover text-center box">
                                        <thead>
                                            <tr role="row" class="bg-primary red">
                                                <th class="text-center text-white" style="font-weight: normal; font-size: 15px;">Thời gian</th>
                                                <th class="text-center text-white" style="font-weight: normal; font-size: 15px;">NICKNAME</th>
                                                <th class="text-center text-white" style="font-weight: normal; font-size: 15px;">MGD</th>
                                                <th class="text-center text-white" style="font-weight: normal; font-size: 15px;">TIỀN CƯỢC</th>
                                                <th class="text-center text-white" style="font-weight: normal; font-size: 15px;">TRÒ CHƠI</th>
                                                <th class="text-center text-white" style="font-weight: normal; font-size: 15px;">CƯỢC</th>
                                                <th class="text-center text-white" style="font-weight: normal; font-size: 15px;">KẾT QUẢ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableHistory">
                                    </table>
                                </div>
                                <!--</div>-->
                                <br>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#code-khuyen-mai" style="margin: 3px 2px; padding: 3px 3px;border: 1px solid red; background-color: #bbff99;">
                                    <span style="color: #8600b3; font-size: 12px; vertical-align: -3px;"> GiftCode</span>
                                </button>
                                <button class="btn btn-default" data-toggle="modal" data-target="#modal-kiem-tra-giao-dich" style="margin: 3px 2px; padding: 3px 3px;border: 1px solid red; background-color: #bbff99;">
                                    <span style="color: #8600b3; font-size: 12px; vertical-align: -3px;"> Check TranID</span>
                                </button>
                                <button class="btn btn-default" data-toggle="modal" data-target="#modal-kiem-tra-no-hu" style="margin: 3px 2px; padding: 3px 3px;border: 1px solid red; background-color: #bbff99;">
                                    <span style="color: #8600b3; font-size: 12px; vertical-align: -3px;"> Nổ Hủ</span>
                                </button>
                                <button class="btn btn-default" server-action="change" data-toggle="modal" data-target="#diem-danh" style="margin: 3px 2px; padding: 3px 3px;border: 1px solid red; background-color: #bbff99;">
                                    <span style="color: #8600b3; font-size: 12px; vertical-align: -3px;"> Điểm Danh</span>
                                </button>
                                <button class="btn btn-default" server-action="change" data-toggle="modal" data-target="#nhiem-vu-ngay" style="margin: 3px 2px; padding: 3px 3px;border: 1px solid red; background-color: #bbff99;">
                                    <span style="color: #8600b3; font-size: 12px; vertical-align: -3px;"> Nhiệm Vụ Ngày</span>
                                </button>
                                <button class="btn btn-default" server-action="change" data-target="#taonickname" data-toggle="modal" style="margin: 3px 2px; padding: 3px 3px;border: 1px solid red; background-color: #bbff99;">
                                    <span style="color: #8600b3; font-size: 12px; vertical-align: -3px;"> Tạo NICKNAME</span>
                                </button>
                                <button class="btn btn-default" server-action="change" data-target="#modalReJoin" data-toggle="modal" style="margin: 3px 2px; padding: 3px 3px;border: 1px solid red; background-color: #bbff99;">
                                    <span style="color: #8600b3; font-size: 12px; vertical-align: -3px;"> Tham Gia Lại</span>
                                </button>
                                
                                <div class="panel-heading text-center" style="border-color: white">
                                    <h4 style="color: white; font-weight: normal; font-size: large">Lịch Sử Chơi của bạn</h4>
                                </div>
                                <!--<div class="panel-body occho">-->
                                <div class="table-responsive">
                                    <div class="form-group"><div class="row gutters-xs"><div class="col"><input type="text" id="useridd" name="useridd" class="form-control" placeholder="Nhập Nickname để kiểm tra"></div><span class="col-auto"><button id="checkHistoryUserIDButton" class="btn btn-primary"><i class="fa fa-search"></i></button></span></div></div>
                                    <table class="table table-striped table-bordered table-hover text-center box">
                                        <thead>
                                            <tr role="row" class="bg-primary red">
                                                <th class="text-center text-white" style="font-weight: normal; font-size: 15px;">THỜI GIAN</th>
                                                <th class="text-center text-white" style="font-weight: normal; font-size: 15px;">SỐ TÀI KHOẢN</th>
                                                <th class="text-center text-white" style="font-weight: normal; font-size: 15px;">MGD</th>
                                                <th class="text-center text-white" style="font-weight: normal; font-size: 15px;">TIỀN CƯỢC</th>
                                                <th class="text-center text-white" style="font-weight: normal; font-size: 15px;">TRÒ CHƠI</th>
                                                <th class="text-center text-white" style="font-weight: normal; font-size: 15px;">CƯỢC</th>
                                                <th class="text-center text-white" style="font-weight: normal; font-size: 15px;">KẾT QUẢ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="datahisuer">
                                    </table>
                                </div>
                                <!--</div>-->
                                <div class="alert alert-danger" style="color: yellow; border: 2px solid red;!important; background-color: #ffffff12;">CHÚ Ý
                                        <?= $tkuma->site('nofication_ex'); ?>
                                </div>
                            
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
     <marquee width="100%" behavior="scroll" style="color: #ffff; display: block;position: fixed;z-index: 1000;cursor: pointer;width: 100%; left: 0px;bottom: 0px;"> <span color="white" style="text-shadow: 0 0 0.2em #ff0000, 0 0 0.2em #ff0000,  0 0 0.2em #ff0000">
            <p> Chào mừng bạn đã đến với hệ thống game chẵn lẻ TOP 1 Việt Nam. <?= $tkuma->site('title'); ?> cam kết chất lượng dịch vụ và độ uy tín luôn dẫn đầu thị trường. </p>
        </span>
    </marquee>
  
     <?php if ($tkuma->site('notification') != '') { ?>
        <!-- Modal Notification -->
        
        <div class="modal fade" id="modalNoti" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" >
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
   <?php require_once(__DIR__ . '/modal.php'); ?>

    <footer class="footer ">
        <div class="container ">
            <div class="row ">
                <div class="col-xs-8 text-white "> Copyright © by <?= $tkuma->site('title'); ?> </div>
            </div>
        </div>
    </footer>
    <style>
        select option {
            margin: 40px;
            background: rgba(0, 0, 0, 0.3);
            color: #000;
            text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
        }
    </style>
    <!-- <script>-->
    <!--    let a = document.querySelectorAll('[data-dismiss="modal"]');-->
    <!--    a.forEach(function(item){-->
    <!--        item.onclick = function(){-->
    <!--            let b = document.getElementById("noticeModal");-->
    <!--            b.removeAttribute("style");-->
    <!--            b.classList.remove("in");-->
    <!--        }-->
    <!--    });-->
    <!-- </script>-->





    <link href="<?= base_url('public/cute-alert/sweetalert2/sweetalert2.min.css'); ?>" rel="stylesheet" type="text/css" />
    <script src="<?= base_url('public/cute-alert/sweetalert2/sweetalert2.min.js'); ?>"></script>
    <script src="<?= BASE_URL('public'); ?>/js/clipboard.js"></script>
    <script src="<?= BASE_URL('public/'); ?>js/kuma.js?v=<?= time(); ?>"></script>
    <script src="<?= BASE_URL('public/'); ?>js/custom.js?v=<?= time(); ?>"></script>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

 
</body>

</html>