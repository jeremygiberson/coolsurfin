<?php


namespace JeremyGiberson\Coolsurfin\Controller;


use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class IndexController
{
    /** @var  Twig */
    protected $view;

    /**
     * IndexController constructor.
     * @param Twig $view
     */
    public function __construct(Twig $view)
    {
        $this->view = $view;
    }


    public function __invoke(Request $request, Response $response){
        return $this->view->render($response, 'index.html');
    }
}