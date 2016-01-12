<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Controller\AppController;
use App\Model\Repo\EventRepo;
use App\Pageinator\Pageinator;
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
        $pageinator = new Pageinator($this->getEventRepo()->getQueryAllSortedByTitle());
        $data = [
          'page' => $pageinator->getPage(1)
        ];
        $this->app->render('backend/events/index.twig', $data);
    }

}