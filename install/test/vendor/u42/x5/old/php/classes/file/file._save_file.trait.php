<?php

trait File__save_file {
        public static function _save_file($filepath, $content) {
                $filepath = str_replace('/', DIRECTORY_SEPARATOR, $filepath);
                file_put_contents($filepath, $content);
                @chmod($filepath, 0777);
            }
}
