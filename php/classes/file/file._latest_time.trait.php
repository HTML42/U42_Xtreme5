<?php

trait File__latest_time {

    public static function _latest_time($files = []) {
        $latest = -1;
        foreach ($files as $filepath) {
            if (!is_url($filepath) && is_file($filepath)) {
                $latest = max(array($latest, filemtime($filepath)));
            }
        }
        return $latest;
    }

}
