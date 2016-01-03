<?php

namespace Celaris\Game\Entity\ResearchSpecific;

use Celaris\Game\Entity\ResearchPlayer;

abstract class AbstractResearch
{
    /**
     * @var ResearchPlayer 
     */
    protected $researchPlayer;

    protected function getLevel()
    {
        return $this->researchPlayer->getLevel();
    }

    public function __construct(ResearchPlayer $researchPlayer)
    {
        $this->researchPlayer = $researchPlayer;
    }

    abstract protected function mineraisCompute();

    abstract protected function cristalCompute();

    abstract protected function nobeliumCompute();

    abstract protected function hydrogeneCompute();

    abstract protected function albinionCompute();

    protected function getResearchTime($x, $researchLabLvl, $operator = null, $y = null)
    {
        $computeWithLevel = $this->getLevel();

        if ($operator == 'divide') {
            $computeWithLevel = $this->getLevel() / $y;
        } else if ($operator == 'multiply') {
            $computeWithLevel = $this->getLevel() * $y;
        }

        return round(($x * ($computeWithLevel + 1) / 2) / ((1 + log($researchLabLvl + 1))));
    }

    protected function researchPointCompute()
    {
        $point = 0;

        if ($this->getLevel() > 0) {
            $point = (
                round(($this->researchPlayer->getSumRessourcesWithoutAlbinion() + (7 * $this->researchPlayer->getAlbinion())) / 500)
            ) - $this->researchPlayer->getResearchPoint();
        }

        $this->researchPlayer->setResearchPoint($point);
    }

    /**
     * $researchLabLvl représente le laboratoire de recherche dont on a besoin
     * pour calculer le temps de recherche
     * 
     * @param int $researchLabLvl
     * @param boolean $init
     */
    public function levelUp($researchLabLvl = 0, $init = false)
    {
        if (!$init) {
            $this->researchPlayer->setLevel($this->getLevel() + 1);
        } else {
            $this->researchPlayer->setEnabled(false);
        }

        $this->mineraisCompute();
        $this->cristalCompute();
        $this->nobeliumCompute();
        $this->hydrogeneCompute();
        $this->albinionCompute();
        $this->researchTimeCompute($researchLabLvl);
        $this->researchPointCompute();
    }
}
