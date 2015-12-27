<?php


namespace JeremyGiberson\Coolsurfin\View;


use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

class TwigProvider implements ServiceProviderInterface
{

    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     */
    public function register(Container $container)
    {
        $view = new Twig(__DIR__ . '/../../views');
        $view->addExtension(new TwigExtension($container['router'],
            $container['request']->getUri()));
        $container['view'] = $view;
    }
}