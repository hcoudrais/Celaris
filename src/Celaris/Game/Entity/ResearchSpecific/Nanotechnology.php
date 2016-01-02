<?php

namespace Celaris\Game\Entity\BuildingSpecific;

class Nanotechnology extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(27500 * pow(($this->getLevel() + 1), 2));
    }

    public function cristalCompute()
    {
        $this->researchPlayer->setCristaux(10000 * pow(($this->getLevel() + 1), 2));
    }

    public function nobeliumCompute()
    {
        $this->researchPlayer->setNobelium(12500 * pow(($this->getLevel() + 1), 2));
    }

    public function hydrogeneCompute()
    {
        $this->researchPlayer->setHydrogene(24000 * pow(($this->getLevel() + 1), 2));
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
