<?php


namespace Coolsurfin\Unit\Api\V1\Controllers\Post;


use Coolsurfin\Unit\MockRequestTrait;
use JeremyGiberson\Coolsurfin\Api\V1\Controller\Post\CreatePost;
use JeremyGiberson\Coolsurfin\Api\V1\Model\Post;
use JeremyGiberson\Coolsurfin\Api\V1\Response\ModelResponse;
use JeremyGiberson\Coolsurfin\Api\V1\Storage\PostStorageInterface;
use JeremyGiberson\Coolsurfin\Api\V1\Validator\ValidationResult;
use JeremyGiberson\Coolsurfin\Api\V1\Validator\ValidatorInterface;
use Slim\Http\Response;

class CreatePostTest extends \PHPUnit_Framework_TestCase
{
    use MockRequestTrait;

    /** @var  CreatePost */
    protected $controller;
    /** @var  PostStorageInterface|\PHPUnit_Framework_MockObject_MockObject */
    protected $storage;
    /** @var  ValidatorInterface|\PHPUnit_Framework_MockObject_MockObject */
    protected $validator;
    protected $captcha;

    public function setUp()
    {
        parent::setUp();
        $this->storage = $this->getMock(PostStorageInterface::class);
        $this->validator = $this->getMock(ValidatorInterface::class);
        $this->controller = new CreatePost($this->storage, $this->validator);
    }

    public function test_it_returns_persisted_post_model(){
        $controller = $this->controller;
        $request = $this->mockRequest('/', 'POST', []);
        $response = new Response();

        $this->validator->expects($this->any())
            ->method('validate')
            ->willReturn(new ValidationResult(true));

        $this->storage->expects($this->once())
            ->method('save')
            ->with($this->isInstanceOf(Post::class));

        /** @var ModelResponse $result */
        $result = $controller($request, $response);
        $this->assertInstanceOf(ModelResponse::class, $result);
        $this->assertInstanceOf(Post::class, $result->getModel());
    }

    public function test_it_returns_a_validation_result_on_invalid_post_data(){
        $controller = $this->controller;
        $request = $this->mockRequest('/', 'POST', []);
        $response = new Response();

        $this->validator->expects($this->any())
            ->method('validate')
            ->willReturn(new ValidationResult(false, ['foo'=>'bar']));

        /** @var ValidationResult $result */
        $result = $controller($request, $response);
        $this->assertInstanceOf(ValidationResult::class, $result);
        $this->assertFalse($result->isValid());
    }

}
