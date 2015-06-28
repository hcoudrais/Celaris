<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\EntityRepository;

class ResearchRepository extends EntityRepository
{
    public function getAllResearch()
    {
        return $this
            ->createQueryBuilder('r')
            ->getQuery()
            ->getArrayResult()
        ; 
    }
}
