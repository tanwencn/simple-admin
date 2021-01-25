<?php

return [

    'router' => [
        'prefix' => 'admin',
        'namespaces' => 'App\\Admin\\Controllers',
        'routes' => app_path('Admin/routes.php'),
        'index' => 'admin.dashboard',
        'middleware' => [
            Tanwencn\Admin\Http\Middleware\FirstLogin::class,
            Tanwencn\Admin\Http\Middleware\Pjax::class,
            App\Admin\Middleware\Menu::class
        ]
    ],

    'elfinder' => [
        'default' => [
            'process' => 'Tanwencn\Admin\FinderProcess',
            'options' => [
                'disk' => 'public',
                'uploadOverwrite' => false,
                'uploadMaxSize' => '3M',
                'onlyMimes' => ['image'],
                'uploadOrder' => ['allow'],
                'path' => 'images',
                'alias' => 'Gallery'
            ]
        ]
    ],

    'supervisor' => [
        'resolvers' => [
            'Operation Record' => [
                'mode' => 'database',
                'table' => 'operation_logs',
                'connection' => 'mysql',
                'primaryKey' => 'id',
                'order' => 'desc',
                'render' => [
                    'body' => [
                        'content' => 'click'
                    ]
                ]
            ]
        ],
        'view' => ['Operation Record']
    ],

    'auth' => [
        'login' => [
            'controller' => 'App\Admin\Controllers\LoginController',
            'throttle' => '60,15'
            //'username' => 'name'
        ],
        'guards' => [
            'admin' => [
                'driver' => 'session',
                'provider' => 'admin',
            ],
        ],
        'providers' => [
            'admin' => [
                'driver' => 'eloquent',
                'model' => Tanwencn\Admin\Database\Eloquent\User::class
            ],
        ]
    ],

    'logger' => [
        'method' => ['post', 'put', 'patch', 'delete'],
        'except' => ['password', 'password_confirmation']
    ]
];
