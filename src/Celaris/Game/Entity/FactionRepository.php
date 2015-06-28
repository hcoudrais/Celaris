<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\EntityRepository;

class FactionRepository extends EntityRepository
{
    public function getAllFactions()
    {
        return $this
            ->createQueryBuilder('f')
            ->getQuery()
            ->getArrayResult()
        ; 
    }
}

