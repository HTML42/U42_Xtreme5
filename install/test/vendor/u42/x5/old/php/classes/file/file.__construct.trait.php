<?php

trait File___construct
{
        public function __construct($file_path = null)
        {
                if (is_string($file_path)) {
                        $this->path = $file_path;
                        $this->load_meta();
                }
        }
}