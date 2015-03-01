<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\ConfederationRepository")
 * @ORM\Table(name="Confederation")
 */
class Confederation
{
    /**
     * @ORM\Column(name="ConfederationId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $confederationId;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;
}
