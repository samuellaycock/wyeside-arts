<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Repo;


use App\Model\Entity\Event;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;


class EventRepo extends EntityRepository
{

    /**
     * @param mixed $id
     * @param null $lockMode
     * @param null $lockVersion
     * @return Event|null
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        return parent::find($id, $lockMode = null, $lockVersion = null);
    }


    /**
     * @return array
     */
    public function getGenres(){
        return $this->createQueryBuilder('e')
            ->select('e.id, e.title')
            ->getQuery()->getArrayResult();

    }


    /**
     * @return Query
     */
    public function getQueryAllSortedByTitle()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.title')
            ->getQuery();
    }


    /**
     * @return Query
     */
    public function getQueryAllSortedByDateCreated()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.createdTs', 'DESC')
            ->getQuery();
    }


    /**
     * @return Event[]
     */
    public function getXUpcoming($num)
    {
        return $this->_em->createQuery('
            SELECT DISTINCT e FROM App\Model\Entity\Event e
            LEFT JOIN App\Model\Entity\Showing s WHERE e.id=s.event
            WHERE e.status = 1
            AND s.ts >= CURRENT_DATE()
            ORDER BY s.ts ASC
        ')->setMaxResults($num)->getResult();
    }


    /**
     * @param $ticketsolveId
     * @return bool
     */
    public function eventExistsForTicketsolve($ticketsolveId)
    {
        $results = $this->_em->createQuery('
            SELECT e FROM App\Model\Entity\Event e
            WHERE e.ticketsolve = :ticketsolve
            OR e.ticketsolve3D = :ticketsolve
        ')->setParameters([
            'ticketsolve' => $ticketsolveId,
        ])->setMaxResults(1)->execute();

        if(count($results) == 0){
            return false;
        }
        return true;
    }
}