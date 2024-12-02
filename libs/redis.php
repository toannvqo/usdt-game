<?php

if (!defined('IN_SITE')) {
    die('The Request Not Found');
}

include_once(__DIR__ . '/../vendor/autoload.php');

use Predis\Client;

class CronController
{
    private $redis;
    private $sessionKey;

    public function __construct($sessionName)
    {
        // $this->redis = new Client();
        $this->redis =    new Predis\Client([
        'scheme' => 'tcp',
        'host'   => '127.0.0.1',
        'port'   => 6379,
        ]);
        $this->sessionKey = 'cronRunCount_' . $sessionName;
    }

    public function canRun()
    {
        $limit = 1; // Số lần chạy tối đa trong khoảng thời gian
        $resetTime = 10; // Thời gian reset (60 giây)

        $runCount = $this->redis->get($this->sessionKey);

        if (!$runCount) {
            $this->redis->setex($this->sessionKey, $resetTime, 1);
            return true;
        }

        if ($runCount < $limit) {
            $this->redis->incr($this->sessionKey);
            return true;
        }

        return false;
    }
    public function checkdata($dataToCheck)
    {
        if (!$this->redis->exists($dataToCheck)) {
            $this->redis->setex($dataToCheck, 48 * 60 * 60, 1);
            return false;
        }
        return true;
    }
    public function remote($dataToCheck) {
        if ($this->redis->exists($dataToCheck)) {
            // Dữ liệu tồn tại, xóa nó
            $this->redis->del($dataToCheck);
            return false; // Dữ liệu không tồn tại
            
        }
        return true; // Dữ liệu đã bị xóa
    }
}
// sudo apt install redis-server
// redis-server