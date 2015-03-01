<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\CelarisRepository")
 * @ORM\Table(name="Celaris")
 */
class Celaris
{
    /**
     * @ORM\Column(name="CelarisId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $celarisId;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(name="Mapping", type="string", length=50)
     */
    protected $mapping;

    /**
     * @ORM\Column(name="Energy", type="integer")
     */
    protected $energy;

    /**
     * @ORM\Column(name="SpaceAvailable", type="integer")
     */
    protected $spaceAvailable;
}
