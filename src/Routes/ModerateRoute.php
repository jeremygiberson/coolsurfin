<?php
/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 8/9/2016
 * Time: 5:18 PM
 */

namespace Coolsurfin\Routes;

use Coolsurfin\Repositories\CommentRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ModerateRoute
{
    /** @var  CommentRepository */
    private $repository;
    /** @var  string */
    private $secret;

    /**
     * ModerateRoute constructor.
     * @param CommentRepository $repository
     * @param string $secret
     */
    public function __construct(CommentRepository $repository, $secret)
    {
        $this->repository = $repository;
        $this->secret = $secret;
    }


    public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
    {
        $id = $request->getAttribute('id');
        $secret = $request->getAttribute('secret');

        if($secret !== $this->secret) {
            return $response->withStatus(400, 'not authenticated');
        }

        $comment = $this->repository->load($id);
        $this->repository->delete($comment);
    }
}