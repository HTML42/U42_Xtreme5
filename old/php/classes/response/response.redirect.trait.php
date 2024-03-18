<?php

trait Response_redirect
{
    public static function redirect($url = '/', $status = 200)
    {
        while (ob_get_level() > 1) {
            ob_end_clean();
        }
        Response::header('Location: ' . $url, $status);
        Response::header('Refresh:0; url=' . $url);
        die();
    }
}

