<?php

namespace Celaris\Game\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

abstract class EventCommand extends ContainerAwareCommand
{
    protected function getSession()
    {
        return $this->getContainer()->get('session');
    }

    protected function getDoctrine()
    {
        return $this->getContainer()->get('doctrine');
    }

    protected function getEventBuilding()
    {
        return $this
            ->getDoctrine()
            ->getRepository('CelarisSiteBundle:EventBuilding', 'auth')
            ->getEventsNotDone()
        ;
    }

    final protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            return $this->start($input, $output);
        } catch(\Exception $e) {
            // Ecrire les logs dans un fichier
//            MessageManager::error((string)$e);
            $output->writeln((string)$e);
            throw $e;
        }
    }

    abstract protected function start(InputInterface $input, OutputInterface $output);
}
