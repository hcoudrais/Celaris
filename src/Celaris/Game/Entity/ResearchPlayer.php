<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Celaris\Game\Entity\ResearchPlayerRepository")
 * @ORM\Table(name="ResearchPlayer")
 */
class ResearchPlayer
{
    /**
     * @ORM\ManyToOne(targetEntity="Research", cascade={"persist"})
     * @ORM\JoinColumn(name="researchId", referencedColumnName="ResearchId")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Id
     * */
    protected $research;
    
    /**
     * @ORM\ManyToOne(targetEntity="Players", cascade={"persist"})
     * @ORM\JoinColumn(name="playerId", referencedColumnName="PlayerId")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Id
     */
    protected $player;

    /**
     * @ORM\Column(name="Level", type="integer")
     */
    protected $level;

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
     * @ORM\Column(name="ResearchTime", type="integer")
     */
    protected $researchTime;

    public function __construct()
    {
        $this->level = 0;
        $this->minerais = 0;
        $this->cristaux = 0;
        $this->nobelium = 0;
        $this->hydrogene = 0;
        $this->albinion = 0;
        $this->researchTime = 0;
    }

    public function getResearch()
    {
        return $this->research;
    }

    public function getPlayer()
    {
        return $this->player;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getMinerais()
    {
        return $this->minerais;
    }

    public function getCristaux()
    {
        return $this->cristaux;
    }

    public function getNobelium()
    {
        return $this->nobelium;
    }

    public function getHydrogene()
    {
        return $this->hydrogene;
    }

    public function getAlbinion()
    {
        return $this->albinion;
    }

    public function getResearchTime()
    {
        return $this->researchTime;
    }

    public function setResearch($research)
    {
        $this->research = $research;

        return $this;
    }

    public function setPlayer($player)
    {
        $this->player = $player;

        return $this;
    }

    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    public function setMinerais($minerais)
    {
        $this->minerais = $minerais;

        return $this;
    }

    public function setCristaux($cristaux)
    {
        $this->cristaux = $cristaux;

        return $this;
    }

    public function setNobelium($nobelium)
    {
        $this->nobelium = $nobelium;

        return $this;
    }

    public function setHydrogene($hydrogene)
    {
        $this->hydrogene = $hydrogene;

        return $this;
    }

    public function setAlbinion($albinion)
    {
        $this->albinion = $albinion;

        return $this;
    }

    public function setResearchTime($researchTime)
    {
        $this->researchTime = $researchTime;

        return $this;
    }

    public function getSumRessourcesWithoutALbinion()
    {
        return  $this->getMinerais()  + 
                $this->getCristaux()  + 
                $this->getNobelium()  + 
                $this->getHydrogene()
        ;
    }
}
