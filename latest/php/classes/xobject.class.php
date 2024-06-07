<?php

class XObject
{
    public $id = 0;
    public $db_row = [];

    public static $db_table = null;

    public static $_CACHE = [
        'instances' => []
    ];

    public function __construct($id = 0)
    {
        if (is_numeric($id) && $id > 0) {
            $class = get_called_class();
            if ($class::$db_table) {
                $data = DB::select_first($class::$db_table, $id);
                if ($data) {
                    $this->db_row = $data;
                    $this->id = $data['id'];
                    foreach ($data as $key => $value) {
                        if (property_exists($this, $key)) {
                            $this->$key = $value;
                        }
                    }
                }
            }
        }
    }

    public static function load($id)
    {
        $class = get_called_class();
        if (!isset($class::$_CACHE['instances'][$id])) {
            $class::$_CACHE['instances'][$id] = new $class($id);
        }
        return $class::$_CACHE['instances'][$id];
    }

    public static function create($data)
    {
        $class = get_called_class();
        if ($class::$db_table) {
            $id = DB::insert($class::$db_table, $data);
            return $class::load($id);
        }
        return null;
    }
}
