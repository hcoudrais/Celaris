<?php

namespace Celaris\Game\Views;

use Celaris\Game\Entity\Players;
use Celaris\Game\Entity\Confederation;
use Celaris\Game\Entity\Race;
use Celaris\Game\Entity\Faction;

class PlayerView
{
    public function getPlayerInfoView(Players $player)
    {
        $playerInfo = array();

        if ($player) {
            $playerInfo = array (
                'playerId' => $player->getPlayerId(),
                'name' => $player->getName(),
                'poppulation' => $player->getPoppulation(),
                'holidayMode' => $player->getHolidayMode(),
                'description' => $player->getDescription(),
                'militaryPoint' => $player->getMilitaryPoint(),
                'workPoint' => $player->getWorkPoint(),
                'ReasearchPoint' => $player->getResearchPoint()
            );

            if ($player->getConfederation() instanceof Confederation)
                $playerInfo['confederation'] = array(
                    'id' => $player->getConfederation()->getConfederationId(),
                    'name' => $player->getConfederation()->getName(),
                    'desc' => $player->getConfederation()->getDescrition()
                );

            if ($player->getRace() instanceof Race)
                $playerInfo['race'] = array(
                    'id' => $player->getRace()->getRaceId(),
                    'name' => $player->getRace()->getName()
                );

            if ($player->getFaction() instanceof Faction)
                $playerInfo['faction'] = array(
                    'id' => $player->getFaction()->getFactionId(),
                    'name' => $player->getFaction()->getName()
                );
        }

        return $playerInfo;
    }
}
