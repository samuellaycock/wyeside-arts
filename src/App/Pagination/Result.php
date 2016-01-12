<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Pagination;


use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;


class Result
{

    /** @var DoctrinePaginator */
    protected $doctrinePaginator;

    /** @var int */
    protected $page;

    /** @var int */
    protected $perPage;

    /** @var string */
    protected $refreshUrl;


    /**
     * Result constructor.
     * @param DoctrinePaginator $paginator
     * @param $page
     * @param $perPage
     */
    public function __construct(DoctrinePaginator $paginator, $page, $perPage, $refreshUrl)
    {
        $this->doctrinePaginator = $paginator;
        $this->page = $page;
        $this->perPage = $perPage;
        $this->refreshUrl = $refreshUrl;
    }


    /**
     * @return string
     */
    public function getRefreshUrl()
    {
        return $this->refreshUrl;
    }

    /**
     * @return array
     */
    public function getResults()
    {
        return $this->doctrinePaginator;
    }

    /**
     * @return int
     */
    public function getResultCount()
    {
        return count($this->doctrinePaginator->getIterator());
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return count($this->doctrinePaginator);
    }

    /**
     * @return int
     */
    public function getTotalPages()
    {
        return floor($this->getTotal() / $this->getPerPage());
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

}