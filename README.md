# Apple style notifications :)

This version support Zend Framework 3 and Noty v3

View Helper for showing flash messages with help of **NOTY** plugin http://ned.im/noty/#/

![Screenshot](https://raw.githubusercontent.com/elialejandro/zend-flash-noty-messenger/master/asset/screenshot.png)

## **Install**

Add in composer.json file and than run **composer update**

```json
{
  "require": {
    "rurounize/zend-flash-noty-messenger":"^3.0"
  }
}
```

The module should be registered in **config/modules.config.php** in Zend Framework 3

```php
return [
    // ...
    'FlashNotyMessenger'
    // ...
]
```

**Note** FlashNotyMessenger includes local files and CDN assets, you can decide what to use.

After that, copy JS files from **vendor/rurounize/zend-flash-noty-messenger/asset/** <br/>
and put it on path **public/js/noty/** <br/>

```shell
mkdir public/js/noty/
# For develop
cp vendor/rurounize/zend-flash-noty-messenger/asset/noty.js public/js/noty/noty.js
# For production
cp vendor/rurounize/zend-flash-noty-messenger/asset/noty.min.js public/js/noty/noty.min.js
```

If you can use local assets copy CSS files from **vendor/rurounize/zend-flash-noty-messenger/asset/** <br/>
and put it on path **public/css/noty/** <br/>

```shell
mkdir public/css/noty/
# For develop
cp vendor/rurounize/zend-flash-noty-messenger/asset/noty.css public/css/noty/noty.css
# For production
cp vendor/rurounize/zend-flash-noty-messenger/asset/noty.min.css public/css/noty/noty.min.css
```

If you want to customize the configuration you can copy in ***config/autoload/global.php*** or ***config/autoload/local.php***

```php
return [
    // ...
    'noty_config' => [
        'layout'    => 'topRight',
        'theme'     => 'mint',
        'closeWith' => ['click', 'button'],
        /* 'animation' => [
            'open'  => 'animated fadeInRight',
            'close' => 'animated fadeOutRight'
        ] */
    ],

    'noty_assets' => [
        'use'   => 'cdn', // local for local assets
        'cdn'   => [
            'css'   => 'https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.css',
            'js'    => 'https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.min.js',
        ],
        'local' => [
            'css'   => 'css/noty/noty.min.css',
            'js'    => 'js/noty/noty.min.js',
        ]
    ],
    // ...
];
```

<br/>

## Setup

In layout.phtml somewhere at the end trigger fire()

```php

/**
 * The fire() method do
 *     Collect all messages from previous and current request
 *     clear current messages because we will show it
 *     add JS files
 *     add JS notifications
 */
<?php $this->flashNoty()->fire(); ?>

<!-- if you already don't have this line, must add it for including JS files -->
<?= $this->inlineScript() ?>
```

## **Use**

Use it in any controller.<br/>
Add messages in your controller and the messages will be showed (in redirected request or current)

```php
<?php
$this->flashMessenger()->addSuccessMessage('Success message, bravo!');
$this->flashMessenger()->addErrorMessage('Error with system, contact us.');
$this->flashMessenger()->addInfoMessage('Info message, to do whatever...');
$this->flashMessenger()->addWarningMessage('Warning message to be careful.');
```

## Credits

The original version belongs to https://github.com/tasmaniski/zend-flash-noty-messenger

