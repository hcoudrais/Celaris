<?php

namespace Celaris\Game\Entity\BuildingSpecific;

use Celaris\Game\Entity\BuildingCelaris;

class CloningCenter
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
        $minerais = 10 * (pow(($this->getLevel() + 1), 4)) + 1000;

        $this->buildingCelaris->setMinerais($minerais);
    }

    public function cristalCompute()
    {
        $cristaux = 7 * (pow(($this->getLevel() + 1), 4)) + 500;

        $this->buildingCelaris->setCristaux($cristaux);
    }

    public function nobeliumCompute()
    {
        $nobelium = 4 * (pow(($this->getLevel() + 1), 4)) + 300;

        $this->buildingCelaris->setNobelium($nobelium);
    }

    public function hydrogeneCompute()
    {
        $hydrogene = 2 * (pow(($this->getLevel() + 1), 4)) + 300;

        $this->buildingCelaris->setHydrogene($hydrogene);
    }

    public function albinionCompute()
    {
        $this->buildingCelaris->setAlbinion(0);
    }

    public function stockageCompute()
    {
        $stockage =pow(2, $this->getLevel()) + ($this->getLevel() * 100) + 10;

        $this->buildingCelaris->setStockage($stockage);
    }

    public function constructTimeCompute($ccLvl)
    {
        $time = round((8000 * ($this->getLevel() + 1) / 2) / ((1 + log($ccLvl + 1))));

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
            $this->buildingCelaris->setEnabled(false);
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
