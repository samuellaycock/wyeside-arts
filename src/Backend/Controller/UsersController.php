<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Controller\AppController;
use App\Model\Repo\EventRepo;
use App\Pagination\Pagination;


/**
 * Class UsersController
 * @package Backend\Controller
 */
class UsersController extends AppController
{

    /**
     * @return EventRepo
     */
    protected function getUserRepo()
    {
        return $this->em->getRepository('App\Model\Entity\User');
    }


    public function indexAction()
    {
        $data = [
          'users' => $this->getUserRepo()->findAll()
        ];
        $this->app->render('backend/users/index.twig', $data);
    }

}