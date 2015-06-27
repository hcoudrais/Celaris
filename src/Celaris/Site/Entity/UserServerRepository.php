<?php

namespace Celaris\Site\Entity;

use Doctrine\ORM\EntityRepository;

use Celaris\Site\Entity\User;

class UserServerRepository extends EntityRepository
{
    public function getServersAvailableByUser($user)
    {
        if ($user instanceof User) {
            return $this
                ->createQueryBuilder('us')
                ->where('us.user = :user')
                ->setParameter('user', $user->getId())
                ->getQuery()
                ->getArrayResult()
            ;
        }

        return;
    }
}