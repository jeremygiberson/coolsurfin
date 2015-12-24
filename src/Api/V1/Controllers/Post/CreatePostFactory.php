<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Controllers\Post;


use Pimple\Container;

class CreatePostFactory
{
    public function __invoke(Container $container){
        $storage = $container['post_storage'];
        $validator = $container['post_validator'];
        return new CreatePost($storage, $validator);
    }
}