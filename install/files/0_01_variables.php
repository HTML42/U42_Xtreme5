<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
define('DIR_ROOT', str_replace('\\', '/', __DIR__) . '/');
define('DIR_VENDOR', DIR_ROOT . 'vendor/');
define('FILE_install_scriptname', basename($_SERVER['SCRIPT_FILENAME']));
define('FILE_install', DIR_ROOT . FILE_install_scriptname);
define('BASEURL', @reset(explode(FILE_install_scriptname, $_SERVER['REQUEST_URI'])));
define('BASEURL_SCRIPT', BASEURL . FILE_install_scriptname);
$step_min = 1;
$step_max = 9;
$step = isset($_GET['step']) ? intval($_GET['step']) : $step_min;
define('STEP', $step >= $step_min && $step <= $step_max ? $step : $step_min);

$php_version = phpversion();
$requirements = [
    'php' => ['PHP Version', $php_version, '8.1', '8.4', comp('8.1', '8.4', $php_version)],
];
$check_all = true;
eval('foreach($requirements as $r){if(!$r[4]){$check_all=false;break;}}');

?>