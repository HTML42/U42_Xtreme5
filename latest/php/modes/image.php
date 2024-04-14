<?php


$img = null;
$img_content = '';
$img_type = 'plain';
$action_clean = str_replace(['.jpg', '.jpeg', '.png', '.gif'], '', App::$action);
$cache_key = json_encode(array(App::$action, $_GET));
//
if(Cache::get($cache_key, DAY))  {
    $img_type = Cache::get($cache_key . 'mime', DAY + 100);
    $img_content = Cache::get($cache_key, DAY);
} else {
    if(isset(App::$images[App::$action])) {
        $img = isset(App::$images[App::$action]) ? App::$images[App::$action] : false;
    }
    if(!$img && isset(App::$images[$action_clean])) {
        $img = isset(App::$images[$action_clean]) ? App::$images[$action_clean] : null;
    }
    //
    if(isset($img) && is_array($img)) {
        if(isset($img['src'])) {
            $File_img = File::i($img['src']);
            if($File_img->exists) {
                $img_content = $File_img->get_content();
                $img_type = @end(explode('/', mime_content_type($File_img->path)));
                if(!isset($img['raw']) || !$img['raw']) {
                    $img_content = Image::x_2_webp($File_img->path);
                    $img_type = 'webp';
                }
            }
        }
    }
    //
    if (isset($_GET['max-width']) && is_numeric($_GET['max-width'])  && $_GET['max-width'] > 0) {
        $img_content = Image::resize_to_max_width($img_content, intval($_GET['max-width']));
    }
    if (isset($_GET['max-height']) && is_numeric($_GET['max-height'])  && $_GET['max-height'] > 0) {
        $img_content = Image::resize_to_max_height($img_content, intval($_GET['max-height']));
    }
    //
    Cache::set($cache_key, $img_content, true);
    Cache::set($cache_key .  'mime', $img_type);
}
//
App::$mime = 'image/' . $img_type;
Response::deliver($img_content);