<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Exception;


class EntityNotFound extends \RuntimeException
{

    /**
     * EntityNotFound constructor.
     */
    public function __construct()
    {
        parent::__construct('The specified entity was not found', 0, null);
    }
}