<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */


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
     * @ManyToMany(targetEntity="App\Model\Entity\Genre", inversedBy="events")
     * @JoinTable(
     *      name="eventgenrelink",
     *      joinColumns={@JoinColumn(name="eventID", referencedColumnName="eventID")},
     *      inverseJoinColumns={@JoinColumn(name="genreID", referencedColumnName="genreID")}
     * )
     * @var Genre[]
     */
    protected $genres;

    /**
     * @OneToMany(targetEntity="App\Model\Entity\Image", mappedBy="event")
     * @var Image[]
     */
    protected $images;


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


    /**
     * @return Genre[]
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param Genre $genre
     */
    public function addGenre(Genre $genre)
    {
        $this->genres[] = $genre;
    }

    public function clearGenres()
    {
        $this->genres = [];
    }


    /**
     * @return string
     */
    public function getBannerImageUrl()
    {
        $imageName = $this->getBanner() . $this->getBannerExt();
        return $imageName;
    }

    /**
     * @return Image[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param Image $image
     */
    public function addImage(Image $image)
    {
        $this->images[] = $image;
    }



    /**
     * @return string
     */
    public function getTypeName()
    {
        switch($this->getType())
        {
            case 1:
                return 'Cinema';
            case 2:
                return 'Live';
            case 3:
                return 'Community';
            case 4:
                return 'Satellite Live!';
            case 5:
                return 'Workshop';
            case 6:
                return 'Gallery';
            default:
                return 'Unknown';
        }
    }

    /**
     * @return string
     */
    public function getTypePrimaryColor()
    {
        switch($this->getType())
        {
            case 1:
                return '#B0D817';
            case 2:
                return '#01B6AD';
            case 3:
                return '#CCCCCC';
            case 4:
                return '#E30769';
            case 5:
                return '#CCCCCC';
            case 6:
                return '#A14DB2';
            default:
                return '#000000';
        }
    }


}