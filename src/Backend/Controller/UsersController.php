<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Controller\AppController;
use App\Hydrator;
use App\Model\Entity\User;
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


    public function createAction()
    {
        if($this->app->request->isPost()){
            $user = new User();
            $hydrator = new Hydrator();
            $hydrator->hydrate($user, $this->app->request->params());
            $this->em->persist($user);
            $this->em->flush();
            $this->app->redirect('/system/users', 302);
        }
        $this->app->render('backend/users/create.twig', []);
    }

}