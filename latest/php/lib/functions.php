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
function darken_color($color, $factor = 0.25) {
    // Entferne Leerzeichen und mache den Farbwert einheitlich
    $color = trim(strtolower($color));

    // Funktion zur Anpassung der Helligkeit von RGB-Werten
    $adjust_color = function($r, $g, $b, $factor) {
        $r = max(0, min(255, round($r * (1 - $factor))));
        $g = max(0, min(255, round($g * (1 - $factor))));
        $b = max(0, min(255, round($b * (1 - $factor))));
        return [$r, $g, $b];
    };

    // Falls es sich um Hex handelt
    if (preg_match('/^#?([a-f\d]{3}|[a-f\d]{6})$/', $color, $matches)) {
        $hex = ltrim($matches[1], '#');

        // Expandiere kurze Hex-Codes (z. B. f60 -> ff6600)
        if (strlen($hex) === 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        // Extrahiere die RGB-Werte
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        // Passe die Helligkeit an
        [$r, $g, $b] = $adjust_color($r, $g, $b, $factor);

        // Gib den neuen Hex-Code zurück
        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }

    // Falls es sich um RGB oder RGBA handelt
    if (preg_match('/^rgba?\\((\\d+),\\s*(\\d+),\\s*(\\d+)(?:,\\s*([0-9.]+))?\\)$/', $color, $matches)) {
        $r = (int)$matches[1];
        $g = (int)$matches[2];
        $b = (int)$matches[3];
        $a = isset($matches[4]) ? (float)$matches[4] : null;

        // Passe die Helligkeit an
        [$r, $g, $b] = $adjust_color($r, $g, $b, $factor);

        // Gib den neuen Farbwert zurück
        return isset($a)
            ? sprintf('rgba(%d, %d, %d, %.2f)', $r, $g, $b, $a)
            : sprintf('rgb(%d, %d, %d)', $r, $g, $b);
    }

    // Falls das Format unbekannt ist, gib die Originalfarbe zurück
    return $color;
}
