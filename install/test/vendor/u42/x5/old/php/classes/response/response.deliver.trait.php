<?php

trait Response_deliver {
    public static function deliver($content) {
        $current_output = trim(ob_get_clean());
        if (strlen($current_output) > 0) {
            $content = $current_output . $content;
        }
        
        if (ENV != 'dev') {
            self::header('Cache-Control: public');
            self::header('Pragma: cache');
            self::header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + (HOUR * 6)));
        }

        self::header('Content-length: ' . strlen($content));
        self::header('Content-Type: ' . App::$mime . '; charset=' . App::$encoding, 200);

        echo $content;
    }
}

