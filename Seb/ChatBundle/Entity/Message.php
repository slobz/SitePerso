<?php

namespace Seb\ChatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 * 
 * @author Sébastien 26/02/14
 * @version 1.0
 * 
 * @ORM\Table()
 * @ORM\Entity
 */
class Message {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeStamp", type="datetime")
     */
    private $timeStamp;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\Column(name="idReceiver", type="integer")
     */
    private $idReceiver;

    /**
     * @var integer
     *
     * @ORM\Column(name="idSender", type="integer")
     */
    private $idSender;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="pending1", type="boolean")
     */
    private $pending1;

    /**
     * @var boolean
     * 
     * @ORM\Column(name="pending2", type="boolean")
     */
    private $pending2;

    /**
     * Get id
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set timeStamp
     * @param \DateTime $timeStamp
     * @return Message
     */
    public function setTimeStamp($timeStamp) {
        $this->timeStamp = $timeStamp;

        return $this;
    }

    /**
     * Get timeStamp
     * @return \DateTime 
     */
    public function getTimeStamp() {
        return $this->timeStamp;
    }

    /**
     * Set content
     * @param string $content
     * @return Message
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     * @return string 
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set idReceiver
     * @param integer $idReceiver
     * @return Message
     */
    public function setIdReceiver($idReceiver) {
        $this->idReceiver = $idReceiver;

        return $this;
    }

    /**
     * Get idReceiver
     * @return integer 
     */
    public function getIdReceiver() {
        return $this->idReceiver;
    }

    /**
     * Set idSender
     * @param integer $idSender
     * @return Message
     */
    public function setIdSender($idSender) {
        $this->idSender = $idSender;

        return $this;
    }

    /**
     * Get idSender
     * @return integer 
     */
    public function getIdSender() {
        return $this->idSender;
    }


    /**
     * Set pending1
     *
     * @param boolean $pending1
     * @return Message
     */
    public function setPending1($pending1) {
        $this->pending1 = $pending1;

        return $this;
    }

    /**
     * Get pending1
     *
     * @return boolean 
     */
    public function getPending1() {
        return $this->pending1;
    }

    /**
     * Set pending2
     *
     * @param boolean $pending2
     * @return Message
     */
    public function setPending2($pending2) {
        $this->pending2 = $pending2;

        return $this;
    }

    /**
     * Get pending2
     *
     * @return boolean 
     */
    public function getPending2() {
        return $this->pending2;
    }

    public function setPending($pending) {
        $this->pending1 = $pending;
        $this->pending2 = $pending;
    }

}
