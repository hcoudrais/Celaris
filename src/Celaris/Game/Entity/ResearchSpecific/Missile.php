<?php

namespace Celaris\Game\Entity\BuildingSpecific;

class Missile extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(35000 * pow(($this->getLevel() + 1), 2));
    }

    public function cristalCompute()
    {
        $this->researchPlayer->setCristaux(8000 * pow(($this->getLevel() + 1), 2));
    }

    public function nobeliumCompute()
    {
        $this->researchPlayer->setNobelium(7000 * pow(($this->getLevel() + 1), 2));
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
        $time = $this->getResearchTime(5000, $researchLabLvl, 'divide', 4);

        $this->researchPlayer->setResearchTime($time);
    }
}
