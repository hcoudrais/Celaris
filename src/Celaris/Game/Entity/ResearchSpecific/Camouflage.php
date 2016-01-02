<?php

namespace Celaris\Game\Entity\BuildingSpecific;

class Camouflage extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(0);
    }

    public function cristalCompute()
    {
        $this->researchPlayer->setCristaux(0);
    }

    public function nobeliumCompute()
    {
        $this->researchPlayer->setNobelium(round(25000 * (pow(($this->getLevel() + 1), 2)) / 3));
    }

    public function hydrogeneCompute()
    {
        $this->researchPlayer->setHydrogene(round(15000 * (pow(($this->getLevel() + 1), 2)) / 3));
    }

    public function albinionCompute()
    {
        $this->researchPlayer->setAlbinion(1800 * pow(($this->getLevel() + 1), 2));
    }

    public function researchTimeCompute($researchLabLvl)
    {
        $time = $this->getResearchTime(20000, $researchLabLvl);

        $this->researchPlayer->setResearchTime($time);
    }
}
