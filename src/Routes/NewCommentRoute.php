<?php


namespace Coolsurfin\Routes;


use Coolsurfin\Models\Comment;
use Coolsurfin\Services\ReCaptcha;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Router;

class NewCommentRoute
{
    /** @var  EntityManager */
    private $entityManager;
    /** @var  Router */
    private $router;
    /** @var  ReCaptcha */
    private $recaptcha;

    /**
     * NewCommentRoute constructor.
     * @param EntityManager $entityManager
     * @param Router $router
     * @param ReCaptcha $recaptcha
     */
    public function __construct(EntityManager $entityManager, Router $router, ReCaptcha $recaptcha)
    {
        $this->entityManager = $entityManager;
        $this->router = $router;
        $this->recaptcha = $recaptcha;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $post = $request->getParsedBody();
        $gReCaptcha = empty($post['g-recaptcha-response']) ? null : $post['g-recaptcha-response'];
        $secret = empty($post['secret']) ? null : $post['secret'];
        $author = empty($post['author']) ? 'anonymous' : $post['author'];

        if (empty($post['comment'])) {
            return $response->withStatus(400, 'you have to post something...');
        }

        // validate w/ google
        if (! $this->recaptcha->IsVerified($gReCaptcha)) {
            return $response->withStatus(400, 'You did not pass re-captcha');
        }

        $comment = Comment::factory($author, $post['comment'], $secret);

        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        return $response->withStatus(302, 'comment posted')
            ->withHeader('Location', $this->router->pathFor('home'));
    }
}