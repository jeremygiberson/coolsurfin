<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Storage;


use DateTime;
use JeremyGiberson\Coolsurfin\Api\V1\Exception\EntityNotFound;
use JeremyGiberson\Coolsurfin\Api\V1\Model\Post;
use JeremyGiberson\Coolsurfin\Api\V1\Paginator\PaginatorInterface;

interface PostStorageInterface
{
    /**
     * @param Post $post
     */
    public function save(Post $post);

    /**
     * Provides list of posts on or before $date_time sorted by $date_time desc.
     * The parameter makes pagination consistent even as new posts are created.
     * @param DateTime $date_time (inclusive)
     * @return PaginatorInterface
     */
    public function getPostsBefore(DateTime $date_time);

    /**
     * @param int $id
     * @return Post
     * @throws EntityNotFound
     */
    public function load($id);
}