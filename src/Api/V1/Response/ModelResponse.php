<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Response;

use Slim\Http\Response;


class ModelResponse extends Response
{
    /** @var int mixed */
    private $model;

    /**
     * @param mixed $model
     */
    public function __construct($model)
    {
        parent::__construct(200);
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

}