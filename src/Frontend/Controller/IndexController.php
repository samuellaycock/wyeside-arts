<?php

namespace Frontend\Controller;


use App\Controller\AppController;


class IndexController extends AppController
{

    public function indexAction()
    {
        $this->app->render('frontend/index.twig');
    }

}