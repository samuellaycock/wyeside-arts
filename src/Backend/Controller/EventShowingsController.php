<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Hydrator;
use App\Model\Entity\Showing;
use App\Model\Repo\EventRepo;
use App\Model\Repo\ShowingRepo;

/**
 * Class EventShowingsController
 * @package Backend\Controller
 */
class EventShowingsController extends BackendController
{

    /**
     * @return EventRepo
     */
    protected function getEventRepo()
    {
        return $this->em->getRepository('App\Model\Entity\Event');
    }

    /**
     * @return ShowingRepo
     */
    protected function getShowingRepo()
    {
        return $this->em->getRepository('App\Model\Entity\Showing');
    }


    /**
     *
     */
    public function createShowingsAction()
    {
        $id = $this->app->router->getCurrentRoute()->getParam('id');
        $event = $this->getEventRepo()->find($id);

        $showing = new Showing;
        $showing->setTs(
            \DateTime::createFromFormat('Y-m-d H:i',
                $this->app->request->post('showingDate') . ' ' . $this->app->request->post('showingTime')
            )
        );
        $showing->setLocation($this->app->request->post('showingLocation'));
        $showing->setType($this->app->request->post('showingType'));

        $event->addShowing($showing);
        $this->em->persist($showing);
        $this->em->flush();

        $this->app->render('backend/events/_partials/event-showings-table.twig', ['event' => $event]);
    }



    public function deleteShowingAction()
    {
        $id = $this->app->router->getCurrentRoute()->getParam('id');
        $showing = $this->getShowingRepo()->find($id);
        $event = $showing->getEvent();
        $this->em->remove($showing);
        $this->em->flush();
        $this->app->render('backend/events/_partials/event-showings-table.twig', ['event' => $event]);
    }


    public function editShowingAction()
    {
        $id = $this->app->router->getCurrentRoute()->getParam('id');
        $showing = $this->getShowingRepo()->find($id);
        $hydrator = new Hydrator();
        $hydrator->hydrate($showing, $this->app->request->params());
        $this->em->persist($showing);
        $this->em->flush($showing);
    }

}