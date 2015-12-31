<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\BuildingRepository")
 * @ORM\Table(name="Building")
 */
class Building
{
    const PATH_TO_BUILDING_CLASS = 'Celaris\Game\Entity\Building\\';

    /**
     * @ORM\Column(name="BuildingId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $buildingId;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(name="SpecificName", type="string", length=50)
     */
    protected $specificName;

    public function getBuildingId()
    {
        return $this->buildingId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSpecificClass()
    {
        return self::PATH_TO_BUILDING_CLASS . $this->specificName;
    }
}
