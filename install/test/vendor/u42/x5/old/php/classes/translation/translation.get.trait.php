<?php

trait Translation_get {

    public static function get($key = null) {
        $dir = DIR_TRANSLATIONS . self::$LANG . '/';
        $direct = $dir . $key . '.html';
        $default_file = $dir . self::$default_translations;
        $cache_key = md5($key);
        if (!isset(self::$_CACHE[$cache_key]) || is_null(self::$_CACHE[$cache_key])) {
            if (is_file($direct)) {
                self::$_CACHE[$cache_key] = file_get_contents($direct);
            } else if (is_file($default_file)) {
                if(!isset(self::$_CACHE['default']) || is_null(self::$_CACHE['default'])) {
                    self::$_CACHE['default'] = @json_decode(file_get_contents($default_file), true);
                }
                if(is_array(self::$_CACHE['default'])) {
                    if(isset(self::$_CACHE['default'][$key])) {
                        self::$_CACHE[$cache_key] = self::$_CACHE['default'][$key];
                    }
                }
            }
        }
        return isset(self::$_CACHE[$cache_key]) ? self::$_CACHE[$cache_key] : null;
    }

}
