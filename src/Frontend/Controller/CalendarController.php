<?php
/**
 * @author Samuel Laycock <samuel.paul.laycock@gmail.com>
 */

namespace Frontend\Controller;

/**
 * Class CalendarController
 * @package Frontend\Controller
 */
class CalendarController extends FrontendController
{

    public function CalendarAction()
    {
        $showings = $this->getShowingsRepo()->getAllSortedByDate();
        $organised = [];
        foreach($showings as $showing){
            $keyDate = $showing->getTs()->format('Y-m-d');
            if(!isset($organised[$keyDate])){
                $organised[$keyDate] = [];
            }
            $organised[$keyDate][] = $showing;
        }

        $this->app->render('frontend/calendar/index.twig', [
            'days' => $organised
        ]);
    }

}
