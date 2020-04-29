<?php

use core\lib\Config;
use core\lib\Route;

function curl_get_contents($url, $timeout = 2)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

error_reporting(0);
ini_set("display_errors", 0);

header("Content-type: text/html;charset=utf-8");

define("BX_ROOT", substr(dirname(__FILE__), 0, -4));
define("DS", DIRECTORY_SEPARATOR);

require_once BX_ROOT . "core/lib/Load.php";
spl_autoload_register(["\\core\\lib\\Load", "autoload"]);

require_once BX_ROOT . "core/function.inc.php";
require_once BX_ROOT . "core/version.php";

if (!get_magic_quotes_gpc()) {
    if (!empty($_GET)) {
        $_GET = addslashes_deep($_GET);
    }
    if (!empty($_POST)) {
        $_POST = addslashes_deep($_POST);
    }
    $_COOKIE = addslashes_deep($_COOKIE);
    $_REQUEST = addslashes_deep($_REQUEST);
}

Config::set(require BX_ROOT . 'config/config.php');
date_default_timezone_set(Config::get('default_timezone'));

// 加载路由
$bx_route_files = Config::get('route_config_file');
foreach ($bx_route_files as $i) {
    Route::addRule(include BX_ROOT . "config/" . $i . ".php");
}
Route::init();

/*
if (strtolower(Route::$module) == "api") {
@(include BX_ROOT . "core/error.php");
} else {
$GLOBALS['abc_bx_key'] = Config::get('key');
$_var_3 = $GLOBALS["abc_bx_key"];
$_var_3 = isset($_var_3) && $_var_3 != '' ? $_var_3 : "error";
$_var_4 = isset($_SERVER["HTTP_HOST"]) && $_SERVER["HTTP_HOST"] != '' ? $_SERVER["HTTP_HOST"] : "error";
$_var_5 = @curl_get_contents("http://wlyz.bingxs.com/api/index.php?key=" . $_var_3 . "&domain=" . $_var_4 . '');
if ($_var_5 != "ok" && $_var_5 != '') {
    $_var_6 = json_decode($_var_5, true);
    if ($_var_6) {
        // file_put_contents(BX_ROOT . "core/error.php", "<?php exit(\"" . $_var_6["msg"] . "\"); ?>");
        echo $_var_6["msg"];
        eval("exit;");
        require BX_ROOT . "core/error.php";
        return 0;
    }
}
@unlink(BX_ROOT . "core/error.php");
}
*/

Route::load();
