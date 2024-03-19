<?php

class Translation {
    
    public static $LANG = 'en';
    public static $_CACHE = [];
    public static $default_translations = 'i18n.json';
    
    use Translation_get;
    use Translation_get_all;
    use Translation_set_lang;

}
