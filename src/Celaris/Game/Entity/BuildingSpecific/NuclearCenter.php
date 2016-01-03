<?php

namespace Celaris\Game\Entity\BuildingSpecific;

use Celaris\Game\Entity\BuildingCelaris;
use Celaris\Game\Entity\Celaris;

class NuclearCenter extends AbstractBuilding
{
    public function __construct(BuildingCelaris $buildingCelaris, Celaris $celaris)
    {
        parent::__construct($buildingCelaris, $celaris);

        $this->isEnabled = true;
        $this->energy = 10;
        $this->spaceAvailable = -1;
    }

    public function mineraisCompute()
    {
        $this->buildingCelaris->setMinerais(250 * ($this->getLevel() + 1));
    }

    public function cristalCompute()
    {
        $this->buildingCelaris->setCristaux(600 * ($this->getLevel() + 1));
    }

    public function nobeliumCompute()
    {
        $this->buildingCelaris->setNobelium(400 * ($this->getLevel() + 1));
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
        $time = round((1500 * (($this->getLevel() * 2) + 1) / 2) / ((1 + log($ccLvl + 1))));

        $this->buildingCelaris->setConstructTime($time);
    }
}
