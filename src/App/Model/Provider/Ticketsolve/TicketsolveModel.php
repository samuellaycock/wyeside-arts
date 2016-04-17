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


    /**
     * @return array
     */
    public function view()
    {
        $modelView = [
            'ticketsolve' => (string)$this->getDataValue('id'),
            'title' => trim((string)$this->getDataValue('name'), "\r\n "),
            'description' => htmlentities(trim((string)$this->getDataValue('long_description'), "\r\n ")),
        ];

        $modelView['showings'] = [];
        foreach($this->getDataValue('upcoming_events', [])->event as $upcomingShowing){
            $date = new \DateTime((string)$upcomingShowing->date);
            $modelView['showings'][] = [
                'date' => $date->format('Y-m-d H:i:s')
            ];
        }

        return $modelView;
    }

    /**
     * @param $key
     * @param null $default
     * @return null|\SimpleXMLElement[]
     */
    protected function getDataValue($key, $default = null)
    {
        if(isset($this->data->{$key})){
            return $this->data->{$key};
        }
        return $default;
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