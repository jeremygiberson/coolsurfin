<?php


namespace Coolsurfin\Routes;


use Coolsurfin\Repositories\CommentRepository;
use Coolsurfin\ViewModels\CommentViewModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class IndexRoute
{
    /** @var  Twig */
    private $view;
    /** @var  CommentRepository */
    private $repository;

    /**
     * IndexRoute constructor.
     * @param Twig $view
     * @param CommentRepository $repository
     */
    public function __construct(Twig $view, CommentRepository $repository)
    {
        $this->view = $view;
        $this->repository = $repository;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $comment = $this->repository->getMostRecent();
        $this->view->render($response, 'post.phtml', [
            'comment' => new CommentViewModel($comment)
        ]);
    }
}