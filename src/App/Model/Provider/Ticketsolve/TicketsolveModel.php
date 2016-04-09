<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Provider\Ticketsolve;

/**
 * Class TicketsolveModel
 * @package App\Model\Provider\Ticketsolve
 */
class TicketsolveModel
{

    /** @var \SimpleXMLElement */
    protected $data;


    /**
     * TicketsolveModel constructor.
     * @param \SimpleXMLElement $data
     */
    public function __construct(\SimpleXMLElement $data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getTicketsolveId()
    {
        return (string)$this->data->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return (string)$this->data->name;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return (string)$this->data->category;
    }


    protected function chooseAction()
    {
        /**
         * options:
         *  - Find an existing event that looks like a match
         *  - Suggest Creating a new event
         *  - Do Nothing
         *
         * Look at similar events (we might want to combine 2d and 3d events)
         */
        
        
        
        
    }



    /**
     * @param \SimpleXMLElement $show
     * @return Event
     */
    /*
    protected function buildEvent(\SimpleXMLElement $show)
    {
        //todo:event number
        $event = new Event();
        $event->setTicketsolve((string)$show->id);
        $event->setTitle(trim((string)$show->name));
        $event->setType((string)$show->event_category); //todo convert to db int
        $event->setDescription((string)$show->long_description);

        if(isset($show->upcoming_events->event)) {
            foreach ($show->upcoming_events->event as $showingData) {
                $showing = new Showing();
                $showing->setTs(new \DateTime($showingData->date));
                $event->addShowing($showing);
            }
        }

        return $event;
    }*/

}