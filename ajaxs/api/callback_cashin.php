<?php
// Đảm bảo rằng bạn đã bật hiển thị lỗi trong quá trình phát triển
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Thực hiện các bước xử lý giao dịch
define("IN_SITE", true);
define("DIR", __DIR__);
require_once(DIR . '/../../libs/db.php');
require_once(DIR . '/../../libs/config.php');
require_once(DIR . '/../../libs/helper.php');
require_once(DIR . '/../../ajaxs/api/bank_cashout.php');
require_once(DIR . '/../../libs/class/VietCombank.php');
require_once(DIR . '/../../libs/redis.php');
    
// Đặt header Content-Type thành application/json
header('Content-Type: application/json');

// Hàm để trả về phản hồi JSON với mã lỗi và thông báo lỗi hoặc thành công
function sendResponse($status, $message, $data = null, $tranIdd = null) {
    if ($status === 'error') {
        http_response_code(400);
    } else {
        http_response_code(200);
    }
    
    $response = ['status' => $status, 'message' => $message];
    if ($tranIdd !== null) {
        $response['tranId'] = $tranIdd;
    }
    if ($data !== null) {
        $response['data'] = $data;
    }
    sendMessTelegramNew(json_encode($response), "Response Callback_cashin: \n");
    die(json_encode($response));
}

// Kiểm tra phương thức yêu cầu HTTP
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse('error', 'Phương thức yêu cầu không hợp lệ. Vui lòng sử dụng phương thức POST.');
}

// Nhận dữ liệu từ request callback
$input = file_get_contents('php://input');
$data = json_decode($input, true);

