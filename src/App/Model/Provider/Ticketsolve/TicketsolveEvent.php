<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Provider\Ticketsolve;

use App\Model\Provider\Entity\AbstractEvent;

/**
 * @author james.dobb@gmail.com
 */
class TicketsolveEvent extends AbstractEvent
{

    /**
     * TicketsolveEvent constructor.
     * @param \SimpleXMLElement $data
     */
    public function __construct(\SimpleXMLElement $data)
    {
        $this->eventId = (string)$this->getDataValue($data, 'id');
        $this->name = (string)$this->getDataValue($data, 'name', '');
        $this->description = (string)$this->getDataValue($data, 'long_description', '');
        $this->category = (string)$this->getDataValue($data, 'category', '');

        foreach ($this->getDataValue($data, 'upcoming_events')->event as $showing) {
            $this->showings[] = new TicketsolveShowing($showing);
        }
    }

    /***
     * @param $data
     * @param $key
     * @param null $default
     * @return mixed
     */
    protected function getDataValue($data, $key, $default = null)
    {
        if (isset($data->{$key})) {
            return $data->{$key};
        }
        return $default;
    }


    /**
     * @return array
     */
    public function view()
    {
        return [
            'eventId' => $this->eventId,
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category
        ];
    }

}