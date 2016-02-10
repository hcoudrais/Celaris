<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\FactionRepository")
 * @ORM\Table(name="Faction")
 */
class Faction
{
    /**
     * @ORM\Column(name="FactionId", type="integer", unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $factionId;

    /**
     * @ORM\Column(name="Name", type="string", length=50)
     */
    protected $name;

    /**
     * @ORM\Column(name="Ionic", type="integer")
     */
    protected $ionic;

    /**
     * @ORM\Column(name="Plasma", type="integer")
     */
    protected $plasma;

    /**
     * @ORM\Column(name="Toxic", type="integer")
     */
    protected $toxic;

    /**
     * @ORM\Column(name="Antimatter", type="integer")
     */
    protected $antimatter;

    /**
     * @ORM\Column(name="Missile", type="integer")
     */
    protected $missile;

    /**
     * @ORM\Column(name="Fuze", type="integer")
     */
    protected $fuze;

    /**
     * @ORM\Column(name="Shield", type="integer")
     */
    protected $shield;

    /**
     * @ORM\Column(name="Carbon", type="integer")
     */
    protected $carbon;

    /**
     * @ORM\Column(name="Iron", type="integer")
     */
    protected $iron;

    /**
     * @ORM\Column(name="Teleporter", type="integer")
     */
    protected $teleporter;

    /**
     * @ORM\Column(name="Freight", type="integer")
     */
    protected $freight;

    /**
     * @ORM\Column(name="Spy", type="integer")
     */
    protected $spy;

    /**
     * @ORM\Column(name="CounterEspionage", type="integer")
     */
    protected $counterEspionage;

    /**
     * @ORM\Column(name="Sabotage", type="integer")
     */
    protected $sabotage;

    function getFactionId() {
        return $this->factionId;
    }

    function getName() {
        return $this->name;
    }

    function getIonic() {
        return $this->ionic;
    }

    function getPlasma() {
        return $this->plasma;
    }

    function getToxic() {
        return $this->toxic;
    }

    function getAntimatter() {
        return $this->antimatter;
    }

    function getMissile() {
        return $this->missile;
    }

    function getFuze() {
        return $this->fuze;
    }

    function getShield() {
        return $this->shield;
    }

    function getCarbon() {
        return $this->carbon;
    }

    function getIron() {
        return $this->iron;
    }

    function getTeleporter() {
        return $this->teleporter;
    }

    function getFreight() {
        return $this->freight;
    }

    function getSpy() {
        return $this->spy;
    }

    function getCounterEspionage() {
        return $this->counterEspionage;
    }

    function getSabotage() {
        return $this->sabotage;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setIonic($ionic) {
        $this->ionic = $ionic;
    }

    function setPlasma($plasma) {
        $this->plasma = $plasma;
    }

    function setToxic($toxic) {
        $this->toxic = $toxic;
    }

    function setAntimatter($antimatter) {
        $this->antimatter = $antimatter;
    }

    function setMissile($missile) {
        $this->missile = $missile;
    }

    function setFuze($fuze) {
        $this->fuze = $fuze;
    }

    function setShield($shield) {
        $this->shield = $shield;
    }

    function setCarbon($carbon) {
        $this->carbon = $carbon;
    }

    function setIron($iron) {
        $this->iron = $iron;
    }

    function setTeleporter($teleporter) {
        $this->teleporter = $teleporter;
    }

    function setFreight($freight) {
        $this->freight = $freight;
    }

    function setSpy($spy) {
        $this->spy = $spy;
    }

    function setCounterEspionage($counterEspionage) {
        $this->counterEspionage = $counterEspionage;
    }

    function setSabotage($sabotage) {
        $this->sabotage = $sabotage;
    }


}
