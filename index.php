<!-- DEVELOPER BY tkuma.vn | MMO Solution -->
<?php
define("IN_SITE", true);
require_once(__DIR__ . '/libs/config.php');
require_once(__DIR__ . '/libs/db.php');
require_once(__DIR__ . '/libs/helper.php');

date_default_timezone_set("Asia/Ho_Chi_Minh");
$tkuma = new DB();

if ($tkuma->num_rows("SELECT 1 FROM information_schema.tables WHERE table_name = 'users'") == 0) :
    header('Location: /install.php');
    exit();
endif;

$module = !empty($_GET['module']) ? check_string($_GET['module']) : 'client';
$home   = $module == 'client' ? theme() : 'home';
$action = !empty($_GET['action']) ? check_string($_GET['action']) : $home;
    
if ($module == 'client') :
    if ($tkuma->site('statusweb') != 1 && !isset($_SESSION['admin_login'])) {
        require_once(__DIR__ . '/views/common/maintenance.php');
        exit();
    }
endif;


if ($action == 'footer' || $action == 'header' || $action == 'sidebar' || $action == 'nav') :
    require_once(__DIR__ . '/views/common/404.php');
    exit();
endif;
// $path = "views/$module/$action.php";

if ($module == 'admin') :
    $path = "views/$module/$action.php";
    if (file_exists($path)) {
        require_once(__DIR__ . '/' . $path);
        exit();
    } else {
        require_once(__DIR__ . '/views/common/404.php');
        exit();
    }
endif;


$path = "views/$module/$action.php";
if (file_exists($path)) {
    require_once(__DIR__ . '/' . $path);
    exit();
} else {
    require_once(__DIR__ . '/views/common/404.php');
    exit();
}

?>
<!-- Dev By tkuma.vn | MMO Solution -->