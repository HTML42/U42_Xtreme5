<?php

trait File_instance
{
        /**
         * 
         * @param string $file_path
         * @return File
         */
        public static function instance($file_path)
        {
                if (!isset(self::$_CACHE['instances'][$file_path])) {
                        self::$_CACHE['instances'][$file_path] = new self($file_path);
                }
                return self::$_CACHE['instances'][$file_path];
        }
}
