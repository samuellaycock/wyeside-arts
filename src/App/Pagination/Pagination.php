<?php

namespace App\Pagination;


use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;


class Pagination
{

    /** @var DoctrinePaginator */
    protected $doctrinePaginator;

    /** @var int */
    protected $defaultPerPage;

    /** @var int */
    protected $results;

    /** @var string */
    protected $refreshUrl;


    /**
     * Pagination constructor.
     * @param Query $query
     * @param $refreshUrl string
     */
    public function __construct(Query $query, $refreshUrl)
    {
        $this->refreshUrl = $refreshUrl;
        $this->query = $query;
        $this->doctrinePaginator = new DoctrinePaginator($query);
        $this->defaultPerPage = 25;
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

        return new Result($this->doctrinePaginator, $page, $perPage, $this->refreshUrl);
    }


    /**
     * @param $offset
     * @param $limit
     * @return array
     */
    protected function setOffsetLimit($offset, $limit)
    {
        $this->doctrinePaginator
            ->getQuery()
            ->setMaxResults($limit)
            ->setFirstResult($offset);
    }

}