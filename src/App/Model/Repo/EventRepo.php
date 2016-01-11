<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Repo;


use App\Model\Entity\Event;
use Doctrine\ORM\EntityRepository;


class EventRepo extends EntityRepository
{

    /**
     * @return array
     */
    public function getGenres(){
        return $this->createQueryBuilder('e')
            ->select('e.id, e.title')
            ->getQuery()->getArrayResult();

    }


    /**
     * @return Event[]
     */
    public function getAllSortedByTitle()
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.title')
            ->getQuery()->getResult();
    }

}