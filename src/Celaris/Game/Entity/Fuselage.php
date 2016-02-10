<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\FuselageRepository")
 * @ORM\Table(name="Fuselage")
 */
class Fuselage
{
    /**
     * @ORM\Column(name="FuselageId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $fuselageId;

    /**
     * @ORM\Column(name="Type", type="string", length=255)
     */
    protected $type;

    /**
     * @ORM\Column(name="SpaceAvailable", type="integer")
     */
    protected $spaceAvailable;

    /**
     * @ORM\Column(name="SpaceHangar", type="integer")
     */
    protected $spaceHangar;

    /**
     * @ORM\Column(name="Poppulation", type="integer")
     */
    protected $poppulation;

    /**
     * @ORM\Column(name="Minerais", type="integer")
     */
    protected $minerais;

    /**
     * @ORM\Column(name="Cristaux", type="integer")
     */
    protected $cristaux;

    /**
     * @ORM\Column(name="Nobelium", type="integer")
     */
    protected $nobelium ;

    /**
     * @ORM\Column(name="MilitaryPoint", type="integer")
     */
    protected $militaryPoint;

    /**
     * @ORM\Column(name="Prerequisite", type="string", length=1000)
     */
    protected $prerequisite;
    
    function getFuselageId() {
        return $this->fuselageId;
    }

    function getType() {
        return $this->type;
    }

    function getSpaceAvailable() {
        return $this->spaceAvailable;
    }

    function getSpaceHangar() {
        return $this->spaceHangar;
    }

    function getPoppulation() {
        return $this->poppulation;
    }

    function getMinerais() {
        return $this->minerais;
    }

    function getCristaux() {
        return $this->cristaux;
    }

    function getNobelium() {
        return $this->nobelium;
    }

    function getMilitaryPoint() {
        return $this->militaryPoint;
    }

    function getPrerequisite() {
        return $this->prerequisite;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setSpaceAvailable($spaceAvailable) {
        $this->spaceAvailable = $spaceAvailable;
    }

    function setSpaceHangar($spaceHangar) {
        $this->spaceHangar = $spaceHangar;
    }

    function setPoppulation($poppulation) {
        $this->poppulation = $poppulation;
    }

    function setMinerais($minerais) {
        $this->minerais = $minerais;
    }

    function setCristaux($cristaux) {
        $this->cristaux = $cristaux;
    }

    function setNobelium($nobelium) {
        $this->nobelium = $nobelium;
    }

    function setMilitaryPoint($militaryPoint) {
        $this->militaryPoint = $militaryPoint;
    }
}
