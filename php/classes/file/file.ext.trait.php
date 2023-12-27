<?php

trait File_ext
{
        public function ext()
        {
                return self::_ext($this->path);
        }

        public static function _ext($filepath)
        {
                if (!isset(self::$_CACHE['fileext'][$filepath])) {
                        if (strstr($filepath, '.')) {
                                $file_exts                          = explode('.', $filepath);
                                self::$_CACHE['fileext'][$filepath] = end($file_exts);
                        } else {
                                self::$_CACHE['fileext'][$filepath] = false;
                        }
                }
        }
}
