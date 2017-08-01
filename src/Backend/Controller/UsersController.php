<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Hydrator;
use App\Model\Entity\User;
use App\Model\Repo\EventRepo;

/**
 * Class UsersController
 * @package Backend\Controller
 */
class UsersController extends BackendController
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


    public function editAction()
    {
        $id = $this->app->router->getCurrentRoute()->getParam('id');
        $user = $this->getUserRepo()->find($id);
        if($this->app->request->isPost()){
            $hydrator = new Hydrator();
            $hydrator->hydrate($user, $this->app->request->params());
            $this->em->persist($user);
            $this->em->flush();
            $this->app->redirect('/system/users', 302);
        }
        $this->app->render('backend/users/edit.twig', ['user' => $user]);
    }


    /**
     * todo: this will allow the current logged in user to delete themselves, fix this!
     */
    public function deleteAction()
    {
        $id = $this->app->router->getCurrentRoute()->getParam('id');
        $user = $this->getUserRepo()->find($id);
        $this->em->remove($user);
        $this->em->flush();
    }

}