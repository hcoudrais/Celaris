<?php

namespace Celaris\Game\Entity\ResearchSpecific;

class StorageModule extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(640 * pow(($this->getLevel() + 1), 2));
    }

    public function cristalCompute()
    {
        $this->researchPlayer->setCristaux(320 * pow(($this->getLevel() + 1), 2));
    }

    public function nobeliumCompute()
    {
        $this->researchPlayer->setNobelium(160 * pow(($this->getLevel() + 1), 2));
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
        $time = $this->getResearchTime(5600, $researchLabLvl, 'divide', 4);

        $this->researchPlayer->setResearchTime($time);
    }
}
