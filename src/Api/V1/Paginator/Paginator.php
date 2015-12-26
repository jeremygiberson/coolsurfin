<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Paginator;

use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
class Paginator extends DoctrinePaginator implements PaginatorInterface
{
    /**
     * @return int
     */
    public function getOffset()
    {
        return $this->getQuery()->getFirstResult();
    }

    /**
     * @param int $offset
     * @return self
     */
    public function setOffset($offset)
    {
        $this->getQuery()->setFirstResult($offset);
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        return $this->getQuery()->getMaxResults();
    }

    /**
     * @param int $limit
     * @return self
     */
    public function setLimit($limit)
    {
        $this->getQuery()->setMaxResults($limit);
        return $this;
    }
}