<?php


namespace Coolsurfin\Unit\Api\V1\Controllers\Post;


use Coolsurfin\Unit\MockRequestTrait;
use JeremyGiberson\Coolsurfin\Api\V1\Controller\Post\ReadPost;
use JeremyGiberson\Coolsurfin\Api\V1\Model\Post;
use JeremyGiberson\Coolsurfin\Api\V1\Storage\PostStorageInterface;
use Slim\Http\Response;

class ReadPostTest extends \PHPUnit_Framework_TestCase
{
    use MockRequestTrait;

    public function setUp()
    {
        parent::setUp();
    }

    public function test_it_returns_post_loaded_from_storage()
    {
        /** @var PostStorageInterface|\PHPUnit_Framework_MockObject_MockObject $storage_mock */
        $storage_mock = $this->getMock(PostStorageInterface::class);
        $storage_mock->expects($this->any())
            ->method('load')
            ->with($id = 3)
            ->willReturn($model = new Post());

        $request = $this->mockRequest("api/v1/post/$id");
        $response = new Response();

        $controller = new ReadPost($storage_mock);
        $returned_value = $controller($request, $response, ['id' => $id]);
        $this->assertSame($model, $returned_value);
    }
}
