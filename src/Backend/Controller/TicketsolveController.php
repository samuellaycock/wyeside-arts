<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Hydrator;
use App\Model\Entity\Event;
use App\Model\Entity\Showing;
use App\Model\Provider\Ticketsolve;
use App\Model\Provider\TicketsolveProvider;
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


    /**
     * Syncs and existing event's 2D ticketsolve reference
     */
    public function syncEventsDatesAction()
    {
        $event = $this->getEventRepo()->find($this->app->request->post('eventId'));

        $provider = new TicketsolveProvider();

        $tsEvent = $provider->eventByEventId($event->getTicketsolve());
        if ($tsEvent) {
            foreach ($tsEvent->showings() as $tsShowing) {
                $showing = new Showing();
                $showing->setTicketsolveIt($tsShowing->showingId());
                $showing->setType("2D");
                $showing->setTs($tsShowing->time());
                $event->addShowing($showing);
                $this->em->persist($showing);
            }
        }

        $tsEvent = $provider->eventByEventId($event->getTicketsolve3D());
        if ($tsEvent) {
            foreach ($tsEvent->showings() as $tsShowing) {
                $showing = new Showing();
                $showing->setTicketsolveIt($tsShowing->showingId());
                $showing->setType("3D");
                $showing->setTs($tsShowing->time());
                $event->addShowing($showing);
                $this->em->persist($showing);
            }
        }

        $this->em->flush();

        $this->app->render('backend/events/_partials/event-showings-table.twig', ['event' => $event]);
    }


    /**
     * public function importAction()
     * {
     * $eventRepo = $this->getEventRepo();
     *
     * if ($this->app->request->isAjax()) {
     * $feed = new Ticketsolve(null, $eventRepo);
     * $models = $feed->downloadFeedModels();
     *
     * $unSyncedEvents = [];
     * $syncedEvents = [];
     * foreach ($models as $model) {
     * if ($eventRepo->eventExistsForTicketsolve($model->getTicketsolveId())) {
     * $syncedEvents[] = $model->view();
     * } else {
     * $unSyncedEvents[] = $model->view();
     * }
     * }
     *
     * header("Content-Type: application/json");
     * echo json_encode([
     * 'syncedEvents' => $syncedEvents,
     * 'unSyncedEvents' => $unSyncedEvents
     * ]);
     * exit;
     * } else {
     * $this->app->render('backend/events/import.twig', []);
     * }
     * }
     * */


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