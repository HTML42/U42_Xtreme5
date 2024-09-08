<?php
App::$config['db'] = [
    'users' => [
        '_' => [
            'default' => [
                ['id' => 1, 'name' => 'Admin', 'email' => 'admin.x5@html42.de', 'password' => '001FEEBDC3496C1B787B561D299074223FBF1DA1E971C53B2DDFD5987A3A10713C43E7D4'],
            ],
        ],
        'name' => ['type' => 'string'],
        'email' => ['type' => 'email'],
        'password' => ['type' => 'password'],
    ],
    'groups' => [
        '_' => [
            'default' => [
                ['name' => 'active', 'rank' => 10],
                ['name' => 'inactive', 'rank' => 1],
                ['name' => 'deleted', 'rank' => 1],
                ['name' => 'admin', 'rank' => 90],
                ['name' => 'root', 'rank' => 99],
            ]
        ],
        'name' => ['type' => 'string'],
        'rank' => ['type' => 'int', 'default' => 50],
    ],
    'users_groups' => [
        '_' => [
            'default' => [
                ['users_id' => 1, 'groups_id' => 1],
                ['users_id' => 1, 'groups_id' => 4],
                ['users_id' => 1, 'groups_id' => 5],
            ],
        ],
        'users_id' => ['type' => 'int'],
        'groups_id' => ['type' => 'int'],
    ],
];