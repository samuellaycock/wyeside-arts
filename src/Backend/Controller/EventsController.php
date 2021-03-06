<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Hydrator;
use App\Model\Entity\Genre;
use App\Model\Entity\Event;
use App\Model\Entity\Showing;
use App\Model\Provider\Ticketsolve;
use App\Model\Provider\TicketsolveProvider;
use App\Model\Repo\EventRepo;
use App\Model\Repo\GenreRepo;
use App\Model\Repo\ShowingRepo;
use App\Pagination\Pagination;

/**
 * Class EventsController
 * @package Backend\Controller
 */
class EventsController extends BackendController
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
     * @param Genre[] $genres
     * @param Event $event
     */
    protected function updateEventGenres(array $genres, Event $event)
    {
        $event->clearGenres();
        foreach ($genres as $genre) {
            $keyName = 'genre-' . $genre->getId();
            if (null !== $this->app->request->post($keyName)) {
                $event->addGenre($genre);
            }
        }
    }


    public function indexAction()
    {
        if (null !== $this->app->request->get('page')) {
            $page = $this->app->request->get('page');
        } else {
            $page = 1;
        }

        if(null !== $this->app->request->get('search')){
            $search = $this->app->request->get('search');
        }else{
            $search = "";
        }
        
        $queryBuilder = $this->getEventRepo()->getQueryBuilder();
        $query = $queryBuilder
            ->where($queryBuilder->expr()->like('e.title', ':title'))
            ->orderBy('e.createdTs', 'DESC')
            ->setParameter('title', '%' . $search . '%')->getQuery();
        
        $pageinator = new Pagination($query, $this->app->request->getResourceUri());
        $data = ['eventsPaginated' => $pageinator->getPage($page)];
        
        if ($this->app->request->isAjax()) {
            $this->app->render('backend/events/_events-table.twig', $data);
        } else {
            $this->app->render('backend/events/index.twig', $data);
        }
    }


    public function editAction()
    {
        $id = $this->app->router->getCurrentRoute()->getParam('id');
        $event = $this->getEventRepo()->find($id);
        $genres = $this->getGenreRepo()->getAllSortedByName();


        if ($this->app->request->isPost()) {
            $hydrator = new Hydrator;
            $hydrator->hydrate($event, $this->app->request->params());
            $this->updateEventGenres($genres, $event);
            $this->em->persist($event);
            $this->em->flush();
        }

        $data = [
            'event' => $event,
            'genres' => $genres
        ];

        $this->app->render('backend/events/edit.twig', $data);
    }


    public function updateStatusAction()
    {
        $id = $this->app->router->getCurrentRoute()->getParam('id');
        $event = $this->getEventRepo()->find($id);
        $status = $this->app->router->getCurrentRoute()->getParam('status');

        $event->setStatus($status);
        $this->em->persist($event);
        $this->em->flush();
    }


    public function createAction()
    {
        $type = $this->app->router->getCurrentRoute()->getParam('type');
        $event = new Event();
        $event->setType($type);
        $genres = $this->getGenreRepo()->getAllSortedByName();

        if ($this->app->request->isPost()) {
            $hydrator = new Hydrator;
            $hydrator->hydrate($event, $this->app->request->params());

            $ts = $this->app->request->post('ticketsolveIdCreate');
            if(strlen($ts) > 1){
                $event->setTicketsolve($ts);
            }
            $ts = $this->app->request->post('ticketsolveIdCreate3D');
            if(strlen($ts) > 1){
                $event->setTicketsolve3D($ts);
            }

            $this->updateEventGenres($genres, $event);
            $event->setCreatedTs(new \DateTime());

            $this->em->persist($event);

            $provider = new TicketsolveProvider();

            $tsEvent = $provider->eventByEventId($event->getTicketsolve());
            if ($tsEvent) {
                foreach ($tsEvent->showings() as $tsShowing) {
                    $showing = new Showing();
                    $showing->setTicketsolveIt($tsShowing->showingId());
                    $showing->setType("2D");
                    $showing->setTs($tsShowing->time());
                    $showing->setLocation($tsShowing->location());
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
                    $showing->setLocation($tsShowing->location());
                    $event->addShowing($showing);
                    $this->em->persist($showing);
                }
            }

            $this->em->flush();
            $this->app->redirect('/system/events', 302);
        }

        $data = [
            'event' => $event,
            'genres' => $genres
        ];

        $this->app->render('backend/events/create.twig', $data);
    }


    /**
     *
     */
    public function deleteEventAction()
    {
        $event = $this->getEventRepo()->find($this->app->request->post('eventId'));
        foreach($event->getImages() as $image){
            $this->em->remove($image);
        }
        foreach($event->getGenres() as $genre){
            $this->em->remove($genre);
        }
        foreach($event->getShowings() as $showing){
            $this->em->remove($showing);
        }
        $this->em->remove($event);
        $this->em->flush();

        $this->app->redirect('/system/events');
    }
    

}