<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Controller\AppController;
use App\Model\Entity\Event;
use App\Model\Repo\EventRepo;
use App\Util\ImageUploader;

class EventImagesController extends AppController
{

    /**
     * @return EventRepo
     */
    protected function getEventRepo()
    {
        return $this->em->getRepository('App\Model\Entity\Event');
    }


    public function bannerAction()
    {
        $id = $this->app->router->getCurrentRoute()->getParam('id');
        $event = $this->getEventRepo()->find($id);
        $event->removeCurrentBannerIfExists();

        $uploader = new ImageUploader($_FILES['file']['tmp_name'], $_FILES['file']['name']);
        $uploader->fit(1920, 800);
        $filename = $uploader->save(APP_DIR . '/web/event-assets/images/', $this->chooseNewImageName($event));

        $event->setBanner($filename);
        $this->em->persist($event);
        $this->em->flush();
        $this->app->render('backend/events/_partials/banner-image.twig', [
            'event' => $event,
            'imageReload' => true
        ]);
    }


    /**
     * @param Event $event
     * @return string
     */
    protected function chooseNewImageName(Event $event)
    {
        $now = new \DateTime();
        return 'banner-' . $event->getTitle() . '-' . $now->format('Ymdhis');
    }
}