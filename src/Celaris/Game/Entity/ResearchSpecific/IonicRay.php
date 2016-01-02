<?php

namespace Celaris\Game\Entity\BuildingSpecific;

class IonicRay extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(0);
    }

    public function cristalCompute()
    {
        $this->researchPlayer->setCristaux(round(6300 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function nobeliumCompute()
    {
        $this->researchPlayer->setNobelium(0);
    }

    public function hydrogeneCompute()
    {
        $this->researchPlayer->setHydrogene(round(3700 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function albinionCompute()
    {
        $this->researchPlayer->setAlbinion(0);
    }

    public function researchTimeCompute($researchLabLvl)
    {
        $time = $this->getResearchTime(5000, $researchLabLvl);

        $this->researchPlayer->setResearchTime($time);
    }
}
