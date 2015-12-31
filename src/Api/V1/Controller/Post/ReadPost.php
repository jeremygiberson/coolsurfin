<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Controller\Post;


use DateTime;
use DateTimeZone;
use JeremyGiberson\Coolsurfin\Api\V1\Response\ModelResponse;
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


    public function __invoke(Request $request, Response $response, array $args)
    {
        $id = $args['id'];
        if($id){
            return new ModelResponse($this->storage->load($args['id']));
        }

        return new ModelResponse($this->storage->getPostsBefore(
            new DateTime('now',
            new DateTimeZone('UTC'))));
    }
}