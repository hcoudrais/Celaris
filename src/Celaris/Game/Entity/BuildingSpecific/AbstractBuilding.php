<?php

namespace Celaris\Game\Entity\BuildingSpecific;

use Celaris\Game\Entity\BuildingCelaris;
use Celaris\Game\Entity\Celaris;

abstract class AbstractBuilding
{
    /**
     * @var BuildingCelaris 
     */
    protected $buildingCelaris;

    /**
     * @var Celaris 
     */
    protected $celaris;

    protected $isEnabled;

    protected $energy;

    protected $spaceAvailable;

    protected function getLevel()
    {
        return $this->buildingCelaris->getLevel();
    }

    public function __construct(BuildingCelaris $buildingCelaris, Celaris $celaris)
    {
        $this->buildingCelaris = $buildingCelaris;
        $this->celaris = $celaris;
    }

    abstract protected function mineraisCompute();

    abstract protected function cristalCompute();

    abstract protected function nobeliumCompute();

    abstract protected function hydrogeneCompute();

    abstract protected function albinionCompute();

    abstract protected function stockageCompute();

    abstract protected function constructTimeCompute($ccLvl);

    /**
     * Ajoute l'énergie au celaris au level up de certain building
     */
    public function energyCompute()
    {
        if ($this->buildingCelaris->getEnergy() > 0) {
            $energy = $this->celaris->getEnergy() + $this->buildingCelaris->getEnergy();

            $this->celaris->setEnergy($energy);
        }
    }

    public function spaceAvailableCompute()
    {
        if ($this->buildingCelaris->getSpaceRequired() > 0) {
            $spaceAvailable = $this->celaris->getSpaceAvailable() + $this->buildingCelaris->getSpaceRequired();

            $this->celaris->setSpaceAvailable($spaceAvailable);
        }
    }

    protected function workPointCompute()
    {
        $point = 0;

        if ($this->getLevel() > 0)
            $point = (round(($this->buildingCelaris->getSumRessourcesWithoutAlbinion()) / 500) * $this->getLevel()) - $this->buildingCelaris->getWorkPoint();

        $this->buildingCelaris->setWorkPoint($point);
    }

    /**
     * $ccLvl représente le centre de commandement dont on a besoin
     * pour calculer le temps de construction des bâtiments
     * 
     * $init est à true lorsque l'on créé un nouvel univers.
     * Il permet de ne pas level up un bâtiment, setter les champs
     * energy, espaceAvailable et enabled car elles sont contantes sauf pour le champs
     * energy de SolarCenter, dans le BuildingCelaris
     * 
     * @param int $ccLvl
     * @param boolean $init
     */
    public function levelUp($ccLvl = 0, $init = false)
    {
        if (!$init) {
            $this->buildingCelaris->setLevel($this->getLevel() + 1);

            // Set celaris fields
            $this->energyCompute();
            $this->spaceAvailableCompute();
        } else {
            // Set building celaris fields au moment de la création de l'univers
            $this->buildingCelaris->setEnabled($this->isEnabled);
            $this->buildingCelaris->setEnergy($this->energy);
            $this->buildingCelaris->setSpaceRequired($this->spaceAvailable);
        }

        // Set building celaris fields
        $this->mineraisCompute();
        $this->cristalCompute();
        $this->nobeliumCompute();
        $this->hydrogeneCompute();
        $this->albinionCompute();
        $this->stockageCompute();
        $this->constructTimeCompute($ccLvl);
        $this->workPointCompute();
    }
}
