<?php

namespace Celaris\Site\Entity;

use Doctrine\ORM\EntityRepository;

class EventBuildingRepository extends EntityRepository
{
    public function getEventsNotDone()
    {
        return $this
            ->createQueryBuilder('eb')
            ->where('eb.doneAt IS NULL')
            ->orderBy('eb.startEventDate')
            ->getQuery()
            ->getResult()
        ; 
    }
}