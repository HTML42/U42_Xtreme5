<?php

trait Translation_set_lang {
    public static function set_lang($lang) {
        if(is_string($lang)) {
            $lang = strtolower(trim($lang));
            if(!empty($lang)) {
                self::$LANG = $lang;
            }
        }
    }
}
