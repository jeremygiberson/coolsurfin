<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Controller\Post;


use Pimple\Container;

class ReadPostFactory
{
    public function __invoke(Container $container){
        return new ReadPost();
    }
}