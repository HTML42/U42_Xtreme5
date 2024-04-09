<?php

trait Js_concat {

    public static function concat($files = [], $templates = []) {
        $js = '';
        foreach ($files as $file) {
            if (substr($file, 0, 6) == 'https:' || substr($file, 0, 6) == 'https:') {
                $js .= Curl::get_cached($file, DAY)  . "\n";
            } else {
                $File = File::instance($file);
                $js .= $File->get_content() . "\n";
            }
        }
        if (is_array($templates) && !empty($templates)) {
            $jsTemplates = 'var TEMPLATES = {';
            foreach ($templates as $template) {
                $content = File::instance($template)->get_content();
                $jsTemplates .= '"' . basename($template, '.xtpl') . '":' . json_encode($content) . ',';
            }
            $jsTemplates = rtrim($jsTemplates, ',') . '};';

            $js .= $jsTemplates;
        }
        
        foreach (['/*!
  * Bootstrap v5.3.2 (https://getbootstrap.com/)
  * Copyright 2011-2023 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
  */'] as $search_string) {
            $js = str_replace($search_string, '', $js);
        }
        $js = trim($js);
        
        return $js;
    }

}
