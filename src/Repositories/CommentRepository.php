<?php


namespace Coolsurfin\Repositories;


use Coolsurfin\Models\Comment;
use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
    /**
     * @return Comment
     */
    public function getMostRecent()
    {
        return $this->findBy([], ['postedAt' => 'desc'], 1)[0];
    }
}