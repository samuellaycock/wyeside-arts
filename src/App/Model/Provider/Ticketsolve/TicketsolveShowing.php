<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Provider\Ticketsolve;

use App\Model\Provider\Entity\AbstractShowing;

/**
 * Class TicketsolveModel
 * @package App\Model\Provider\Ticketsolve
 */
class TicketsolveShowing extends AbstractShowing
{

    /**
     * TicketsolveShowing constructor.
     * @param \SimpleXMLElement $data
     */
    public function __construct(\SimpleXMLElement $data)
    {
        $this->showingId = (string)$this->getDataValue($data, 'id', '');

        $this->time = new \DateTime(
            (string)$this->getDataValue($data, 'date', '')
        );
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

}