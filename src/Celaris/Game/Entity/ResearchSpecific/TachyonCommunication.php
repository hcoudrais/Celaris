<?php

namespace Celaris\Game\Entity\BuildingSpecific;

class TachyonCommunication extends AbstractResearch
{
    public function mineraisCompute()
    {
        $minerais = 120000;

        if ($this->getLevel() > 0)
            $minerais = round((120000 * pow(($this->getLevel() + 1), 2)) / 3);

        $this->researchPlayer->setMinerais($minerais);
    }

    public function cristalCompute()
    {
        $cristaux = 90000;

        if ($this->getLevel() > 0)
            $cristaux = round((90000 * pow(($this->getLevel() + 1), 2)) / 3);

        $this->researchPlayer->setCristaux($cristaux);
    }

    public function nobeliumCompute()
    {
        $nobelium = 130000;

        if ($this->getLevel() > 0)
            $nobelium = round((130000 * pow(($this->getLevel() + 1), 2)) / 3);

        $this->researchPlayer->setNobelium($nobelium);
    }

    public function hydrogeneCompute()
    {
        $hydrogene = 150000;

        if ($this->getLevel() > 0)
            $hydrogene = round((150000 * pow(($this->getLevel() + 1), 2)) / 3);

        $this->researchPlayer->setHydrogene($hydrogene);
    }

    public function albinionCompute()
    {
        $albinion = 0;

        if ($this->getLevel() > 4)
            $albinion = 5000 * pow(($this->getLevel() + 1), 2);

        $this->researchPlayer->setAlbinion($albinion);
    }

    public function researchTimeCompute($researchLabLvl)
    {
        $time = $this->getResearchTime(25000, $researchLabLvl);

        $this->researchPlayer->setResearchTime($time);
    }
}
