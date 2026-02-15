<?php

$files = array(
    File::i('css/xtreme/mixins.less')->path,
    File::i('css/basics.less')->path,
    File::i('css/header.less')->path,
    File::i('css/footer.less')->path,
    File::i('css/xtreme/xbutton.less')->path,
    File::i('css/xtreme/xform.less')->path,
    File::i('css/xtreme/xpopup.less')->path,
    File::i('css/xtreme/xgeo.less')->path,
    File::i('css/xtabs.less')->path,
    File::i('css/pages.less')->path,
    File::i('css/forms.less')->path,
    File::i('css/fonts.less')->path,
    File::i('css/print.less')->path,
);
$Css = new Css($files, App::config('xcss', []));

App::$mime = 'text/css';
App::$encoding = 'UTF-8';

Response::deliver($Css->code);
