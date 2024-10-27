<?php

$errors = [];
$response = [];

// Load form configuration for validation
$form_config = App::$config['forms']['registration'];
$username_min_length = $form_config['username']['min-length'] ?? 2;
$password_min_length = $form_config['password']['min-length'] ?? 4;

// Retrieve input values
$username = Request::param('username');
$email = Request::param('email');
$password = Request::param('password');
$password2 = Request::param('password2');
$captcha_input = Request::param('captcha');

// Validate required fields
if (empty($username) || strlen($username) < $username_min_length) {
    $errors[] = _('errors.users.invalid_username');
}
if (empty($email)) {
    $errors[] = _('errors.users.missing_email');
}
if (empty($password) || strlen($password) < $password_min_length) {
    $errors[] = sprintf(_('errors.users.password_too_short'), $password_min_length);
}
if ($password !== $password2) {
    $errors[] = _('errors.users.passwords_do_not_match');
}

// Validate captcha
if (strtoupper($captcha_input) !== $_SESSION['captcha_code']) {
    $errors[] = _('errors.captcha.invalid');
}

// Check for unique email
if (empty($errors)) {
    $existing_user = DB::select_first('users', ['email' => $email]);
    if ($existing_user) {
        $errors[] = _('errors.users.email_exists');
    }
}

// Create user if no errors
if (empty($errors)) {
    $user_data = [
        'name' => $username,
        'email' => $email,
        'password' => xhash($password),
    ];

    $new_user_id = DB::insert('users', $user_data);
    if ($new_user_id) {
        $response['success'] = true;
        $response['user_id'] = $new_user_id;
    } else {
        $errors[] = _('errors.users.creation_failed');
    }
}

// Send JSON response
Response::ajax($response, empty($errors) ? 200 : 400, $errors);
