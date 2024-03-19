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

//

include DIR_ROOT . 'php/variables.php';
include DIR_CLASSES . 'autoload.php';
include DIR_PHP . 'functions.php';
include DIR_CLASSES . 'app.class.php';

define('BASEURL', 'http' . (is_https() ? 's' : '') . '://' . $_SERVER['SERVER_NAME'] . '/' . Request::$url_path_to_script);

$GLOBALS['ASSET_PREFIX'] = '';
for ($i = 0; $i < count(Request::$requested_clean_path_array) - 1; $i++) {
    $GLOBALS['ASSET_PREFIX'] .= '../';
}
define('ASSET_PREFIX', $GLOBALS['ASSET_PREFIX']);

//
if (isset(Request::$requested_clean_path_array[0]) && !empty(Request::$requested_clean_path_array[0])) {
    App::$object = strtolower(trim(Request::$requested_clean_path_array[0]));
    if (isset(Request::$requested_clean_path_array[1]) && !empty(Request::$requested_clean_path_array[1])) {
        App::$action = strtolower(trim(Request::$requested_clean_path_array[1]));
    }
}
//
foreach (glob(DIR_CONFIG . '*.php') as $configfile) {
    if (is_file($configfile)) {
        include_once $configfile;
    }
}
//
if (App::config('composer') && is_file(DIR_VENDOR . 'autoload.php')) {
    include_once DIR_VENDOR . 'autoload.php';
}
//
if (is_null(App::$object) && is_null(App::$action)) {
    Response::deliver('<!DOCTYPE html><html lang><head>' .
            '<meta name="viewport" content="width=device-width, initial-scale=1" />' .
            '<script>window.BASEURL="' . BASEURL . '";window.LANG="' . Translation::$LANG . '";</script>' .
            '<script src="js/xtreme" async></script>' .
            '</head></html>');
} else {
    $object_path = 'objects/' . (is_string(App::$object) && is_string(App::$action) ? App::$object . '/' . App::$action : 'error/404');
    if (is_file(DIR_ROOT . $object_path)) {
        $File_object = File::instance(DIR_ROOT . $object_path);
    } else {
        $object_trylist = File::_create_try_list($object_path, array('.php', '.html', '.css', '.js', ''), array(''));
        $File_object = File::instance_of_first_existing_file($object_trylist);
    }
    if (!$File_object->exists) {
        $File_object = File::instance(DIR_OBJECTS . 'error/404');
    }
    //
    include $File_object->path;
}
