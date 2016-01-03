<?php

namespace Celaris\Game\Entity\BuildingSpecific;

use Celaris\Game\Entity\BuildingCelaris;
use Celaris\Game\Entity\Celaris;

class Bank extends AbstractBuilding
{
    public function __construct(BuildingCelaris $buildingCelaris, Celaris $celaris)
    {
        parent::__construct($buildingCelaris, $celaris);

        $this->isEnabled = false;
        $this->energy = -5;
        $this->spaceAvailable = -1;
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
}
