<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Provider\Action;
use App\Model\Provider\Ticketsolve\TicketsolveModel;

/**
 * Class AlreadySyncedAction
 * @package App\Model\Provider\Action
 */
class AlreadySyncedAction implements ActionInterface
{

    /** @var TicketsolveModel */
    protected $ticketsolveModel;


    /**
     * AlreadySyncedAction constructor.
     * @param TicketsolveModel $model
     */
    public function __construct(TicketsolveModel $model)
    {
        $this->ticketsolveModel = $model;
    }

    /**
     * @return TicketsolveModel
     */
    public function getModel()
    {
        return $this->ticketsolveModel;
    }

    /**
     * @return string
     */
    public function getActionValue()
    {
        return "";
    }

    /**
     * @return string
     */
    public function getActionText()
    {
        return "Already Synced";
    }

}