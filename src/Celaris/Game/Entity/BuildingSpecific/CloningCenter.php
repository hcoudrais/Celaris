<?php

namespace Celaris\Game\Entity\BuildingSpecific;

use Celaris\Game\Entity\BuildingCelaris;
use Celaris\Game\Entity\Celaris;

class CloningCenter extends AbstractBuilding
{
    public function __construct(BuildingCelaris $buildingCelaris, Celaris $celaris)
    {
        parent::__construct($buildingCelaris, $celaris);

        $this->isEnabled = false;
        $this->energy = -1;
        $this->spaceAvailable = -1;
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
}
