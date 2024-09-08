<?php

$errors = [];
$response = [];
$me = User::load($GLOBALS['ME_id']);
$is_admin = $me->is_admin || $me->is_root;

$users = DB::select('users');

if ($users) {
    foreach ($users as $user_data) {
        $User = User::load($user_data['id']);
        if ($User) {
            $response[] = $is_admin ? json_decode($User->export_js(), true) : $User->export();
        }
    }
} else {
    $errors[] = _('errors.users.not_found');
}

Response::ajax($response, empty($errors) ? 200 : 400, $errors);
