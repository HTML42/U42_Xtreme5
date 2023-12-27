<?php

class Css {

    public $files = [];
    public $latest_time = -1;
    public $cache_key = 'nocache.css';
    public $code = '';
    public static $lib_dir = 'phplibs/';

    use Css_concat;
    use Css__libs;

    public function __construct($files = [], $variables = []) {
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

}
