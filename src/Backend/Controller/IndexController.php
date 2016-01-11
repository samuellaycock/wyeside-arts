<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Controller\AppController;


class IndexController extends AppController
{

    public function indexAction()
    {
        $this->app->render('backend/index.twig');
    }

}