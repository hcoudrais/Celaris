<?php

namespace Celaris\Game\Entity\ResearchSpecific;

class VSLPropulsion extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(0);
    }

    public function cristalCompute()
    {
        $this->researchPlayer->setCristaux(round(400000 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function nobeliumCompute()
    {
        $this->researchPlayer->setNobelium(round(350000 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function hydrogeneCompute()
    {
        $this->researchPlayer->setHydrogene(round(450000 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function albinionCompute()
    {
        $this->researchPlayer->setAlbinion(round(100000 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function researchTimeCompute($researchLabLvl)
    {
        $time = $this->getResearchTime(20000, $researchLabLvl, 'multiply', 2);

        $this->researchPlayer->setResearchTime($time);
    }
}
