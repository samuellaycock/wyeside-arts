<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Entity;

/**
 * @Entity(repositoryClass="App\Model\Repo\GenreRepo")
 * @Table(name="eventgenre")
 */
class Genre
{

    /**
     * @Id
     * @Column(type="integer", name="genreID")
     * @GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string", name="genre")
     * @var string
     */
    protected $name;

    /**
     * @ManyToMany(targetEntity="App\Model\Entity\Event", mappedBy="genres")
     * @var Event[]
     */
    protected $events;


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
     * @return Event[]
     */
    public function getEvents()
    {
        return $this->events;
    }

}