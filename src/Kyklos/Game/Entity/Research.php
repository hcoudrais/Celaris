<?php

namespace Kyklos\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Kyklos\Game\Entity\ResearchRepository")
 * @ORM\Table(name="Research")
 */
class Research
{
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
}
