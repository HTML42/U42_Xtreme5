<?php

Trait Css__libs {

    public static function _libs() {
        $lib_files = [
            'less.class.php' => 'https://raw.githubusercontent.com/leafo/lessphp/master/lessc.inc.php',
        ];
        foreach ($lib_files as $filepath => $src) {
            $lib_filedir = str_replace('//', '/', DIR_CACHE . self::$lib_dir);
            $lib_filepath = $lib_filedir . $filepath;
            if (!is_file($lib_filepath)) {
                if (!is_dir($lib_filedir)) {
                    @mkdir($lib_filedir);
                }
                if (substr($src, 0, 18) == 'https://github.com') {
                    $file_content = self::__concat_from_github($src);
                } else {
                    $file_content = Curl::get_cached($src, 1);
                }
                foreach ([
            '$subProp[1]{0}' => '$subProp[1][0]',
            '$name{0}' => '$name[0]',
            '$tag{0}' => '$tag[0]',
                ] as $replace_before => $replace_after) {
                    while (strstr($file_content, $replace_before)) {
                        $file_content = str_replace($replace_before, $replace_after, $file_content);
                    }
                }
                file_put_contents($lib_filepath, $file_content);
                sleep(0.1);
            }
            include $lib_filepath;
        }
    }

}
