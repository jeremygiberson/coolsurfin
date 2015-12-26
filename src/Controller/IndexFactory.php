<?php


namespace JeremyGiberson\Coolsurfin\Controller;


use Pimple\Container;

class IndexFactory
{
    public function __invoke(Container $container){
        if(!isset($container['view'])){
            throw new \RuntimeException('DI container does not provide `view`');
        }

        $view = $container['view'];
        return new IndexController($view);
    }
}