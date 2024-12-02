<?php

// define("IN_SITE", true);

// require_once(__DIR__ . '/../../libs/db.php');
// require_once(__DIR__ . '/../../libs/config.php');
// require_once(__DIR__ . '/../../libs/helper.php');
// $tkuma = new DB();

// use GuzzleHttp\Client;
// use GuzzleHttp\Pool;
// use GuzzleHttp\Psr7\Request;



// // Tạo một đối tượng Client
// $httpClient = new Client();

// foreach ($tkuma->get_list("SELECT * FROM `cronjobsact` WHERE `status` = ? ORDER BY `id` ASC",['1']) as $rank) {
//     if ($rank['status'] == 1) {
//         if ($rank['get_time'] == 0) {
//             // Đánh dấu rằng đã chạy trong phiên này
//             $tkuma->update("cronjobsact", array(
//                 'get_time' => $rank['time']
//             ), " `id` = ? ",[$rank['id']]);

//             $url = base_url($rank['url']) . '?type=' . $tkuma->site('pin_cron');

//             // Tạo một đối tượng Request
//             $request = new Request($rank['method'], $url);

//             // Thực hiện yêu cầu bằng cách sử dụng Pool
//             $pool = new Pool($httpClient, [$request], [
//                 'concurrency' => 1,
//                 'fulfilled'   => function ($response, $index) use ($tkuma, $rank) {
//                     echo 'Request completed for job ' . $rank['id'] . PHP_EOL . "\n";
//                     echo $response->getBody() . PHP_EOL. "\n";

//                     // Cập nhật trạng thái và thời gian cập nhật
//                     $tkuma->update('cronjobsact', [
//                         'update_time' => gettime()
//                     ], " `id` = ? ",[$rank['id'] ]);
//                 },
//                 'rejected'    => function ($reason, $index) use ($rank) {
//                     echo 'Request failed for job ' . $rank['id'] . ': ' . $reason . PHP_EOL. "\n";
//                 },
//             ]);

//             $promise = $pool->promise();
//             $promise->wait();
//         } else {
//             $tkuma->update("cronjobsact", array(
//                 'get_time' => $rank['get_time'] - 1
//             ), " `id` = ? ",[$rank['id']]);
//         }
//     }
// }

define("IN_SITE", true);

require_once(__DIR__ . '/../../libs/db.php');
require_once(__DIR__ . '/../../libs/config.php');
require_once(__DIR__ . '/../../libs/helper.php');
$tkuma = new DB();

use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;

// Tạo một đối tượng Client
$httpClient = new Client();

// Lấy danh sách các công việc
$jobs = $tkuma->get_list("SELECT * FROM `cronjobsact` WHERE `status` = ? ORDER BY `id` ASC", ['1']);

// Mảng chứa các promise của Pool
$promises = [];

foreach ($jobs as $rank) {
    if ($rank['status'] == 1 && $rank['get_time'] == 0) {
        $url = base_url($rank['url']) . '?type=' . $tkuma->site('pin_cron');

        // Tạo một đối tượng Request
        $request = new Request($rank['method'], $url);

        // Thêm promise vào mảng
        $promises[] = $httpClient->sendAsync($request)->then(function ($response) use ($tkuma, $rank) {
            echo 'Request completed for job ' . $rank['id'] . PHP_EOL . "\n";
            echo $response->getBody() . PHP_EOL . "\n";

            // Cập nhật trạng thái và thời gian cập nhật
            $tkuma->update('cronjobsact', [
                'get_time' => $rank['time'],
                'update_time' => gettime()
            ], " `id` = ? ", [$rank['id']]);
        }, function ($reason) use ($rank) {
            echo 'Request failed for job ' . $rank['id'] . ': ' . $reason . PHP_EOL . "\n";
        });
    } else {
            $tkuma->update("cronjobsact", array(
                'get_time' => $rank['get_time'] - 1
            ), " `id` = ? ",[$rank['id']]);
        }
}

// Đợi tất cả các promise hoàn thành
foreach ($promises as $promise) {
    $promise->wait();
}
