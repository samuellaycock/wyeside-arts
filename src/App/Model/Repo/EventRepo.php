<?php

namespace App\Model\Repo;


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

}