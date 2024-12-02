<?php
// Đảm bảo rằng bạn đã bật hiển thị lỗi trong quá trình phát triển
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Đặt header Content-Type thành application/json
header('Content-Type: application/json');

// Kiểm tra phương thức yêu cầu HTTP
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die(json_encode(['status' => 'error', 'message' => 'Phương thức yêu cầu không hợp lệ. Vui lòng sử dụng phương thức POST.']));
}

// Nhận dữ liệu từ request callback
$input = file_get_contents('php://input');
$data = json_decode($input, true);
if (!defined('IN_SITE')) {
    define("IN_SITE", true);
}

require_once(__DIR__ . '/../../libs/db.php');
require_once(__DIR__ . '/../../libs/config.php');
require_once(__DIR__ . '/../../libs/helper.php');
$tkuma = new DB();
$request_id = null;
sendMessTelegramNew($input, "Request Callback_cashout: \n");
// kiểm tra xem callback cashout đến từ nguồn nào
if (isset($data['cash_out_id'])) {
    $request_id = $data['request_id'];
} else if ($data['merchantno']) {
    $request_id = $data['morderno'];
} else {
    die(json_encode(['status' => 'error', 'message' => 'Callback cashout không hợp lệ.']));
}

if ($request_id) {
    $rows = $tkuma->get_row(
        "SELECT * FROM `lich_su_choi` WHERE ( `result` = ? OR `result` = ? ) AND `status` = ? AND `phone` != '' AND `tranId` = ?",
        ['success', 'sainoidung', 'getotp', $request_id]
    );
    if ($data['status'] == 4) {
        // Kiểm tra kết quả truy vấn
        if ($rows) {
            $tkuma->insert("chuyen_tien", [
                'type_gd' => $rows['type_gd'],
                'tranId' => $data['request_id'],
                'partnerId' => $rows['id_momo'],
                'partnerName' => $data['customer_name'],
                'amount' => $data['amount'],
                'comment' => $data['content'],
                'status' => 'success',
                'message' => 'success',
                'data' => json_encode($data),
                'balance' => $data['amount'],
                'ownerNumber' => $rows['tranId'],
                'ownerName' => $data['customer_name'],
                'type' => 1,
                'date_time' => gettime(),
                'time' => gettime()
            ]);
            $tkuma->update("lich_su_choi", ['status' => 'success', 'msg_send' => 'Thành công'], " `tranId` = ?  ", [$data['request_id']]);
            sendMessTelegramNew(json_encode(['status' => 'success', 'message' => 'Callback thành công']), "Response Callback_cashout: \n");
            echo json_encode(['status' => 'success', 'message' => 'Callback thành công']);
        } else {
            // Xử lý trường hợp không tìm thấy kết quả
            http_response_code(400);
            sendMessTelegramNew(json_encode(['status' => 'error', 'message' => 'Không tìm thấy kết quả trong bảng lich_su_choi']), "Response Callback_cashout: \n");
            echo json_encode(['status' => 'error', 'message' => 'Không tìm thấy kết quả trong bảng lich_su_choi']);
        }
    } else {
        $tkuma->update("lich_su_choi", ['status' => 'success', 'msg_send' => $data['error_message']], " `tranId` = ?  ", [$data['request_id']]);
        sendMessTelegramNew(json_encode(['status' => 'success', 'message' => $data['error_message']]), "Response Callback_cashout: \n");
    }
} else {
    // Xử lý trường hợp $request_id không tồn tại
    http_response_code(400);
    sendMessTelegramNew(json_encode(['status' => 'error', 'message' => 'Request ID không tồn tại']), "Response Callback_cashout: \n");
    echo json_encode(['status' => 'error', 'message' => 'Request ID không tồn tại']);
}
