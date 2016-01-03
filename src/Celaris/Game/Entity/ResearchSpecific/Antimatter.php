<?php

namespace Celaris\Game\Entity\ResearchSpecific;

class Antimatter extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(15000 * pow(($this->getLevel() + 1), 2));
    }

    public function cristalCompute()
    {
        $this->researchPlayer->setCristaux(35000 * pow(($this->getLevel() + 1), 2));
    }

    public function nobeliumCompute()
    {
        $this->researchPlayer->setNobelium(0);
    }

    public function hydrogeneCompute()
    {
        $this->researchPlayer->setHydrogene(40000 * pow(($this->getLevel() + 1), 2));
    }

    public function albinionCompute()
    {
        $albinion = 0;

        if ($this->getLevel() > 10)
            $albinion = 1000 * pow(($this->getLevel() + 1), 2);

        $this->researchPlayer->setAlbinion($albinion);
    }

    public function researchTimeCompute($researchLabLvl)
    {
        $time = $this->getResearchTime(10000, $researchLabLvl, 'divide', 2);

        $this->researchPlayer->setResearchTime($time);
    }
}
