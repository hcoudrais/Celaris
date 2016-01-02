<?php

namespace Celaris\Game\Entity\BuildingSpecific;

class PlanetaryDefense extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(round(5300 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function cristalCompute()
    {
        $this->researchPlayer->setCristaux(round(2800 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function nobeliumCompute()
    {
        $this->researchPlayer->setNobelium(round(3900 * (pow(sqrt(2), $this->getLevel()))));
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
        $time = $this->getResearchTime(4000, $researchLabLvl);

        $this->researchPlayer->setResearchTime($time);
    }
}
