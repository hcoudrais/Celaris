<?php

namespace Celaris\Game\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Celaris\Game\Entity\Building;
use Celaris\Game\Entity\Research;

use DateTime;

class EventBuildingCommand extends EventCommand
{
    protected function configure()
    {
        $this
            ->setName('event:building:up')
            ->setDescription('Building level up !')
            ->addOption('serverName', null, InputOption::VALUE_REQUIRED, 'ServerName')
        ;
    }

    private function checkPrerequisite($celaris, $player)
    {
        $buildingsCelaris = $this->getRepository('CelarisGameBundle:BuildingCelaris')->findBy(array(
            'celaris' => $celaris
        ));

        $researchesPlayer = $this->getRepository('CelarisGameBundle:ResearchPlayer')->findBy(array(
            'player' => $player
        ));

        // Get level for all building
        foreach ($buildingsCelaris as $buildingCelaris)
            $buildingsLvl[$buildingCelaris->getBuilding()->getBuildingId()] = $buildingCelaris->getLevel();

        // Get level for all research
        foreach ($researchesPlayer as $researchPlayer)
            $researchesLvl[$researchPlayer->getResearch()->getResearchId()] = $researchPlayer->getLevel();

        $buildings = $this->getRepository('CelarisGameBundle:Building')->findAll();

        $em = $this->getManager();

        // Check prerequisite to enabled building
        foreach ($buildings as $building) {
            // Récupère le BuildingCelaris
            $buildingsCelarisToSet = $this->getRepository('CelarisGameBundle:BuildingCelaris')->findOneBy(array(
                'celaris' => $celaris,
                'building' => $building
            ));

            // Si le BuildingCelaris est déjà actif je passe au prochain
            if ($buildingsCelarisToSet->getEnabled())
                continue;

            $preRequisites = $building->getPrerequisite(); // Array

            // Si il n'y pas de pré requis c'est que normalement je ne doit pas arriver là :)
            if (is_null($preRequisites)) {
                $buildingsCelarisToSet->setEnabled(true);
                continue;
            }

            // J'init à true, si jamais un pré requis ne correspond pas, je set à false
            $isEnabled = true;
            if (isset($preRequisites['building']))
                foreach ($preRequisites['building'] as $buildingName => $buildingLvl)
                    if ($buildingsLvl[Building::$findBuildingIdByName[$buildingName]] < $buildingLvl)
                        $isEnabled = false;

            if (isset($preRequisites['research']))
                foreach ($preRequisites['research'] as $researchName => $researchLvl)
                    if ($researchesLvl[Research::$findResearchIdByName[$researchName]] < $researchLvl)
                        $isEnabled = false;

            if ($isEnabled) {
                $buildingsCelarisToSet->setEnabled(true);

                $em->persist($buildingsCelarisToSet);
            }
        }
    }
    
    protected function start(InputInterface $input, OutputInterface $output)
    {
        $events = $this->getEventBuilding();
        $this->serverName = $input->getOption('serverName');
        $em = $this->getManager();

        foreach ($events as $event) {
            // Je recharge les entités avec doctrine pour pouvoir accéder à tous les champs au moment du flush
            $celaris = $this->getRepository('CelarisGameBundle:Celaris')->find($event->getCelaris()->getCelarisId());
            $buildingToLevelUp = $this->getRepository('CelarisGameBundle:Building')->find($event->getBuilding()->getBuildingId());
            $event = $this->getRepository('CelarisGameBundle:EventBuilding')->find($event->getId());
            $player = $this->getRepository('CelarisGameBundle:Players')->find($event->getPlayer()->getPlayerId());

            $buildingCelarisToLevelUp = $this->getRepository('CelarisGameBundle:BuildingCelaris')->findOneBy(array(
                'celaris' => $celaris,
                'building' => $buildingToLevelUp
            ));

            // Si le building à level up n'est pas encore activé pour le player
            // alors je ne fais rien (Exception ?)
            if (!$buildingCelarisToLevelUp->getEnabled()) {
                $event->setDoneAt(new DateTime('now'));
                $em->persist($event);

                continue;
            }

            // Récupère le centre de commande (si c'est pas le building courant) 
            // utiliser pour level up le building
            if (Building::COMMAND_CENTER_ID != $buildingToLevelUp->getBuildingId()) {
                $ccBuilding = $this
                    ->getRepository('CelarisGameBundle:Building')
                    ->find(Building::COMMAND_CENTER_ID)
                ;

                $ccBuildingCelaris = $this->getRepository('CelarisGameBundle:BuildingCelaris')->findOneBy(array(
                    'celaris' => $celaris,
                    'building' => $ccBuilding
                ));
            } else {
                $ccBuildingCelaris = $buildingCelarisToLevelUp;
            }

            // Dans l'entité BuildingCelaris courant, set tous les champs
            // besoin du centre de commandemant pour définir le temps de construction
            // Récupère le nom de la classe spéciale du building
            $currentBuildingToLevelUp = $buildingToLevelUp->getSpecificClass();

            // Instancie la classe spéciale pour modifier le BuildingCelaris
            $currentBuildingSpecific = new $currentBuildingToLevelUp($buildingCelarisToLevelUp, $celaris);
            // Level up !
            $currentBuildingSpecific->levelUp($ccBuildingCelaris->getLevel());

            $em->persist($buildingCelarisToLevelUp);
            $em->persist($celaris);
            $em->flush();

            // Check prerequisite
            $this->checkPrerequisite($celaris, $player);

            // Ajouter les points au classement général (table Player, workPoint)
            $player->setWorkPoint($buildingCelarisToLevelUp->getWorkPoint());
            $em->persist($player);

            $event->setDoneAt(new DateTime('now'));
            $em->persist($event);
        }

        $em->flush();
    }
}
