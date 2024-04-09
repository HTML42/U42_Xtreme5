<?php

$files = array(
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
    File::i('js/classes/app.class.js'),
    File::i('js/classes/controller.class.js'),
    File::i('js/classes/page.class.js'),
    File::i('js/classes/router.class.js'),
    File::i('js/classes/template.class.js'),
    File::i('js/classes/translation.class.js'),
    File::i('js/functions.js'),
);
$files = array_merge($files, glob(DIR_PROJECT . 'js/controller/*.controller.js'));
$files[] = File::i('js/bootstrap.js');
$templates = array_merge(File::ls(DIR_X5_TEMPLATES, true, true), File::ls(DIR_PROJECT_TEMPLATES, true, true));
$translations = Translation::get_all();
$Js = new Js($files, $templates, $translations);
App::$mime = 'application/javascript';
App::$encoding = 'UTF-8';

Response::deliver($Js->code);
