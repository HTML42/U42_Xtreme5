<?php

trait Cache_get {
    public static function get($key, $ttl = 3600) {
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
}
