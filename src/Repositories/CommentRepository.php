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
    
    public function delete(Comment $comment)
    {
        $this->getEntityManager()->remove($comment);
        $this->getEntityManager()->flush();
    }
    
    public function load($id)
    {
        return $this->find($id);    
    }
}