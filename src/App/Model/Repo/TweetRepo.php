<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Repo;

use Doctrine\ORM\EntityRepository;

/**
 * @package App\Model\Repo
 * @author James Dobb <james.dobb@gmail.com>
 */
class TweetRepo extends EntityRepository
{

    public function getLatestTweet()
    {
        return $this->findOneBy([]);
    }


}