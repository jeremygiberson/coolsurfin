<?php


namespace Coolsurfin\Routes;


use Coolsurfin\Models\Comment;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Router;

class NewCommentRoute
{
    /** @var  EntityManager */
    private $entityManager;
    /** @var  Router */
    private $router;

    /**
     * NewCommentRoute constructor.
     * @param EntityManager $entityManager
     * @param Router $router
     */
    public function __construct(EntityManager $entityManager, Router $router)
    {
        $this->entityManager = $entityManager;
        $this->router = $router;
    }


    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $post = $request->getParsedBody();
        $secret = empty($post['secret']) ? null : $post['secret'];
        $author = empty($post['author']) ? 'anonymous' : $post['author'];

        if (empty($post['comment'])) {
            return $response->withStatus(400, 'you have to post something...');
        }

        $comment = Comment::factory($author, $post['comment'], $secret);

        $this->entityManager->persist($comment);
        $this->entityManager->flush();

        return $response->withStatus(302, 'comment posted')
            ->withHeader('Location', $this->router->pathFor('home'));
    }
}