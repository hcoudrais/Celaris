<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\EntityRepository;

class EventResearchRepository extends EntityRepository
{
    public function getEventsNotDone()
    {
        return $this
            ->createQueryBuilder('er')
            ->where('er.doneAt IS NULL')
            ->orderBy('er.startEventDate')
            ->getQuery()
            ->getResult()
        ; 
    }
}