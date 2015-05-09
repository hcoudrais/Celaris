<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\EntityRepository;

class CelarisRepository extends EntityRepository
{
    public function getOneRandomCelaris($galaxy)
    {
        $mapping = "G0$galaxy%";

        $result = $this
            ->createQueryBuilder('c')
            ->where('c.mapping LIKE :mapping')
            ->setParameter(':mapping', $mapping)
            ->getQuery()
            ->getResult()
        ;

        $int = mt_rand(0, count($result));

        return $result[$int];
    } 
}

