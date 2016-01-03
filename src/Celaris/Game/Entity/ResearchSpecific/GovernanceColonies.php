<?php

namespace Celaris\Game\Entity\ResearchSpecific;

class GovernanceColonies extends AbstractResearch
{
    public function mineraisCompute()
    {
        $minerais = 100000;

        if ($this->getLevel() > 0)
            $minerais = round((100000 * pow(($this->getLevel() + 1), 2)) / 3);

        $this->researchPlayer->setMinerais($minerais);
    }

    public function cristalCompute()
    {
        $cristaux = 125000;

        if ($this->getLevel() > 0)
            $cristaux = round((125000 * pow(($this->getLevel() + 1), 2)) / 3);

        $this->researchPlayer->setCristaux($cristaux);
    }

    public function nobeliumCompute()
    {
        $nobelium = 90000;

        if ($this->getLevel() > 0)
            $nobelium = round((90000 * pow(($this->getLevel() + 1), 2)) / 3);

        $this->researchPlayer->setNobelium($nobelium);
    }

    public function hydrogeneCompute()
    {
        $hydrogene = 50000;

        if ($this->getLevel() > 0)
            $hydrogene = round((50000 * pow(($this->getLevel() + 1), 2)) / 3);

        $this->researchPlayer->setHydrogene($hydrogene);
    }

    public function albinionCompute()
    {
        $albinion = 0;

        if ($this->getLevel() > 4)
            $albinion = 4000 * pow(($this->getLevel() + 1), 2);

        $this->researchPlayer->setAlbinion($albinion);
    }

    public function researchTimeCompute($researchLabLvl)
    {
        $time = $this->getResearchTime(20000, $researchLabLvl);

        $this->researchPlayer->setResearchTime($time);
    }
}
