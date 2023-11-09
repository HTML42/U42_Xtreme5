<?php

trait File_instance_of_first_existing_file {
    /**
     * 
     * @param array/string $file_path
     * @return File
     */
    public static function instance_of_first_existing_file($file_pathes) {
        foreach ((array) $file_pathes as $file_path) {
            if (is_file($file_path)) {
                return self::instance($file_path);
            }
        }
        return new self();
    }
}
