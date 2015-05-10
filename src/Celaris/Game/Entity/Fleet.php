<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\FleetRepository")
 * @ORM\Table(name="Fleet")
 */
class Fleet
{
    /**
     * @ORM\Column(name="FleetId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $fleetId;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Ship", mappedBy="shipId")
     */
    protected $ships;

    /**
     * @ORM\OneToMany(targetEntity="Celaris", mappedBy="celarisId")
     */
    protected $celarisId;
}
