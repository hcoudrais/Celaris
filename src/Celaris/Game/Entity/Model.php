<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\ModelRepository")
 * @ORM\Table(name="Model")
 */
class Model
{
    /**
     * @ORM\Column(name="ModelId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $modelId;

    /**
     * @ORM\ManyToOne(targetEntity="Players", cascade={"persist"})
     * @ORM\JoinColumn(name="PlayerId", referencedColumnName="PlayerId")
     */
    protected $player;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;

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
     * @ORM\ManyToOne(targetEntity="Fuselage", cascade={"persist"})
     * @ORM\JoinColumn(name="FuselageId", referencedColumnName="FuselageId")
     */
    protected $fuselage;
    
    function getModelId() {
        return $this->modelId;
    }

    function getPlayer() {
        return $this->player;
    }

    function getName() {
        return $this->name;
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

    function getFuselage() {
        return $this->fuselage;
    }

    function setPlayer($player) {
        $this->player = $player;
    }

    function setName($name) {
        $this->name = $name;
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

    function setFuselage($fuselage) {
        $this->fuselage = $fuselage;
    }
}
