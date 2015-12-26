<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Storage;


use Doctrine\ORM\EntityManager;
use JeremyGiberson\Coolsurfin\Api\V1\Model\Post;

class PostStorage implements PostStorageInterface
{
    /** @var  EntityManager */
    protected $entity_manager;

    /**
     * PostStorage constructor.
     * @param EntityManager $entity_manager
     */
    public function __construct(EntityManager $entity_manager)
    {
        $this->entity_manager = $entity_manager;
    }


    /**
     * @param Post $post
     */
    public function save(Post $post)
    {
        $this->entity_manager->persist($post);
        $this->entity_manager->flush();
    }
}