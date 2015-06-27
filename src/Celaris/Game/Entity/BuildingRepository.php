<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\EntityRepository;

class BuildingRepository extends EntityRepository
{
    public function getAllBuildings()
    {
        return $this
            ->createQueryBuilder('b')
            ->getQuery()
            ->getArrayResult()
        ;     
    }
}

