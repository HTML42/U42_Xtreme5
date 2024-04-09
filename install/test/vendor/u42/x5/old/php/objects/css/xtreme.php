<?php

$files = array(
    DIR_ROOT . 'css/xtreme/mixins.less',
    DIR_ROOT . 'css/xtreme/basics.less',
    DIR_ROOT . 'css/xtreme/header.less',
);
$Css = new Css($files, App::config('xcss', []));

App::$mime = 'text/css';
App::$encoding = 'UTF-8';

Response::deliver($Css->code);
