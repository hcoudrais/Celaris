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

    private function prerequisiteBuilding($celaris, $buildingsLvl, $researchesLvl)
    {
        $em = $this->getManager();

        $buildings = $this->getRepository('CelarisGameBundle:Building')->findAll();
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

    private function prerequisiteResearch($player, $buildingsLvl, $researchesLvl)
    {
        $em = $this->getManager();

        $researches = $this->getRepository('CelarisGameBundle:Research')->findAll();
        foreach ($researches as $research) {
            // Récupère le ResearchPlayer
            $researchesPlayer = $this->getRepository('CelarisGameBundle:ResearchPlayer')->findOneBy(array(
                'player' => $player,
                'research' => $research
            ));

            // Si le ResearchPlayer est déjà actif je passe au prochain
            if ($researchesPlayer->getEnabled())
                continue;

            $preRequisites = $research->getPrerequisite(); // Array

            // Si il n'y pas de pré requis c'est que normalement je ne doit pas arriver là :)
            if (is_null($preRequisites)) {
                $researchesPlayer->setEnabled(true);
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
                $researchesPlayer->setEnabled(true);

                $em->persist($researchesPlayer);
            }
        }
    }

    private function checkPrerequisite($player)
    {
        $researchesPlayer = $this->getRepository('CelarisGameBundle:ResearchPlayer')->findBy(array(
            'player' => $player
        ));

        // Get level for all research
        foreach ($researchesPlayer as $researchPlayer)
            $researchesLvl[$researchPlayer->getResearch()->getResearchId()] = $researchPlayer->getLevel();

        // Récupère toutes les celaris du joueur
        $allCelaris = $this->allCelaris;

        foreach ($allCelaris as $celaris) {
            $buildingsCelaris = $this->getRepository('CelarisGameBundle:BuildingCelaris')->findBy(array(
                'celaris' => $celaris
            ));

            // Get level for all building
            foreach ($buildingsCelaris as $buildingCelaris)
                $buildingsLvl[$buildingCelaris->getBuilding()->getBuildingId()] = $buildingCelaris->getLevel();

            // Check prerequisite to enabled building
            $this->prerequisiteBuilding($celaris, $buildingsLvl, $researchesLvl);

            // Check prerequisite to enabled building
            $this->prerequisiteResearch($player, $buildingsLvl, $researchesLvl);
        }
    }

    private function getResearchLabLvl($player, $celaris)
    {
        // Récupère la technologie tachyon
        $tachyonResearch = $this->getRepository('CelarisGameBundle:Research')->find(Research::TACHYONCOMMUNICATION_ID);

        // Récupère la technologie tachyon du joueur pour avoir son level
        $tachyonResearchPlayer = $this->getRepository('CelarisGameBundle:ResearchPlayer')->findOneBy(array(
            'research' => $tachyonResearch,
            'player' => $player
        ));

        // Récupère le laboratoire de recherche 
        // utiliser pour level up la recherche
        $researchLab = $this
            ->getRepository('CelarisGameBundle:Building')
            ->find(Building::RESEARCH_LAB_ID)
        ;

        // Récupère toutes les celaris du joueur
        $allCelaris = $this->allCelaris;

        // Si le joueur a la technologie Tachyon et plus d'une planète, selon son niveau,
        // va cumuler les laboratoires de recherche les plus améliorés.
        // Sinon, récupère le niveau du labo du celaris courant.
        if ($tachyonResearchPlayer->getLevel() > 0 && count($allCelaris) > 1) {
            // Stock tout les niveau de tout les laboratoires du player
            $labLevels = array(); 
            foreach ($allCelaris as $celaris) {
                $researchLabBuilding = $this->getRepository('CelarisGameBundle:BuildingCelaris')->findOneBy(array(
                    'celaris' => $celaris,
                    'building' => $researchLab
                ));

                $labLevels[] = $researchLabBuilding->getLevel();
            }

            // Trie les niveau du plus grand au plus petit
            rsort($labLevels);

            $i = 0;
            $labLevel = 0;
            // Cumule le niveau des laboratoire selon le niveau
            // de la recherche tachyon
            while ($i < $tachyonResearchPlayer->getLevel()) {
                $labLevel += array_shift($labLevels);

                $i++;
            }

            return $labLevel;
        } else {
            $researchLabBuilding = $this
                ->getRepository('CelarisGameBundle:BuildingCelaris')
                ->findOneBy(array(
                    'building' => $researchLab,
                    'celaris' => $celaris
                ))
            ;

            return $researchLabBuilding->getLevel();
        }
    }
    
    protected function start(InputInterface $input, OutputInterface $output)
    {
        $events = $this->getEventResearch();
        $this->serverName = $input->getOption('serverName');
        $em = $this->getManager();

        foreach ($events as $event) {
            
            // Je recharge les entités avec doctrine pour pouvoir accéder à tous les champs au moment du flush
            // Pourquoi ??????
            $researchToLevelUp = $this->getRepository('CelarisGameBundle:Research')->find($event->getResearch()->getResearchId());
            $celaris = $this->getRepository('CelarisGameBundle:Celaris')->find($event->getCelaris()->getCelarisId());
            $player = $this->getRepository('CelarisGameBundle:Players')->find($event->getPlayer()->getPlayerId());
            $event = $this->getRepository('CelarisGameBundle:EventResearch')->find($event->getId());
            $this->allCelaris = $allCelaris = $this->getRepository('CelarisGameBundle:Celaris')->findBy(array(
                'player' => $player
            ));

            $researchCelarisToLevelUp = $this->getRepository('CelarisGameBundle:ResearchPlayer')->findOneBy(array(
                'research' => $researchToLevelUp,
                'player' => $player
            ));

            // Si la recherche à level up est déjà activé pour le player
            // alors je ne fais rien (Exception ?)
            if ($researchCelarisToLevelUp->getEnabled()) {
                $event->setDoneAt(new DateTime('now'));
                $em->persist($event);

                continue;
            }


            // Dans l'entité ResearchPlayer courant, set tous les champs.
            // Récupère le nom de la classe spéciale de la recherche
            $currentResearchToLevelUp = $researchToLevelUp->getSpecificClass();

            // Instancie la classe spéciale pour modifier le ResearchPlayer
            $currentResearchSpecific = new $currentResearchToLevelUp($researchCelarisToLevelUp);
            // Level up !
            $researchLabLvl = $this->getResearchLabLvl($player, $celaris);
            $currentResearchSpecific->levelUp($researchLabLvl);

            $em->persist($researchCelarisToLevelUp);
            $em->flush();

            // Check prerequisite for each celaris
            $this->checkPrerequisite($player);

            // Ajouter les points au classement général (table Player, researchPoint)
            $player->setResearchPoint($researchCelarisToLevelUp->getResearchPoint());
            $em->persist($player);

            $event->setDoneAt(new DateTime('now'));
            $em->persist($event);
        }

        $em->flush();
    }
}
