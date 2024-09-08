<?php

class User extends XUser
{
    public static $_CACHE = [
        'instances' => [],
    ];
    public static function init()
    {
    }

    public function __construct($id = 0)
    {
        parent::__construct($id);
        if ($this->id > 0) {
            $this->is_active = in_array('active', $this->groups_names);
            $this->is_admin = in_array('admin', $this->groups_names);
            $this->is_root = in_array('root', $this->groups_names);
        }
    }
    public static function load($id)
    {
        if (!isset(User::$_CACHE['instances'][$id])) {
            User::$_CACHE['instances'][$id] = new User($id);
        }
        return User::$_CACHE['instances'][$id];
    }

    public function edit($attributes = []) {
        $direct_changes = [];
        foreach($attributes as $key => $value) {
            if(in_array($key, ['name', 'email'])) {
                $direct_changes[$key] = $value;
            }
        }
        if(!empty($direct_changes)) {
            DB::update('users', $direct_changes, $this->id);
        }
    }
    
    public function export($fields = null) {
        return self::_export($this, $fields);
    }

    public static function _export($input, $fields = null) {
        $User = null;
        $return = null;
        if(is_array($input) && isset($input['id'])) {
            $User = User::load($input['id']);
        } else if(is_numeric($input) && $input > 0) {
            $User = User::load($input);
        } else if(is_object($input) && get_class($input) == 'User') {
            $User = $input;
        }
        $input = null;
        unset($input);
        //
        if($User && $User->id > 0) {
            $return = [
                'id' => $User->id,
                'name' => $User->name,
                'is_active' => $User->is_active,
                'is_admin' => $User->is_admin,
                'is_root' => $User->is_root,
            ];
        }
        return $return;
    }

}
User::init();
