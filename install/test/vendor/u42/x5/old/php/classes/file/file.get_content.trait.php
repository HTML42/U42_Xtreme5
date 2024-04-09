<?php

trait File_get_content
{
        public function get_content()
        {
                if ($this->exists) {
                        if ($this->ext() == 'php') {
                                ob_start();
                                include $this->path;
                                return ob_get_clean();
                        } else {
                                return file_get_contents($this->path);
                        }
                } else {
                        return '';
                }
        }
}
