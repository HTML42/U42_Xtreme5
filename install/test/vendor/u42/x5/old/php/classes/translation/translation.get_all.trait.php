<?php

trait Translation_get_all {

    public static function get_all() {
        $dir = DIR_TRANSLATIONS . self::$LANG . '/';
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

}
