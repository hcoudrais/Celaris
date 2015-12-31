<?php

namespace Celaris\Site\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Site\Entity\EventBuildingRepository")
 * @ORM\Table(name="EventBuilding")
 */
class EventBuilding
{
    /**
     * @ORM\Column(name="Id", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $Id;

    /**
     * @ORM\Column(name="PlayerId", type="integer")
     */
    protected $playerId;

    /**
     * @ORM\Column(name="CelarisId", type="integer")
     */
    protected $celarisId;

    /**
     * @ORM\Column(name="BuildingId", type="integer")
     */
    protected $buildingId;

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

    public function getPlayerId() {
        return $this->playerId;
    }

    public function getCelarisId() {
        return $this->celarisId;
    }

    public function getBuildingId() {
        return $this->buildingId;
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

    public function setPlayerId($playerId) {
        $this->playerId = $playerId;
    }

    public function setCelarisId($celarisId) {
        $this->celarisId = $celarisId;
    }

    public function setBuildingId($buildingId) {
        $this->buildingId = $buildingId;
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
