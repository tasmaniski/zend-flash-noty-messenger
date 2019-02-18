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

    'view_helpers' => [
        'factories' => [
            'flashNoty' => FlashNotyMessenger\Factory\View\Helper\FlashNotyFactory::class,
        ]
    ]
];
