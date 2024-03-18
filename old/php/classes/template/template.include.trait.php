<?php

trait Template_include {
    public function include($template, $placeholders = []) {
        ob_start();
        $content = file_get_contents($template);
        $content = $this->process_laceholders($content, $placeholders);
        echo $content;
        return ob_get_clean();
    }
}
