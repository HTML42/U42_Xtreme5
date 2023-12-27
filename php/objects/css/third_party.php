<?php

$files = array(
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css'
);
$Css = new Css($files);

App::$mime = 'text/css';
App::$encoding = 'UTF-8';

Response::deliver($Css->code);
