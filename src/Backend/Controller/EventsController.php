<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Hydrator;
use App\Model\Entity\Genre;
use App\Model\Entity\Event;
use App\Model\Provider\Ticketsolve;
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
        foreach($genres as $genre){
            $keyName = 'genre-' . $genre->getId();
            if(null !== $this->app->request->post($keyName)){
                $event->addGenre($genre);
            }
        }
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


    public function editAction()
    {
        $id = $this->app->router->getCurrentRoute()->getParam('id');
        $event = $this->getEventRepo()->find($id);
        $genres = $this->getGenreRepo()->getAllSortedByName();


        if($this->app->request->isPost()){
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

        if($this->app->request->isPost()){
            $hydrator = new Hydrator;
            $hydrator->hydrate($event, $this->app->request->params());
            $this->updateEventGenres($genres, $event);
            $event->setCreatedTs(new \DateTime());
            $this->em->persist($event);
            $this->em->flush();
            $this->app->redirect('/system/events', 302);
        }

        $data = [
            'event' => $event,
            'genres' => $genres
        ];

        $this->app->render('backend/events/create.twig',$data);
    }



    public function importAction()
    {
        $feed = new Ticketsolve();
        $data = $feed->downloadFeed();
        $this->app->render('backend/events/import.twig', ['data' => $data]);
    }

}