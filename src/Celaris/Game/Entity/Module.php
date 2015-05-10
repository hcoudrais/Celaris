<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\ModuleRepository")
 * @ORM\Table(name="Module")
 */
class Module
{
    /**
     * @ORM\Column(name="ModuleId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $moduleId;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(name="Attack", type="integer")
     */
    protected $attack;

    /**
     * @ORM\Column(name="Defense", type="integer")
     */
    protected $defense;

    /**
     * @ORM\Column(name="Fret", type="integer")
     */
    protected $fret;

    /**
     * @ORM\Column(name="Compartment", type="integer")
     */
    protected $compartment;
}
