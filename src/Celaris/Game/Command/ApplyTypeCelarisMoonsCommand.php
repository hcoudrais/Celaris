<?php

namespace Celaris\Game\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ApplyTypeCelarisMoonsCommand extends EventCommand
{
    protected function configure()
    {
        $this
            ->setName('apply:type_celaris:moon')
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
            $types = $this->getRepository('CelarisGameBundle:TypeCelaris')->findAllTypeCelarisByTypeName('Moon');
        } else {
            // For test
            $em = $this->getDoctrine()->getManager();
            $types = $this->getDoctrine()->getRepository('CelarisGameBundle:TypeCelaris')->findAllTypeCelarisByTypeName('Moon');
        }

        // 1 - 25% ; 6 - 25% ; 7 - 25% ; 8 - 25%
        $typeIdAvailable = array(1, 6, 7, 8);
        // 11 - 33% ; 12 - 33% ; 14 - 33% 
        $typeIdAvailableAlbinion = array(11, 12, 14);

        $moonsType = array();
        foreach ($types as $type)
            $moonsType[$type->getTypeCelarisId()] = $type;

        if ($this->serverName != 'Game') {
            $moons = $this->getRepository('CelarisGameBundle:Celaris')->findAllMoons();
        } else {
            // For test
            $moons = $this->getDoctrine()->getRepository('CelarisGameBundle:Celaris')->findAllMoons();
        }

        $output->writeln(count($moons));

        // Shuffle all my planets before apply type
        shuffle($moons);

        foreach ($moons as $moon) {
            if (substr($moon->getMapping(), 0, 3) == 'G01') {
                // Cherche un index dans le tableau qui liste les type id disponible
                $index = rand(0, count($typeIdAvailableAlbinion) - 1);
                // Récupère la valeur de l'id correspondant au type de Celaris
                $indexTypeId = $typeIdAvailableAlbinion[$index];
                // Et enfin on récupère l'entité du type selectionné
                $applyType = $moonsType[$indexTypeId];
            } else {
                // Cherche un index dans le tableau qui liste les type id disponible
                $index = rand(0, count($typeIdAvailable) - 1);
                // Récupère la valeur de l'id correspondant au type de Celaris
                $indexTypeId = $typeIdAvailable[$index];
                // Et enfin on récupère l'entité du type selectionné
                $applyType = $moonsType[$indexTypeId];
            }

            $moon->setTypeCelaris($applyType);
            $em->persist($moon);
        }

        $em->flush();
        $output->writeln('End');
    }
}
