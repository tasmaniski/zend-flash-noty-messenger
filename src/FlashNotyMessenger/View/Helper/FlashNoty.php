<?php

namespace FlashNotyMessenger\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\View\Helper\FlashMessenger;
use Zend\View\Helper\InlineScript;
use Zend\View\Helper\BasePath;

class FlashNoty extends AbstractHelper
{
    private $flashMessenger;
    private $inlineScript;
    private $basePath;

    public function __construct(FlashMessenger $flashMessenger, InlineScript $inlineScript, BasePath $basePath)
    {
        $this->flashMessenger = $flashMessenger;
        $this->inlineScript   = $inlineScript;
        $this->basePath       = $basePath;
    }

    /**
     * Collect all messages from previous and current request
     * clear current messages because we will show it
     * add JS files
     * add JS notifications
     */
    public function fire()
    {
        $basePath = $this->basePath;
        $plugin   = $this->flashMessenger->getPluginFlashMessenger();
        $noty     = [
            'alert'       => array_merge($plugin->getMessages(), $plugin->getCurrentMessages()),
            'information' => array_merge($plugin->getInfoMessages(), $plugin->getCurrentInfoMessages()),
            'success'     => array_merge($plugin->getSuccessMessages(), $plugin->getCurrentSuccessMessages()),
            'warning'     => array_merge($plugin->getWarningMessages(), $plugin->getCurrentWarningMessages()),
            'error'       => array_merge($plugin->getErrorMessages(), $plugin->getCurrentErrorMessages()),
        ];

        $plugin->clearCurrentMessages('default');
        $plugin->clearCurrentMessages('info');
        $plugin->clearCurrentMessages('success');
        $plugin->clearCurrentMessages('warning');
        $plugin->clearCurrentMessages('error');

        $this->inlineScript->appendFile($basePath('js/noty/jquery.noty.packaged.js'));
        $this->inlineScript->appendFile($basePath('js/noty/jquery.noty.config.js'));

        $this->inlineScript->captureStart();
        foreach(array_filter($noty) as $type => $messages){
            $message = implode('<br/><br/>', $messages);
            $message = preg_replace('/\s+/', ' ', $message);

            echo "var n = noty({text: '$message',type: '$type'});";
        }
        $this->inlineScript->captureEnd();
    }

}