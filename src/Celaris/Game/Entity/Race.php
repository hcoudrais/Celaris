<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\RaceRepository")
 * @ORM\Table(name="Race")
 */
class Race
{
    /**
     * @ORM\Column(name="RaceId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $raceId;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(name="ShipConstruct", type="integer")
     */
    protected $shipConstruct;

    /**
     * @ORM\Column(name="ShipTimeConstruct", type="integer")
     */
    protected $shipTimeConstruct;

    /**
     * @ORM\Column(name="DefenseConstruct", type="integer")
     */
    protected $defenseConstruct;

    /**
     * @ORM\Column(name="DefenseTimeConstruct", type="integer")
     */
    protected $defenseTimeConstruct;

    /**
     * @ORM\Column(name="BonusRessource", type="integer")
     */
    protected $bonusRessource;

    /**
     * Get raceId
     *
     * @return integer
     */
    public function getRaceId()
    {
        return $this->raceId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Race
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

    function getShipConstruct() {
        return $this->shipConstruct;
    }

    function getShipTimeConstruct() {
        return $this->shipTimeConstruct;
    }

    function getDefenseConstruct() {
        return $this->defenseConstruct;
    }

    function getDefenseTimeConstruct() {
        return $this->defenseTimeConstruct;
    }

    function getBonusRessource() {
        return $this->bonusRessource;
    }

    function setShipConstruct($shipConstruct) {
        $this->shipConstruct = $shipConstruct;
    }

    function setShipTimeConstruct($shipTimeConstruct) {
        $this->shipTimeConstruct = $shipTimeConstruct;
    }

    function setDefenseConstruct($defenseConstruct) {
        $this->defenseConstruct = $defenseConstruct;
    }

    function setDefenseTimeConstruct($defenseTimeConstruct) {
        $this->defenseTimeConstruct = $defenseTimeConstruct;
    }

    function setBonusRessource($bonusRessource) {
        $this->bonusRessource = $bonusRessource;
    }
}
