<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Model\Entity\Event;
use App\Model\Entity\Image;
use App\Model\Repo\EventRepo;
use App\Util\ImageUploader;
use App\Util\StringUtil;

/**
 * Class EventUploadsController
 * @package Backend\Controller
 */
class EventUploadsController extends BackendController
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
        $filename = $uploader->save(APP_DIR . '/web/event-assets/images/', 'banner-' . $this->chooseNewImageName($event));

        $event->setBanner($filename);
        $this->em->persist($event);
        $this->em->flush();
        $this->app->render('backend/events/_partials/banner-image.twig', [
            'event' => $event,
            'imageReload' => true
        ]);
    }


    public function imageAction()
    {
        $id = $this->app->router->getCurrentRoute()->getParam('id');
        $event = $this->getEventRepo()->find($id);

        foreach($_FILES['file']['name'] as $key => $file){
            $uploader = new ImageUploader($_FILES['file']['tmp_name'][$key], $_FILES['file']['name'][$key]);
            $filename = $uploader->save(APP_DIR . '/web/event-assets/images/', $this->chooseNewImageName($event) . '-' . StringUtil::genRndStr(8));
            $uploader->fit(300, 300);
            $uploader->save(APP_DIR . '/web/event-assets/thumbnails/', $filename, false);
            $eventImage = new Image;
            $eventImage->setName($filename);
            $event->addImage($eventImage);
            $this->em->persist($eventImage);
        }

        $this->em->flush();

        $this->app->render('backend/events/_partials/event-images-response.twig', [
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
        return $event->getTitle() . '-' . $now->format('Ymdhis');
    }
}