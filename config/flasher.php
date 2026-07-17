<?php

return [
    'default' => 'sweetalert',

    'main_script' => '/vendor/flasher/flasher.min.js',

    'public_path' => '',

    'styles' => [
        '/vendor/flasher/flasher.min.css',
    ],

    'options' => [
        'timer' => 3000,
        'timerProgressBar' => true,
        'toast' => true,
        'position' => 'top-end',
        'showConfirmButton' => false,
        'customClass' => [
            'popup' => 'gs-toast-popup',
            'title' => 'gs-toast-title',
            'htmlContainer' => 'gs-toast-html',
        ],
    ],

    'inject_assets' => true,

    'translate' => true,

    'excluded_paths' => [],

    'flash_bag' => [
        'success' => ['success'],
        'error' => ['error', 'danger'],
        'warning' => ['warning', 'alarm'],
        'info' => ['info', 'notice', 'alert'],
    ],

    'plugins' => [
        'sweetalert' => [
            'scripts' => [
                '/vendor/flasher/sweetalert2.min.js',
                '/vendor/flasher/flasher-sweetalert.min.js',
            ],
            'styles' => [
                '/vendor/flasher/sweetalert2.min.css',
            ],
            'options' => [
                'timer' => 3000,
                'timerProgressBar' => true,
                'toast' => true,
                'position' => 'top-end',
                'showConfirmButton' => false,
                'customClass' => [
                    'popup' => 'gs-toast-popup',
                    'title' => 'gs-toast-title',
                    'htmlContainer' => 'gs-toast-html',
                ],
            ],
        ],
    ],
];
