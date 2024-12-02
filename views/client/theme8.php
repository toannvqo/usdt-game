<!DOCTYPE html>
<html class="no-js" lang="vi">

<head>
    <title><?= $tkuma->site('title'); ?></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="CHẴN LẺ BANK - BANKBET.ME" name="title" />
    <meta content="Chẵn lẻ bank là một trò chơi xanh chín, dựa vào mã giao dịch của ngân hàng, Hiện nay BANKBET đang là hệ thống bank chẵn lẻ thanh toán tự động chỉ trong 3 giây và uy tín nhất hiện tại, Hỗ trợ khách hàng 24/7" name="description" />
    <meta content="chẵn lẻ bank, chan le bank, BANKBET, bank chẵn lẻ, chẵn lẻ bank, chẵn lẻ bank tự động, tài xỉu bank, chẵn lẻ bank uy tín, bank chẵn lẻ uy tín, chẵn lẻ banking, chẵn lẻ ngân hàng, chẵn lẻ bank 5k, chan le bank 5k, chẵn lẻ bank 10k, chan le bank 10k, cltx, za" name="keywords">
    <link href="<?= BASE_URL($tkuma->site('logo')); ?>" rel="shortcut icon" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.css" rel="stylesheet" />
    <link href="<?= BASE_URL('public/theme8/css/'); ?>bootstrap.min.css?v=<?= time(); ?>" rel="stylesheet" />
    <link href="<?= BASE_URL('public/theme8/css/'); ?>style.css?v=<?= time(); ?>" rel="stylesheet" />
    <link href="<?= BASE_URL('public/theme8/css/'); ?>custom.css?v=<?= time(); ?>" rel="stylesheet" />
     <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js?v=1001"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>

<body>
    <div class="navbar navbar-custom">
        <div class="container">
            <div class="navbar-header">
                <div class="text-center">
                    <a href="/" class="">
                        <div class="">
                            <img src="<?= BASE_URL($tkuma->site('anhbia')); ?>" class="logo" style="width: 100%;height: auto;" alt="<?= $tkuma->site('title'); ?>" />
                        </div>
                    </a>
                    <?php if (isset($_SESSION['login'])) { ?>
                        <div style="margin-top: 10px;" class="user-panel mb-10">
                            <div class="dropdown"><button onclick="dropbtn()" class="btn btn-outline-pink  dropbtn() ">Xin chào: <?= $tkuma->get_row(" SELECT * FROM `users` WHERE `token` = ? ",[$_SESSION['login']])['username'];?></button>
                                <div id="mydrop" class="dropdown-content">
                                    <a href="/">Trang chủ</a>
                                    <a data-toggle="modal" data-target="#code-khuyen-mai">Giftcode</a>
                                    <a data-toggle="modal" data-target="#nhiem-vu-ngay">Nhiệm vụ ngày</a>
                                    <a data-target="#modal-kiem-tra-giao-dich" data-toggle="modal">Check TranID</a>
                                    <a data-target="#modal-kiem-tra-no-hu" data-toggle="modal" data-toggle="modal">Nổ Hủ</a>
                                    <a href="<?= BASE_URL('client/logout'); ?>">Đăng xuất</a>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div style="margin-top: 10px;" class="user-panel mb-10">
                            <a type="submit" class="btn btn-success mb-2" href data-target="#modalReJoin" data-toggle="modal">Đăng nhập</a>
                            <a type="submit" class="btn btn-danger mb-2" href data-target="#taonickname" data-toggle="modal">Đăng ký</a>
                        </div>
                    <?php } ?>
                    
                    
                </div>
            </div>
        </div>
    </div>
    <script>
       function dropbtn() {
            $("#mydrop").toggle("show");
        }
    </script>
<style>
    .text-white {
            color: #0a0a0a !important;
        }
    .text-whited {
            color: #fff !important;
        }
