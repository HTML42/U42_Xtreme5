<?php

// Pfad zu den JavaScript-Dateien
$files = array(
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
    DIR_ROOT . 'js/classes/app.class.js',
    DIR_ROOT . 'js/classes/controller.class.js',
    DIR_ROOT . 'js/classes/template.class.js',
    DIR_ROOT . 'js/controller/index.controller.js',
    DIR_ROOT . 'js/bootstrap.js',
);
$js = '';

// Durchlaufe alle Dateien und füge ihren Inhalt zusammen
foreach ($files as $file) {
    if(substr($file, 0, 6) == 'https:' || substr($file, 0, 6) == 'https:') {
        $js .= Curl::get_cached($file, DAY)  . "\n";
    } else {
        $File = File::instance($file);
        $js .= $File->get_content() . "\n";
    }
}

$jsTemplates = 'var TEMPLATES = {';
foreach (File::ls(DIR_TEMPLATES) as $template) {
    $content = File::instance(DIR_TEMPLATES . $template)->get_content();
    $jsTemplates .= '"' . basename($template, '.xtpl') . '":' . json_encode($content) . ',';
}
$jsTemplates = rtrim($jsTemplates, ',') . '};';

$js .= $jsTemplates;

// Setze den MIME-Typ und Kodierung für die Antwort
App::$mime = 'application/javascript';
App::$encoding = 'UTF-8';

// Sende den zusammengefügten JavaScript-Inhalt
Response::deliver($js);
