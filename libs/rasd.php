<?php
require_once(__DIR__ . '/config.php');
include_once(__DIR__.'/../vendor/autoload.php');


use phpseclib\Crypt\RSA;

// Tạo đối tượng RSA
$rsa = new RSA();

// Tạo cặp khóa RSA (chứa cả khóa công khai và bí mật)
$rsa->setPrivateKeyFormat(RSA::PRIVATE_FORMAT_PKCS1);
$rsa->setPublicKeyFormat(RSA::PUBLIC_FORMAT_PKCS1);
$keyPair = $rsa->createKey(512); // Độ dài khóa 512 bits

// Dữ liệu cần mã hóa
$dataToEncrypt = "40b6f750679bc4877da4e517ff4a494c";

// Sử dụng khóa công khai để mã hóa
$publicKey = $keyPair['publickey'];
$rsa->loadKey($publicKey);
$encryptedData = $rsa->encrypt($dataToEncrypt);
$base64 = base64_encode($encryptedData);
$unbase64 = base64_decode($base64);

// Sử dụng khóa bí mật để giải mã
$privateKey = $keyPair['privatekey'];
$rsa->loadKey($privateKey);
$decryptedData = $rsa->decrypt($unbase64);

echo "Dữ liệu gốc: " . $dataToEncrypt . "<br>";
echo "Dữ liệu đã mã hóa: " . $encryptedData . "<br>";
echo "Dữ liệu đã mã hóa base64: " . base64_encode($encryptedData) . "<br>";
echo "Dữ liệu đã giải mã: " . $decryptedData . "<br>";
echo "Dữ liệu publickey: " . $keyPair['publickey'] . "<br>";
echo "Dữ liệu privatekey: " . $keyPair['privatekey'] . "<br>";
?>