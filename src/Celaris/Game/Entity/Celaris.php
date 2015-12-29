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
    
    public function getCelarisId() {
        return $this->celarisId;
    }

    public function getName() {
        return $this->name;
    }

    public function getMapping() {
        return $this->mapping;
    }

    public function getPlayer() {
        return $this->player;
    }

    public function getEnergy() {
        return $this->energy;
    }

    public function getSpaceAvailable() {
        return $this->spaceAvailable;
    }

    public function setCelarisId($celarisId) {
        $this->celarisId = $celarisId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setMapping($mapping) {
        $this->mapping = $mapping;
    }

    public function setPlayer($player)
    {
        $this->player = $player;

        return $this;
    }

    public function setEnergy($energy) {
        $this->energy = $energy;
    }

    public function setSpaceAvailable($spaceAvailable) {
        $this->spaceAvailable = $spaceAvailable;
    }
}
