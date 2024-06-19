<?php

function is_https() {
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https');
}
function is_url($string) {
    if(!is_string($string)) {
        return false;
    }
    return substr($string, 0, 5) == 'http:' || substr($string, 0, 6) == 'https:';
}
function is_json($input) {
    if(!is_string($input) || strlen($input) <= 1) {
        return false;
    }
    if((strstr($input, '{') && strstr($input, '}')) || (strstr($input, '[') && strstr($input, ']'))) {
        return $input;
    }
    return false;
}
function json($input) {
    return is_json($input) ? @json_decode($input, true) : [];
}

function debug($var, $height = 'auto', $width = 'auto') {
    $backtrace = debug_backtrace();
    $file = 'Unknown';
    $line = 'Unknown';
    if (count($backtrace) > 1 && isset($backtrace[1]['function']) && in_array($backtrace[1]['function'], array('debug'))) {
        $file = '<span title="Through a debug from: ' . $backtrace[0]['file'] . '">' . $backtrace[1]['file'] . '</span>';
        $line = $backtrace[1]['line'];
    } else if (isset($backtrace[0]['file']) && isset($backtrace[0]['line'])) {
        $file = $backtrace[0]['file'];
        $line = $backtrace[0]['line'];
    }
    echo '<pre style="' .
    'word-break:break-word;border: 1px dashed #BBB;background-color: #CCC;padding:10px;color:#333;' . ($height == 'auto' ? '' : 'overflow-y:scroll;') .
    'height:' . ($height == 'auto' ? 'auto' : $height . 'px') . ';width:' . (strstr($width, '%') || strstr($width, 'px') ? $width : (strstr($width, 'auto') ? 'auto' : $width . 'px')) .
    ';' . ($width != '100%' ? 'margin: 0 auto 10px;' : '') . '">';
    echo '<span style="display: block; margin-bottom: 5px; font-weight: 700;">' . $file . ' (line ' . $line . '):</span>';
    ob_start();
    var_dump($var);
    echo htmlspecialchars(ob_get_clean());
    echo '</pre>';
}
function xhash($input) {
    if(!is_string($input)) {
        $input = @json_encode($input);
    }
    if(!is_string($input)) {
        return null;
    }
    $hash = sha1($input . 'X5!') . md5($input . 'X5!');
    $hash = strtoupper($hash);
    return $hash;
}
function xhash_check($input, $hash) {
    $hash = strtoupper($hash);
    return $hash == xhash($input);
}
function remote_ip() {
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        return $_SERVER["HTTP_CF_CONNECTING_IP"];
    } else if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        return $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else if (isset($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    } else {
        return null;
    }
}
function fingerprint() {
    return md5($_SERVER['HTTP_USER_AGENT'] . remote_ip());
}
