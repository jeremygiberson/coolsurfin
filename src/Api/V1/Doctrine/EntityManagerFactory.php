<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Doctrine;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


class EntityManagerFactory
{
    /** @var  array */
    protected $connection_params;

    /**
     * EntityManagerFactory constructor.
     * @param array $connection_params
     */
    public function __construct(array $connection_params)
    {
        $this->connection_params = $connection_params;
    }


    /**
     * @param bool|false $is_dev
     * @return EntityManager
     * @throws \Doctrine\ORM\ORMException
     */
    public function create($is_dev = false) {
        $paths = array(__DIR__ . '/../Model');

        $config = Setup::createAnnotationMetadataConfiguration($paths, $is_dev);
        return EntityManager::create($this->connection_params, $config);
    }
}