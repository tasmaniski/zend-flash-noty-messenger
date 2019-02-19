<?php

return [
    
    'noty_config' => [
        'layout'    => 'topRight',
        'theme'     => 'metroui',
        'closeWith' => ['click', 'button'],
        /* 'animation' => [
            'open'  => 'animated fadeInRight',
            'close' => 'animated fadeOutRight'
        ] */
    ],

    'noty_assets' => [
        'use'   => 'cdn',
        'cdn'   => [
            'css'   => 'https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css',
            'js'    => 'https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js',
        ],
        'local' => [
            'css'   => 'css/noty/noty.min.css',
            'js'    => 'js/noty/noty.min.js',
        ]
    ],

    'view_helpers' => [
        'factories' => [
            'flashNoty' => FlashNotyMessenger\Factory\View\Helper\FlashNotyFactory::class,
        ]
    ]
];
