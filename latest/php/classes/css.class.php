<?php

class Css
{

    public $files = [];
    public $latest_time = -1;
    public $cache_key = 'nocache.css';
    public $code = '';
    public static $lib_dir = 'phplibs/';

    public function __construct($files = [], $variables = [])
    {
        self::_libs();
        if (is_array($files)) {
            $this->files = $files;
        }
        $this->latest_time = File::_latest_time($this->files);
        $this->cache_key = json_encode(array($this->files, $this->latest_time));
        $this->code = Cache::get($this->cache_key, DAY * 31);
        if (!is_string($this->code) || empty($this->code)) {
            $this->code = Cache::set($this->cache_key, self::concat($this->files, $variables));
        }
    }

    public static function _libs()
    {
        $lib_files = [
            'less.class.php' => 'https://raw.githubusercontent.com/leafo/lessphp/master/lessc.inc.php',
        ];
        foreach ($lib_files as $filepath => $src) {
            $lib_filedir = str_replace('//', '/', DIR_CACHE . self::$lib_dir);
            $lib_filepath = $lib_filedir . $filepath;
            if (!is_file($lib_filepath)) {
                if (!is_dir($lib_filedir)) {
                    @mkdir($lib_filedir);
                }
                if (substr($src, 0, 18) == 'https://github.com') {
                    $file_content = self::__concat_from_github($src);
                } else {
                    $file_content = Curl::get_cached($src, 1);
                }
                foreach (['$subProp[1]{0}' => '$subProp[1][0]', '$name{0}' => '$name[0]', '$tag{0}' => '$tag[0]',] as $replace_before => $replace_after) {
                    while (strstr($file_content, $replace_before)) {
                        $file_content = str_replace($replace_before, $replace_after, $file_content);
                    }
                }
                file_put_contents($lib_filepath, $file_content);
                sleep(0.1);
            }
            include $lib_filepath;
        }
    }
    public static function concat($files_input = [], $variables = [])
    {
        $files = ['css' => [], 'less' => [], 'scss' => []];
        foreach ($files_input as $filepath) {
            $ext = strtolower(File::_ext($filepath));
            $css_code = '';
            if (substr($filepath, 0, 6) == 'https:' || substr($filepath, 0, 6) == 'https:') {
                $css_code = Curl::get_cached($filepath, DAY) . "\n";
                $css_code = preg_replace('/--[^\:]+\:\s*;/isU', '', $css_code);
            } else {
                $File = File::instance($filepath);
                $css_code = $File->get_content() . "\n";
            }
            $css_code = trim($css_code);
            if (!empty($css_code)) {
                if (!isset($files[$ext]) || $ext == 'css') {
                    array_push($files['css'], $css_code);
                } else {
                    array_push($files[$ext], $css_code);
                }
            }
        }
        //
        $variables_string = '';
        if (is_array($variables) && !empty($variables)) {
            foreach ($variables as $variable_name => $variable_value) {
                $variables_string .= "\n" . '#$#' . $variable_name . '#=#' . $variable_value . ';';
            }
            $variables_string = trim($variables_string);
        }
        //
        $css_code = ':root {' . str_replace('#$#', '--', str_replace('#=#', ':', $variables_string)) . '}';
        if (!empty($files['css'])) {
            foreach ($files['css'] as $code) {
                $css_code .= "\n" . $code;
            }
        }
        if (!empty($files['less'])) {
            $less_code = str_replace('#$#', '@', str_replace('#=#', ':', $variables_string));
            foreach ($files['less'] as $code) {
                $less_code .= "\n" . $code;
            }
            $less = new lessc;
            $css_code .= "\n" . $less->compile($less_code);
        }
        if (!empty($files['scss'])) {
            $scss_code = str_replace('#$#', '$', str_replace('#=#', ':', $variables_string));
            ;
            foreach ($files['scss'] as $code) {
                $scss_code .= "\n" . $code;
            }
            $scss = new ScssPhp\ScssPhp\Compiler();
            $css_code .= "\n" . $scss->compile($scss_code);
        }
        //
        foreach (['/*!
 * Bootstrap  v5.3.2 (https://getbootstrap.com/)
 * Copyright 2011-2023 The Bootstrap Authors
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 */', '@charset "UTF-8";'] as $search_string) {
                   $css_code = str_replace($search_string, '', $css_code);
               }
               $css_code = trim($css_code);
               $minifier = new MatthiasMullie\Minify\CSS();
               $minifier->add($css_code);
               $css_code = $minifier->minify();
        //
        return $css_code;
    }

}
