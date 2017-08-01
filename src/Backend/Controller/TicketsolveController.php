<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Hydrator;
use App\Model\Entity\Event;
use App\Model\Provider\Ticketsolve;
use App\Model\Repo\EventRepo;
use App\Model\Repo\GenreRepo;
use App\Model\Repo\ShowingRepo;


/**
 * Class EventsController
 * @package Backend\Controller
 */
class TicketsolveController extends BackendController
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
     * @return GenreRepo
     */
    protected function getGenreRepo()
    {
        return $this->em->getRepository('App\Model\Entity\Genre');
    }


    public function importAction()
    {
        $eventRepo = $this->getEventRepo();

        if ($this->app->request->isAjax()) {
            $feed = new Ticketsolve(null, $eventRepo);
            $models = $feed->downloadFeedModels();

            $unSyncedEvents = [];
            $syncedEvents = [];
            foreach ($models as $model) {
                if ($eventRepo->eventExistsForTicketsolve($model->getTicketsolveId())) {
                    $syncedEvents[] = $model->view();
                } else {
                    $unSyncedEvents[] = $model->view();
                }
            }

            header("Content-Type: application/json");
            echo json_encode([
                'syncedEvents' => $syncedEvents,
                'unSyncedEvents' => $unSyncedEvents
            ]);
            exit;
        } else {
            $this->app->render('backend/events/import.twig', []);
        }
    }


    public function createAction()
    {
        $event = new Event();
        $hydrator = new Hydrator();
        $hydrator->hydrate($event, $this->app->request->params());
        $event->setCreatedTs(new \DateTime());
        $this->em->persist($event);
        $this->em->flush();
    }


}