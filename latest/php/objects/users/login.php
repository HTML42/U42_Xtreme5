<?php
$errors = [];
$response = null;
$username = Request::param('username');
$password = Request::param('password');

$db_check = DB::select_first('users', [
    'name' => [$username, 'operator' => 'LIKE'],
    'password' => xhash($password),
]);

if($db_check) {
    if(isset($db_check['id']) && $db_check['id'] > 0) {
        if(!$db_check['delete_date']) {
            $User = XUser::load($db_check['id']);
            $User->login();
            $response = [
                'id' => $db_check['id'],
                'name' => $db_check['name'],
                'insert_date' => $db_check['insert_date'],
                'update_date' => $db_check['update_date'],
            ];
        } else {
            $errors[] = _('errors.login.deleted');
        }
    } else {
        $errors[] = _('errors.login.id');
    }
} else {
    $errors[] = _('errors.login.notfound');
}

Response::ajax($response, empty($errors) ? 200 : 400, $errors);