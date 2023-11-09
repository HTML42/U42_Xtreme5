<?php

class IndexController {
    public static function default() {
        Response::redirect(BASEURL . 'index/index');
        return null;
    }
}
