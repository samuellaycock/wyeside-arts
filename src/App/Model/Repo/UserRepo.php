<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Repo;


use Doctrine\ORM\EntityRepository;
use App\Model\Entity\User;


class UserRepo extends EntityRepository
{


    /**
     * @param $username
     * @return User|null
     */
    public function findByUsernameOrEmail($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username=:username')
            ->orWhere('u.email=:email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }



}