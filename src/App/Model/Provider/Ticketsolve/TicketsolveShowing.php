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
        $this->showingId = trim((string)$this->getAttributeValue($data, 'id', ''));

        $this->time = new \DateTime(
            trim((string)$this->getDataValue($data, 'date_time_iso', ''))
        );

        $location = trim($this->getDataValue($data, 'venue_layout', ''));
        switch($location){
            case "Castle Cinema":
                $this->location = 0;
                break;
            case "Market Theatre":
                $this->location = 1;
                break;
            case "Gallery":
                $this->location = 2;
                break;
            default:
                $this->location = null;
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
     * @param $data
     * @param $key
     * @param null $default
     * @return mixed
     */
    protected function getAttributeValue($data, $key, $default = null)
    {
        if(isset($data->attributes()->{$key})){
            return $data->attributes()->{$key};
        }
        return $default;
    }


}