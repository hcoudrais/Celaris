<?php

namespace Kyklos\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Kyklos\GameBundle\Entity\RaceRepository")
 * @ORM\Table(name="Race")
 */
class Race
{
    /**
     * @ORM\Column(name="RaceId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $raceId;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;

    /**
     * Get raceId
     *
     * @return integer
     */
    public function getFactionId()
    {
        return $this->serverId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Race
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
