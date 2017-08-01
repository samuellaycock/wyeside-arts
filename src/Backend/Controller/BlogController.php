<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;



/**
 * Class BlogController
 * @package Backend\Controller
 */
class BlogController extends BackendController
{

    public function indexAction()
    {
        $this->app->render('backend/blog/index.twig', []);
    }

}