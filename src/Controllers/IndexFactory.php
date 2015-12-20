<?php


namespace JeremyGiberson\Coolsurfin\Controllers;


use Pimple\Container;

class IndexFactory
{
    public function __invoke(Container $container){
        return new IndexController();
    }
}