<?php

define('DIR_PHP', DIR_ROOT . 'php/');
define('DIR_CLASSES', DIR_PHP . 'classes/');
define('DIR_MODES', DIR_PHP . 'modes/');
define('DIR_DIST', DIR_ROOT . 'dist/');

define('FILE_ENVIRONMENT', DIR_DIST . 'environment');

define('HOUR', 3600);
define('DAY', HOUR * 24);
define('WEEK', DAY * 7);

define('ENV', is_file(FILE_ENVIRONMENT) ? strtolower(trim(file_get_contents(FILE_ENVIRONMENT))) : 'DEV');
