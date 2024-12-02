<?php
define("IN_SITE", true);
require_once(__DIR__.'/../../libs/config.php');
require_once(__DIR__."/../../libs/helper.php");


function generateHash($chargeType, $amount, $request_id, $sign_key) {
    $data = $chargeType . $amount . $request_id . $sign_key;
    $hash = hash('sha256', $data);
    return $hash;
}

function buildCashin($chargeType, $amount, $code) {
    $apiKey = API_KEY;
    $url_callback = CALLBACK_CASHIN_URL;
    $sign_key = SIGN_KEY;

$request_id = date('dmYHis');
$vsign = generateHash($chargeType, $amount, $request_id, $sign_key);

$url = API_BASE_URL . "/api/v1/Cashin/Create";

$data = [
    'apiKey' => $apiKey,
    'chargeType' => $chargeType,
    'amount' => $amount,
    'url_callback' => $url_callback,
    'vsign' => $vsign,
    'request_id' => $request_id,
    'code' => $code
];

// Chuyển dữ liệu thành chuỗi JSON
$jsonData = json_encode($data);

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

// Kiểm tra lỗi cURL
if ($response === false) {
    echo 'Lỗi cURL: ' . curl_error($ch);
} else {
    echo $response;
}

// Đóng cURL
curl_close($ch);

}
// buildCashin('ACB', '10000', 'ACB');



