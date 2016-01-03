<?php

namespace Celaris\Game\Entity\ResearchSpecific;

class AdvancedAlloy extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(32500 * pow(($this->getLevel() + 1), 2));
    }

    public function cristalCompute()
    {
        $this->researchPlayer->setCristaux(17500 * pow(($this->getLevel() + 1), 2));
    }

    public function nobeliumCompute()
    {
        $this->researchPlayer->setNobelium(0);
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
        $time = $this->getResearchTime(5000, $researchLabLvl, 'divide', 4);

        $this->researchPlayer->setResearchTime($time);
    }
}
