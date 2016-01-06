<?php

namespace App\Model\Entity;

/**
 * @Entity
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

}