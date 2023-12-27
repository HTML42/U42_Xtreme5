<?php

$font_size = 14;
$color_main = '#44D';
$color_secondary = '#3C6';
$distance = 20;
$header_size = 60;
$amplifier = 0.2;
$page_width = 1200;
//Breakpoints - Description: 0 -> 570 = Small ; 571 - 1199 = Medium ; 1200 - XX = Big
$xbp_small = 570;
$xbp_big = 1200;

App::$config['xcss'] = [
    //#Do not Change
    'amplifier' => ($amplifier * 100) . '%',
    'page_width' => $page_width . 'px',
    //#Do not change
    'font_size_normal' => $font_size . 'px',
    'font_size_small' => _amplifier($font_size, -$amplifier) . 'px',
    'font_size_tiny' => _amplifier($font_size, -$amplifier * 2) . 'px',
    'font_size_big' => _amplifier($font_size, $amplifier) . 'px',
    'font_size_huge' => _amplifier($font_size, $amplifier * 2) . 'px',
    //#Do not Change
    'distance_normal' => $distance . 'px',
    'distance_small' => _amplifier($distance, -$amplifier) . 'px',
    'distance_tiny' => _amplifier($distance, -$amplifier * 2) . 'px',
    'distance_big' => _amplifier($distance, $amplifier) . 'px',
    'distance_huge' => _amplifier($distance, $amplifier * 2) . 'px',
    //#Change maybe
    'color_main_normal' => $color_main,
    'color_main_dark' => '#11A', //ToDo
    'color_secondary_normal' => $color_secondary,
    'color_secondary_dark' => '#4B7', // ToDo
    'color_grey_normal' => 'rgba(0,0,0,0.2)',
    'color_grey_dark' => 'rgba(0,0,0,0.3)',
    'color_grey_darker' => 'rgba(0,0,0,0.4)',
    'color_grey_light' => 'rgba(0,0,0,0.1)',
    'color_grey_lighter' => 'rgba(0,0,0,0.05)',
    //#Change for Project
    'header_height' => $header_size . 'px',
    //#Do not Change
    'xbp_small_max' => $xbp_small . 'px',
    'xbp_big_min' => $xbp_big . 'px',
    'xbp_small' => '~"(max-width: ' . $xbp_small . 'px)"',
    'xbp_medium' => '~"(min-width: ' . ($xbp_small + 1) . 'px) and (max-width:' . ($xbp_big - 1) . 'px)"',
    'xbp_big' => '~"(min-width: ' . $xbp_big . 'px)"',
    'xbp_non_small' => '~"(min-width: ' . ($xbp_small + 1) . 'px)"',
    'xbp_non_big' => '~"(max-width: ' . ($xbp_big - 1) . 'px)"',
];

function _amplifier($value, $amp = null) {
    if (is_numeric($amp)) {
        $value = @intval($value);
        $value = $value * (1 + $amp);
        $value = round($value, 1);
        return $value;
    }
    return null;
}
