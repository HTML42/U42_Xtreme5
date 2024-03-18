<?php

trait Curl_special {
    public static function special($url, $options) {
        if (is_string($url) && strlen($url) > 5) {
            $url = trim($url);
            ob_start();
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt_array($ch, $options);
            $ch_exec = curl_exec($ch);
            //
            if (!$ch_exec && !App::config('offline_able'))
                self::error($ch, $url);
            //
            curl_close($ch);
            return ob_get_clean();
        }
        return '';
    }
}
