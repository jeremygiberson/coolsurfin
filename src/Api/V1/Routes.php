<?php


namespace JeremyGiberson\Coolsurfin\Api\V1;


use JeremyGiberson\Coolsurfin\Api\V1\Controller\Post\CreatePostFactory;
use JeremyGiberson\Coolsurfin\Api\V1\Controller\Post\ReadPostFactory;
use JeremyGiberson\Coolsurfin\Api\V1\Doctrine\EntityManagerProvider;
use JeremyGiberson\Coolsurfin\Api\V1\Middleware\CaptchaValidator;
use JeremyGiberson\Coolsurfin\Api\V1\Middleware\EntityNotFoundMiddleware;
use JeremyGiberson\Coolsurfin\Api\V1\Middleware\ModelMarshaller;
use JeremyGiberson\Coolsurfin\Api\V1\Middleware\ValidationMarshaller;
use JeremyGiberson\Coolsurfin\Api\V1\Storage\PostStorageFactory;
use JeremyGiberson\Coolsurfin\Api\V1\Validator\JsonSchemaValidatorFactory;
use JeremyGiberson\Coolsurfin\Api\V1\Validator\ReCaptchaValidatorFactory;
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
        $container['captcha_validator'] = new ReCaptchaValidatorFactory();
        $container['post_storage'] = new PostStorageFactory();
        $container['post_validator'] = new JsonSchemaValidatorFactory(
            __DIR__ . '/Model/post.json'
        );

        $entity_manager_provider = new EntityManagerProvider();
        $entity_manager_provider->register($container);

        $validator_factory = new ReCaptchaValidatorFactory;

        $app->group('/api/v1', function() use($validator_factory, $container) {
            /** @var App $app */
            $app = $this;

            $app->get('/posts/{id:[0-9]*}', 'read_post_factory')
                ->setName('get_posts');

            $app->post('/posts/', 'create_post_factory')
                ->setName('create_post')
                ->add(new CaptchaValidator($validator_factory($container)));
        })
            ->add(new ModelMarshaller())
            ->add(new ValidationMarshaller())
            ->add(new EntityNotFoundMiddleware());
    }
}