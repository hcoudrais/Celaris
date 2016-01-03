<?php

namespace Celaris\Game\Entity\ResearchSpecific;

class Shield extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(0);
    }

    public function cristalCompute()
    {
        $this->researchPlayer->setCristaux(round(2400 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function nobeliumCompute()
    {
        $this->researchPlayer->setNobelium(round(2800 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function hydrogeneCompute()
    {
        $this->researchPlayer->setHydrogene(round(4800 * (pow(sqrt(2), $this->getLevel()))));
    }

    public function albinionCompute()
    {
        $this->researchPlayer->setAlbinion(0);
    }

    public function researchTimeCompute($researchLabLvl)
    {
        $time = $this->getResearchTime(4800, $researchLabLvl);

        $this->researchPlayer->setResearchTime($time);
    }
}
