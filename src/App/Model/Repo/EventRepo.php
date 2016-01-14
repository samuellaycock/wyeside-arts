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
}