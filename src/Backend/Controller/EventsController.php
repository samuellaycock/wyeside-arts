<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Controller\AppController;
use App\Model\Repo\EventRepo;
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
        $data = [
          'events' => $this->getEventRepo()->getAllSortedByTitle()
        ];

        $this->app->render('backend/events/index.twig', $data);
    }

}