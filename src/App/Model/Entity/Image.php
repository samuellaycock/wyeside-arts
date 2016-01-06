<?php

namespace App\Model\Entity;


/**
 * @Entity
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




}