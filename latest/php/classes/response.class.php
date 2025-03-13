<?php

class Response
{
    public static function header($set = null, $status = null)
    {
        if (is_string($set)) {
            $set = trim($set);
            if (!headers_sent()) {
                if (is_int($status)) {
                    header($set, true, $status);
                } else {
                    header($set);
                }
            }
        }
    }
    public static function redirect($url = '/', $status = 200)
    {
        while (ob_get_level() > 1) {
            ob_end_clean();
        }
        Response::header('Location: ' . $url, $status);
        Response::header('Refresh:0; url=' . $url);
        die();
    }
    public static function deliver($content)
    {
        $current_output = trim(ob_get_clean());
        if (strlen($current_output) > 0) {
            $content = $current_output . $content;
        }

        if (ENV != 'dev') {
            self::header('Cache-Control: public');
            self::header('Pragma: cache');
            self::header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + (HOUR * 6)));
        }

        self::header('Content-length: ' . strlen($content));
        self::header('Content-Type: ' . App::$mime . '; charset=' . App::$encoding, 200);

        echo $content;
    }
    public static function ajax($response, $status, $errors = [], $success = true)
    {
        if (!is_int($status)) {
            $status = 500;
        }
        if (!is_array($errors)) {
            $errors = [];
        }

        $output = [
            'response' => $response,
            'status' => $status,
            'errors' => $errors,
            'success' => $success
        ];

        self::header('Content-Type: application/json; charset=' . App::$encoding, 200);
        echo json_encode($output);
    }
}

