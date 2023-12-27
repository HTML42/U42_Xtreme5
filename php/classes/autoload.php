<?php

spl_autoload_register(function ($classname) {
    $class_dir = DIR_CLASSES . strtolower($classname) . "/";

    foreach (glob($class_dir . "*.trait.php") as $file) {
        require_once $file;
    }

    $class_file = $class_dir . strtolower($classname) . "._class.php";
    if (file_exists($class_file)) {
        require_once $class_file;
    }
    $class_methods = get_class_methods($classname);
    if (is_array($class_methods) && in_array('init', $class_methods)) {
        $classname::init();
    }
});

