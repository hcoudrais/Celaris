<?php

namespace Kyklos\Site\Entity;

use Doctrine\ORM\Mapping as ORM;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity()
 * @ORM\Table(name="Users")
*/
class User extends BaseUser
{
    /**
     * @ORM\Column(name="UserId", type="integer", unique=true, nullable=false)
     * @ORM\Id
    */
    protected $userId;
}
