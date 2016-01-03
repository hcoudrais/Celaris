<?php

namespace Celaris\Game\Entity\BuildingSpecific;

use Celaris\Game\Entity\BuildingCelaris;
use Celaris\Game\Entity\Celaris;

class AssemblyFactory extends AbstractBuilding
{
    public function __construct(BuildingCelaris $buildingCelaris, Celaris $celaris)
    {
        parent::__construct($buildingCelaris, $celaris);

        $this->isEnabled = false;
        $this->energy = -4;
        $this->spaceAvailable = -1;
    }

    public function mineraisCompute()
    {
        $this->buildingCelaris->setMinerais(7500 * ($this->getLevel() + 1));
    }

    public function cristalCompute()
    {
        $this->buildingCelaris->setCristaux(4000 * ($this->getLevel() + 1));
    }

    public function nobeliumCompute()
    {
        $this->buildingCelaris->setNobelium(9000 * ($this->getLevel() + 1));
    }

    public function hydrogeneCompute()
    {
        $this->buildingCelaris->setHydrogene(2500 * ($this->getLevel() + 1));
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
        $time = round((4400 * (($this->getLevel() * 2) + 1) / 2) / ((1 + log($ccLvl + 1))));

        $this->buildingCelaris->setConstructTime($time);
    }
}
