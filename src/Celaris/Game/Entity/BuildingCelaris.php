<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\BuildingCelarisRepository")
 * @ORM\Table(name="BuildingCelaris")
 */
class BuildingCelaris
{
    /**
     * @ORM\ManyToOne(targetEntity="Building", cascade={"persist"})
     * @ORM\JoinColumn(name="buildingId", referencedColumnName="BuildingId")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Id
     * */
    protected $building;
    
    /**
     * @ORM\ManyToOne(targetEntity="Celaris", cascade={"persist"})
     * @ORM\JoinColumn(name="celarisId", referencedColumnName="CelarisId")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Id
     */
    protected $celaris;

    /**
     * @ORM\Column(name="Level", type="integer")
     */
    protected $level;

    /**
     * @ORM\Column(name="Minerais", type="integer")
     */
    protected $minerais;

    /**
     * @ORM\Column(name="Cristaux", type="integer")
     */
    protected $cristaux;

    /**
     * @ORM\Column(name="Nobelium", type="integer")
     */
    protected $nobelium;

    /**
     * @ORM\Column(name="Hydrogene", type="integer")
     */
    protected $hydrogene;

    /**
     * @ORM\Column(name="Albinion", type="integer")
     */
    protected $albinion;

    /**
     * @ORM\Column(name="Stockage", type="integer")
     */
    protected $stockage;

    /**
     * @ORM\Column(name="ConstructTime", type="integer")
     */
    protected $constructTime;

    /**
     * @ORM\Column(name="Energy", type="integer")
     */
    protected $energy;

    public function __construct()
    {
        $this->level = 0;
        $this->minerais = 0;
        $this->cristaux = 0;
        $this->nobelium = 0;
        $this->hydrogene = 0;
        $this->albinion = 0;
        $this->stockage = 0;
        $this->constructTime = 0;
        $this->energy = 0;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getBuilding()
    {
        return $this->building;
    }

    public function getCelaris()
    {
        return $this->celaris;
    }

    public function getLevel()
    {
        return $this->level;
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

    public function getStockage()
    {
        return $this->stockage;
    }

    public function getConstructTime()
    {
        return $this->constructTime;
    }

    public function getEnergy()
    {
        return $this->energy;
    }

    public function setBuilding($building)
    {
        $this->building = $building;

        return $this;
    }

    public function setCelaris($celaris)
    {
        $this->celaris = $celaris;

        return $this;
    }

    public function setLevel($level)
    {
        $this->level = $level;

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

    public function setStockage($stockage)
    {
        $this->stockage = $stockage;

        return $this;
    }

    public function setConstructTime($constructTime)
    {
        $this->constructTime = $constructTime;

        return $this;
    }

    public function setEnergy($energy)
    {
        $this->energy = $energy;

        return $this;
    }
}
