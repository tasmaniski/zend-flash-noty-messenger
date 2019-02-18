<?php

namespace FlashNotyMessenger\Factory\View\Helper;

use Interop\Container\ContainerInterface;
use FlashNotyMessenger\View\Helper\FlashNoty;

class FlashNotyFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');

        return new FlashNoty(
            $container->get('ControllerPluginManager')->get('flashmessenger'),
            $container->get('ViewHelperManager')->get('inlinescript'),
            $container->get('ViewHelperManager')->get('basepath'),
            $config['noty_config']
        );
    }

}