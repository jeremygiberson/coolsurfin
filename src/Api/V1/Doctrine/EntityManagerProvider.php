<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Doctrine;


use Pimple\Container;
use Pimple\ServiceProviderInterface;

class EntityManagerProvider implements ServiceProviderInterface
{

    /**
     * Registers services on the given container.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $factory = new EntityManagerFactory([
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../../../data/db.sqlite'
        ]);
        $pimple['entity_manager'] = $factory->create(true);
    }
}