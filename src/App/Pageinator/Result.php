<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Pageinator;


use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePageinator;


class Result
{

    /** @var DoctrinePageinator */
    protected $doctrinePageinator;

    /** @var int */
    protected $page;

    /** @var int */
    protected $perPage;


    /**
     * Result constructor.
     * @param DoctrinePageinator $pageinator
     * @param $page
     * @param $perPage
     */
    public function __construct(DoctrinePageinator $pageinator, $page, $perPage)
    {
        $this->doctrinePageinator = $pageinator;
        $this->page = $page;
        $this->perPage = $perPage;
    }


    /**
     * @return array
     */
    public function getResults()
    {
        return $this->doctrinePageinator;
    }

    /**
     * @return int
     */
    public function getResultCount()
    {
        return count($this->doctrinePageinator->getIterator());
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return count($this->doctrinePageinator);
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