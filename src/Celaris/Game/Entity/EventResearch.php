<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\EventResearchRepository")
 * @ORM\Table(name="EventResearch")
 */
class EventResearch
{
    /**
     * @ORM\Column(name="Id", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Players", cascade={"persist"})
     * @ORM\JoinColumn(name="PlayerId", referencedColumnName="PlayerId")
     */
    protected $player;

    /**
     * @ORM\ManyToOne(targetEntity="Celaris", cascade={"persist"})
     * @ORM\JoinColumn(name="CelarisId", referencedColumnName="CelarisId")
     */
    protected $celaris;

    /**
     * @ORM\ManyToOne(targetEntity="Research", cascade={"persist"})
     * @ORM\JoinColumn(name="ResearchId", referencedColumnName="ResearchId")
     */
    protected $research;

    /**
     * @ORM\Column(name="ServerName", type="string", length=100)
     */
    protected $serverName;

    /**
     * @ORM\Column(name="CreatedAt", type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="StartEventDate", type="datetime")
     */
    protected $startEventDate;

    /**
     * @ORM\Column(name="DoneAt", type="datetime", nullable=true)
     */
    protected $doneAt;

    /**
     * @ORM\Column(name="Message", type="string", length=255, nullable=true)
     */
    protected $message;

    public function getId() {
        return $this->id;
    }

    public function getPlayer() {
        return $this->player;
    }

    public function getCelaris() {
        return $this->celaris;
    }

    public function getResearch() {
        return $this->research;
    }

    public function getServerName() {
        return $this->serverName;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getStartEventDate() {
        return $this->startEventDate;
    }

    public function getDoneAt() {
        return $this->doneAt;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setPlayer($player) {
        $this->player = $player;
    }

    public function setCelaris($celaris) {
        $this->celaris = $celaris;
    }

    public function setResearch($research) {
        $this->research = $research;
    }

    public function setServerName($serverName) {
        $this->serverName = $serverName;
    }

    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    public function setStartEventDate($startEventDate) {
        $this->startEventDate = $startEventDate;
    }

    public function setDoneAt($doneAt) {
        $this->doneAt = $doneAt;
    }

    public function setMessage($message) {
        $this->message = $message;
    }
}
