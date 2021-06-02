<?php

    /**
    *--------------------------------------------------------------------------
    * Domain Settings
    *--------------------------------------------------------------------------
    *
    * This option controls the Domain Settings
    * Enable and Disable Domain Registers
    * Commands - Factories - Migrations - Translations - Views - Routes - Policies
    *
    */

    return [
        'path'          => env('DOMAIN_PATH', 'Domains'),
        'commands'      => true,
        'migrations'    => true,
        'factories'     => true,
        'views'         => true,
        'translations'  => true,
        'structure' => [
            'Commands',
            'Database' => [
                'Factories',
                'Migrations',
                'Seeds'
            ],
            'Entities',
            'Http' => [
                'Controllers' => [
                    'AdminPanel',
                    'API',
                    'EndUser',
                    'SAC',
                ],
                'Requests' => [
                    'AdminPanel',
                    'API',
                    'EndUser',
                ]
            ],
            'Notifications' => [
                'AdminPanel',
                'EndUser',
            ],
            'Providers',
            'Repositories' => [
                'Contracts',
                'Eloquent',
            ],
            'Resources' => [
                'Views' => [
                    'adminpanel',
                    'enduser',
                ],
                'Lang'=>[
                    'en',
                    'ar'
                ]
            ],
            'Routes',
        ],
    ];
