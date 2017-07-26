<?php

return [
    'noty_assets' => [
        // Noty library
        'library'   => 'js/noty/jquery.noty.packaged.js',

        // Custom configuration
        'config'    => 'js/noty/jquery.noty.config.js',

        // If you use Noty v3+
        'useNotyV3' => false,
        'theme'     => 'metroui',
        'css'       => ''
    ],

    'view_helpers' => [
        'factories' => [
            'flashNoty' => FlashNotyMessenger\Factory\View\Helper\FlashNotyFactory::class,
        ]
    ]
];
