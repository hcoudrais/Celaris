<?php

namespace Celaris\Site\Entity;

use Doctrine\ORM\Mapping as ORM;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Users")
*/
class UserSite extends BaseUser
{
    /**
     * @ORM\Column(name="id", type="integer", unique=true, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /*
     * @ORM\Column(name="username", type="string", nullable=false)
     */
    protected $username;

    /*
     * @ORM\Column(name="mail", type="string", nullable=false)
     */
    protected $mail;

    /*
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    protected $enabled;

    /*
     * @ORM\Column(name="password", type="string", nullable=false)
     */
    protected $password;

    /*
     * @ORM\Column(name="last_login", type="datetime", nullable=false)
     */
    protected $last_login;

    /*
     * @ORM\Column(name="locked", type="boolean", nullable=false)
     */
    protected $locked;

    /*
     * @ORM\Column(name="roles", type="array", nullable=false)
     */
    protected $roles;
}
