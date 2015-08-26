<?php

return [

    // templating configuration
    'templating' => [
        'paths' => [
            __DIR__ . '/../views'
        ]
    ],

    // routing configuration
    'routing'    => [
        'welcome' => [
            'path'     => '/',
            'defaults' => [
                '_controller' => 'App\Controller\DefaultController::indexAction'
            ]
        ]
    ]
];