<?php

$files = array(
    File::i('css/xtreme/mixins.less')->path,
    File::i('css/xtreme/basics.less')->path,
    File::i('css/xtreme/header.less')->path,
    File::i('css/xtreme/xtabs.less')->path,
);
$Css = new Css($files, App::config('xcss', []));

App::$mime = 'text/css';
App::$encoding = 'UTF-8';

Response::deliver($Css->code);
