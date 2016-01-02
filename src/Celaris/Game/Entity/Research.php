<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\ResearchRepository")
 * @ORM\Table(name="Research")
 */
class Research
{
    const PATH_TO_BUILDING_CLASS = 'Celaris\Game\Entity\ResearchSpecific\\';

    const SPY_ID = 1;
    const SIGNALMODULATION_ID = 2;
    const FUSELAGESHIP_ID = 3;
    const FLEETMANAGEMENT_ID = 4; 
    const CAMOUFLAGE_ID = 5;
    const IONICRAY_ID = 6;
    const PLASMA_ID = 7;
    const BIOLOGIC_ID = 8; 
    const MISSILE_ID = 9;
    const FUZE_ID = 10;
    const ANTIMATTER_ID = 11;
    const SHIELD_ID = 12;
    const ENERGYCONVERSION_ID = 13;
    const CARBON_ID = 14;
    const NANOTECHNOLOGY_ID = 15;
    const STEELINDUSTRY_ID = 16;
    const ADVANCEDALLOY_ID = 17;
    const QUANTUM_ID = 18;
    const PLANETARYDEFENSE_ID = 19;
    const STORAGEMODULE_ID = 20;
    const GOVERNANCECOLONIES_ID = 21;
    const SABOTAGE_ID = 22;
    const TACHYONCOMMUNICATION_ID = 23;
    const SUBLIGHTPROPULSION_ID = 24;
    const NUCLEARPROPULSION_ID = 25;
    const REACTORHYPERSPACE_ID = 26;
    const VSLPROPULSION_ID = 27;

    public static $findResearchIdByName = array(
        'Spy' => self::SPY_ID,
        'SignalModulation' => self::SIGNALMODULATION_ID,
        'FuselageShip' => self::FUSELAGESHIP_ID,
        'FleetManagement' => self::FLEETMANAGEMENT_ID,
        'Camouflage' => self::CAMOUFLAGE_ID,
        'IonicRay' => self::IONICRAY_ID,
        'Plasma' => self::PLASMA_ID,
        'Biologic' => self::BIOLOGIC_ID,
        'Missile' => self::MISSILE_ID,
        'Fuze' => self::FUZE_ID,
        'Antimatter' => self::ANTIMATTER_ID,
        'Shield' => self::SHIELD_ID,
        'EnergyConversion' => self::ENERGYCONVERSION_ID,
        'Carbon' => self::CARBON_ID,
        'Nanotechnology' => self::NANOTECHNOLOGY_ID,
        'SteelIndustry' => self::STEELINDUSTRY_ID,
        'AdvancedAlloy' => self::ADVANCEDALLOY_ID,
        'Quantum' => self::QUANTUM_ID,
        'PlanetaryDefense' => self::PLANETARYDEFENSE_ID,
        'StorageModule' => self::STORAGEMODULE_ID,
        'GovernanceColonies' => self::GOVERNANCECOLONIES_ID,
        'Sabotage' => self::SABOTAGE_ID,
        'TachyonCommunication' => self::TACHYONCOMMUNICATION_ID,
        'SublightPropulsion' => self::SUBLIGHTPROPULSION_ID,
        'NuclearPropulsion' => self::NUCLEARPROPULSION_ID,
        'ReactorHyperspace' => self::REACTORHYPERSPACE_ID,
        'VSLPropulsion' => self::VSLPROPULSION_ID,
    );

    /**
     * @ORM\Column(name="ResearchId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $researchId;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(name="SpecificName", type="string", length=50)
     */
    protected $specificName;

    /**
     * @ORM\Column(name="Prerequisite", type="string", length=500)
     */
    protected $prerequisite;

    public function getName()
    {
        return $this->name;
    }

    public function getPrerequisite($raw = false)
    {
        if ($raw)
            return $this->prerequisite;

        return json_decode($this->prerequisite, true);
    }

    public function getSpecificClass()
    {
        return self::PATH_TO_BUILDING_CLASS . $this->specificName;
    }
}
