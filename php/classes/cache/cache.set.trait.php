<?php

trait Cache_set {
    public static function set($key, $value) {
        file_put_contents(self::$dir . sha1($key) . '.cache', json_encode($value));
        self::$_CACHE[$key] = $value;
        return self::$_CACHE[$key];
    }
}
