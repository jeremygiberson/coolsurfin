<?php


namespace JeremyGiberson\Coolsurfin\Api\V1;


use JeremyGiberson\Coolsurfin\Api\V1\Controllers\Post\ReadPostFactory;
use JeremyGiberson\Coolsurfin\Api\V1\Middleware\CaptchaValidatorFactory;
use JeremyGiberson\Coolsurfin\Api\V1\Middleware\ModelMarshaller;
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
        $container['captcha_validator'] = new CaptchaValidatorFactory();

        $app->group('/api/v1', function(){
            /** @var App $app */
            $app = $this;

            $app->get('/posts/{id:[0-9]*}', 'read_post_factory')
//            ->add('captcha_validator'); // this makes unit testing hard
            ;
            $app->post('/posts/', 'create_post_factory');
        })->add(new ModelMarshaller());
    }
}