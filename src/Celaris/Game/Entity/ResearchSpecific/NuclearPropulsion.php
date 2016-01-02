<?php

namespace Celaris\Game\Entity\BuildingSpecific;

class NuclearPropulsion extends AbstractResearch
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
        $this->researchPlayer->setNobelium(round(900 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function hydrogeneCompute()
    {
        $this->researchPlayer->setHydrogene(round(1700 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function albinionCompute()
    {
        $this->researchPlayer->setAlbinion(0);
    }

    public function researchTimeCompute($researchLabLvl)
    {
        $time = $this->getResearchTime(2600, $researchLabLvl, 'multiply', 2);

        $this->researchPlayer->setResearchTime($time);
    }
}
