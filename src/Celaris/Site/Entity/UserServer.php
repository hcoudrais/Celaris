<?php

namespace Celaris\Site\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use Celaris\Site\Entity\Server;
use Celaris\Site\Entity\User;

/**
 * @ORM\Entity(repositoryClass="Celaris\Site\Entity\UserServerRepository")
 * @ORM\Table(name="UserServer")
 */
class UserServer
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Server")
     * @ORM\JoinColumn(name="ServerId", referencedColumnName="ServerId", nullable=false)
     */
    protected $server;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="UserId", referencedColumnName="id", nullable=false)
     */
    protected $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->server = new ArrayCollection();
    }
    
    function getServer() {
        return $this->server;
    }

    function getUser() {
        return $this->user;
    }

    function setServer($server) {
        $this->server = $server;
    }

    function setUser($user) {
        $this->user = $user;
    }
}