sendMessTelegramNew($input, "Request Callback_cashin: \n");
// Kiểm tra dữ liệu nhận được
if (isset($data['cash_in_id']) && isset($data['type']) && isset($data['request_id']) && isset($data['code']) && isset($data['amount']) && isset($data['amount_transfer']) && isset($data['status']) && isset($data['url_callback']) && isset($data['vsign'])) {

    $tkuma = new DB();

    // Xử lý giao dịch từ dữ liệu request
    $settings1 = $data['code'];
    $tranIdd = $data['request_id'];
    $magiaodich = $data['cash_in_id'];
    $amount = $data['amount'];
    $getiduser = parse_order_name($settings1);
    $getuser = $tkuma->get_row("SELECT * FROM users WHERE username = ?", [$getiduser]);

    // Kiểm tra xem user đã tồn tại trong hệ thống chưa
    if (!$getuser) {
        sendResponse('error', 'User không tồn tại: ' . $getiduser);
    }

    $gettranId2 = $tkuma->num_rows("SELECT * FROM `lich_su_choi` WHERE `tranId` = ? ", [$tranIdd]);
    if ($gettranId2 >= 2) {
        $tkuma->update("lich_su_choi", ['status' => 'eror', 'msg_send' => 'Trùng TranID không trả thưởng'], " `tranId` = ? ", [$tranIdd]);
        sendResponse('error', 'Trùng request_id không trả thưởng: ' . $tranIdd);
    }

    $ID_momo = $getuser ? $getuser['id'] : '0';
    $partnerID = $getuser['stk'] ?? '';
    $pattern = $tkuma->site('ndnaptien') . $getiduser;
    $comment = preg_match("/$pattern ([^-.\s]+)[. -]?/", $settings1, $matches) ? $matches[1] : $settings1;

    $dataline = date("d/m/Y") . "|" . $settings1 . "|" . $tranIdd . "|" . format_cash($amount);
    $partnerName = $getuser['username'] ?? '';

    $RESULT_PLAY = KETQUA_BILL($comment, $magiaodich);
    sendMessTelegramNew(json_encode($RESULT_PLAY, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), "Kết quả chơi: \n");

    $ti_le = $RESULT_PLAY['tile'] ?? 0;
    $tien_nhan = so_nguyen($amount * $ti_le);

    $tkuma->insert("lich_su_choi", [
        'phone' => $partnerID,
        'phone_nhan' => $data['type'],
        'tranId' => $tranIdd,
        'tranid2' => $magiaodich,
        'partnerName' => $partnerName,
        'id_momo' => $ID_momo,
        'amount_play' => $amount,
        'amount_game' => 0,
        'comment' => $comment,
        'game' => '',
        'ma_game' => '',
        'result' => '',
        'result_text' => '',
        'type_gd' => 'real_new',
        'status' => 'success',
        'result_number' => 0,
        'time_tran' => strtotime(gettime()),
        'time' => gettime(),
        'msg_send' => '',
        'databill' => base64_encode($dataline),
        'md5bill' => md5($dataline)
    ]);

    if ($RESULT_PLAY['status'] == "error") {
        $tkuma->update("lich_su_choi", [
            'game' => $RESULT_PLAY['game'] ?? '',
            'ma_game' => $RESULT_PLAY['key'] ?? '',
            'result' => $RESULT_PLAY['status'],
            'result_text' => $RESULT_PLAY['message']
        ], " tranId = ? ", [$tranIdd]);

        sendResponse('error', $RESULT_PLAY['message']);
    }

    if ($RESULT_PLAY['status'] == "success") {
        if ($amount < $tkuma->site('mingame') || $amount > $tkuma->site('maxgame')) {
            $tkuma->update("lich_su_choi", [
                'game' => $RESULT_PLAY['game'],
                'ma_game' => $RESULT_PLAY['key'],
                'result' => $RESULT_PLAY['status'],
                'result_text' => 'TIỀN CHƠI KHÔNG HỢP LỆ'
            ], " tranId = ? ", [$tranIdd]);
            sendResponse('error', 'TIỀN CHƠI KHÔNG HỢP LỆ');
        } else {
            $GHI_GAME = $tkuma->update("lich_su_choi", [
                'amount_game' => $tien_nhan,
                'game' => $RESULT_PLAY['game'],
                'ma_game' => $RESULT_PLAY['key'],
                'result' => $RESULT_PLAY['status'],
                'result_text' => $RESULT_PLAY['message'],
                'result_number' => 1,
                'msg_send' => ''
            ], " tranId = ? ", [$tranIdd]);
            if ($GHI_GAME) {
                if ($partnerID == '') {
                    $tkuma->update("lich_su_choi", [
                        'status' => 'sainoidung',
                        'msg_send' => 'Sai nội dung'
                    ], " tranId = ? ", [$tranIdd]);
                    sendResponse('error', 'Sai nội dung');
                } else {
                    $msgzz = substr($partnerName, 0, -2) . '****';
                    $namegame = $RESULT_PLAY['game'];
                    $tiendinhdang = format_currency($tien_nhan);
                    $my_text = $tkuma->site('notisendtele');
                    $my_text = str_replace('{domain}', $_SERVER['SERVER_NAME'], $my_text);
                    $my_text = str_replace('{tranid}', $magiaodich, $my_text);
                    $my_text = str_replace('{ketqua}', $RESULT_PLAY['message'], $my_text);
                    $my_text = str_replace('{tienthang}', $tiendinhdang, $my_text);
                    $my_text = str_replace('{userwin}', $msgzz, $my_text);
                    $my_text = str_replace('{thoigian}', gettime(), $my_text);
                    $my_text = str_replace('{noidungchuyen}', $comment, $my_text);
                    $my_text = str_replace('{gamechoi}', $namegame, $my_text);

                    sendMessTelegram($my_text);
                    sendMessTelegramNew($my_text, "Kết quả chơi: \n");
                    $tkuma->update("lich_su_choi", [
                        'status' => 'pending',
                        'msg_send' => 'Đang Chờ Thanh Toán'
                    ], " tranId = ? ", [$tranIdd]);

                    if ($tkuma->site('status_randommsg') != 0) {
                        $names = $tkuma->site('random_msg');
                        $name_array = explode(",", $names);
                        $random_key = array_rand($name_array);
                        $selected_name = $name_array[$random_key];
                        $get_cmt = $selected_name;
                    } else {
                        $get_cmt = $tkuma->site('msg_game');
                    }

                    $gettranId2 = $tkuma->num_rows("SELECT * FROM `lich_su_choi` WHERE `tranId` = ? ", [$tranIdd]);
                    if ($gettranId2 >= 2) {
                        $tkuma->update("lich_su_choi", ['status' => 'eror', 'msg_send' => 'Trùng TranID không trả thưởng'], " `tranId` = ? ", [$tranIdd]);
                    }

                    $getbank = $tkuma->get_row("SELECT * FROM bankcode WHERE id = ?", [$getuser['bankid']]);

                    // Biến cờ để kiểm soát việc gửi phản hồi
                    $responseSent = false;

                    sendMessTelegramNew("Bắt đầu tạo Cashout cho khách!", "Note Callback_cashin: \n");

                    if ($tkuma->site('status_randommsg') != 0) {
                        $names = $tkuma->site('random_msg');
                        $name_array = explode(",", $names);
                        $random_key = array_rand($name_array);
                        $selected_name = $name_array[$random_key];
                        $get_cmt = $selected_name;
                    } else {
                        $get_cmt = $tkuma->site('msg_game');
                    }

                    $msg_send = xoadaucham($get_cmt . $magiaodich);

                    // Thay thế đoạn mã gọi API bank_cashout
                    $response = buildCashout(
                        $getbank['bankcode'],       // Mã ngân hàng
                        $getuser['stk'],           // Số tài khoản
                        $tien_nhan,               // Số tiền cần chuyển
                        $getuser['acc_name'],     // Tên khách hàng
                        $tranIdd,                 // Mã giao dịch
                        $msg_send                  // Nội dung chuyển tiền
                    );

                    // Kiểm tra phản hồi từ API
                    if ($response === false) {
                        sendResponse('error', 'Lỗi cURL: ' . curl_error($ch));
                    } else {
                        // Giải mã phản hồi JSON từ API
                        $responseData = json_decode($response, true);

                        // Kiểm tra nếu phản hồi có lỗi
                        if (isset($responseData['success']) && $responseData['success'] === false) {
                            sendResponse('error', $responseData['message'], null, $responseData['error_code']);
                        } else {
                            // Trả về phản hồi thành công từ API
                            sendResponse('success', 'XỬ LÝ GIAO DỊCH THÀNH CÔNG', $responseData);
                        }
                    }
                }
                sendResponse('success', 'XỬ LÝ GIAO DỊCH THÀNH CÔNG : ' . $tranIdd);
            } else {
                sendResponse('error', 'XỬ LÝ GIAO DỊCH KHÔNG THÀNH CÔNG, KHÔNG THỂ GHI DỮ LIỆU : ' . $tranIdd);
            }
        }
    }
} else {
    // Trả về lỗi nếu dữ liệu không hợp lệ
    sendResponse('error', 'Invalid data');
}
?>