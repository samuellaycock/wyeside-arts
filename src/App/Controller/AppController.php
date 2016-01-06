<?php

namespace App\Controller;


use Slim\Container;
use Psr\Http\Message\ResponseInterface;


class AppController
{

    /** @var Container */
    protected $di;

    /** @var ResponseInterface*/
    protected $response;


    /**
     * AppController constructor.
     * @param Container $di
     * @param ResponseInterface $response
     */
    public function __construct(Container $di, ResponseInterface $response)
    {
        $this->di = $di;
        $this->response = $response;
    }

    /**
     * @param $string
     */
    protected function writeString($string)
    {
        $this->response->getBody()->write($string);
    }

    /**
     * @param $view
     */
    protected function writeView($view, array $data = [])
    {
        $twig = $this->di->get('twig');
        $this->response->getBody()->write($twig->render($view, $data));
    }


}