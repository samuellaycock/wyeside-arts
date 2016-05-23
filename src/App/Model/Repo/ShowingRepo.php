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
     * @return Showing[]
     */
    public function getAllSortedByDate()
    {
        return $this->_em->createQuery('
          SELECT s FROM App\Model\Entity\Showing s
          WHERE s.ts >= CURRENT_DATE()
          ORDER BY s.ts ASC
      ')->getResult();
    }

}
