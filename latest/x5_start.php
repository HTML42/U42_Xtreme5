<?php

include 'php/lib/bootstrap.php';
if (isset(Request::$requested_clean_path_array[0]) && !empty(Request::$requested_clean_path_array[0])) {
    App::$object = strtolower(trim(Request::$requested_clean_path_array[0]));
    if (isset(Request::$requested_clean_path_array[1]) && !empty(Request::$requested_clean_path_array[1])) {
        App::$action = strtolower(trim(Request::$requested_clean_path_array[1]));
    }
}
//
foreach (glob(DIR_PROJECT_CONFIG . '*.php') as $configfile) {
    if (is_file($configfile)) {
        include_once $configfile;
    }
}
include DIR_X5_PHP_CLASSES . 'db.class.php';
include DIR_X5_PHP_CLASSES . 'xuser.class.php';
$GLOBALS['login'] = null;
$GLOBALS['ME_id'] = 0;
$GLOBALS['ME'] = XUser::load(0);
if(isset($_COOKIE['X5_login'])) {
    $GLOBALS['login'] = @json_decode(base64_decode($_COOKIE['X5_login']), true) ?? null;
    if(isset($GLOBALS['login']['userid']) && $GLOBALS['login']['userid'] > 0 && isset($GLOBALS['login']['fingerprint']) && $GLOBALS['login']['fingerprint'] == fingerprint()) {
        $GLOBALS['ME_id'] = intval($GLOBALS['login']['userid']);
        $GLOBALS['ME'] = XUser::load($GLOBALS['ME_id']);
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
        '<script>window.BASEURL="' . BASEURL . '";window.LANG="' . Translation::$LANG . '";window.ME=' . $GLOBALS['ME']->export_js() . ';</script>' .
        '<script src="js/xtreme" async></script>' .
        '</head></html>');
} else {
    if (App::$object == 'images') {
        $File_object = File::i('modes/image.php');
    } else {
        $object_path = 'objects/' . (is_string(App::$object) && is_string(App::$action) ? App::$object . '/' . App::$action : 'error/404');
        if (is_file(DIR_PROJECT . $object_path)) {
            $File_object = File::instance(DIR_PROJECT . $object_path);
        } else {
            $object_trylist = File::_create_try_list($object_path, array('.php', '.html', '.css', '.js', ''), array(DIR_PROJECT, DIR_X5));
            $File_object = File::instance_of_first_existing_file($object_trylist);
        }
        if (!$File_object->exists) {
            $File_object = File::instance(DIR_X5_OBJECTS . 'error/404');
        }
    }
    //
    include $File_object->path;
}