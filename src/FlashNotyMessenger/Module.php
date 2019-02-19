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
        $eventManager        = $e->getApplication()->getEventManager();
        $eventManager
            ->getSharedManager()
            ->attach(AbstractActionController::class, MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch'], 100);
    }

    private function onDispatch(MvcEvent $e)
    {
        $application = $e->getTarget();
        $container = $application->getServiceManager();
        $config = $container->get('config');
        $basePath = $container->get('ViewHelperManager')->get('basepath');
        $headLink = $container->get('ViewHelperManager')->get('headLink');
        
        switch ($config['assets']['use']) {
            case 'cdn':
                $headLink->appendStylesheet($config['assets']['cdn']['css']);
                break;
            case 'local':
            default:
                $headLink->appendStylesheet($config['assets']['local']['css']);
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
