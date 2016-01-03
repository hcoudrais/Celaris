<?php

namespace Celaris\Game\Entity\ResearchSpecific;

class Fuze extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(30000 * pow(($this->getLevel() + 1), 2));
    }

    public function cristalCompute()
    {
        $this->researchPlayer->setCristaux(12000 * pow(($this->getLevel() + 1), 2));
    }

    public function nobeliumCompute()
    {
        $this->researchPlayer->setNobelium(18000 * pow(($this->getLevel() + 1), 2));
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
        $time = $this->getResearchTime(6000, $researchLabLvl, 'divide', 4);

        $this->researchPlayer->setResearchTime($time);
    }
}
