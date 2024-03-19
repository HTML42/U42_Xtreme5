<?php
spl_autoload_register(function ($classname) {
    $class_filename = strtolower($classname) . '.class.php';
    $class_filepath = DIR_PROJECT_PHP_CLASSES . $class_filename;
    if(!is_file($class_filepath)) {
        $class_filepath = DIR_X5_PHP_CLASSES . $class_filename;
    }
    if(is_file($class_filepath)) {
        require_once $class_filepath;
    }
});