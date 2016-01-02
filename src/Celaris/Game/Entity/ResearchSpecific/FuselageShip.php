<?php

namespace Celaris\Game\Entity\BuildingSpecific;

class FuselageShip extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(round(3000 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function cristalCompute()
    {
        $this->researchPlayer->setCristaux(round(1800 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function nobeliumCompute()
    {
        $this->researchPlayer->setNobelium(round(1100 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function hydrogeneCompute()
    {
        $this->researchPlayer->setHydrogene(0);
    }

    public function albinionCompute()
    {
        $this->researchPlayer->setAlbinion(0);
    }

    public function researchTimeCompute($researchLabLvl)
    {
        $time = $this->getResearchTime(9000, $researchLabLvl);

        $this->researchPlayer->setResearchTime($time);
    }
}
