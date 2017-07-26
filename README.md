# Apple style notifications :)

New version is here! Current version support Zend Framework 3

View Helper for showing flash messages with help of **NOTY** jQuery plugin http://ned.im/noty/#/about  <br/>
You must include the latest release of jQuery and Bootstrap. <br/> <br/>

![alt tag](https://raw.githubusercontent.com/tasmaniski/zend-flash-noty-messenger/master/asset/screen-shot.png)


## **Install**

Add in composer.json file and than run **composer update**

```json
{
  "require": {
    "tasmaniski/zend-flash-noty-messenger":"^2.0"
  }
}
```

The module should be registered in **config/application.config.php** in Zend Framework 2

```php
return [
    // ...
    'modules' => array(
        '...',
        'FlashNotyMessenger'
    ],
    // ...
]
```

The module should be registered in **config/modules.config.php** in Zend Framework 3

```php
return [
    // ...
    'FlashNotyMessenger'
    // ...
]
```

After that, copy 2 JS files from **vendor/tasmaniski/zend-flash-noty-messenger/asset/** <br/>
and put it on path **public/js/noty/** <br/>

```shell

mkdir public/js/noty/
cp vendor/tasmaniski/zend-flash-noty-messenger/asset/jquery.noty.packaged.js public/js/noty/jquery.noty.packaged.js
cp vendor/tasmaniski/zend-flash-noty-messenger/asset/jquery.noty.config.js public/js/noty/jquery.noty.config.js
```

#### For use Noty v3
Using ***node_modules***

```shell
cd public
# npm
npm install noty
# or used yarn
yarn add noty
```

In ***config/autoload/global.php*** or ***config/autoload/local.php***

```php
return [
    // ...
    // For example
    'noty_assets' => [
        // Noty library
        'library'   => 'node_modules/noty/lib/noty.min.js',

        // If you use Noty v3+
        'useNotyV3' => true,
        'theme'     => 'metroui',
        'css'       => 'node_modules/noty/lib/noty.css'
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
<?php echo $this->inlineScript() ?>
```

Example from my code

```php
//  at the end of layout.phtml

/* fire all messages */
<?php $this->flashNoty()->fire(); ?>

<!-- All Scripts to the bottom! -->
<?php echo $this->inlineScript()  // we call here inlineScript()
    ->appendFile($this->basePath('js/jquery.js'))
    ->appendFile($this->basePath('js/bootstrap.js')); ?>

```

*Note: if you want to use it in ZF2 app, add in composer.json version ^1.0*

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

I would like to give a credit to my colleague https://github.com/maksi80 for CSS style of notifications.

