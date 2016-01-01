<?php

namespace Celaris\Game\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Celaris\Game\Entity\Celaris;
use Celaris\Game\Entity\BuildingCelaris;
use Celaris\Game\Entity\Building; // Dossier Building

class CreateUniverseCommand extends EventCommand
{
    protected function configure()
    {
        $this
            ->setName('create:universe')
            ->setDescription('Build universe by galaxy and system.')
            ->addOption('serverName', null, InputOption::VALUE_REQUIRED, 'ServerName')
            ->addOption('galaxy', null, InputOption::VALUE_REQUIRED, 'Galaxy (1, 2, 3, 4 ...)')
            ->addOption('systemMin', null, InputOption::VALUE_REQUIRED, 'System (1, 2, 3, 4 ...)')
            ->addOption('systemMax', null, InputOption::VALUE_REQUIRED, 'System (1, 2, 3, 4 ...)')
        ;
    }

    protected function start(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Start");

        $serverName = $input->getOption('serverName');
        $galaxy = $input->getOption('galaxy');
        $systemMin = $input->getOption('systemMin');
        $systemMax = $input->getOption('systemMax');

        // Set le server name dans la sesion pour le manager et les repos
        if ($serverName != 'Game') {
            $this->serverName = $serverName;
            $em = $this->getManager();

            if (is_null($serverName))
                return 'Server name non renseigné';
        } else {
            // For test
            $em = $this->getDoctrine()->getManager();
        }

        $galaxies = array($galaxy);

        foreach ($galaxies as $galaxy) {
            $currentGalaxy = "G0$galaxy";

            $system = $systemMin;
            while ($system <= $systemMax) {
                switch(strlen($system)) {
                    case 1:
                        $currentSystem = "S00$system";
                        break;
                    case 2:
                        $currentSystem = "S0$system";
                        break;
                    default:
                        $currentSystem = "S$system";
                        break;
                }

                $numberOfPlanetToCreate = rand(6, 12);
                $planetCreate = 0;
                 // 23 - 9 planète et 14 lunes => 100 - 39.13 planètes et 60.86 lunes
                $planets = array(10, 20, 21, 30, 31, 32, 40, 41, 42, 43, 50, 51, 52, 53, 60, 61, 62, 63, 70, 71, 80, 81, 90);

                while ($planetCreate < $numberOfPlanetToCreate) {
                    $planetIndex = rand(0, count($planets) - 1);
                    $currentPlanet = 'P' . $planets[$planetIndex];
                    unset($planets[$planetIndex]);
                    $planets = array_values($planets);

                    // Coordonnées entière de la planète
                    $map = $currentGalaxy . $currentSystem . $currentPlanet;

                    $celaris = new Celaris();
                    $celaris->setMapping($map);
                    
                    // Persist and flush to get celarisId
                    $em->persist($celaris);
                    $em->flush($celaris);

                    if ($serverName != 'Game') {
                        $buildings = $this->getRepository('CelarisGameBundle:Building')->findAll();
                    } else {
                        // For test
                        $buildings = $this->getDoctrine()->getRepository('CelarisGameBundle:Building')->findAll();
                    } 

                    // Create all building by celaris
                    foreach ($buildings as $building) {
                        $currentBuilding = $building->getSpecificClass();

                        $buildingCelaris = new BuildingCelaris($building, $celaris);
                        // Set BuildingCelaris through specific class
                        $currentBuildingCelaris = new $currentBuilding($buildingCelaris);

                        // Précise 0 pour le niveau du centre de commandement
                        // Précise true pour dire que c'est une initialisation
                        // Le niveau du bâtiment restera donc à 0
                        $currentBuildingCelaris->levelUp(0, true);
                        $em->persist($buildingCelaris);
                    }

                    $planetCreate++;
                }

                $output->writeln("System: $system done with $planetCreate planets created");
                $system++;
            }
        }

        $em->flush();

        $output->writeln("Galaxy: $galaxy / System: $systemMin à $systemMax done");
    }
}
