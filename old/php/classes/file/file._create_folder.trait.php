<?php

trait File__create_folder {
        public static function _create_folder($folderpath) {
                $folderpath = str_replace('/', DIRECTORY_SEPARATOR, $folderpath);
                mkdir($folderpath);
            }
}
