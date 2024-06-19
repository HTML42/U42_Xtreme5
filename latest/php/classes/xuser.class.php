<?php

class XUser extends XObject {
    public static $db_table = 'users';
    public $name, $email;
    public $insert_date, $update_date, $delete_date;
    public $is_admin, $is_root, $is_active, $is_login;
    public $groups = [];
    public $groups_names = [];

    public static $_CACHE = [
        'instances' => [],
        'name_to_id' => [],
        'email_to_id' => []
    ];

    public function __construct($id = 0) {
        parent::__construct($id);
        if ($this->id > 0) {
            $this->is_admin = $this->db_row['is_admin'] ?? false;
            $this->is_root = $this->db_row['is_root'] ?? false;
            $this->is_active = !$this->db_row['delete_date'];
            $this->is_login = isset($GLOBALS['ME_id']) && $GLOBALS['ME_id'] === $this->id;
            $this->groups = DB::select('users_groups', ['users_id' => $this->id], false);
            foreach($this->groups as $index => $groups_assign) {
                $this->groups[$index] = DB::select_first('groups', $groups_assign['groups_id'], false);
            }
            foreach($this->groups as $group) {
                array_push($this->groups_names, $group['name']);
            }
        }
    }

    public static function load_by_name($name) {
        if (!isset(self::$_CACHE['name_to_id'][$name])) {
            $user = DB::select('users', ['name' => $name], false, true);
            if ($user) {
                self::$_CACHE['name_to_id'][$name] = $user['id'];
            } else {
                return null;
            }
        }
        return self::load(self::$_CACHE['name_to_id'][$name]);
    }

    public static function load_by_email($email) {
        if (!isset(self::$_CACHE['email_to_id'][$email])) {
            $user = DB::select('users', ['email' => $email], false, true);
            if ($user) {
                self::$_CACHE['email_to_id'][$email] = $user['id'];
            } else {
                return null;
            }
        }
        return self::load(self::$_CACHE['email_to_id'][$email]);
    }

    public function login() {
        if ($this->is_active) {
            $cookie_data = base64_encode(json_encode([
                'userid' => $this->id,
                'fingerprint' => fingerprint()
            ]));
            setcookie('X5_login', $cookie_data, time() + (86400 * 30), "/");
            return true;
        }
        return false;
    }

    public function export_js() {
        $user_data = @(array) $this;
        unset($user_data['db_row']);
        unset($user_data['password']);
        return json_encode($user_data);
    }
}