</style>
    <!--<div id="loading-spinner"></div>-->
    <div class="mainbar hidden-xs">
        <div class="container"></div>
    </div>
    <div class="toast-copy fade">
        <div class="toast-body"></div>
    </div>

    
     <div class="modal fade" id="quydinh" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
    
    <div id="update_bank" class="modal-window">
        <div class="modal-window__title">
            <h4>Thông báo!</h4>
            <br>
            <div class="text-center">
                Vui lòng cập nhật thông tin ngân hàng.
                <div class="mt-3"></div>
                <a href="https://bankbet.me/bank.html" class="btn btn-sm btn-info">Cập nhật ngay</a>
            </div>
            <br>
        </div>
    </div>
    <div id="show_bill" class="modal-window">
        <div class="modal-window__title">
            <h4><?= $tkuma->site('title'); ?> Sao Kê</h4>
            <br>
            <div class="text-center">
            </div>
            <br>
            <a href="#" class="modal-close">ĐÃ ĐỌC</a>
        </div>
    </div>
    <div class="modal-window__backdrop hidden" id="modal-backdrop"></div>
    </script>
    <div class="container">
        <div class="content">
            <div class="content-container content-container-custom">
                <div class="py-5">
                    <div class="text-center">
                        <h3><?= $tkuma->site('title'); ?></h3>
                        <h4 class="cursor"> Uy tín, giao dịch tự động 24/7 - Bank 30s !</h4>
                    </div>
                </div>
                <div class="output" id="output">
                    <div class="text-center mt-5">
                        <div class="text-center mt-5 list-game-custom" id="list-game">
                            
                        </div>
                        <div class="mt-3">
                            <a  data-toggle="modal" data-target="#code-khuyen-mai" class="btn btn-sm btn-danger mt-1">Giftcode</a>
                            <a data-toggle="modal" data-target="#nhiem-vu-ngay" class="btn btn-sm btn-danger mt-1">Nhiệm vụ ngày</a>
                            <a data-target="#modal-kiem-tra-giao-dich" data-toggle="modal" class="btn btn-sm btn-danger mt-1">Check TranID</a>
                            <a data-target="#modal-kiem-tra-no-hu" data-toggle="modal" class="btn btn-sm btn-danger mt-1">Nổ Hủ</a>
                        </div>
                    </div>
                    <div class="text-center mt-5" role="group">
                        <button class="btn btn-success js-modal" data-toggle="modal"  data-target="#quydinh">QUY ĐỊNH</button>
                        <a class="btn btn-info btn-telegram" href="<?= $tkuma->site('telegrambox'); ?>" target="_blank">BOX TELEGRAM</a>
                        <a class="btn btn-warning btn-instruct" href="" target="_blank">Hướng Dẫn</a>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3 cl">
                            <div class="panel panel-primary">
                                <div class="panel-heading text-center" id="gameName">
                                    CÁCH CHƠI
                                </div>
                                <div class="play-rules">
                                    <div class="panel-body game active" style="padding-top: 10px; padding-bottom: 20px;" >
                                        <div class="alert alert-warning" role="alert"><b>Chú ý 🔞:</b> <b>Vui lòng đọc kỹ QUY ĐỊNH trước khi chơi!</b></div>
                                        <p>Chuyển tiền vào 1 trong các tài khoản ngân hàng sau:</p>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover text-center mb-0 bank-info">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-whited bg-primary">TRẠNG THÁI</th>
                                                        <th class="text-center text-whited bg-primary">STK</th>
                                                        <th class="text-center text-whited bg-primary">BANK</th>
                                                        <th class="text-center text-whited bg-primary">Tên CTK</th>
                                                        <th class="text-center text-whited bg-primary">QR</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tablePhone"></tbody>
                                            </table>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover text-center mb-0 bank-info">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-whited bg-primary">CƯỢC MIN</th>
                                                        <th class="text-center text-whited bg-primary">CƯỢC MAX</th>
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
                                        <p class="mt-3">
                                            - Nội dung chuyển:
                                        </p>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover text-center">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center text-whited bg-primary">Nội dung</th>
                                                        <th class="text-center text-whited bg-primary">Số cuối</th>
                                                        <th class="text-center text-whited bg-primary">Tỉ Lệ</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableReward"></tbody>
                                            </table>
                                            <p class="text-center" id="gameNoti"></p>
                                        </div>
                                        <div class="alert alert-danger note" role="alert">
                                            <?= $tkuma->site('cachchoi'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <div class="text-center mb-3">
                        <h3 class="text-uppercase">LỊCH SỬ CHƠI CỦA BẠN</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover text-center">
                            <thead>
                                <tr role="row" class="bg-primary">
                                    <th class="text-center text-whited">THỜI GIAN</th>
                                    <th class="text-center text-whited">SỐ TÀI KHOẢN</th>
                                    <th class="text-center text-whited">MGD</th>
                                    <th class="text-center text-whited">TIỀN CƯỢC</th>
                                    <th class="text-center text-whited">TRÒ CHƠI</th>
                                    <th class="text-center text-whited">CƯỢC</th>
                                    <th class="text-center text-whited">KẾT QUẢ</th>
                                </tr>
                            </thead>
                            <tbody id="datahisuer"></tbody>
                        </table>
                    </div>
                    
                </div>
                <div class="mt-5">
                    <div class="text-center mb-3">
                        <h3 class="text-uppercase">LỊCH SỬ THẮNG</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover text-center">
                            <thead>
                                <tr role="row" class="bg-primary">
                                    <th class="text-whited text-center">Thời gian</th>
                                    <th class="text-whited text-center">NICKNAME</th>
                                    <th class="text-whited text-center">MGD</th>
                                    <th class="text-whited text-center">TIỀN CƯỢC</th>
                                    <th class="text-whited text-center">TRÒ CHƠI</th>
                                    <th class="text-whited text-center">CƯỢC</th>
                                    <th class="text-whited text-center">KẾT QUẢ</th>
                                </tr>
                            </thead>
                            <tbody id="tableHistory"> </tbody>
                        </table>
                    </div>
                </div>
                <?php require_once(__DIR__ . '/modal.php'); ?>
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="mt-5">
                            <div class="text-center mb-3">
                                <h3 class="text-uppercase">TOP ĐẠI GIA TUẦN</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover text-center">
                                    <thead>
                                        <tr role="row" class="bg-primary">
                                            <th class="text-center text-whited">Hạng</th>
                                            <th class="text-center text-whited">Người chơi</th>
                                            <th class="text-center text-whited">Tổng cược</th>
                                            <th class="text-center text-whited">Phần thưởng</th>
                                        </tr>
                                    </thead>
                                    <tbody id="toptuan"></tbody>
                                </table>
                                <div class="text-center">
                                    <b class="text-danger">Phần thưởng TOP sẽ được trao vào 0:00 Thứ hai.</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer" style="padding-bottom: 60px;">
        <div class="container text-center">
            <div class="row">
                <div class="col-xs-12 text-white ">
                    <div class="col-xs-12 text-white"> Copyright 2023 | All rights reserved </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?= BASE_URL('public/'); ?>js/kuma.js?v=<?= time(); ?>"></script>
    <script src="<?= BASE_URL('public/'); ?>js/custom.js?v=<?= time(); ?>"></script>
    <script src="<?= BASE_URL('public/theme2'); ?>/js/clipboard.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>