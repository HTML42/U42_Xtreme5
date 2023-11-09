<?php

trait File_load_meta
{
    public function load_meta()
    {
        if (is_string($this->path)) {
            $this->exists = is_file($this->path);
        }
    }
}
