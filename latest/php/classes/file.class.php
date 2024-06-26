<?php

class File
{
    public $path = null;
    public $exists = false;
    private static $_CACHE = array('instances' => array(), 'filenames' => array(), 'filefolders' => array(), 'fileext' => array());

    public function __construct($file_path = null)
    {
        if (is_string($file_path)) {
            $this->path = $file_path;
            $this->load_meta();
        }
    }

    public static function _create_folder($folderpath)
    {
        $folderpath = str_replace('/', DIRECTORY_SEPARATOR, $folderpath);
        mkdir($folderpath);
    }

    public static function _create_try_list($filename, $extensions = array(), $prepathes = false)
    {
        $list = array();
        $base_pathes = array(DIR_PROJECT, DIR_PROJECT_PHP, DIR_X5, DIR_X5_PHP);
        
        if (!in_array('', $extensions)) {
            array_push($extensions, '');
        }
        if (is_string($prepathes) && strlen($prepathes) > 0) {
            $prepathes = array($prepathes);
        }
        if (!is_array($prepathes)) {
            $prepathes = array('');
        }
        if (!in_array('', $prepathes)) {
            array_push($prepathes, '');
        }
        foreach ($base_pathes as $base_path) {
            foreach ($extensions as $extension) {
                if (strlen($extension) > 0 && !strstr($extension, '.')) {
                    $extension = '.' . $extension;
                }
                if (is_array($prepathes)) {
                    foreach ($prepathes as $prepath) {
                        array_push($list, $base_path . $prepath . $filename . $extension);
                    }
                }
            }
        }
        return $list;
    }

    public static function _latest_time($files = [])
    {
        $latest = -1;
        foreach ($files as $filepath) {
            if(is_object($filepath) && get_class($filepath) == 'File') {
                $filepath = $filepath->path;
            }
            if (!is_url($filepath) && is_file($filepath)) {
                $latest = max(array($latest, filemtime($filepath)));
            }
        }
        return $latest;
    }

    public static function _save_file($filepath, $content)
    {
        $filepath = str_replace('/', DIRECTORY_SEPARATOR, $filepath);
        file_put_contents($filepath, $content);
        @chmod($filepath, 0777);
    }

    public function ext()
    {
        return self::_ext($this->path);
    }

    public static function _ext($filepath)
    {
        if (!isset(self::$_CACHE['fileext'][$filepath])) {
            if (strstr($filepath, '.')) {
                $file_exts = explode('.', $filepath);
                self::$_CACHE['fileext'][$filepath] = end($file_exts);
            } else {
                self::$_CACHE['fileext'][$filepath] = false;
            }
        }
        return self::$_CACHE['fileext'][$filepath];
    }

    public function folder()
    {
        return self::_folder($this->path);
    }

    public static function _folder($filepath)
    {
        if (!isset(self::$_CACHE['filefolders'][$filepath])) {
            $filename = self::_name($filepath);
            $filefolder = str_replace($filename, '', $filepath);
            self::$_CACHE['filefolders'][$filepath] = $filefolder;
        }
        return self::$_CACHE['filefolders'][$filepath];
    }

    public function get_content()
    {
        if ($this->exists) {
            if ($this->ext() == 'php') {
                ob_start();
                include $this->path;
                return ob_get_clean();
            } else {
                return file_get_contents($this->path);
            }
        } else {
            return '';
        }
    }

    public function get_json() {
        if ($this->exists) {
            $content = $this->get_content();
            // HJSON Support
            $content = preg_replace('|/\*.*\*/|Us', '', $content);
            return @json_decode($content, true);
        } else {
            return null;
        }
    }

    public static function i($file_path) {
        $try_list = self::_create_try_list($file_path);
        return self::instance_of_first_existing_file($try_list);
    }

    public static function instance_of_first_existing_file($file_pathes) {
        foreach ((array) $file_pathes as $file_path) {
            if (is_file($file_path)) {
                return self::instance($file_path);
            }
        }
        return new self();
    }

    public static function instance($file_path) {
        if (!isset(self::$_CACHE['instances'][$file_path])) {
            self::$_CACHE['instances'][$file_path] = new self($file_path);
        }
        return self::$_CACHE['instances'][$file_path];
    }

    public function load_meta() {
        if (is_string($this->path)) {
            $this->exists = is_file($this->path);
        }
    }

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

    public function name() {
        return self::_name($this->path);
    }

    public static function _name($filepath) {
        if (!isset(self::$_CACHE['filenames'][$filepath])) {
            $filename = explode('/', $filepath);
            $filename = end($filename);
            self::$_CACHE['filenames'][$filepath] = $filename;
        }
        return self::$_CACHE['filenames'][$filepath];
    }

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

    public static function path($source) {
        $path = explode('/', $source);
        $path = array_slice($path, 0, count($path) - 1);
        $path = implode('/', $path);
        return $path . '/';
    }
}
