<?php


namespace Coolsurfin\Routes;


use Coolsurfin\Repositories\CommentRepository;
use Coolsurfin\ViewModels\CommentViewModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class PostRoute
{
    /** @var  Twig */
    private $view;
    /** @var  CommentRepository */
    private $repository;

    /**
     * PostRoute constructor.
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
        $id = $request->getAttribute('id');
        if (!$comment = $this->repository->find($id))
        {
            return $response->withStatus(404, 'post not found');
        }

        $this->view->render($response, 'post.phtml', [
            'comment' => new CommentViewModel($comment)
        ]);

        return $response;
    }
}