<?php

class DB
{
    public static $dir = '_db/';
    public static $dir_tables = '_db/tables/';
    public static $dir_cache = '_db/cache/';
    public static $dir_meta = '_db/meta/';
    public static $table_meta_defaults = [
        'id' => 1,
        'amount' => 0,
    ];

    public static $_CACHE = [
        'tables' => null,
        'table' => [],
    ];

    public static function init()
    {
        self::$dir = DIR_PROJECT . '_db/';
        self::$dir_tables = self::$dir . 'tables/';
        self::$dir_cache = self::$dir . 'cache/';
        self::$dir_meta = self::$dir . 'meta/';
        foreach ([self::$dir, self::$dir_tables, self::$dir_cache, self::$dir_meta] as $d) {
            if (!is_dir($d)) {
                @mkdir($d);
            }
        }
        App::$config['db'] = isset(App::$config['db']) && is_array(App::$config['db']) ? App::$config['db'] : [];
        foreach (App::$config['db'] as $table => $columns) {
            $table = trim(strtolower($table));
            $table_file = self::$dir_tables . $table . '.json';
            $meta_file = self::$dir_meta . $table . '.json';
            if (!file_exists($meta_file)) {
                file_put_contents($meta_file, json_encode(self::$table_meta_defaults));
            }
            if (!file_exists($table_file)) {
                file_put_contents($table_file, json_encode([]));
                self::$_CACHE['tables'] = null;
                usleep(666);
                if (isset($columns['_']['default']) && is_array($columns['_']['default'])) {
                    foreach ($columns['_']['default'] as $default_entry) {
                        self::insert($table, $default_entry);
                    }
                }
            }
        }
    }
    public static function get_tables()
    {
        if (is_null(self::$_CACHE['tables'])) {
            self::$_CACHE['tables'] = File::ls(self::$dir_tables, false, true);
            foreach (self::$_CACHE['tables'] as $i => $tablename) {
                self::$_CACHE['tables'][$i] = strtolower(str_replace('.json', '', $tablename));
            }
        }
        return self::$_CACHE['tables'];
    }
    public static function get_table($tablename)
    {
        $tablename = self::_is_valid_tablename($tablename);
        if (!$tablename) {
            return null;
        }
        //
        if (isset(self::$_CACHE['table'][$tablename]) && is_array(self::$_CACHE['table'][$tablename]) && !empty(self::$_CACHE['table'][$tablename])) {
            return self::$_CACHE['table'][$tablename];
        }
        //
        $File_table = File::instance(self::$dir_tables . $tablename . '.json');
        if (!$File_table->exists) {
            return false;
        }
        //
        $tabledata = [
            'meta' => self::get_table_meta($tablename),
            'data' => $File_table->get_json(),
        ];
        self::$_CACHE['table'][$tablename] = $tabledata;
        return $tabledata;
    }
    public static function get_table_meta($tablename)
    {
        $tablename = self::_is_valid_tablename($tablename);
        if (!$tablename) {
            return null;
        }
        //
        $File_table_meta = File::instance(self::$dir_meta . $tablename . '.json');
        if (!$File_table_meta->exists) {
            return self::$table_meta_defaults;
        }
        //
        return $File_table_meta->get_json();
    }
    public static function _is_valid_tablename($tablename)
    {
        if (!is_string($tablename)) {
            return null;
        }
        $tablename = trim(strtolower($tablename));
        if (empty($tablename)) {
            return null;
        }
        if (!in_array($tablename, self::get_tables())) {
            return false;
        }
        return $tablename;
    }
    public static function insert($table, $data)
    {
        $table = self::_is_valid_tablename($table);
        if (!$table) {
            return false;
        }
        $meta_file = self::$dir_meta . $table . '.json';
        $File_meta = File::instance($meta_file);
        $meta = $File_meta->exists ? $File_meta->get_json() : self::$table_meta_defaults;
        $data['id'] = $meta['id']++;
        $data['insert_date'] = time();
        $data['update_date'] = null;
        $data['delete_date'] = null;
        //
        $table_file = self::$dir_tables . $table . '.json';
        $File_table = File::instance($table_file);
        $table_data = $File_table->exists ? $File_table->get_json() : [];
        $table_data[] = $data;
        $meta['amount'] = count($table_data);
        //
        file_put_contents($File_table->path, json_encode($table_data));
        self::$_CACHE['table'][$table] = null;
        file_put_contents($File_meta->path, json_encode($meta));
        usleep(999);
        return $data['id'];
    }

