<?php

class Cache
{
    static $dir = 'cache/';
    static $_CACHE = [];

    public static function init()
    {
        self::$dir = DIR_CACHE . 'cache/';
        if (!is_dir(DIR_CACHE)) {
            @mkdir(DIR_CACHE);
        }
        if (!is_dir(self::$dir)) {
            @mkdir(self::$dir);
        }
    }
    public static function get($key, $ttl = 3600)
    {
        if (isset(self::$_CACHE[$key])) {
            return self::$_CACHE[$key];
        }
        $File_cache = File::instance(self::$dir . sha1($key) . '.cache');
        if ($File_cache->exists && (filemtime($File_cache->path) + $ttl) > time()) {
            self::$_CACHE[$key] = $File_cache->get_json();
            return self::$_CACHE[$key];
        }
        return null;
    }
    public static function set($key, $value)
    {
        file_put_contents(self::$dir . sha1($key) . '.cache', json_encode($value));
        self::$_CACHE[$key] = $value;
        return self::$_CACHE[$key];
    }

}
Cache::init();
