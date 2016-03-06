<?php

namespace FlashNotyMessenger\Factory\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Mvc\Router\Http\RouteMatch;
use \FlashNotyMessenger\View\Helper\FlashNoty;

class FlashNotyFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return FlashNoty
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new FlashNoty(
            $serviceLocator->get('flashmessenger'),
            $serviceLocator->get('inlinescript'),
            $serviceLocator->get('basepath')
        );
    }
}