    public static function update($table, $data, $id_or_condition)
    {
        $table = self::_is_valid_tablename($table);
        if (!$table) {
            return false;
        }
        $table_file = self::$dir_tables . $table . '.json';
        $File_table = File::instance($table_file);
        $table_data = $File_table->exists ? $File_table->get_json() : [];
        $updated = false;
        foreach ($table_data as &$row) {
            if (
                (is_int($id_or_condition) && $row['id'] == $id_or_condition) ||
                (is_array($id_or_condition) && self::matches_condition($row, $id_or_condition))
            ) {
                $row = array_merge($row, $data);
                $row['update_date'] = time();
                $updated = true;
            }
        }
        if ($updated) {
            file_put_contents($File_table->path, json_encode($table_data));
            self::$_CACHE['table'][$table] = null;
        }
        return $updated;
    }

    public static function delete($table, $id_or_condition, $soft = true)
    {
        $table = self::_is_valid_tablename($table);
        if (!$table) {
            return false;
        }
        $table_file = self::$dir_tables . $table . '.json';
        $File_table = File::instance($table_file);
        $table_data = $File_table->exists ? $File_table->get_json() : [];
        $deleted = false;
        foreach ($table_data as &$row) {
            if (
                (is_int($id_or_condition) && $row['id'] == $id_or_condition) ||
                (is_array($id_or_condition) && self::matches_condition($row, $id_or_condition))
            ) {
                if ($soft) {
                    $row['delete_date'] = time();
                } else {
                    $row = null;
                }
                $deleted = true;
            }
        }
        if (!$soft) {
            $table_data = array_filter($table_data);
        }
        if ($deleted) {
            file_put_contents($File_table->path, json_encode($table_data));
            // Update the meta amount
            $meta_file = self::$dir_meta . $table . '.json';
            $File_meta = File::instance($meta_file);
            $meta = $File_meta->exists ? $File_meta->get_json() : self::$table_meta_defaults;
            $meta['amount'] = count($table_data);
            file_put_contents($File_meta->path, json_encode($meta));
            self::$_CACHE['table'][$table] = null;
        }
        return $deleted;
    }
    public static function select($table, $condition = [], $with_relations = true, $only_first = false)
    {
        $table = self::_is_valid_tablename($table);
        if (!$table) {
            return false;
        }
        $table_data = self::get_table($table);
        if (!$table_data) {
            return false;
        }
        $rows = $table_data['data'];
        if (is_numeric($condition)) {
            $condition = ['id' => intval($condition)];
        }
        if(!isset($condition['delete_date'])) {
            $condition['delete_date'] = null;
        }
        $results = [];
        foreach ($rows as $row) {
            if (self::matches_condition($row, $condition)) {
                $results[] = $row;
                if ($only_first) {
                    break;
                }
            }
        }
        if ($with_relations && isset(App::$config['db'][$table]['_']['relations'])) {
            foreach ($results as &$row) {
                foreach (App::$config['db'][$table]['_']['relations'] as $field => $relation) {
                    if (isset($row[$field])) {
                        list($related_table, $related_field) = $relation;
                        $related_data = self::select($related_table, [$related_field => $row[$field]]);
                        $row[$related_table] = $related_data;
                    }
                }
            }
        }
        return $only_first ? (isset($results[0]) ? $results[0] : null) : $results;
    }

    public static function select_first($table, $condition, $with_relations = true)
    {
        return self::select($table, $condition, $with_relations, true);
    }

    public static function matches_condition($row, $condition)
    {
        foreach ($condition as $key => $value) {
            $operator = '=';
            if (is_array($value) && isset($value['operator'])) {
                $operator = strtolower($value['operator']);
                $value = $value[0];
            }
            if (!isset($row[$key]) && !is_null($row[$key])) {
                return false;
            }
            $row_value = $row[$key];
            switch ($operator) {
                case 'like':
                case 'LIKE':
                    if (strtolower($row_value) != strtolower($value)) {
                        return false;
                    }
                    break;
                case '>':
                    if ($row_value <= $value) {
                        return false;
                    }
                    break;
                case '<':
                    if ($row_value >= $value) {
                        return false;
                    }
                    break;
                case '>=':
                    if ($row_value < $value) {
                        return false;
                    }
                    break;
                case '<=':
                    if ($row_value > $value) {
                        return false;
                    }
                    break;
                case '!=':
                case '<>':
                    if ($row_value == $value) {
                        return false;
                    }
                    break;
                case 'in':
                case 'IN':
                    if (!in_array($row_value, (array) $value)) {
                        return false;
                    }
                    break;
                case '=':
                default:
                    if ($row_value != $value) {
                        return false;
                    }
                    break;
            }
        }
        return true;
    }

}

DB::init();
