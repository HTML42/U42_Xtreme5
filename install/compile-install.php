<?php

if(!function_exists('rm_r')) {
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
}
//
$code = '';
$css = '';
$js = '';
$dir_root = str_replace('\\', '/', __DIR__) . '/';
$dir_files = $dir_root . 'files/';
$dir_dist = $dir_root . 'dist/';
$dir_test = $dir_root . 'test/';
$filepath_install_php_raw = $dir_dist . 'install.raw.php';
$filepath_install_php = $dir_dist . 'install.php';
$filepath_install_js = $dir_dist . 'script.js';
$filepath_install_css = $dir_dist . 'styles.css';

//Clean Test Folder
if(is_dir($dir_test)) {
    rm_r($dir_test);
}
@mkdir($dir_test);

//
if(!is_dir($dir_files)) {
    @mkdir($dir_files);
}
if(!is_dir($dir_dist)) {
    @mkdir($dir_dist);
}

foreach(scandir($dir_files) as $filename) {
    $filepath = $dir_files . $filename;
    if(strstr($filename, '.js') && !strstr($filename, '.json')) {
        $js .= "\n" . file_get_contents($filepath);
    } else if(strstr($filename, '.css')) {
        $css .= "\n" . file_get_contents($filepath);
    } else if(strstr($filename, '.php')) {
        $code .= "\n" . file_get_contents($filepath);
    } else if(strstr($filename, '.html')) {
        $code .= "\n" . file_get_contents($filepath);
    }
    $css = trim($css);
    $js = trim($js);
    $code = trim($code);
    if(strstr($filename, '.php')) {
        //Check if unclosed PHP Code
    }
}
//
file_put_contents($filepath_install_css, $css);
file_put_contents($filepath_install_js, $js);
//
$code .= '<style type="text/css">' . $css . '</style>';
$code .= '<script type="text/javascript">' . $js . '</script>';
//
$code_min = $code;
for($i = 0 ; $i < 10 ; $i++) {
    $code_min = preg_replace("/\?\>\s*\<\?php/", "", $code_min);
    $code_min = preg_replace("/\n\s*\n/", "\n", $code_min);
}
//
file_put_contents($filepath_install_php_raw, $code);
file_put_contents($filepath_install_php, $code_min);
file_put_contents($dir_test . 'install-xtreme5.php', $code_min);
file_put_contents($dir_test . '.gitignore', "*\n!.gitignore");

//
if(isset($_GET['loop'])) {
    echo '<script>setTimeout("location.reload(true)", 3000)</script>';
}