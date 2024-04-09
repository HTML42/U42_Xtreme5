<?php

class Js {

    public $files = [];
    public $templates = [];
    public $translations = [];
    public $all_files = [];
    public $latest_time = -1;
    public $cache_key = 'nocache.js';
    public $code = '';

    use Js_concat;

    public function __construct($files = [], $templates = [], $translations = []) {
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

}
