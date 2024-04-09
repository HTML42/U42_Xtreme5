<?php

$files = array(
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
    DIR_ROOT . 'js/classes/app.class.js',
    DIR_ROOT . 'js/classes/controller.class.js',
    DIR_ROOT . 'js/classes/page.class.js',
    DIR_ROOT . 'js/classes/router.class.js',
    DIR_ROOT . 'js/classes/template.class.js',
    DIR_ROOT . 'js/classes/translation.class.js',
    DIR_ROOT . 'js/functions.js',
);
$files = array_merge($files, glob(DIR_ROOT . 'js/controller/*.controller.js'));
$files[] = DIR_ROOT . 'js/bootstrap.js';
$templates = File::ls(DIR_TEMPLATES, true, true);
$translations = Translation::get_all();
$Js = new Js($files, $templates, $translations);
App::$mime = 'application/javascript';
App::$encoding = 'UTF-8';

Response::deliver($Js->code);
