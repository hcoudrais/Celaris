<?php

namespace Celaris\Game\Entity\BuildingSpecific;

class Sabotage extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(round(750 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function cristalCompute()
    {
        $this->researchPlayer->setCristaux(round(250 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function nobeliumCompute()
    {
        $this->researchPlayer->setNobelium(round(300 * (pow(sqrt(2), $this->getLevel()))));
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
        $time = $this->getResearchTime(2600, $researchLabLvl);

        $this->researchPlayer->setResearchTime($time);
    }
}
