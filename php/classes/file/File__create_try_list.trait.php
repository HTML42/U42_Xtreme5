<?php

trait File__create_try_list
{
        public static function _create_try_list($filename, $extensions = array(), $prepathes = false)
        {
                $list        = array();
                $base_pathes = array(DIR_ROOT, DIR_PHP);
                //
                if (!in_array('', $extensions)) {
                        array_push($extensions, '');
                }
                if (is_string($prepathes) && strlen($prepathes) > 0) {
                        $prepathes = array($prepathes);
                }
                if (!is_array($prepathes)) {
                        $prepathes = array('');
                }
                if (!in_array('', $prepathes)) {
                        array_push($prepathes, '');
                }
                foreach ($base_pathes as $base_path) {
                        foreach ($extensions as $extension) {
                                if (strlen($extension) > 0 && !strstr($extension, '.')) {
                                        $extension = '.' . $extension;
                                }
                                if (is_array($prepathes)) {
                                        foreach ($prepathes as $prepath) {
                                                array_push($list, $base_path . $prepath . $filename . $extension);
                                        }
                                }
                        }
                }
                var_dump($list);
                return $list;
        }
}
