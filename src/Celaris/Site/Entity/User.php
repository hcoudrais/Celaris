<?php

namespace Celaris\Site\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="Celaris\Site\Entity\UserRepository")
 * @ORM\Table(name="Users")
*/
class User extends BaseUser
{
    /**
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="Server", inversedBy="users")
     * @ORM\JoinTable(name="UserServer",
     *     joinColumns={@ORM\JoinColumn(name="UserId", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="ServerId", referencedColumnName="ServerId")}
     * )
    */
    protected $servers;

    public function __construct()
    {
        parent::__construct();
        $this->servers = new ArrayCollection();
    }

    /**
     * Add servers
     *
     * @param Celaris\Site\Entity\Server $servers
     * @return Server
     */
    public function addServer(Server $servers)
    {
        $this->servers[] = $servers;
    }

    /**
     * Remove server
     *
     * @param Celaris\Site\Entity\Server $servers
     */
    public function removeAServer(Server $servers)
    {
        $this->servers->removeElement($servers);
    }

    /**
     * Get servers
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getServers()
    {
        return $this->servers;
    }
}
