<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Controller\AppController;
use App\Model\Repo\EventRepo;
use App\Pagination\Pagination;
use Doctrine\ORM\EntityManager;


class EventsController extends AppController
{

    /**
     * @return EventRepo
     */
    protected function getEventRepo()
    {
        /** @var EntityManager $em */
        $em = $this->app->container->get('em');
        return $em->getRepository('App\Model\Entity\Event');
    }


    public function indexAction()
    {
        if(null !== $this->app->request->get('page')){
            $page = $this->app->request->get('page');
        }else{
            $page = 1;
        }

        $pageinator = new Pagination($this->getEventRepo()->getQueryAllSortedByTitle(), $this->app->request->getResourceUri());
        $data = ['eventsPaginated' => $pageinator->getPage($page)];

        if($this->app->request->isAjax()) {
            $this->app->render('backend/events/_events-table.twig', $data);
        }else{
            $this->app->render('backend/events/index.twig', $data);
        }
    }

}