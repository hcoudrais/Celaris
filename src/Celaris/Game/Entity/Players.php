<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\PlayersRepository")
 * @ORM\Table(name="Players")
 */
class Players
{
    /**
     * @ORM\Column(name="PlayerId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $playerId;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(name="userId", type="integer")
     */
    protected $userId;

    /**
     * @ORM\ManyToOne(targetEntity="Race", cascade={"persist"})
     * @ORM\JoinColumn(name="RaceId", referencedColumnName="RaceId")
     */
    protected $race;

    /**
     * @ORM\ManyToOne(targetEntity="Faction", cascade={"persist"})
     * @ORM\JoinColumn(name="FactionId", referencedColumnName="FactionId")
     */
    protected $faction;

    /**
     * @ORM\ManyToOne(targetEntity="Confederation", cascade={"persist"})
     * @ORM\JoinColumn(name="ConfederationId", referencedColumnName="ConfederationId")
     */
    protected $confederation;

    /**
     * @ORM\Column(name="Poppulation", type="integer")
     */
    protected $poppulation;

    /**
     * @ORM\Column(name="HolidayMode", type="integer")
     */
    protected $holidayMode;

    /**
     * @ORM\Column(name="Description", type="string", length=1023)
     */
    protected $description;

    /**
     * @ORM\Column(name="MilitaryPoint", type="integer")
     */
    protected $militaryPoint;

    /**
     * @ORM\Column(name="WorkPoint", type="integer")
     */
    protected $workPoint;

    /**
     * @ORM\Column(name="ResearchPoint", type="integer")
     */
    protected $researchPoint;

    function getPlayerId() {
        return $this->playerId;
    }

    function getName() {
        return $this->name;
    }

    function getUserId() {
        return $this->userId;
    }

    function getRaceId() {
        return $this->race;
    }

    function getFactionId() {
        return $this->faction;
    }

    function getConfederationId() {
        return $this->confederation;
    }

    function getPoppulation() {
        return $this->poppulation;
    }

    function getHolidayMode() {
        return $this->holidayMode;
    }

    function getDescription() {
        return $this->description;
    }

    function getMilitaryPoint() {
        return $this->militaryPoint;
    }

    function getWorkPoint() {
        return $this->workPoint;
    }

    function getResearchPoint() {
        return $this->researchPoint;
    }

    function setPlayerId($playerId) {
        $this->playerId = $playerId;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setRaceId($raceId) {
        $this->raceId = $raceId;
    }

    function setFactionId($factionId) {
        $this->factionId = $factionId;
    }

    function setConfederationId($confederationId) {
        $this->confederationId = $confederationId;
    }

    function setPoppulation($poppulation) {
        $this->poppulation = $poppulation;
    }

    function setHolidayMode($holidayMode) {
        $this->holidayMode = $holidayMode;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setMilitaryPoint($militaryPoint) {
        $this->militaryPoint = $militaryPoint;
    }

    function setWorkPoint($workPoint) {
        $this->workPoint = $workPoint;
    }

    function setResearchPoint($researchPoint) {
        $this->researchPoint = $researchPoint;
    }


}
