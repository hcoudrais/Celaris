<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\ShipRepository")
 * @ORM\Table(name="Ship")
 */
class Ship
{
    /**
     * @ORM\Column(name="ShipId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $shipId;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Celaris", mappedBy="celarisId")
     */
    protected $celaris;

    /**
     * @ORM\Column(name="Attack", type="integer")
     */
    protected $attack;

    /**
     * @ORM\Column(name="Defense", type="integer")
     */
    protected $defense;
    
    /**
     * @ORM\Column(name="Freight", type="integer")
     */
    protected $freight;

    /**
     * @ORM\Column(name="L-com", type="boolean")
     */
    protected $lCom;

    /**
     * @ORM\Column(name="Camouflage, type="boolean")
     */
    protected $camouflage;

    /**
     * @ORM\Column(name="Colonization", type="boolean")
     */
    protected $colonization;

    /**
     * @ORM\Column(name="Quantity", type="integer")
     */
    protected $quantity;

    /**
     * @ORM\OneToMany(targetEntity="Fuselage", mappedBy="fuselageId")
     */
    protected $fuselage;

    /**
     * @ORM\OneToMany(targetEntity="Model", mappedBy="modelId")
     */
    protected $model;

    function getShipId() {
        return $this->shipId;
    }

    function getName() {
        return $this->name;
    }

    function getCelaris() {
        return $this->celaris;
    }

    function getAttack() {
        return $this->attack;
    }

    function getDefense() {
        return $this->defense;
    }

    function getFreight() {
        return $this->freight;
    }

    function getLCom() {
        return $this->lCom;
    }

    function getCamouflage() {
        return $this->camouflage;
    }

    function getColonization() {
        return $this->colonization;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getFuselage() {
        return $this->fuselage;
    }

    function getModel() {
        return $this->model;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setCelaris($celaris) {
        $this->celaris = $celaris;
    }

    function setAttack($attack) {
        $this->attack = $attack;
    }

    function setDefense($defense) {
        $this->defense = $defense;
    }

    function setFreight($freight) {
        $this->freight = $freight;
    }

    function setLCom($lCom) {
        $this->lCom = $lCom;
    }

    function setCamouflage($camouflage) {
        $this->camouflage = $camouflage;
    }

    function setColonization($colonization) {
        $this->colonization = $colonization;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function setFuselage($fuselage) {
        $this->fuselage = $fuselage;
    }

    function setModel($model) {
        $this->model = $model;
    }
}
