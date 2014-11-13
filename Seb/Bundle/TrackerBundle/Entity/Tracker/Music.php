<?php

namespace Seb\Bundle\TrackerBundle\Entity\Tracker;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entity:Music
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Music
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="artist", type="string", length=255)
     */
    private $artist;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @var boolean
     *
     * @ORM\Column(name="listened", type="boolean")
     */
    private $listened;

    
     /**
     * Constructeur
     */
    public function __construct() {
        $this->listened = false;
    }
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Entity:Music
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set artist
     *
     * @param string $artist
     * @return Entity:Music
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist
     *
     * @return string 
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return Entity:Music
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set listened
     *
     * @param boolean $listened
     * @return Entity:Music
     */
    public function setListened($listened)
    {
        $this->listened = $listened;

        return $this;
    }

    /**
     * Get listened
     *
     * @return boolean 
     */
    public function getListened()
    {
        return $this->listened;
    }
}
