<?php

class Request
{
    public static $url_path_to_script, $requested_path, $requested_path_array, $requested_clean_path, $requested_clean_path_array;
    use Request_init;
}
