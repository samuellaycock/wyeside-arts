<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Model\Repo\EventRepo;
use App\Model\Repo\UserRepo;
use App\Model\Entity\User;

/**
 * Class LoginController
 * @package Backend\Controller
 */
class LoginController extends BackendController
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


    protected function login(User $user)
    {
        $_SESSION['wyeside-user'] = $user;
    }


    public function loginAction()
    {
        $error = null;

        if($this->app->request->isPost()){
            $username = $this->app->request->post('username');
            $password = $this->app->request->post('password');
            $user = $this->getUserRepo()->findByUsernameOrEmail($username);
            if($user && $user->validatePassword($password)){
                $this->login($user);
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


    public function logoutAction()
    {
        unset($_SESSION['wyeside-user']);
        $this->app->redirect('/system/login', 302);
    }








}