<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Controller\AppController;
use App\Model\Repo\EventRepo;
use App\Pagination\Pagination;


/**
 * Class BlogController
 * @package Backend\Controller
 */
class BlogController extends AppController
{

    public function indexAction()
    {
        $this->app->render('backend/blog/index.twig', []);
    }

}