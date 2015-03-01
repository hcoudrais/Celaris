<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\ShipRepository")
 * @ORM\Table(name="Ship")
 */
class Ship
{
    /**
     * @ORM\Column(name="ShipId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $shipId;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Module", mappedBy="moduleId")
     */
    protected $modules;

    /**
     * @ORM\OneToMany(targetEntity="Celaris", mappedBy="celarisId")
     */
    protected $celarisId;
}
