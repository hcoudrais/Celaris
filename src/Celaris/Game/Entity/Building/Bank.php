<?php

namespace Celaris\Game\Entity\Building;

use Celaris\Game\Entity\BuildingCelaris;

class Bank
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
        $minerais = 5000;
        if ($this->getLevel() > 0)
            $minerais = (25000 * pow($this->getLevel(), 2)) - (50000 * $this->getLevel()) + 100000;

        $this->buildingCelaris->setMinerais($minerais);
    }

    public function cristalCompute()
    {
        $cristaux = 2000;
        if ($this->getLevel() > 0)
            $cristaux = (10000 * pow($this->getLevel(), 2)) - (20000 * $this->getLevel()) + 40000;

        $this->buildingCelaris->setCristaux($cristaux);
    }

    public function nobeliumCompute()
    {
        $nobelium = 4000;
        if ($this->getLevel() > 0)
            $nobelium = (15000 * pow($this->getLevel(), 2)) - (30000 * $this->getLevel()) + 60000;

        $this->buildingCelaris->setNobelium($nobelium);
    }

    public function hydrogeneCompute()
    {
        $this->buildingCelaris->setHydrogene(0);
    }

    public function albinionCompute()
    {
        $this->buildingCelaris->setAlbinion(0);
    }

    public function stockageCompute()
    {
        $this->buildingCelaris->setStockage(0);
    }

    public function constructTimeCompute($ccLvl)
    {
        $time = round((4400 * ((pow($this->getLevel(), 2)) + 1) / 2) / ((1 + log($ccLvl + 1))));

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
        $this->mineraisCompute();
        $this->cristalCompute();
        $this->nobeliumCompute();
        $this->hydrogeneCompute();
        $this->albinionCompute();
        $this->stockageCompute();
        $this->constructTimeCompute($ccLvl);
        $this->workPointCompute();
        $this->buildingCelaris->setEnergy(-5);
        $this->buildingCelaris->setSpaceRequired(-1);

        if (!$init) {
            $this->buildingCelaris->setLevel($this->getLevel() + 1);
        } else {
            $this->buildingCelaris->setEnabled(false);
        }
    }
}
