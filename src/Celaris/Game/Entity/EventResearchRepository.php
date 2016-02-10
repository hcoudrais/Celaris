<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\EntityRepository;

use DateTime;

class EventResearchRepository extends EntityRepository
{
    public function getEventsNotDone()
    {
        return $this
            ->createQueryBuilder('er')
            ->where('er.doneAt IS NULL')
            ->andWhere('er.startEventDate < :now')
            ->setParameter('now', new DateTime('now'))
            ->orderBy('er.startEventDate')
            ->getQuery()
            ->getResult()
        ; 
    }
}