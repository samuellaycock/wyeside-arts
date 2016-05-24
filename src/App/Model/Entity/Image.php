<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Entity;


/**
 * @Entity(repositoryClass="App\Model\Repo\ImageRepo")
 * @Table(name="eventimage")
 */
class Image
{

    /**
     * @Id
     * @Column(type="integer", name="imageID")
     * @GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string", name="imageName")
     * @var string
     */
    protected $name;

    /**
     * @Column(type="string", name="imageExtension")
     * @var string
     */
    protected $ext;

    /**
     * @Column(type="smallint", name="imageMain")
     * @var int
     */
    protected $isMain;

    /**
     * @ManyToOne(targetEntity="App\Model\Entity\Event", inversedBy="images")
     * @JoinColumn(name="eventID", referencedColumnName="eventID")
     */
    protected $event;


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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getExt()
    {
        return $this->ext;
    }

    /**
     * @param string $ext
     */
    public function setExt($ext)
    {
        $this->ext = $ext;
    }

    /**
     * @return int
     */
    public function getIsMain()
    {
        return $this->isMain;
    }

    /**
     * @param int $isMain
     */
    public function setIsMain($isMain)
    {
        $this->isMain = $isMain;
    }

    /**
     * @return Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param Event $event
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;
    }


    CONST IMAGE_DIR = APP_DIR . '/web/event-assets/images/';
    CONST THUMBNAIL_DIR = APP_DIR . '/web/event-assets/thumbnails/';

    /**
     * @return string
     */
    public function getUrl()
    {
        if(file_exists(self::IMAGE_DIR . $this->getName() . $this->getExt())) {
            return '/event-assets/images/' . $this->getName() . $this->getExt();
        }
        return '/img/event-assets/default-banner.jpg';
    }

    /**
     * @return string
     */
    public function getThumbnailUrl()
    {
        if(file_exists(self::THUMBNAIL_DIR . $this->getName() . $this->getExt())) {
            return '/event-assets/thumbnails/' . $this->getName() . $this->getExt();
        }
        return '/img/event-assets/default-banner.jpg';
    }


}