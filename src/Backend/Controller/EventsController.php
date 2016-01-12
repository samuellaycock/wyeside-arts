<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Controller\AppController;
use App\Model\Entity\Event;
use App\Model\Repo\EventRepo;
use App\Model\Repo\GenreRepo;
use App\Pagination\Pagination;
use Doctrine\ORM\EntityManager;


class EventsController extends AppController
{

    /**
     * @return EventRepo
     */
    protected function getEventRepo()
    {
        return $this->em->getRepository('App\Model\Entity\Event');
    }

    /**
     * @return GenreRepo
     */
    protected function getGenreRepo()
    {
        return $this->em->getRepository('App\Model\Entity\Genre');
    }



    public function indexAction()
    {
        if(null !== $this->app->request->get('page')){
            $page = $this->app->request->get('page');
        }else{
            $page = 1;
        }

        $pageinator = new Pagination($this->getEventRepo()->getQueryAllSortedByDateCreated(), $this->app->request->getResourceUri());
        $data = ['eventsPaginated' => $pageinator->getPage($page)];

        if($this->app->request->isAjax()) {
            $this->app->render('backend/events/_events-table.twig', $data);
        }else{
            $this->app->render('backend/events/index.twig', $data);
        }
    }


    public function createAction()
    {
        $type = $this->app->router->getCurrentRoute()->getParam('type');
        $event = new Event();
        $event->setType($type);

        $data = [
            'event' => $event,
            'genres' => $this->getGenreRepo()->getAllSortedByName()
        ];

        $this->app->render('backend/events/create.twig',$data);
    }

}