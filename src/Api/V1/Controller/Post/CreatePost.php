<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Controller\Post;


use DateTimeZone;
use JeremyGiberson\Coolsurfin\Api\V1\Model\Post;
use JeremyGiberson\Coolsurfin\Api\V1\Response\ModelResponse;
use JeremyGiberson\Coolsurfin\Api\V1\Response\ValidationResponse;
use JeremyGiberson\Coolsurfin\Api\V1\Storage\PostStorageInterface;
use JeremyGiberson\Coolsurfin\Api\V1\Validator\ValidatorInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Zend\Hydrator\ClassMethods;

class CreatePost
{
    /** @var PostStorageInterface */
    protected $storage;
    /** @var  ValidatorInterface */
    protected $validator;

    /**
     * CreatePost constructor.
     * @param PostStorageInterface $storage
     * @param ValidatorInterface $model_validator
     */
    public function __construct(PostStorageInterface $storage, ValidatorInterface $model_validator)
    {
        $this->storage = $storage;
        $this->validator = $model_validator;
    }


    public function __invoke(Request $request, Response $response) {
        $data = $request->getParams();
        unset($data['g-recaptcha-response']);

        $validation = $this->validator->validate((object)$data);

        if (!$validation->isValid()) {
            return new ValidationResponse($validation);
        }

        $hydrator = new ClassMethods();
        $post = new Post();
        $hydrator->hydrate($data, $post);

        if (!$post->getCreated()) {
            $post->setCreated(new \DateTime('now', new DateTimeZone('UTC')));
        }

        $this->storage->save($post);

        return new ModelResponse($post);
    }
}