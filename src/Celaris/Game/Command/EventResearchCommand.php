<?php

namespace Celaris\Game\Command;

use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Celaris\Game\Entity\Building;
use Celaris\Game\Entity\Research;

use DateTime;

class EventResearchCommand extends EventCommand
{
    /**
     * Stock toutes les celaris du joueur
     * pour éviter de faire la requête plusieurs fois  
     * 
     * @var Collection 
     */
    private $allCelaris;
    
    protected function configure()
    {
        $this
            ->setName('event:research:up')
            ->setDescription('Research level up !')
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
        $researchesPlayer = $this->getRepository('CelarisGameBundle:ResearchPlayer')->findBy(array(
            'player' => $player
        ));

        // Get level for all research
        foreach ($researchesPlayer as $researchPlayer)
            $researchesLvl[$researchPlayer->getResearch()->getSpecificName()] = $researchPlayer->getLevel();

        // Récupère toutes les celaris du joueur
        $allCelaris = $this->allCelaris;

        foreach ($allCelaris as $celaris) {
            $buildingsCelaris = $this->getRepository('CelarisGameBundle:BuildingCelaris')->findBy(array(
                'celaris' => $celaris
            ));

            // Get level for all building
            foreach ($buildingsCelaris as $buildingCelaris)
                $buildingsLvl[$buildingCelaris->getBuilding()->getSpecificName()] = $buildingCelaris->getLevel();

            // Check prerequisite to enable building
            if (isset($events['building']))
                $this->prerequisiteBuilding($events['building'], $buildingsCelaris, $buildingsLvl, $researchesLvl);

            // Check prerequisite to enable research
            if (isset($events['research']))
                $this->prerequisiteResearch($events['research'], $researchesPlayer, $buildingsLvl, $researchesLvl);
        }
    }

    private function getResearchLabLvl($player, $celaris)
    {
        // Récupère la technologie tachyon du joueur pour avoir son level
        $tachyonResearch = $this->getRepository('CelarisGameBundle:Research')->find(Research::TACHYONCOMMUNICATION_ID);

        $tachyonResearchPlayer = $this->getRepository('CelarisGameBundle:ResearchPlayer')->findOneBy(array(
            'research' => $tachyonResearch,
            'player' => $player
        ));

        // Récupère le laboratoire de recherche utiliser pour level up la recherche
        $researchLab = $this
            ->getRepository('CelarisGameBundle:Building')
            ->find(Building::RESEARCH_LAB_ID)
        ;

        $researchLabBuilding = $this->getRepository('CelarisGameBundle:BuildingCelaris')->findOneBy(array(
            'celaris' => $celaris,
            'building' => $researchLab
        ));

        // Récupère toutes les celaris du joueur
        $allCelaris = $this->allCelaris;

        // Si le joueur a la technologie Tachyon et plus d'une planète, selon son niveau,
        // va cumuler les laboratoires de recherche les plus améliorés.
        // Sinon, récupère le niveau du labo du celaris courant.
        if ($tachyonResearchPlayer->getLevel() > 0 && count($allCelaris) > 1) {
            // Stock tout les niveau de tout les laboratoires du player
            $labLevels = array(); 
            foreach ($allCelaris as $celaris)
                $labLevels[] = $researchLabBuilding->getLevel();

            // Trie les niveau du plus grand au plus petit
            rsort($labLevels);

            $i = 0;
            $labLevel = 0;
            // Cumule le niveau des laboratoire selon le niveau
            // de la recherche tachyon
            while ($i <= $tachyonResearchPlayer->getLevel()) {
                $labLevel += array_shift($labLevels);

                $i++;
            }

            return $labLevel;
        }

        return $researchLabBuilding->getLevel();
    }

    private function checkEvents(Research $research, $level)
    {
        // For test
//        return array(
//            'building' => array('Minerais'),
//            'research' => array('Fuze')
//        );

        $triggerEvent = $research->getTriggerEvent();

        if ($triggerEvent)
            if (isset($triggerEvent[$level]))
                return $triggerEvent[$level];

        return array();
    } 

    protected function start(InputInterface $input, OutputInterface $output)
    {
        $events = $this->getEventResearch();
        $this->serverName = $input->getOption('serverName');
        $em = $this->getManager();

        foreach ($events as $event) {
            // Je recharge les entités avec doctrine pour pouvoir accéder à tous les champs au moment du flush
            // Pourquoi ??????
            $researchToLevelUp = $event->getResearch();
            $celaris = $event->getCelaris();

            $player = $this->getRepository('CelarisGameBundle:Players')->find($event->getPlayer()->getPlayerId());
            $event = $this->getRepository('CelarisGameBundle:EventResearch')->find($event->getId());
            $this->allCelaris = $this->getRepository('CelarisGameBundle:Celaris')->findBy(array(
                'player' => $player
            ));

            $researchPlayerToLevelUp = $this->getRepository('CelarisGameBundle:ResearchPlayer')->findOneBy(array(
                'research' => $researchToLevelUp,
                'player' => $player
            ));

            // Si la recherche à level up est déjà activé pour le player
            // alors je ne fais rien (Exception ?)
            if ($researchPlayerToLevelUp->getEnabled()) {
                $event->setDoneAt(new DateTime('now'));
                $em->persist($event);

                continue;
            }

            // Dans l'entité ResearchPlayer courant, set tous les champs.
            // Récupère l'entité de la classe spéciale de la recherche
            $currentResearchSpecific = $researchToLevelUp->getSpecificClass($researchPlayerToLevelUp);
            // Level up !
            $researchLabLvl = $this->getResearchLabLvl($player, $celaris);
            $currentResearchSpecific->levelUp($researchLabLvl);

            $em->persist($researchPlayerToLevelUp);
            // Verifie si le level déclenche un event particulier
            $events = $this->checkEvents($researchToLevelUp, $researchPlayerToLevelUp->getLevel());

            // Check prerequisite for each celaris
            if (count($events) > 0)
                $this->checkPrerequisite($events, $celaris, $player);

            // Ajouter les points au classement général
            $player->setResearchPoint($researchPlayerToLevelUp->getResearchPoint());
            $em->persist($player);

            $event->setDoneAt(new DateTime('now'));
            $em->persist($event);
        }

        $em->flush();
    }
}
