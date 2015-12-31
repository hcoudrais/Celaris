<?php

namespace Celaris\Game\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EventBuildingCommand extends EventCommand
{
    protected function configure()
    {
        $this
            ->setName('event:building:up')
            ->setDescription('Building level up !')
        ;
    }

    protected function start(InputInterface $input, OutputInterface $output)
    {
        $events = $this->getEventBuilding();
        
        foreach ($events as $event) {
            $serverName = $event->getServerName();
            $celaris = $this
                ->getDoctrine()
                ->getRepository('CelarisGameBundle:Celaris', $serverName)
                ->find($event->getCelarisId())
            ;

            $building = $this
                ->getDoctrine()
                ->getRepository('CelarisGameBundle:Building', $serverName)
                ->find($event->getBuildingId())
            ;

            $buildingCelaris = $this->getDoctrine()->getRepository('CelarisGameBundle:BuildingCelaris')->findBy(array(
                'celaris' => $celaris,
                'building' => $building
            ));

            // Monter d'un niveau le bâtiment BuildingCelaris

            // Dans l'entité BuildingCelaris, set tous les autres champs
            // besoin du centre de commandemant pour définir le temps de construction

            // Ajouter les points au classement général (table Player, workPoint)
            $player = $this
                ->getDoctrine()
                ->getRepository('CelarisGameBundle:Players', $serverName)
                ->find($event->getPlayerId())
            ;

            // persist (flush au fil de l'eau ?)
        }

        // flush
    }
}