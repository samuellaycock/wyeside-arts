<?php

namespace App\Model\Repo;


use App\Model\Entity\Config;
use Doctrine\ORM\EntityRepository;
/**
 * @author james.dobb@gmail.com
 */
class ConfigRepo extends EntityRepository
{

    /**
     * @param mixed $id
     * @param null $lockMode
     * @param null $lockVersion
     * @return null|Config
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        return parent::find($id, $lockMode = null, $lockVersion = null);
    }

    /**
     * @param $name
     * @return null|Config
     */
    public function findOneByName($name)
    {
        return $this->findOneBy(['name' => $name]);
    }

}
