<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Storage;


use Pimple\Container;

class PostStorageFactory
{
    public function __invoke(Container $container) {
        $entity_manager = $container['entity_manager'];
        return new PostStorage($entity_manager);
    }
}