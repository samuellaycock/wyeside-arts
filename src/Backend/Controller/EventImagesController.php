<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Model\Repo\EventRepo;
use App\Model\Repo\ImageRepo;

/**
 * Class EventImagesController
 * @package Backend\Controller
 */
class EventImagesController extends BackendController
{

    /**
     * @return EventRepo
     */
    protected function getEventRepo()
    {
        return $this->em->getRepository('App\Model\Entity\Event');
    }

    /**
     * @return ImageRepo
     */
    protected function getImageRepo()
    {
        return $this->em->getRepository('App\Model\Entity\Image');
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




}