<?php

trait Cache_init
{
    public static function init()
    {
        self::$dir = DIR_CACHE . 'cache/';
        if(!is_dir(DIR_CACHE)) {
            @mkdir(DIR_CACHE);
        }
        if(!is_dir(self::$dir)) {
            @mkdir(self::$dir);
        }
    }
}
