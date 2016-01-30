<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\BuildingRepository")
 * @ORM\Table(name="Building")
 */
class Building
{
    const PATH_TO_BUILDING_CLASS = 'Celaris\Game\Entity\BuildingSpecific\\';

    const MINERAIS_ID                  = 1;
    const CRISTAL_ID                   = 2;
    const NOBELIUM_ID                  = 3;
    const HYDROGENE_ID                 = 4;
    const ALBINION_ID                  = 5;
    const CLONING_CENTER_ID            = 6;
    const MINERAIS_STORAGE_ID          = 7;
    const CRISTAL_STORAGE_ID           = 8;
    const NOBELIUM_STORAGE_ID          = 9;
    const HYDROGENE_STORAGE_ID         = 10;
    const ALBINION_STORAGE_ID          = 11;
    const GALACTIC_CITY_ID             = 12;
    const COMMAND_CENTER_ID            = 13;
    const RESEARCH_LAB_ID              = 14;
    const ORBITAL_CENTER_ID            = 15;
    const SPY_CENTER_ID                = 16;
    const SENSING_STATION_ID           = 17;
    const DEFENSE_STATION_ID           = 18;
    const NUCLEAR_CENTER_ID            = 19;
    const FUSION_CENTER_ID             = 20;
    const SOLAR_CENTER_ID              = 21;
    const TRADING_POST_ID              = 22;
    const BANK_ID                      = 23;
    const OCCULT_SERVICES_CENTER_ID    = 24;
    const ASSEMBLY_FACTORY_ID          = 25;

    public static $findBuildingIdByName = array(
        'Minerais' => self::MINERAIS_ID,
        'Cristal' => self::CRISTAL_ID,
        'Nobelium' => self::NOBELIUM_ID,
        'Hydrogene' => self::HYDROGENE_ID,
        'Albinion' => self::ALBINION_ID,
        'CloningCenter' => self::CLONING_CENTER_ID,
        'MineraisStorage' => self::MINERAIS_STORAGE_ID,
        'CristalStorage' => self::CRISTAL_STORAGE_ID,
        'NobeliumStorage' => self::NOBELIUM_STORAGE_ID,
        'HydrogeneStorage' => self::HYDROGENE_STORAGE_ID,
        'AlbinionStorage' => self::ALBINION_STORAGE_ID,
        'GalacticCity' => self::GALACTIC_CITY_ID,
        'CommandCenter' => self::COMMAND_CENTER_ID,
        'ResearchLab' => self::RESEARCH_LAB_ID,
        'OrbitalCenter' => self::ORBITAL_CENTER_ID,
        'SpyCenter' => self::SPY_CENTER_ID,
        'SensingStation' => self::SENSING_STATION_ID,
        'DefenseStation' => self::DEFENSE_STATION_ID,
        'NuclearCenter' => self::NUCLEAR_CENTER_ID,
        'FusionCenter' => self::FUSION_CENTER_ID,
        'SolarCenter' => self::SOLAR_CENTER_ID,
        'TradingPost' => self::TRADING_POST_ID,
        'Bank' => self::BANK_ID,
        'OccultServicesCenter' => self::OCCULT_SERVICES_CENTER_ID,
        'AssemblyFactory' => self::ASSEMBLY_FACTORY_ID
    );

    /**
     * @ORM\Column(name="BuildingId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $buildingId;

    /**
     * @ORM\Column(name="Name", type="string", length=31)
     */
    protected $name;

    /**
     * @ORM\Column(name="SpecificName", type="string", length=50)
     */
    protected $specificName;

    /**
     * @ORM\Column(name="Prerequisite", type="string", length=1000)
     */
    protected $prerequisite;

    /**
     * @ORM\Column(name="TriggerEvent", type="string", length=8000)
     */
    protected $triggerEvent;

    public function getBuildingId()
    {
        return $this->buildingId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSpecificName()
    {
        return $this->specificName;
    }

    public function getPrerequisite($raw = false)
    {
        if ($raw)
            return $this->prerequisite;

        return json_decode($this->prerequisite, true);
    }

    public function getTriggerEvent($raw = false)
    {
        if ($raw)
            return $this->triggerEvent;

        return json_decode($this->triggerEvent, true);
    }

    public function getSpecificClass(BuildingCelaris $buildingCelaris, Celaris $celaris)
    {
        $specificPath = self::PATH_TO_BUILDING_CLASS . $this->specificName;

        return new $specificPath($buildingCelaris, $celaris);
    }

    public static function getSpecificNameById($buildingId)
    {
        $buildings = array_flip(Building::$findBuildingIdByName);
        
        return $buildings[$buildingId];
    }
}
