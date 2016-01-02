<?php

namespace Celaris\Game\Entity\BuildingSpecific;

use Celaris\Game\Entity\BuildingCelaris;

class Nobelium
{
    /**
     * @var BuildingCelaris 
     */
    private $buildingCelaris;

    private function getLevel()
    {
        return $this->buildingCelaris->getLevel();
    }
    
    public function __construct(BuildingCelaris $buildingCelaris)
    {
        $this->buildingCelaris = $buildingCelaris;
    }

    public function mineraisCompute()
    {
        $this->buildingCelaris->setMinerais(100 * ($this->getLevel() + 1));
    }

    public function cristalCompute()
    {
        $this->buildingCelaris->setCristaux(100 * ($this->getLevel() + 1));
    }

    public function nobeliumCompute()
    {
        $this->buildingCelaris->setNobelium(520 * ($this->getLevel() + 1));
    }

    public function hydrogeneCompute()
    {
        $this->buildingCelaris->setHydrogene(150 * ($this->getLevel() + 1));
    }

    public function albinionCompute()
    {
        $this->buildingCelaris->setAlbinion(0);
    }

    public function stockageCompute()
    {
        $stockage = ((5.2 * pow($this->getLevel(), 2)) + 25) * ($this->getLevel() + 1);

        $this->buildingCelaris->setStockage($stockage);
    }

    public function constructTimeCompute($ccLvl)
    {
        $time = round((1900 * ($this->getLevel() + 1) / 2) / ((1 + log($ccLvl + 1))));

        $this->buildingCelaris->setConstructTime($time);
    }

    public function workPointCompute()
    {
        $point = 0;

        if ($this->getLevel() > 0)
            $point = (round(($this->buildingCelaris->getSumRessources()) / 500) * $this->getLevel()) - $this->buildingCelaris->getWorkPoint();

        $this->buildingCelaris->setWorkPoint($point);
    }

    /**
     * $ccLvl représente le centre de commandement dont on a besoin
     * pour calculer le temps de construction des bâtiments
     * 
     * @param int $ccLvl
     * @param boolean $init
     */
    public function levelUp($ccLvl = 0, $init = false)
    {
        if (!$init) {
            $this->buildingCelaris->setLevel($this->getLevel() + 1);
        } else {
            $this->buildingCelaris->setEnabled(true);
        }

        $this->mineraisCompute();
        $this->cristalCompute();
        $this->nobeliumCompute();
        $this->hydrogeneCompute();
        $this->albinionCompute();
        $this->stockageCompute();
        $this->constructTimeCompute($ccLvl);
        $this->workPointCompute();
        $this->buildingCelaris->setEnergy(-1);
        $this->buildingCelaris->setSpaceRequired(-1);
    }
}
