<?php

namespace App\Pageinator;


use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePageinator;


class Pageinator
{

    /** @var Pageinator */
    protected $doctrinePageinator;

    /** @var int */
    protected $defaultPerPage;

    /** @var int */
    protected $results;


    /**
     * Pageinator constructor.
     * @param Query $query
     */
    public function __construct(Query $query)
    {
        $this->query = $query;
        $this->doctrinePageinator = new DoctrinePageinator($query);
        $this->defaultPerPage = 20;
    }


    /**
     * @param $page
     * @param $perPage
     * @return Result
     */
    public function getPage($page, $perPage = false)
    {
        if(false === $perPage){
            $perPage = $this->defaultPerPage;
        }

        $offset = ($page * $perPage) - $perPage;
        $this->setOffsetLimit($offset, $perPage);

        return new Result($this->doctrinePageinator, $page, $perPage);
    }


    /**
     * @param $offset
     * @param $limit
     * @return array
     */
    protected function setOffsetLimit($offset, $limit)
    {
        $this->doctrinePageinator
            ->getQuery()
            ->setMaxResults($limit)
            ->setFirstResult($offset);
    }

}