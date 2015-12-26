<?php
namespace JeremyGiberson\Coolsurfin\Api\V1\Paginator;

interface PaginatorInterface
{
    /**
     * @return int
     */
    public function getOffset();

    /**
     * @param int $offset
     * @return self
     */
    public function setOffset($offset);

    /**
     * @return int
     */
    public function getLimit();

    /**
     * @param int $limit
     * @return self
     */
    public function setLimit($limit);

    /**
     * {@inheritdoc}
     */
    public function count();
}