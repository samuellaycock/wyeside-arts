<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Entity;

/**
 * @EntityrepositoryClass="App\Model\Repo\TweetRepo")
 * @Table(name="twitter")
 */
class Tweet
{

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $text;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $time;

    /**
     * @Column(type="datetime")
     * @var \DateTime
     */
    protected $inserted;

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
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return \DateTime
     */
    public function getInserted()
    {
        return $this->inserted;
    }

    /**
     * @param \DateTime $inserted
     */
    public function setInserted($inserted)
    {
        $this->inserted = $inserted;
    }



}