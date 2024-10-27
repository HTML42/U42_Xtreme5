<?php
$formitem_Default = [
    'type' => 'text',
    'min-length' => null,
    'max-length' => null,
    'validation' => null,
    'required' => false,
    'label' => null,
];

$formparts = [];
$formparts['userbasics'] = [
    'username' => array_merge($formitem_Default, [
        'label' => 'forms.labels.username',
        'min-length' => 2,
    ]),
    'password' => array_merge($formitem_Default, [
        'label' => 'forms.labels.password',
        'type' => 'password',
        'min-length' => 4,
    ]),
];
$password2_field = $formparts['userbasics']['password'];
$password2_field['label'] = 'forms.labels.password2';

App::$config['forms'] = [
    'login' => array_merge($formparts['userbasics'], [
        '_' => [
            'ajax' => BASEURL . 'users/login',
            'success' => 'callback_login_success',
        ],
        'submitrow' => [
            'submit' => 'forms.labels.login'
        ],
    ]),
    'registration' => [
        'username' => $formparts['userbasics']['username'],
        'email' => array_merge($formitem_Default, [
            'label' => 'forms.labels.email',
            'type' => 'email',
            'required' => true,
        ]),
        'password' => $formparts['userbasics']['password'],
        'password2' => $password2_field,
        'captcha' => array_merge($formitem_Default, [
            'label' => 'forms.labels.captcha',
            'type' => 'captcha',
            'required' => true,
        ]),
        '_' => [
            'ajax' => BASEURL . 'users/registration',
            'success' => 'callback_user_registration_success',
        ],
        'submitrow' => [
            'submit' => 'forms.labels.submit'
        ],
    ],
];
