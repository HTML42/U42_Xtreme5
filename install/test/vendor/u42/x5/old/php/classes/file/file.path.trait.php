<?php

trait File_path {
        public static function path($source) {
                $path = explode('/', $source);
                $path = array_slice($path, 0, count($path) - 1);
                $path = implode('/', $path);
                return $path . '/';
            }
}
