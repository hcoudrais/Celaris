<?php

namespace Celaris\Game\Entity\ResearchSpecific;

class Biologic extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(round(3300 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function cristalCompute()
    {
        $this->researchPlayer->setCristaux(0);
    }

    public function nobeliumCompute()
    {
        $this->researchPlayer->setNobelium(round(5700 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function hydrogeneCompute()
    {
        $this->researchPlayer->setHydrogene(round(1000 * (pow(sqrt(2), $this->getLevel()))));
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
