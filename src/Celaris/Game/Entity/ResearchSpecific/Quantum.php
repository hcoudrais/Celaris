<?php

namespace Celaris\Game\Entity\ResearchSpecific;

class Quantum extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(18000 * pow(($this->getLevel() + 1), 2));
    }

    public function cristalCompute()
    {
        $this->researchPlayer->setCristaux(0);
    }

    public function nobeliumCompute()
    {
        $this->researchPlayer->setNobelium(36000 * pow(($this->getLevel() + 1), 2));
    }

    public function hydrogeneCompute()
    {
        $this->researchPlayer->setHydrogene(36000 * pow(($this->getLevel() + 1), 2));
    }

    public function albinionCompute()
    {
        $albinion = 0;

        if ($this->getLevel() > 10)
            $albinion = 950 * pow(($this->getLevel() + 1), 2);

        $this->researchPlayer->setAlbinion($albinion);
    }

    public function researchTimeCompute($researchLabLvl)
    {
        $time = $this->getResearchTime(9800, $researchLabLvl, 'divide', 2);

        $this->researchPlayer->setResearchTime($time);
    }
}
