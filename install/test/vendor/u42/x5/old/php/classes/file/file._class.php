<?php

class File
{

    public $path = null;
    public $exists = false;
    private static $_CACHE = array('instances' => array(), 'filenames' => array(), 'filefolders' => array());

    use File___construct;
    use File_instance;
    use File_i;
    use File_instance_of_first_existing_file;
    use File_name;
    use File_folder;
    use File_ext;
    use File_load_meta;
    use File_get_json;
    use File_get_content;
    use File__create_folder;
    use File__save_file;
    use File_ls;
    use File_path;
    use File_normalize_folder;
    use File__create_try_list;
    use File__latest_time;
}
