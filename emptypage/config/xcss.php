<?php
/**
 * XCSS config
 * Main colors: Dark blue (#2C3E50), Deep black (#1C1C1C)
 * Accent colors: Neon green (#2ECC71), Silver (#95A5A6)
 */

// Base sizes
$font_size   = 14;
$distance    = 20;
$page_width  = 1200;

$header_size = 100;
$footer_size = 100;
$logo_margin = 10;

$amplifier   = 0.2;

// Breakpoints (0..570 small, 571..1199 medium, 1200.. big)
$xbp_small = 570;
$xbp_big   = 1200;

// Base colors
$color_main      = '#2C3E50';
$color_secondary = '#2ECC71';

// How strong variants should be
$color_variant_steps = [
    'light'   => 0.20,
    'lighter' => 0.40,
    'dark'    => -0.20,
    'darker'  => -0.40,
];

// Generate variants for main + secondary
$main_variants      = xcss_color_variants($color_main, $color_variant_steps);
$secondary_variants = xcss_color_variants($color_secondary, $color_variant_steps);

App::$config['xcss'] = array_merge([
    // Do not change
    'amplifier'  => ($amplifier * 100) . '%',
    'page_width' => $page_width . 'px',

    // Typography
    'font_size_normal' => $font_size . 'px',
    'font_size_small'  => _amplifier($font_size, -$amplifier) . 'px',
    'font_size_tiny'   => _amplifier($font_size, -$amplifier * 2) . 'px',
    'font_size_big'    => _amplifier($font_size,  $amplifier) . 'px',
    'font_size_huge'   => _amplifier($font_size,  $amplifier * 2) . 'px',

    // Spacing
    'distance_normal' => $distance . 'px',
    'distance_small'  => ($distance / 2) . 'px',
    'distance_tiny'   => ($distance / 4) . 'px',
    'distance_big'    => ($distance * 2) . 'px',
    'distance_huge'   => ($distance * 4) . 'px',

    // Greys
    'color_grey_normal'  => 'rgba(0,0,0,0.2)',
    'color_grey_dark'    => 'rgba(0,0,0,0.3)',
    'color_grey_darker'  => 'rgba(0,0,0,0.4)',
    'color_grey_light'   => 'rgba(0,0,0,0.1)',
    'color_grey_lighter' => 'rgba(0,0,0,0.05)',

    // Project sizing
    'header_height'        => $header_size . 'px',
    'header_height_scroll' => '50px',
    'logo_size'            => '220px',
    'logo_margin'          => $logo_margin . 'px',
    'submenu_height'       => '40px',
    'footer_min_height'    => $footer_size . 'px',

    // Breakpoints
    'xbp_small_max' => $xbp_small . 'px',
    'xbp_big_min'   => $xbp_big . 'px',
    'xbp_small'     => '~"(max-width: ' . $xbp_small . 'px)"',
    'xbp_medium'    => '~"(min-width: ' . ($xbp_small + 1) . 'px) and (max-width:' . ($xbp_big - 1) . 'px)"',
    'xbp_big'       => '~"(min-width: ' . $xbp_big . 'px)"',
    'xbp_non_small' => '~"(min-width: ' . ($xbp_small + 1) . 'px)"',
    'xbp_non_big'   => '~"(max-width: ' . ($xbp_big - 1) . 'px)"',
], [
    // Colors: main
    'color_main_normal'  => $color_main,
    'color_main_light'   => $main_variants['light'],
    'color_main_lighter' => $main_variants['lighter'],
    'color_main_dark'    => $main_variants['dark'],
    'color_main_darker'  => $main_variants['darker'],

    // Colors: secondary
    'color_secondary_normal'  => $color_secondary,
    'color_secondary_light'   => $secondary_variants['light'],
    'color_secondary_lighter' => $secondary_variants['lighter'],
    'color_secondary_dark'    => $secondary_variants['dark'],
    'color_secondary_darker'  => $secondary_variants['darker'],
]);

/**
 * Amplify a numeric value by a percentage factor (e.g. 0.2 => +20%).
 */
function _amplifier($value, $amp = null) {
    if (!is_numeric($value) || !is_numeric($amp)) {
        return null;
    }

    $value = (float)$value;
    $amp   = (float)$amp;

    $value = $value * (1.0 + $amp);
    return round($value, 1);
}

/**
 * Create light/lighter/dark/darker variants from a base hex color.
 *
 * @param string $hex   Base color (#RRGGBB or #RGB)
 * @param array  $steps Example: ['light'=>0.2,'lighter'=>0.4,'dark'=>-0.2,'darker'=>-0.4]
 * @return array ['light'=>'#...','lighter'=>'#...','dark'=>'#...','darker'=>'#...']
 */
function xcss_color_variants($hex, array $steps) {
    $out = [];
    foreach ($steps as $name => $percent) {
        $out[$name] = xcss_adjust_color($hex, (float)$percent);
    }
    return $out;
}

/**
 * Lighten/Darken a hex color by percent.
 *  +0.2 => 20% lighter (towards white)
 *  -0.2 => 20% darker (towards black)
 */
function xcss_adjust_color($hex, $percent) {
    $rgb = xcss_hex_to_rgb($hex);
    if ($rgb === null) {
        return $hex;
    }

    $percent = max(-1.0, min(1.0, (float)$percent));

    $r = $rgb['r'];
    $g = $rgb['g'];
    $b = $rgb['b'];

    if ($percent >= 0) {
        // Move towards white
        $r = (int)round($r + (255 - $r) * $percent);
        $g = (int)round($g + (255 - $g) * $percent);
        $b = (int)round($b + (255 - $b) * $percent);
    } else {
        // Move towards black
        $factor = 1.0 + $percent; // percent is negative
        $r = (int)round($r * $factor);
        $g = (int)round($g * $factor);
        $b = (int)round($b * $factor);
    }

    return xcss_rgb_to_hex($r, $g, $b);
}

/**
 * @return array|null ['r'=>int,'g'=>int,'b'=>int]
 */
function xcss_hex_to_rgb($hex) {
    if (!is_string($hex)) {
        return null;
    }

    $hex = trim($hex);
    if (strpos($hex, '#') === 0) {
        $hex = substr($hex, 1);
    }

    if (strlen($hex) === 3) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }

    if (!preg_match('/^[0-9a-fA-F]{6}$/', $hex)) {
        return null;
    }

    return [
        'r' => hexdec(substr($hex, 0, 2)),
        'g' => hexdec(substr($hex, 2, 2)),
        'b' => hexdec(substr($hex, 4, 2)),
    ];
}

function xcss_rgb_to_hex($r, $g, $b) {
    $r = max(0, min(255, (int)$r));
    $g = max(0, min(255, (int)$g));
    $b = max(0, min(255, (int)$b));

    return sprintf('#%02X%02X%02X', $r, $g, $b);
}
