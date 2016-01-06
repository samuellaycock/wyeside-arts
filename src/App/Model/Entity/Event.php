<?php

namespace App\Model\Entity;

/**
 * @Entity(repositoryClass="App\Model\Repo\EventRepo")
 * @Table(name="event")
 */
class Event
{

    /**
     * @Id
     * @Column(type="integer", name="eventID")
     * @GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string", name="eventTitle")
     * @var string
     */
    protected $title;

    /**
     * @Column(type="string", name="eventCertificate")
     * @var string
     */
    protected $certificate;

    /**
     * @Column(type="string", name="eventRunningTime")
     * @var string
     */
    protected $runningTime;

    /**
     * @Column(type="string", name="eventDirector")
     * @var string
     */
    protected $director;

    /**
     * @Column(type="string", name="eventStarring")
     * @var string
     */
    protected $starring;

    /**
     * @Column(type="string", name="eventTrailer")
     * @var string
     */
    protected $trailer;

    /**
     * @Column(type="string", name="eventDescription")
     * @var string
     */
    protected $description;

    /**
     * @Column(type="string", name="eventLink")
     * @var string
     */
    protected $link;

    /**
     * @Column(type="string", name="eventPrices")
     * @var string
     */
    protected $prices;

    /**
     * @Column(type="string", name="eventType")
     * @var string
     */
    protected $type;

    /**
     * @Column(type="smallint", name="eventStatus")
     * @var int
     */
    protected $status;

    /**
     * @Column(type="datetime", name="eventCreated")
     * @var \DateTime
     */
    protected $createdTs;

    /**
     * @Column(type="string", name="eventBanner")
     * @var string
     */
    protected $banner;

    /**
     * @Column(type="string", name="eventBannerExtension")
     * @var string
     */
    protected $bannerExt;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $ticketsolve;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getCertificate()
    {
        return $this->certificate;
    }

    /**
     * @param string $certificate
     */
    public function setCertificate($certificate)
    {
        $this->certificate = $certificate;
    }

    /**
     * @return string
     */
    public function getRunningTime()
    {
        return $this->runningTime;
    }

    /**
     * @param string $runningTime
     */
    public function setRunningTime($runningTime)
    {
        $this->runningTime = $runningTime;
    }

    /**
     * @return string
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @param string $director
     */
    public function setDirector($director)
    {
        $this->director = $director;
    }

    /**
     * @return string
     */
    public function getStarring()
    {
        return $this->starring;
    }

    /**
     * @param string $starring
     */
    public function setStarring($starring)
    {
        $this->starring = $starring;
    }

    /**
     * @return string
     */
    public function getTrailer()
    {
        return $this->trailer;
    }

    /**
     * @param string $trailer
     */
    public function setTrailer($trailer)
    {
        $this->trailer = $trailer;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @param string $prices
     */
    public function setPrices($prices)
    {
        $this->prices = $prices;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedTs()
    {
        return $this->createdTs;
    }

    /**
     * @param \DateTime $createdTs
     */
    public function setCreatedTs($createdTs)
    {
        $this->createdTs = $createdTs;
    }

    /**
     * @return string
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * @param string $banner
     */
    public function setBanner($banner)
    {
        $this->banner = $banner;
    }

    /**
     * @return string
     */
    public function getBannerExt()
    {
        return $this->bannerExt;
    }

    /**
     * @param string $bannerExt
     */
    public function setBannerExt($bannerExt)
    {
        $this->bannerExt = $bannerExt;
    }

    /**
     * @return string
     */
    public function getTicketsolve()
    {
        return $this->ticketsolve;
    }

    /**
     * @param string $ticketsolve
     */
    public function setTicketsolve($ticketsolve)
    {
        $this->ticketsolve = $ticketsolve;
    }



}