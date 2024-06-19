<?php

class Request
{
    public static $url_path_to_script, $requested_path, $requested_path_array, $requested_clean_path, $requested_clean_path_array;

    public static function init()
    {
        $path_to_script = str_replace(basename($_SERVER["SCRIPT_NAME"]), '', $_SERVER["SCRIPT_NAME"]);
        if (substr($path_to_script, 0, 1) == '/') {
            $path_to_script = substr($path_to_script, 1);
        }
        if (substr($path_to_script, -4) == 'php/') {
            $path_to_script = substr($path_to_script, 0, -4);
        }
        if (strstr($_SERVER['REQUEST_URI'], 'dist/') && !strstr($path_to_script, 'dist/')) {
            $path_to_script .= 'dist/';
        }
        self::$url_path_to_script = $path_to_script;
        preg_match('/\/*(.*)\/*/', $_SERVER['REQUEST_URI'], $match);
        if (strstr($match[1], '?')) {
            $match[1] = preg_replace('/\?.*/', '', $match[1]);
        }
        self::$requested_path = $match[1];
        self::$requested_path_array = array_filter(explode('/', Request::$requested_path), 'strlen');
        self::$requested_clean_path = str_replace(self::$url_path_to_script, '', self::$requested_path);
        self::$requested_clean_path_array = array_filter(explode('/', Request::$requested_clean_path), 'strlen');
    }

    public static function param($key, $order = ['post', 'get', 'param', 'server'], $default = null, $as = null)
    {
        if (!is_string($key)) {
            return $default;
        }
        $key = trim($key);
        //
        $from_json_body = file_get_contents('php://input');
        if(is_string($from_json_body) && strlen($from_json_body) > 2 && is_json($from_json_body)) {
            foreach(json($from_json_body) as $k => $v) {         
                $_POST[$k] = $v;       
            }
        }
        //
        $sources = [
            'post' => $_POST,
            'get' => $_GET,
            'param' => $_REQUEST,
            'server' => $_SERVER,
        ];
        foreach ($order as $source) {
            if (isset($sources[$source]) && array_key_exists($key, $sources[$source])) {
                $value = $sources[$source][$key];
                if (is_string($as)) {
                    switch (strtolower($as)) {
                        case 'int':
                        case 'integer':
                        case 'number':
                            return intval($value);
                        case 'float':
                        case 'double':
                            return floatval($value);
                        case 'bool':
                        case 'boolean':
                            return filter_var($value, FILTER_VALIDATE_BOOLEAN);
                        case 'json':
                            $json = json_decode($value, true);
                            return json_last_error() === JSON_ERROR_NONE ? $json : $default;
                        case 'string':
                        default:
                            return strval($value);
                    }
                }

                return $value;
            }
        }
        return $default;
    }

}

Request::init();
