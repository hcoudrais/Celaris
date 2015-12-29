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

    public function getPlayerId() {
        return $this->playerId;
    }

    public function getName() {
        return $this->name;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getRace() {
        return $this->race;
    }

    public function getFaction() {
        return $this->faction;
    }

    public function getConfederation() {
        return $this->confederation;
    }

    public function getPoppulation() {
        return $this->poppulation;
    }

    public function getHolidayMode() {
        return $this->holidayMode;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getMilitaryPoint() {
        return $this->militaryPoint;
    }

    public function getWorkPoint() {
        return $this->workPoint;
    }

    public function getResearchPoint() {
        return $this->researchPoint;
    }

    public function setPlayerId($playerId) {
        $this->playerId = $playerId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setRace($race) {
        $this->race = $race;
    }

    public function setFaction($faction) {
        $this->faction = $faction;
    }

    public function setConfederation($confederation) {
        $this->confederation = $confederation;
    }

    public function setPoppulation($poppulation) {
        $this->poppulation = $poppulation;
    }

    public function setHolidayMode($holidayMode) {
        $this->holidayMode = $holidayMode;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setMilitaryPoint($militaryPoint) {
        $this->militaryPoint = $militaryPoint;
    }

    public function setWorkPoint($workPoint) {
        $this->workPoint = $workPoint;
    }

    public function setResearchPoint($researchPoint) {
        $this->researchPoint = $researchPoint;
    }
}
