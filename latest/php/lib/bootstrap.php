<?php

ini_set('short_open_tag', 1);
ini_set('magic_quotes_gpc', 1);
ini_set("memory_limit", "512M");

@session_start();

//CLI-Special
foreach (array('REQUEST_URI' => '', 'HTTPS' => 'off', 'SERVER_PORT' => 0, 'SERVER_NAME' => 'localhost',) as $_SERVER_KEY => $_SERVER_VALUE) {
    if (!isset($_SERVER[$_SERVER_KEY])) {
        $_SERVER[$_SERVER_KEY] = $_SERVER_VALUE;
    }
}
define('IS_CLI', ($_SERVER['REQUEST_URI'] === '' && $_SERVER['SERVER_NAME'] === 'localhost' && $_SERVER['SERVER_PORT'] === 0));

$dir = str_replace(DIRECTORY_SEPARATOR, '/', __DIR__) . '/';
$dir = str_replace('/php/lib/', '/', $dir);
if (substr($dir, -5) == 'dist/') {
    $dir = substr($dir, 0, -5);
}
if (substr($dir, -4) == 'php/') {
    $dir = substr($dir, 0, -4);
}
define('DIR_X5', $dir);

$dir_project = str_replace('\\', '/', dirname($_SERVER['SCRIPT_FILENAME']));
if(substr($dir_project, -1) != '/') {
    $dir_project .= '/';
}
if(substr($dir_project, -5) == 'dist/') {
    $dir_project = substr($dir_project, 0, -5);
}

include DIR_X5 . 'php/lib/variables.php';
include DIR_X5_PHP . 'autoload.php';
include DIR_X5_PHP_LIB . 'functions.php';
include DIR_X5_PHP_CLASSES . 'app.class.php';
include DIR_X5_PHP_CLASSES . 'request.class.php';
include DIR_X5_PHP_CLASSES . 'xobject.class.php';

define('BASEURL', 'http' . (is_https() ? 's' : '') . '://' . $_SERVER['SERVER_NAME'] . '/' . Request::$url_path_to_script);

$GLOBALS['ASSET_PREFIX'] = '';
for ($i = 0; $i < count(Request::$requested_clean_path_array) - 1; $i++) {
    $GLOBALS['ASSET_PREFIX'] .= '../';
}
define('ASSET_PREFIX', $GLOBALS['ASSET_PREFIX']);