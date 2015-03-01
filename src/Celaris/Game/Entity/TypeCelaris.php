<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\GameBundle\Entity\TypeCelarisRepository")
 * @ORM\Table(name="TypeCelaris")
 */
class TypeCelaris
{
    /**
     * @ORM\Column(name="TypeCelarisId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $typeCelarisId;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;

    /**
     * Get raceId
     *
     * @return integer
     */
    public function getTypeCelarisId()
    {
        return $this->serverId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return TypeCelaris
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
