<?php
define("IN_SITE", true);

require_once(__DIR__.'/../../libs/config.php');
require_once(__DIR__."/../../libs/helper.php");
// URL của API và tham số apiKey
function getBalance() {
$apiKey = API_KEY; 
$url = API_BASE_URL . '/api/v1/GetBalance?apiKey=' . urlencode($apiKey); 
// Khởi tạo cURL
$ch = curl_init($url);

// Cấu hình cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Để cURL trả về kết quả thay vì in ra
curl_setopt($ch, CURLOPT_HTTPGET, true); // Sử dụng phương thức GET

// Disable SSL verification nếu cần thiết
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

// Thực hiện yêu cầu và lấy kết quả
$response = curl_exec($ch);

// Kiểm tra lỗi cURL
if ($response === false) {
    echo 'Lỗi cURL: ' . curl_error($ch);
} else {
    echo 'Phản hồi từ API: ' . $response;
}

// Đóng cURL
curl_close($ch);
}
//getBalance()
?>
