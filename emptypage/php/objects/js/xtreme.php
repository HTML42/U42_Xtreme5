<?php

Translation::set_lang('de');
$files = array(
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
    File::i('js/x5fixes.js')->path,
    File::i('js/classes/app.class.js')->path,
    File::i('js/classes/controller.class.js')->path,
    File::i('js/classes/page.class.js')->path,
    File::i('js/classes/router.class.js')->path,
    File::i('js/classes/template.class.js')->path,
    File::i('js/classes/translation.class.js')->path,
    File::i('js/classes/form.class.js')->path,
    File::i('js/classes/xgeo.class.js')->path,
    File::i('js/classes/xpopup.class.js')->path,
    File::i('js/classes/xuser.class.js')->path,
    File::i('js/classes/xscroll.class.js')->path,
    File::i('js/classes/xtabs.class.js')->path,
    File::i('js/functions.js')->path,
    File::i('js/project.js')->path,
);
$files = array_merge($files, glob(DIR_PROJECT . 'js/controller/*.controller.js'));
$files[] = File::i('js/bootstrap.js');
$templates = array_merge(File::ls(DIR_X5_TEMPLATES, true, true), File::ls(DIR_PROJECT_TEMPLATES, true, true));
$translations = Translation::get_all();
$Js = new Js($files, $templates, $translations, App::$config['forms']);
App::$mime = 'application/javascript';
App::$encoding = 'UTF-8';

Response::deliver($Js->code);
