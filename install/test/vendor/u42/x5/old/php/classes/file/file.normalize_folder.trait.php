<?php

trait File_normalize_folder {
        public static function normalize_folder($source) {
                if (is_string($source)) {
                    $source = trim($source);
                    if (substr($source, -1) != '/') {
                        $source .= '/';
                    }
                }
                return $source;
            }
            public static function n($p) {
                return self::normalize_folder($p);
            }
}
