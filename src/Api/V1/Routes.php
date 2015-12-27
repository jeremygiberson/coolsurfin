<?php


namespace JeremyGiberson\Coolsurfin\Api\V1;


use JeremyGiberson\Coolsurfin\Api\V1\Controller\Post\CreatePostFactory;
use JeremyGiberson\Coolsurfin\Api\V1\Controller\Post\ReadPostFactory;
use JeremyGiberson\Coolsurfin\Api\V1\Doctrine\EntityManagerProvider;
use JeremyGiberson\Coolsurfin\Api\V1\Middleware\CaptchaValidatorFactory;
use JeremyGiberson\Coolsurfin\Api\V1\Middleware\EntityNotFoundMiddleware;
use JeremyGiberson\Coolsurfin\Api\V1\Middleware\ModelMarshaller;
use JeremyGiberson\Coolsurfin\Api\V1\Middleware\ValidationMarshaller;
use JeremyGiberson\Coolsurfin\Api\V1\Storage\PostStorageFactory;
use JeremyGiberson\Coolsurfin\Api\V1\Validator\JsonSchemaValidatorFactory;
use JeremyGiberson\Coolsurfin\Router\RoutesProviderInterface;
use Pimple\Container;
use Slim\App;

class Routes implements RoutesProviderInterface
{

    public function register(App $app)
    {
        /** @var Container $container */
        $container = $app->getContainer();
        $container['read_post_factory'] = new ReadPostFactory();
        $container['create_post_factory'] = new CreatePostFactory();
        $container['captcha_validator'] = new CaptchaValidatorFactory();
        $container['post_storage'] = new PostStorageFactory();
        $container['post_validator'] = new JsonSchemaValidatorFactory(
            __DIR__ . '/Model/post.json'
        );

        $entity_manager_provider = new EntityManagerProvider();
        $entity_manager_provider->register($container);

        $app->group('/api/v1', function(){
            /** @var App $app */
            $app = $this;

            $app->get('/posts/{id:[0-9]*}', 'read_post_factory')
//            ->add('captcha_validator'); // this makes unit testing hard
            ;
            $app->post('/posts/', 'create_post_factory');
        })
            ->add(new ModelMarshaller())
            ->add(new ValidationMarshaller())
            ->add(new EntityNotFoundMiddleware());
    }
}