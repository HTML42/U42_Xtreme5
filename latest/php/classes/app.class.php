<?php

class App
{
    public static $mime = 'text/html';
    public static $encoding = 'UTF-8';

    public static $object = null;
    public static $action = null;
    
    public static $config = [];
    
    public static function config($key, $default = null) {
        return isset(self::$config[$key]) && !is_null(self::$config[$key]) ? self::$config[$key] : $default;
    }
}

