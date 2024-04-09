<?php

class Js
{

    public $files = [];
    public $templates = [];
    public $translations = [];
    public $all_files = [];
    public $latest_time = -1;
    public $cache_key = 'nocache.js';
    public $code = '';

    public function __construct($files = [], $templates = [], $translations = [])
    {
        if (is_array($files)) {
            $this->files = $files;
        }
        if (is_array($templates)) {
            $this->templates = $templates;
        }
        if (is_array($translations)) {
            $this->translations = $translations;
        }
        $this->all_files = array_merge($this->files, $this->templates);
        $this->latest_time = File::_latest_time($this->all_files);
        $this->cache_key = json_encode(array($this->all_files, $this->latest_time, $this->translations));
        $this->code = Cache::get($this->cache_key, DAY * 31);
        if (!is_string($this->code) || empty($this->code)) {
            $js_code = self::concat($this->files, $this->templates);
            $js_code .= 'TRANSLATIONS=' . json_encode($this->translations) . ';';
            $this->code = Cache::set($this->cache_key, $js_code);
        }
    }

    public static function concat($files = [], $templates = [])
    {
        $js = '';
        foreach ($files as $file) {
            if(is_object($file) && get_class($file) == 'File') {
                $file = $file->path;
            }
            if (substr($file, 0, 6) == 'https:' || substr($file, 0, 6) == 'https:') {
                $js .= Curl::get_cached($file, DAY) . "\n";
            } else {
                $File = File::instance($file);
                $js .= $File->get_content() . "\n";
            }
        }
        if (is_array($templates)) {
            $jsTemplates = 'var TEMPLATES = {';
            foreach ($templates as $template) {
                $content = File::instance($template)->get_content();
                $jsTemplates .= '"' . basename($template, '.xtpl') . '":' . json_encode($content) . ',';
            }
            $jsTemplates = rtrim($jsTemplates, ',') . '};';

            $js .= $jsTemplates;
        }

        foreach (['/*!
  * Bootstrap v5.3.2 (https://getbootstrap.com/)
  * Copyright 2011-2023 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
  */'] as $search_string) {
            $js = str_replace($search_string, '', $js);
        }
        $js = trim($js);

        return $js;
    }
}
