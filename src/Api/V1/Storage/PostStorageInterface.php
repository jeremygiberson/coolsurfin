<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Storage;


use JeremyGiberson\Coolsurfin\Api\V1\Model\Post;

interface PostStorageInterface
{
    /**
     * @param Post $post
     */
    public function save(Post $post);
}