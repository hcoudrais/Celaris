<?php

namespace Celaris\Game\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Celaris\Game\Entity\Building;

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

    private function prerequisiteBuilding($eventsBuilding, array $buildingsCelaris, $buildingsLvl, $researchesLvl)
    {
        $em = $this->getManager();
        
        foreach ($buildingsCelaris as $buildingCelaris) {
            if (in_array($buildingCelaris->getBuilding()->getSpecificName(), $eventsBuilding)) {
                // Si le BuildingCelaris est déjà actif je passe au prochain
                if ($buildingCelaris->getEnabled())
                    continue;

                // J'init à true, si jamais un pré requis ne correspond pas, je set à false
                $isEnabled = true;

                $prerequisite = $buildingCelaris->getBuilding()->getPrerequisite();
                if (isset($prerequisite['building']))
                    foreach ($prerequisite['building'] as $buildingName => $lvl)
                        if ($buildingsLvl[$buildingName] < $lvl)
                            $isEnabled = false;

                if (isset($prerequisite['research']))
                    foreach ($prerequisite['research'] as $researchName => $lvl)
                        if ($researchesLvl[$researchName] < $lvl)
                            $isEnabled = false;
 
                if ($isEnabled) {
                    $buildingCelaris->setEnabled(true);

                    $em->persist($buildingCelaris);
                }
            }
        }
    }

    private function prerequisiteResearch($eventsResearch, array $researchesPlayer, $buildingsLvl, $researchesLvl)
    {
        $em = $this->getManager();
        
        foreach ($researchesPlayer as $research) {
            if (in_array($research->getResearch()->getSpecificName(), $eventsResearch)) {
                // Si la recherche est déjà actif je passe au prochain
                if ($research->getEnabled())
                    continue;

                // J'init à true, si jamais un pré requis ne correspond pas, je set à false
                $isEnabled = true;

                $prerequisite = $research->getResearch()->getPrerequisite();
                if (isset($prerequisite['building']))
                    foreach ($prerequisite['building'] as $buildingName => $lvl)
                        if ($buildingsLvl[$buildingName] < $lvl)
                            $isEnabled = false;

                if (isset($prerequisite['research']))
                    foreach ($prerequisite['research'] as $researchName => $lvl)
                        if ($researchesLvl[$researchName] < $lvl)
                            $isEnabled = false;
 
                if ($isEnabled) {
                    $research->setEnabled(true);

                    $em->persist($research);
                }
            }
        }
    }

    private function checkPrerequisite($events, $celaris, $player)
    {
        $buildingsCelaris = $this->getRepository('CelarisGameBundle:BuildingCelaris')->findBy(array(
            'celaris' => $celaris
        ));

        $researchesPlayer = $this->getRepository('CelarisGameBundle:ResearchPlayer')->findBy(array(
            'player' => $player
        ));

        // Get level for all building
        foreach ($buildingsCelaris as $buildingCelaris)
            $buildingsLvl[$buildingCelaris->getBuilding()->getSpecificName()] = $buildingCelaris->getLevel();

        // Get level for all research
        foreach ($researchesPlayer as $researchPlayer)
            $researchesLvl[$researchPlayer->getResearch()->getSpecificName()] = $researchPlayer->getLevel();

        // Check prerequisite to enabled building
        if (isset($events['building']))
            $this->prerequisiteBuilding($events['building'], $buildingsCelaris, $buildingsLvl, $researchesLvl);

        // Check prerequisite to enabled research
        if (isset($events['research']))
            $this->prerequisiteResearch($events['research'], $researchesPlayer, $buildingsLvl, $researchesLvl);
    }

    private function checkEvents(Building $building, $level)
    {
        $triggerEvent = $building->getTriggerEvent();
        
        // This foreach just for test
//        if ($triggerEvent)
//            foreach ($triggerEvent as $lvl => $events)
//                if ($level >= $lvl)
//                    return $events;

        if ($triggerEvent)
            if (isset($triggerEvent[$level]))
                return $triggerEvent[$level];

        return array();
    }        

    protected function start(InputInterface $input, OutputInterface $output)
    {
        $events = $this->getEventBuilding();
        $this->serverName = $input->getOption('serverName');
        $em = $this->getManager();

        // Peut être qu'il faudrait faire une boucle en amont sur les events 
        // pour dire qu'ils sont déjà pris en compte pour éviter qu'un autre appel
        // récupère un event qui est déjà pris en charge
        foreach ($events as $event) {
            // Je recharge les entités avec doctrine pour pouvoir accéder à tous les champs au moment du flush
            // Pourquoi ??????
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
            // utilisé pour level up le building
            if (Building::COMMAND_CENTER_ID != $buildingToLevelUp->getBuildingId()) {
                $ccBuildingCelaris = $this->getRepository('CelarisGameBundle:BuildingCelaris')->findOneBy(array(
                    'celaris' => $celaris,
                    'building' => Building::COMMAND_CENTER_ID
                ));
            } else {
                $ccBuildingCelaris = $buildingCelarisToLevelUp;
            }

            // Dans l'entité BuildingCelaris courant, set tous les champs,
            // besoin du centre de commandemant pour définir le temps de construction.
            // Récupère l'entité de la classe spéciale du building
            $currentBuildingSpecific = $buildingToLevelUp->getSpecificClass($buildingCelarisToLevelUp, $celaris);
            // Level up !
            $currentBuildingSpecific->levelUp($ccBuildingCelaris->getLevel());

            $em->persist($buildingCelarisToLevelUp);
            $em->persist($celaris);
            // Flush for level up ?

            // Verifie si le level déclenche un event particulier
            $events = $this->checkEvents($buildingToLevelUp, $buildingCelarisToLevelUp->getLevel());

            // Check prerequisite
            if (count($events) > 0)
                $this->checkPrerequisite($events, $celaris, $player);

            // Ajouter les points au classement général (table Player, workPoint)
            $player->setWorkPoint($buildingCelarisToLevelUp->getWorkPoint());
            $em->persist($player);

            $event->setDoneAt(new DateTime('now'));
            $em->persist($event);
        }

        $em->flush();
    }
}
