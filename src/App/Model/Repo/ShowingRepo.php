<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Repo;


use Doctrine\ORM\EntityRepository;
use App\Model\Entity\Showing;


/**
 * Class ShowingRepo
 * @package App\Model\Repo
 */
class ShowingRepo extends EntityRepository
{


    /**
     * @param mixed $id
     * @param null $lockMode
     * @param null $lockVersion
     * @return Showing|null
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        return parent::find($id, $lockMode = null, $lockVersion = null);
    }

}