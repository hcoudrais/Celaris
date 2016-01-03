<?php

namespace Celaris\Game\Entity\BuildingSpecific;

use Celaris\Game\Entity\BuildingCelaris;
use Celaris\Game\Entity\Celaris;

class CristalStorage extends AbstractBuilding
{
    public function __construct(BuildingCelaris $buildingCelaris, Celaris $celaris)
    {
        parent::__construct($buildingCelaris, $celaris);

        $this->isEnabled = true;
        $this->energy = -1;
        $this->spaceAvailable = -1;
    }

    public function mineraisCompute()
    {
        $minerais = 480 * (pow(($this->getLevel() + 1), 2)) + 400;

        $this->buildingCelaris->setMinerais($minerais);
    }

    public function cristalCompute()
    {
        $cristal = 400 * (pow(($this->getLevel() + 1), 2)) + 400;

        $this->buildingCelaris->setCristaux($cristal);
    }

    public function nobeliumCompute()
    {
        $nobelium = 225 * (pow(($this->getLevel() + 1), 2)) + 300;

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
        $stockage = (3000 * pow($this->getLevel(), 2)) - (2000 * $this->getLevel()) + 5000;

        $this->buildingCelaris->setStockage($stockage);
    }

    public function constructTimeCompute($ccLvl)
    {
        $time = round((4000 * ($this->getLevel() + 1) / 2) / ((1 + log($ccLvl + 1))));

        $this->buildingCelaris->setConstructTime($time);
    }
}
