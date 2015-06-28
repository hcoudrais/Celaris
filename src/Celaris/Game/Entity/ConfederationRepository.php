<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\EntityRepository;

class ConfederationRepository extends EntityRepository
{
    public function getAllConfederations()
    {
        return $this
            ->createQueryBuilder('c')
            ->getQuery()
            ->getArrayResult()
        ; 
    }
}

