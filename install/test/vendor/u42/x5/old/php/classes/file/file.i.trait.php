<?php

trait File_i {
    /**
     * Shurtcut.Method for 
     * @param string $file_path
     * @return File
     */
    public static function i($file_path) {
        $try_list = self::_create_try_list($file_path);
        return self::instance_of_first_existing_file($try_list);
    }
}
