<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\CelarisRepository")
 * @ORM\Table(name="Celaris")
 */
class Celaris
{
    /**
     * @ORM\Column(name="CelarisId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $celarisId;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(name="Mapping", type="string", length=50)
     */
    protected $mapping;

    /**
     * @ORM\ManyToOne(targetEntity="Players", cascade={"persist"})
     * @ORM\JoinColumn(name="PlayerId", referencedColumnName="PlayerId")
     */
    protected $player;

    /**
     * @ORM\Column(name="Energy", type="integer")
     */
    protected $energy;

    /**
     * @ORM\Column(name="SpaceAvailable", type="integer")
     */
    protected $spaceAvailable;

    function getCelarisId() {
        return $this->celarisId;
    }

    function getName() {
        return $this->name;
    }

    function getMapping() {
        return $this->mapping;
    }

    function getPlayer() {
        return $this->player;
    }

    function getEnergy() {
        return $this->energy;
    }

    function getSpaceAvailable() {
        return $this->spaceAvailable;
    }

    function setCelarisId($celarisId) {
        $this->celarisId = $celarisId;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setMapping($mapping) {
        $this->mapping = $mapping;
    }

    function setPlayer($player) {
        $this->player = $player;
    }

    function setEnergy($energy) {
        $this->energy = $energy;
    }

    function setSpaceAvailable($spaceAvailable) {
        $this->spaceAvailable = $spaceAvailable;
    }
}
