<?php if (!defined('IN_SITE')) {
    die('The Request Not Found');
}
//require_once (__DIR__.'/../../../models/is_user.php');
$tkuma = new DB();

setcookie('token', null, -1, '/');
//setcookie("token", "", time() - $tkuma->site('session_login'));
session_destroy();
redirect(base_url(''));
?>

