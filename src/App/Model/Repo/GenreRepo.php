<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Repo;


use Doctrine\ORM\EntityRepository;
use App\Model\Entity\Genre;


class GenreRepo extends EntityRepository
{


    /**
     * @return Genre[]
     */
    public function getAllSortedByName()
    {
        return $this->createQueryBuilder('g')
            ->orderBy('g.name')->getQuery()->getResult();
    }


}