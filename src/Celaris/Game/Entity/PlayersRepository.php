<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\EntityRepository;

class PlayersRepository extends EntityRepository
{
    public function getPlayerByUserId($userId)
    {
        $player = $this
            ->createQueryBuilder('p')
            ->where('p.userId = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getArrayResult()
        ;

        return count($player) > 0 ? $player[0] : null;
    }
}
