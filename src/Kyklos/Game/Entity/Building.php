<?php

namespace Kyklos\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Kyklos\Game\Entity\BuildingRepository")
 * @ORM\Table(name="Building")
 */
class Building
{
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
}
