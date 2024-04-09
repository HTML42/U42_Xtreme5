<?php

class Translation {
    
    public static $LANG = 'en';
    public static $_CACHE = [];
    public static $default_translations = 'i18n.json';
    
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

    public static function get_all() {
        $dir = DIR_PROJECT . 'translations/' . self::$LANG . '/';
        $default_file = $dir . self::$default_translations;
        if (!isset(self::$_CACHE['#all#']) || is_null(self::$_CACHE['#all#'])) {
            if(is_file($default_file)) {
                if(!isset(self::$_CACHE['default']) || is_null(self::$_CACHE['default'])) {
                    self::$_CACHE['default'] = @json_decode(file_get_contents($default_file), true);
                    self::$_CACHE['#all#'] = self::$_CACHE['default'];
                }
            }
            foreach(glob($dir . '*') as $translation_file) {
                if(is_file($translation_file) && $translation_file != $default_file) {
                    $translation_path = str_replace($dir, '', $translation_file);
                    $translation_path = str_replace('.html', '', $translation_path);
                    $translation_path = str_replace('/', '.', $translation_path);
                    $translation_path = trim($translation_path);
                    if(!empty($translation_path)) {
                        self::$_CACHE['#all#'][$translation_path] = file_get_contents($translation_file);
                    }
                }
            }
        }
        return isset(self::$_CACHE['#all#']) ? self::$_CACHE['#all#'] : null;
    }

    public static function set_lang($lang) {
        if(is_string($lang)) {
            $lang = strtolower(trim($lang));
            if(!empty($lang)) {
                self::$LANG = $lang;
            }
        }
    }
}
