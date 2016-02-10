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
     * @ORM\Column(name="SpecificName", type="string", length=50)
     */
    protected $specificName;

    /**
     * @ORM\Column(name="Speciality", type="string", length=100, nullable=true)
     */
    protected $speciality;

    /**
     * @ORM\Column(name="Attack", type="integer")
     */
    protected $attack;

    /**
     * @ORM\Column(name="Defense", type="integer")
     */
    protected $defense;

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
    protected $nobelium;

    /**
     * @ORM\Column(name="Hydrogene", type="integer")
     */
    protected $hydrogene;

    /**
     * @ORM\Column(name="Albinion", type="integer")
     */
    protected $albinion;

    /**
     * @ORM\Column(name="Freight", type="integer")
     */
    protected $freight;

    /**
     * @ORM\Column(name="Compartment", type="string", length=50)
     */
    protected $compartment;

    /**
     * @ORM\Column(name="Hangar", type="integer")
     */
    protected $hangar;

    /**
     * @ORM\Column(name="MilitaryPoint", type="integer")
     */
    protected $militaryPoint;

    /**
     * @ORM\Column(name="Enabled, type="boolean")
     */
    protected $enabled;

    /**
     * @ORM\Column(name="Prerequisite", type="string", length=1000)
     */
    protected $prerequisite;
    
    function getModuleId() {
        return $this->moduleId;
    }

    function getName() {
        return $this->name;
    }

    function getSpecificName() {
        return $this->specificName;
    }

    function getSpeciality() {
        return $this->speciality;
    }

    function getAttack() {
        return $this->attack;
    }

    function getDefense() {
        return $this->defense;
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

    function getHydrogene() {
        return $this->hydrogene;
    }

    function getAlbinion() {
        return $this->albinion;
    }

    function getFreight() {
        return $this->freight;
    }

    function getCompartment() {
        return $this->compartment;
    }

    function getHangar() {
        return $this->hangar;
    }

    function getMilitaryPoint() {
        return $this->militaryPoint;
    }

    function getEnabled() {
        return $this->enabled;
    }

    function getPrerequisite() {
        return $this->prerequisite;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setSpecificName($specificName) {
        $this->specificName = $specificName;
    }

    function setSpeciality($speciality) {
        $this->speciality = $speciality;
    }

    function setAttack($attack) {
        $this->attack = $attack;
    }

    function setDefense($defense) {
        $this->defense = $defense;
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

    function setHydrogene($hydrogene) {
        $this->hydrogene = $hydrogene;
    }

    function setAlbinion($albinion) {
        $this->albinion = $albinion;
    }

    function setFreight($freight) {
        $this->freight = $freight;
    }

    function setCompartment($compartment) {
        $this->compartment = $compartment;
    }

    function setHangar($hangar) {
        $this->hangar = $hangar;
    }

    function setMilitaryPoint($militaryPoint) {
        $this->militaryPoint = $militaryPoint;
    }

    function setEnabled($enabled) {
        $this->enabled = $enabled;
    }

    function setPrerequisite($prerequisite) {
        $this->prerequisite = $prerequisite;
    }
}
