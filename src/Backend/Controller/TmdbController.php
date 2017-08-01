<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;

use App\Hydrator;
use App\Model\Entity\Event;
use App\Model\Entity\Image;
use App\Model\Entity\Showing;
use App\Model\Provider\TicketsolveProvider;
use App\Model\Repo\EventRepo;
use App\Model\Repo\GenreRepo;
use App\Model\Repo\ShowingRepo;
use App\Model\Tmdb\TmdbClientFactory;
use App\Util\ImageUploader;
use App\Util\StringUtil;
use Tmdb\Repository\MovieRepository;


/**
 * @author james.dobb@gmail.com
 */
class TmdbController extends BackendController
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


    public function findBackdropImagesAction()
    {
        $event = $this->getEventRepo()->find($this->app->request->post('eventId'));

        $tmdb = TmdbClientFactory::build();
        $searchClient = $tmdb->getSearchApi();
        $results = $searchClient->searchMovies($event->getTitle());
        $resultId = (int)reset($results['results'])['id'];

        $tmpdbRepo = new MovieRepository($tmdb);
        $movie = $tmpdbRepo->load($resultId);

        /** @var \Tmdb\Model\Collection\Images $backdrops */
        $backdrops = $movie->getImages()->filterBackdrops();

        $rtn = [
            'tmdbId' => $resultId,
            'images' => []
        ];

        /** @var \Tmdb\Model\Image\BackdropImage $image */
        foreach ($backdrops->getImages() as $image) {
            $rtn['images'][] = TmdbClientFactory::IMG_PREFIX . $image->getFilePath();
        }

        $response = $this->app->response();
        $response->header('Content-Type', 'application/json');
        $response->body(json_encode($rtn));
    }


    public function copyImageAction()
    {
        $event = $this->getEventRepo()->find($this->app->request->post('eventId'));

        $filename = $this->chooseNewImageName($event);
        $tempFilename = '/tmp/' . $filename;
        copy($this->app->request->post('imageSource'), $tempFilename);

        $uploader = new ImageUploader($tempFilename, $this->app->request->post('imageSource'));
        $uploader->fit(1920, 800);
        $filename = $uploader->save(APP_DIR . '/web/event-assets/images/', $filename);
        $uploader->fit(480, 200);
        $uploader->save(APP_DIR . '/web/event-assets/thumbnails/', $filename, false);

        $eventImage = new Image();
        $eventImage->setName($filename);
        $event->addImage($eventImage);
        $this->em->persist($eventImage);

        $this->em->flush();
    }

    /**
     * @param Event $event
     * @return string
     */
    protected function chooseNewImageName(Event $event)
    {
        $now = new \DateTime();
        return $event->getTitle() . '-' . $now->format('Ymdhis') . '-tmdb' . StringUtil::genRndStr(8);
    }

}