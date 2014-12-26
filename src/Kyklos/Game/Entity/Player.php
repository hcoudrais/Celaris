<?php

namespace Kyklos\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Kyklos\GameBundle\Entity\PlayerRepository")
 * @ORM\Table(name="Player")
 */
class Player
{
    /**
     * @ORM\Column(name="PlayerId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $playerId;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Race", mappedBy="RaceId")
     */
    protected $raceId;

    /**
     * @ORM\OneToMany(targetEntity="Faction", mappedBy="FactionId")
     */
    protected $factionId;

    /**
     * @ORM\OneToMany(targetEntity="Confederation", mappedBy="ConfederationId")
     */
    protected $confederationId;

    /**
     * @ORM\Column(name="Poppulation", type="integer")
     */
    protected $poppulation;

    /**
     * @ORM\Column(name="HolidayMode", type="integer")
     */
    protected $holidayMode;

    /**
     * @ORM\Column(name="Description", type="string", length=1023)
     */
    protected $description;

    /**
     * @ORM\Column(name="MilitaryPoint", type="integer")
     */
    protected $militaryPoint;

    /**
     * @ORM\Column(name="WorkPoint", type="integer")
     */
    protected $workPoint;

    /**
     * @ORM\Column(name="ResearchPoint", type="integer")
     */
    protected $researchPoint;
}
