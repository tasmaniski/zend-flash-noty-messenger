<?php

namespace FlashNotyMessenger;

use Zend\Mvc\ApplicationInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $this->addStylesheet($e->getApplication());
    }

    private function addStylesheet(ApplicationInterface $application)
    {
        $container = $application->getServiceManager();
        $config = $container->get('config');
        $basePath = $container->get('ViewHelperManager')->get('basepath');

        if ($config['noty_assets']['useNotyV3']) {
            $container->get('ViewHelperManager')->get('headlink')->appendStylesheet($basePath($config['noty_assets']['css']));
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
