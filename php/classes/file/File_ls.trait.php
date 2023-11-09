<?php

trait File_ls {
        public static function ls($source, $fullpath = false, $only_files = false) {
                if (is_dir($source)) {
                    $source = self::n($source);
                    $folder = scandir($source);
                    $folder = array_filter($folder, function($filename) {
                        return $filename != '.' && $filename != '..';
                    });
                    if ($only_files) {
                        $folder = array_filter($folder, function($filename) use ($source) {
                            return is_file($source . $filename);
                        });
                    }
                    if ($fullpath) {
                        foreach ($folder as &$filename) {
                            $filename = $source . $filename;
                        }
                    }
                    return $folder;
                } else {
                    return array();
                }
            }
}
