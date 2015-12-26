<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Controller\Post;


use JeremyGiberson\Coolsurfin\Api\V1\Storage\PostStorageInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ReadPost
{
    /** @var PostStorageInterface */
    protected $storage;

    /**
     * ReadPost constructor.
     * @param PostStorageInterface $storage
     */
    public function __construct(PostStorageInterface $storage)
    {
        $this->storage = $storage;
    }


    public function __invoke(Request $request, Response $response, array $args) {
        return $this->storage->load($args['id']);
    }
}