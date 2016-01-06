<?php

namespace Frontend\Controller;


use App\Controller\AppController;
use App\Model\Tweet;


class IndexController extends AppController
{

    public function indexAction()
    {
        /** @var Tweet $tweet */
        $tweet = $this->di->offsetGet('em')->find('App\Model\Tweet', 1120256);
        $tweet->setText('Testing The Tweet');
        $this->di->offsetGet('em')->persist($tweet);
        $this->di->offsetGet('em')->flush();
        $this->writeView('frontend/index.twig');
    }

}