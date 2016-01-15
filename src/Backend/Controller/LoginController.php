<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Controller\AppController;
use App\Model\Repo\EventRepo;
use App\Model\Repo\UserRepo;


class LoginController extends AppController
{

    /**
     * @return EventRepo
     */
    protected function getEventRepo()
    {
        return $this->em->getRepository('App\Model\Entity\Event');
    }

    /**
     * @return UserRepo
     */
    protected function getUserRepo()
    {
        return $this->em->getRepository('App\Model\Entity\User');
    }



    public function loginAction()
    {
        $error = null;

        if($this->app->request->isPost()){
            $username = $this->app->request->post('username');
            $password = $this->app->request->post('password');
            $user = $this->getUserRepo()->findByUsernameOrEmail($username);
            if($user && $user->validatePassword($password)){
                $this->app->redirect('/system', 302);
                return;
            }else{
                $error = 'Invalid Username or Password';
            }
        }

        $events = $this->getEventRepo()->getXUpcoming(10);
        shuffle($events);
        $event = array_pop($events);
        $this->app->render('backend/login/index.twig',[
            'event' => $event,
            'error' => $error
        ]);
    }








}