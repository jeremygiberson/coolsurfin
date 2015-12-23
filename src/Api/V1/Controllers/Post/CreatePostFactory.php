<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Controllers\Post;


use Pimple\Container;

class CreatePostFactory
{
    public function __invoke(Container $container){
        return new CreatePost();
    }
}