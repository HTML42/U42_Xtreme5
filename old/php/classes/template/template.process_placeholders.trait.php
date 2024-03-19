<?php

trait Template_process_placeholders {
    public function process_placeholders($content, $placeholders) {
        foreach ($placeholders as $key => $value) {
            $content = str_replace('{{' . $key . '}}', $value, $content);
        }
        return $content;
    }
}
