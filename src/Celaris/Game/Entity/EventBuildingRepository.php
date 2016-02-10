<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\EntityRepository;

use DateTime;

class EventBuildingRepository extends EntityRepository
{
    public function getEventsNotDone()
    {
        return $this
            ->createQueryBuilder('eb')
            ->where('eb.doneAt IS NULL')
            ->andWhere('eb.startEventDate < :now')
            ->setParameter('now', new DateTime('now'))
            ->orderBy('eb.startEventDate')
            ->getQuery()
            ->getResult()
        ; 
    }
}