<?php

namespace FlashNotyMessenger\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Zend\View\Helper\InlineScript;
use Zend\View\Helper\BasePath;

class FlashNoty extends AbstractHelper
{
    /**
     * @var FlashMessenger
     */
    private $flashMessenger;

    /**
     * @var InlineScript
     */
    private $inlineScript;

    /**
     * @var BasePath
     */
    private $basePath;

    /** 
     * @var array
     */
    private $config;

    /**
     * FlashNoty constructor.
     * @param FlashMessenger $flashMessenger
     * @param InlineScript $inlineScript
     * @param BasePath $basePath
     * @param array $config
     */
    public function __construct(FlashMessenger $flashMessenger, InlineScript $inlineScript, BasePath $basePath, array $config)
    {
        $this->flashMessenger = $flashMessenger;
        $this->inlineScript   = $inlineScript;
        $this->basePath       = $basePath;
        $this->config         = $config;
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
        $plugin   = $this->flashMessenger;
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

        $this->inlineScript->appendFile($basePath('js/noty/noty.min.js'));

        $this->inlineScript->captureStart();

        echo sprintf("Noty.overrideDefaults(%s)\n", json_encode($this->config));

        foreach(array_filter($noty) as $type => $messages){
            $message = implode('<br/><br/>', $messages);
            $message = preg_replace('/\s+/', ' ', $message);
            $message = str_replace("'", '&#34;', $message);
            
            echo sprintf("new Noty({text:'%s', type:'%s'}).show();\n", $message, $type);
        }
        $this->inlineScript->captureEnd();
    }

}