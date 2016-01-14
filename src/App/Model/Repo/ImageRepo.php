<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Repo;


use App\Model\Entity\Image;
use Doctrine\ORM\EntityRepository;


class ImageRepo extends EntityRepository
{

    /**
     * @param mixed $id
     * @param null $lockMode
     * @param null $lockVersion
     * @return Image|null
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        return parent::find($id, $lockMode = null, $lockVersion = null);
    }



}