<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Controller\AppController;
use App\Hydrator;
use App\Model\Entity\Genre;
use App\Model\Entity\Event;
use App\Model\Repo\EventRepo;
use App\Model\Repo\GenreRepo;
use App\Model\Repo\ImageRepo;
use App\Pagination\Pagination;


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

    /**
     * @return ImageRepo
     */
    protected function getImageRepo()
    {
        return $this->em->getRepository('App\Model\Entity\Image');
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



    public function getImagesAction()
    {
        $id = $this->app->router->getCurrentRoute()->getParam('id');
        $event = $this->getEventRepo()->find($id);
        $this->app->render('backend/events/_partials/event-images.twig', ['event' => $event]);
    }


    public function deleteImageAction()
    {
        $id = $this->app->router->getCurrentRoute()->getParam('id');
        $image = $this->getImageRepo()->find($id);
        $event = $image->getEvent();
        $this->em->remove($image);
        $this->em->flush();
        $this->app->render('backend/events/_partials/event-images.twig', ['event' => $event]);
    }

    public function setImageMainAction()
    {
        $id = $this->app->router->getCurrentRoute()->getParam('id');
        $image = $this->getImageRepo()->find($id);
        $event = $image->getEvent();
        foreach($event->getImages() as $i){
            if($i == $image){
                $i->setIsMain(1);
            }else{
                $i->setIsMain(0);
            }
            $this->em->persist($i);
        }
        $this->em->flush();
        $this->app->render('backend/events/_partials/event-images.twig', ['event' => $event]);
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

}