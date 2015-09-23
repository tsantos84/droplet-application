<?php

use Framework\Droplet\Core\Routing\RouteCollectionBuilder;

return [

    // templating configuration
    'templating' => [
        'paths' => [
            __DIR__ . '/../views'
        ]
    ],

    // routing configuration
    'routing'    => [
        'providers' => [
            'main' => function (RouteCollectionBuilder $builder) {
                $builder->get('/', 'App\\Controller\\DefaultController::indexAction')->assign('home');
            }
        ]
    ]
];
