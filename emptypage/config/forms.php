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
    'registration' => [],
];
