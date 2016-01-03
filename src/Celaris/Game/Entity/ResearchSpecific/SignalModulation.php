<?php

namespace Celaris\Game\Entity\ResearchSpecific;

class SignalModulation extends AbstractResearch
{
    public function mineraisCompute()
    {
        $this->researchPlayer->setMinerais(0);
    }

    public function cristalCompute()
    {
        $cristaux = 750;
        
        if ($this->getLevel() > 0)
            $cristaux = round(750 * (pow(2, ($this->getLevel() + 1) / ($this->getLevel() + 1))));

        $this->researchPlayer->setCristaux($cristaux);
    }

    public function nobeliumCompute()
    {
        $nobelium = 500;

        if ($this->getLevel() > 0)
            $nobelium = round(500 * (pow(2, ($this->getLevel() + 1) / ($this->getLevel() + 1))));

        $this->researchPlayer->setNobelium($nobelium);
    }

    public function hydrogeneCompute()
    {
        $hydrogene = 250;

        if ($this->getLevel() > 0)
            $hydrogene = round(250 * (pow(2, ($this->getLevel() + 1) / ($this->getLevel() + 1))));

        $this->researchPlayer->setHydrogene($hydrogene);
    }

    public function albinionCompute()
    {
        $this->researchPlayer->setAlbinion(0);
    }

    public function researchTimeCompute($researchLabLvl)
    {
        $time = $this->getResearchTime(3000, $researchLabLvl);

        $this->researchPlayer->setResearchTime($time);
    }
}
