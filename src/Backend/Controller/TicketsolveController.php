<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;

use App\Hydrator;
use App\Model\Entity\Event;
use App\Model\Entity\Showing;
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

        foreach ($event->getShowings() as $showing) {
            $this->em->remove($showing);
        }
        $this->em->flush();

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
     *
     */
    public function getEventsNotSyncedAjaxAction()
    {
        $provider = new TicketsolveProvider();
        $events = $provider->eventsNotSynced($this->getEventRepo());

        $view = [];
        foreach ($events as $event) {
            $view[] = $event->view();
        }

        $response = $this->app->response();
        $response->header('Content-Type', 'application/json');
        $response->body(json_encode($view));
    }


    /**
     * Updates Ticketsolve references
     */
    public function updateEventTsAction()
    {
        $event = $this->getEventRepo()->find($this->app->request->post('eventId'));
        $event->setTicketsolve($this->app->request->post('ticketsolveId', $event->getTicketsolve()));
        $event->setTicketsolve3D($this->app->request->post('ticketsolveId3D', $event->getTicketsolve3D()));
        $this->em->persist($event);
        $this->em->flush();

        $response = $this->app->response();
        $response->header('Content-Type', 'application/json');
        $response->body(json_encode([
            'ticketsolveId' => $event->getTicketsolve(),
            'ticketsolveId3D' => $event->getTicketsolve3D()
        ]));
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