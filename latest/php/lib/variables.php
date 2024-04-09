<?php

define('DIR_X5_PHP', DIR_X5 . 'php/');
define('DIR_X5_PHP_LIB', DIR_X5_PHP . 'lib/');
define('DIR_X5_PHP_CLASSES', DIR_X5_PHP . 'classes/');
define('DIR_X5_OBJECTS', DIR_X5_PHP . 'objects/');
define('DIR_X5_TEMPLATES', DIR_X5 . 'templates/');
define('DIR_PROJECT', $dir_project);
define('DIR_PROJECT_PHP', DIR_PROJECT . 'php/');
define('DIR_PROJECT_PHP_LIB', DIR_PROJECT_PHP . 'lib/');
define('DIR_PROJECT_PHP_CLASSES', DIR_PROJECT_PHP . 'classes/');
define('DIR_PROJECT_OBJECTS', DIR_PROJECT_PHP . 'objects/');
define('DIR_PROJECT_TEMPLATES', DIR_PROJECT . 'templates/');
define('DIR_VENDOR', DIR_PROJECT . 'vendor/');
define('DIR_PROJECT_CONFIG', DIR_PROJECT . 'config/');
define('DIR_CACHE', DIR_X5 . '_cache/');

/*
define('DIR_CACHE', DIR_ROOT . '_cache/');
define('DIR_CLASSES', DIR_PHP . 'classes/');
define('DIR_MODES', DIR_PHP . 'modes/');
define('DIR_DIST', DIR_ROOT . 'dist/');
define('DIR_OBJECTS', DIR_ROOT . 'objects/');
define('DIR_TEMPLATES', DIR_ROOT . 'templates/');
define('DIR_TRANSLATIONS', DIR_ROOT . 'translations/');
define('DIR_VENDOR', DIR_ROOT . 'vendor/');
*/

define('FILE_ENVIRONMENT', DIR_PROJECT . 'environment');

define('HOUR', 3600);
define('DAY', HOUR * 24);
define('WEEK', DAY * 7);

define('ENV', is_file(FILE_ENVIRONMENT) ? strtolower(trim(file_get_contents(FILE_ENVIRONMENT))) : 'dev');
