<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Storage;


use DateTime;
use Doctrine\ORM\EntityManager;
use JeremyGiberson\Coolsurfin\Api\V1\Exception\EntityNotFound;
use JeremyGiberson\Coolsurfin\Api\V1\Model\Post;
use JeremyGiberson\Coolsurfin\Api\V1\Paginator\Paginator;
use JeremyGiberson\Coolsurfin\Api\V1\Paginator\PaginatorInterface;

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

    /**
     * Provides list of posts on or before $date_time sorted by $date_time desc.
     * The parameter makes pagination consistent even as new posts are created.
     * @param DateTime $date_time (inclusive)
     * @return PaginatorInterface
     */
    public function getPostsBefore(DateTime $date_time)
    {
        $query_builder = $this->entity_manager->createQueryBuilder();
        $query_builder->select('p')
            ->from(Post::class, 'p')
            ->where('p.created <= :created')
            ->orderBy('p.created', 'DESC');
        $query_builder->setParameter('created', $date_time->format('Y-m-d H:i:s'));

        $paginator = new Paginator($query_builder, false);
        // provide sane defaults
        $paginator->setLimit(25);
        $paginator->setOffset(0);
        return $paginator;
    }

    /**
     * @param int $id
     * @return Post
     * @throws EntityNotFound
     */
    public function load($id)
    {
        $post = $this->entity_manager->getRepository(Post::class)->find($id);
        if($post === null){
            throw new EntityNotFound();
        }
        return $post;
    }


}