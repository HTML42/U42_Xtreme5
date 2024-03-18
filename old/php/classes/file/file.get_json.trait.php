<?php

trait File_get_json {
        public function get_json() {
                if ($this->exists) {
                    $content = $this->get_content();
        
                    //HJSON Support
                    $content = preg_replace('|\/\*.*\*\/|U', '', $content);
        
                    return @json_decode($content, true);
                } else {
                    return null;
                }
            }
}
