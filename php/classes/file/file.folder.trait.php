<?php

trait File_folder {
        public function folder() {
                return self::_folder($this->path);
            }
            public static function _folder($filepath) {
                if (!isset(self::$_CACHE['filefolders'][$filepath])) {
                    $filename = self::_name($filepath);
                    $filefolder = str_replace($filename, '', $filepath);
                    self::$_CACHE['filefolders'][$filepath] = $filefolder;
                }
                return self::$_CACHE['filefolders'][$filepath];
            }
}
