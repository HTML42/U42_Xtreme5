<?php
function comp($min, $max, $current)
{
    $has_min = version_compare($current, $min, '>=');
    $has_max = version_compare($current, $max, '<=');
    return $has_min && $has_max;
}
function cp_r($src, $dest) {
    if (!is_dir($dest)) {
        @mkdir($dest, 0755, true);
    }
    $dir = opendir($src);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                cp_r($src . '/' . $file, $dest . '/' . $file);
            }
            else {
                copy($src . '/' . $file, $dest . '/' . $file);
            }
        }
    }
    closedir($dir);
}
function rm_r($dir) {
    if (!is_dir($dir)) {
        @unlink($dir);
        return;
    }
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $path = $dir . '/' . $file;
            if (is_dir($path)) {
                rm_r($path);
            }
            else {
                @unlink($path);
            }
        }
        closedir($dh);
    }
    @rmdir($dir);
}

?>