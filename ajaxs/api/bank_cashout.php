<?php

if (!defined('IN_SITE')) {
    define("IN_SITE", true);
}
require_once(__DIR__.'/../../libs/config.php');
require_once(__DIR__."/../../libs/helper.php");

function generateHash($bank_code, $bank_account, $amount, $request_id, $sign_key) {
    $data = $bank_code . $bank_account . $amount . $request_id . $sign_key;
    $hash = hash('sha256', $data);
    return $hash;
}

function buildCashout($bank_code, $bank_account, $amount, $customerName, $request_id, $content) {
    $apiKey = API_KEY;
    $url_callback = CALLBACK_CASHOUT_URL;
    $sign_key = SIGN_KEY;
    $vsign = generateHash($bank_code, $bank_account, $amount, $request_id, $sign_key);

    $url = API_BASE_URL . "/api/v1/Cashout/Create";

    $data = [
        'apiKey' => $apiKey,
        'bank_code' => $bank_code,
        'bank_account' => $bank_account,
        'amount' => $amount,
        'customer_name' => $customerName,
        'url_callback' => $url_callback,
        'content' => $content,
        'vsign' => $vsign,
        'request_id' => $request_id
    ];

    // Chuyển dữ liệu thành chuỗi JSON
    $jsonData = json_encode($data);

    sendMessTelegramNew($jsonData, "Request Cashout: \n");


    // Khởi tạo cURL
    $ch = curl_init($url);

    // Cấu hình cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Để cURL trả về kết quả thay vì in ra
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',  // Đặt header là JSON
        'Content-Length: ' . strlen($jsonData), // Độ dài của dữ liệu
        'User-Agent: Mozilla/5.0' // Để tránh bị chặn khi truy cập từ server
    ]);

    //curl_setopt($ch, CURLOPT_POST, true); // Sử dụng phương thức POST
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // Gửi dữ liệu POST

    // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    // Thực hiện yêu cầu và lấy kết quả
    $response = curl_exec($ch);
    sendMessTelegramNew($response, "Response Cashout: \n");
    // Kiểm tra lỗi cURL
    if ($response === false) {
        $error = 'Lỗi cURL: ' . curl_error($ch);
        curl_close($ch);
        return $error;
    }

    // Đóng cURL
    curl_close($ch);

    return $response;
}

//buildCashout('ACB', '123456789', 100000, 'Nguyen Van A');