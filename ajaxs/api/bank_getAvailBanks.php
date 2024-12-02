<?php
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
require_once(__DIR__.'/../../libs/config.php');
require_once(__DIR__."/../../libs/helper.php");
// URL của API và tham số apiKey
function getAvailBanks() {
$apiKey = API_KEY;
$url = API_BASE_URL . '/api/v1/GetListBankOn?apiKey=' . urlencode($apiKey);

$client = new Client();
$response = $client->get($url, [
    'verify' => false
]);

//echo $response->getBody();

return json_decode($response->getBody(), true);
}
//getAvailBanks()
?>
