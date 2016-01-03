<?php

namespace Celaris\Game\Entity\BuildingSpecific;

use Celaris\Game\Entity\BuildingCelaris;
use Celaris\Game\Entity\Celaris;

class Cristal extends AbstractBuilding
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
        $this->buildingCelaris->setMinerais(300 * ($this->getLevel() + 1));
    }

    public function cristalCompute()
    {
        $this->buildingCelaris->setCristaux(500 * ($this->getLevel() + 1));
    }

    public function nobeliumCompute()
    {
        $this->buildingCelaris->setNobelium(150 * ($this->getLevel() + 1));
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
        $stockage = ((5.8 * pow($this->getLevel(), 2)) + 25) * ($this->getLevel() + 1);

        $this->buildingCelaris->setStockage($stockage);
    }

    public function constructTimeCompute($ccLvl)
    {
        $time = round((1800 * ($this->getLevel() + 1) / 2) / ((1 + log($ccLvl + 1))));

        $this->buildingCelaris->setConstructTime($time);
    }
}
