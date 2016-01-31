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

    /**
     * @ORM\ManyToOne(targetEntity="TypeCelaris", cascade={"persist"})
     * @ORM\JoinColumn(name="TypeCelarisId", referencedColumnName="TypeCelarisId")
     */
    protected $typeCelaris;

    /**
     * @ORM\Column(name="Minerais", type="integer")
     */
    protected $minerais = 5000;

    /**
     * @ORM\Column(name="Cristaux", type="integer")
     */
    protected $cristaux = 5000;

    /**
     * @ORM\Column(name="Nobelium", type="integer")
     */
    protected $nobelium = 3000;

    /**
     * @ORM\Column(name="Hydrogene", type="integer")
     */
    protected $hydrogene = 1000;

    /**
     * @ORM\Column(name="Albinion", type="integer")
     */
    protected $albinion;

    /**
     * @ORM\Column(name="LastUpdate", type="datetime")
     */
    protected $lastUpdate;
    
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

    public function getTypeCelaris() {
        return $this->typeCelaris;
    }

    public function getEnergy() {
        return $this->energy;
    }

    public function getSpaceAvailable() {
        return $this->spaceAvailable;
    }

    public function getMinerais()
    {
        return $this->minerais;
    }

    public function getCristaux()
    {
        return $this->cristaux;
    }

    public function getNobelium()
    {
        return $this->nobelium;
    }

    public function getHydrogene()
    {
        return $this->hydrogene;
    }

    public function getAlbinion()
    {
        return $this->albinion;
    }

    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    public function setCelarisId($celarisId) {
        $this->celarisId = $celarisId;

        return $this;
    }

    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    public function setMapping($mapping) {
        $this->mapping = $mapping;

        return $this;
    }

    public function setPlayer($player)
    {
        $this->player = $player;

        return $this;
    }

    public function setTypeCelaris($typeCelaris)
    {
        $this->typeCelaris = $typeCelaris;

        return $this;
    }

    public function setEnergy($energy) {
        $this->energy = $energy;

        return $this;
    }

    public function setSpaceAvailable($spaceAvailable) {
        $this->spaceAvailable = $spaceAvailable;

        return $this;
    }

    public function setMinerais($minerais)
    {
        $this->minerais = $minerais;

        return $this;
    }

    public function setCristaux($cristaux)
    {
        $this->cristaux = $cristaux;

        return $this;
    }

    public function setNobelium($nobelium)
    {
        $this->nobelium = $nobelium;

        return $this;
    }

    public function setHydrogene($hydrogene)
    {
        $this->hydrogene = $hydrogene;

        return $this;
    }

    public function setAlbinion($albinion)
    {
        $this->albinion = $albinion;

        return $this;
    }

    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }
}
