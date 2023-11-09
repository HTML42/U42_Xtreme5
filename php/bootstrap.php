<?php

ini_set('short_open_tag', 1);
ini_set('magic_quotes_gpc', 1);
ini_set("memory_limit", "512M");

@session_start();

//CLI-Special
foreach (array('REQUEST_URI' => '', 'HTTPS' => 'off', 'SERVER_PORT' => 0, 'SERVER_NAME' => 'localhost', ) as $_SERVER_KEY => $_SERVER_VALUE) {
    if (!isset($_SERVER[$_SERVER_KEY])) {
        $_SERVER[$_SERVER_KEY] = $_SERVER_VALUE;
    }
}
define('IS_CLI', ($_SERVER['REQUEST_URI'] === '' && $_SERVER['SERVER_NAME'] === 'localhost' && $_SERVER['SERVER_PORT'] === 0));

//

$dir = str_replace(DIRECTORY_SEPARATOR, '/', __DIR__) . '/';
if (substr($dir, -5) == 'dist/') {
    $dir = substr($dir, 0, -5);
}
if (substr($dir, -4) == 'php/') {
    $dir = substr($dir, 0, -4);
}
define('DIR_ROOT', $dir);

include DIR_ROOT . 'php/variables.php';
include DIR_CLASSES . 'autoload.php';
include DIR_PHP . 'functions.php';
include DIR_CLASSES . 'app.php';

Request::init();

define('BASEURL', 'http' . (is_https() ? 's' : '') . '://' . $_SERVER['SERVER_NAME'] . '/' . Request::$url_path_to_script);

$GLOBALS['ASSET_PREFIX'] = '';
for ($i = 0; $i < count(Request::$requested_clean_path_array) - 1; $i++) {
    $GLOBALS['ASSET_PREFIX'] .= '../';
}
define('ASSET_PREFIX', $GLOBALS['ASSET_PREFIX']);

//
if (isset(Request::$requested_clean_path_array[0]) && !empty(Request::$requested_clean_path_array[0])) {
    App::$controller = Request::$requested_clean_path_array[0];
    if (isset(Request::$requested_clean_path_array[1]) && !empty(Request::$requested_clean_path_array[1])) {
        App::$view = Request::$requested_clean_path_array[1];
        if (isset(Request::$requested_clean_path_array[2]) && !empty(Request::$requested_clean_path_array[2])) {
            App::$action = Request::$requested_clean_path_array[2];
        }
    }
}
echo 'Neues Framework';
