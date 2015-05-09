<?php

namespace Celaris\Game\Entity;

use Doctrine\ORM\EntityRepository;

class PlayersRepository extends EntityRepository
{
    public function getPlayerByUserId($userId)
    {
        $players = $this->findAll();

        foreach ($players as $player) {
            if ($player->getUserId() == $userId)
                return $player;
        }

        return null;
    }   
}