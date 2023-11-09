<?php

trait File_name {
        public function name() {
                return self::_name($this->path);
            }
            public static function _name($filepath) {
                if (!isset(self::$_CACHE['filenames'][$filepath])) {
                    $filename = explode('/', $filepath);
                    $filename = end($filename);
                    self::$_CACHE['filenames'][$filepath] = $filename;
                }
                return self::$_CACHE['filenames'][$filepath];
            }
}
