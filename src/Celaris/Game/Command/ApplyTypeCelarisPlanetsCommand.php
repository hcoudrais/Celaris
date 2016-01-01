<?php

namespace Celaris\Game\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ApplyTypeCelarisPlanetsCommand extends EventCommand
{
    protected function configure()
    {
        $this
            ->setName('apply:type_celaris:planet')
            ->setDescription('Build universe by galaxy and system.')
            ->addOption('serverName', null, InputOption::VALUE_REQUIRED, 'ServerName')
        ;
    }

    protected function start(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Start");

        $this->serverName = $input->getOption('serverName');

        if ($this->serverName != 'Game') {
            $em = $this->getManager();
            $types = $this->getRepository('CelarisGameBundle:TypeCelaris')->findAllTypeCelarisByTypeName('Planet');
        } else {
            // For test
            $em = $this->getDoctrine()->getManager();
            $types = $this->getDoctrine()->getRepository('CelarisGameBundle:TypeCelaris')->findAllTypeCelarisByTypeName('Planet');
        }

        // 2 - 30% ; 3 - 20% ; 4 - 25% ; 5 - 25%
        $typeIdAvailable = array(2, 2, 2, 2, 2, 2, 3, 3, 3, 3, 4, 4, 4, 4, 4, 5, 5, 5, 5, 5);
        // 9 - 40% ; 10 - 30% ; 13 - 30% 
        $typeIdAvailableAlbinion = array(9, 9, 9, 9, 10, 10, 10, 13, 13, 13);

        $planetsType = array();
        foreach ($types as $type)
            $planetsType[$type->getTypeCelarisId()] = $type;

        if ($this->serverName != 'Game') {
            $planets = $this->getRepository('CelarisGameBundle:Celaris')->findAllPlanets();
        } else {
            // For test
            $planets = $this->getDoctrine()->getRepository('CelarisGameBundle:Celaris')->findAllPlanets();
        }

        $output->writeln(count($planets) . ' planets');

        // Shuffle all my planets before apply type
        shuffle($planets);

        foreach ($planets as $planet) {
            if (substr($planet->getMapping(), 0, 3) == 'G01') {
                // Cherche un index dans le tableau qui liste les type id disponible
                $index = rand(0, count($typeIdAvailableAlbinion) - 1);
                // Récupère la valeur de l'id correspondant au type de Celaris
                $indexTypeId = $typeIdAvailableAlbinion[$index];
                // Et enfin on récupère l'entité du type selectionné
                $applyType = $planetsType[$indexTypeId];
            } else {
                // Cherche un index dans le tableau qui liste les type id disponible
                $index = rand(0, count($typeIdAvailable) - 1);
                // Récupère la valeur de l'id correspondant au type de Celaris
                $indexTypeId = $typeIdAvailable[$index];
                // Et enfin on récupère l'entité du type selectionné
                $applyType = $planetsType[$indexTypeId];
            }

            $planet->setTypeCelaris($applyType);
            $em->persist($planet);
        }

        $em->flush();
        $output->writeln('End');
    }
}
