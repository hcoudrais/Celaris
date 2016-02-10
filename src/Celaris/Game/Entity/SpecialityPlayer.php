<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\SpecialityPlayerRepository")
 * @ORM\Table(name="SpecialityPlayer")
 */
class SpecialityPlayer
{
    /**
     * @ORM\ManyToOne(targetEntity="Player", cascade={"persist"})
     * @ORM\JoinColumn(name="playerId", referencedColumnName="PlayerId")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Id
     * */
    protected $player;
    
    /**
     * @ORM\ManyToOne(targetEntity="Speciality", cascade={"persist"})
     * @ORM\JoinColumn(name="specialityId", referencedColumnName="SpecialityId")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Id
     */
    protected $speciality;

    /**
     * @ORM\Column(name="Value", type="integer")
     */
    protected $value;

    function getPlayer() {
        return $this->player;
    }

    function getSpeciality() {
        return $this->speciality;
    }

    function getValue() {
        return $this->value;
    }

    function setPlayer($player) {
        $this->player = $player;
    }

    function setSpeciality($speciality) {
        $this->speciality = $speciality;
    }

    function setValue($value) {
        $this->value = $value;
    }
}
