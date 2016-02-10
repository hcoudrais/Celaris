<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\SpecialityRepository")
 * @ORM\Table(name="Speciality")
 */
class Speciality
{
    /**
     * @ORM\Column(name="SpecialityId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $specialityId;

    /**
     * @ORM\Column(name="SpecificName", type="string", length=255)
     */
    protected $specificName;

    /**
     * @ORM\Column(name="TriggerEvent", type="string", length=8000)
     */
    protected $triggerEvent;
    
    function getSpecialityId() {
        return $this->specialityId;
    }

    function getSpecificName() {
        return $this->specificName;
    }

    function getTriggerEvent() {
        return $this->triggerEvent;
    }

    function setSpecificName($specificName) {
        $this->specificName = $specificName;
    }

    function setTriggerEvent($triggerEvent) {
        $this->triggerEvent = $triggerEvent;
    }
}
