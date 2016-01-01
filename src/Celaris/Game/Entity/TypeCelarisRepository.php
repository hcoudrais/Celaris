<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\EntityRepository;

class TypeCelarisRepository extends EntityRepository
{
    public function findAllTypeCelarisByTypeName($typeName)
    {
        return $this
            ->createQueryBuilder('tc')
            ->where('tc.type = :type')
            ->setParameter(':type', $typeName)
            ->getQuery()
            ->getResult()
        ;
    }
}
