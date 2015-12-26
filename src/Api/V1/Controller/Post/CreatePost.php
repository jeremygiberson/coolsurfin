<?php


namespace JeremyGiberson\Coolsurfin\Api\V1\Controller\Post;


use JeremyGiberson\Coolsurfin\Api\V1\Model\Post;
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


    public function __invoke(Request $request, Response $response){
        $validation = $this->validator->validate($request->getParams());

        if(!$validation->isValid()){
            return $validation;
        }

        $hydrator = new ClassMethods();
        $post = new Post();
        $hydrator->hydrate($request->getParams(), $post);
        $this->storage->save($post);

        return $post;
    }
}