<?php

if (!defined('IN_SITE')) {
    define("IN_SITE", true);
}
require_once(__DIR__.'/../../libs/config.php');
require_once(__DIR__."/../../libs/helper.php");


function generateMd5Sign($merchantno, $morderno, $bankcode, $type, $realname, $cardno, $money, $sendtime, $buyerip, $md5key) {
    $originalString = $merchantno . "|" . $morderno . "|" . $bankcode . "|" . $type . "|" . $realname . "|" . $cardno . "|" . $money . "|" . $sendtime . "|" . $buyerip . "|" . $md5key;
    $sign = md5($originalString);
    return $sign;
}

function buildCashout($bank_code, $bank_account, $amount, $customerName, $request_id, $content) {
    $merchantno = AEE_MERCHANT_NO;
    $url_callback = CALLBACK_CASHOUT_URL;
    $type = AEE_TYPE;
    $sendtime = date('YmdHis');
    $md5_key = AEE_MD5KEY;
    $buyerip = IP_HOST;
    $sign = generateMd5Sign($merchantno, $request_id, $bank_code, $type, $customerName, $bank_account, $amount, $sendtime, $buyerip, $md5_key);

    $url = AEE_API_BASE_URL . "/api/withdraw";

    $data = [
        'merchantno' => $merchantno,
        'morderno' => $request_id,
        'type' => $type,
        'money' => $amount,
        'bankcode' => $bank_code,
        'realname' => $customerName,
        'cardno' => $bank_account,
        'sendtime' => $sendtime,
        'notifyurl' => $url_callback,
        'buyerip' => $buyerip,
        'sign' => $sign
    ];

    // Chuyển dữ liệu thành chuỗi query string
    $postData = http_build_query($data);
    sendMessTelegramNew($postData, "Request Cashout: \n");

    // Khởi tạo cURL
    $ch = curl_init($url);

    // Cấu hình cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Để cURL trả về kết quả thay vì in ra
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',  // Đặt header là x-www-form-urlencoded
        'Content-Length: ' . strlen($postData), // Độ dài của dữ liệu
        'User-Agent: Mozilla/5.0' // Để tránh bị chặn khi truy cập từ server
    ]);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); // Gửi dữ liệu POST

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

//generateMd5Sign("1002184", "20210719123456789", "VND_MB","0","CTY TNHH CN KT DT DUC CUONG", "812766668888","100000", "20241015000300", "122.8.121.74", "fSTvIfYbcy950LBr");
//buildCashout("VND_MB", "72770689689", "100000", "CT TNHH TM DIEN TU HUU KIEN", "20210719123456781", "Withdraw");
