<?php

namespace FlashNotyMessenger;

use Zend\Mvc\ApplicationInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Controller\AbstractActionController;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $app = $e->getTarget();
        $eventManager = $app->getEventManager();
        $eventManager
            ->getSharedManager()
            ->attach(AbstractActionController::class, MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch']);
    }

    public function onDispatch(MvcEvent $event)
    {
        $application = $event->getApplication();
        $container = $application->getServiceManager();
        $config = $container->get('config');
        $basePath = $container->get('ViewHelperManager')->get('basepath');
        $headLink = $container->get('ViewHelperManager')->get('headLink');
        
        switch ($config['noty_assets']['use']) {
            case 'cdn':
                $headLink->appendStylesheet($config['noty_assets']['cdn']['css']);
                break;
            case 'local':
            default:
                $headLink->appendStylesheet($config['noty_assets']['local']['css']);
                break;
        }
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__,
                ],
            ],
        ];
    }

}
