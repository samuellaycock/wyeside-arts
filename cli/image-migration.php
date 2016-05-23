<?php

require './_bootstrap.php';

CONST IMAGE_DIR = APP_DIR . '/web/event-assets/images/';
CONST THUMBNAIL_DIR = APP_DIR . '/web/event-assets/thumbnails/';

echo "Migrating Images..." . PHP_EOL;

/** @var \App\Model\Repo\EventRepo $eventRepo */
$eventRepo = $em->getRepository(\App\Model\Entity\Event::class);

/** @var \App\Model\Entity\Event[] $events */
$events = $eventRepo->findAll();
$totalEvents = count($events);

$doneEvents = 0;
$doneImages = 0;
foreach ($events as $event) {

    foreach($event->getImages() as $image){
        try {
            $uploader = new \App\Util\ImageUploader(IMAGE_DIR . $image->getName() . $image->getExt(), $image->getName() . $image->getExt());
            $uploader->fit(1920, 800);
            $filename = $uploader->save(IMAGE_DIR, $image->getName() . $image->getExt(), false);
            $uploader->fit(480, 200);
            $uploader->save(THUMBNAIL_DIR, $filename, false);
            $doneImages++;
        }catch(\Exception $e){
            //
        }
    }


    if (strlen($event->getBanner()) > 1) {

        try {
            $image = $event->getBanner();
            $ext = $event->getBannerExt();

            $uploader = new \App\Util\ImageUploader(IMAGE_DIR . $image . $ext, $image . $ext);
            $uploader->fit(1920, 800);
            $filename = $uploader->save(IMAGE_DIR, $image . $ext, false);
            $uploader->fit(480, 200);
            $uploader->save(THUMBNAIL_DIR, $filename, false);
            $doneImages++;

            $eventImage = new \App\Model\Entity\Image();
            $eventImage->setName($image);
            $eventImage->setExt($ext);
            $eventImage->setIsMain(1);
            $event->addImage($eventImage);
            foreach ($event->getImages() as $image) {
                if ($eventImage != $image) {
                    $image->setIsMain(0);
                    $em->persist($image);
                }
            }
            $em->persist($eventImage);

            $event->setBanner('');
            $event->setBannerExt('');
            $em->persist($event);
            $em->flush();
        }catch(\Exception $e){
            //
        }
    }

    $doneEvents++;
    echo "Updated " . $doneEvents . " of " . $totalEvents . " Events"
        . " (" . number_format(floor($doneEvents / $totalEvents * 100), 0) . "%) / "
        . $doneImages . " Images...\r";

}

echo PHP_EOL . "Done!" . PHP_EOL;