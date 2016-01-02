<?php

namespace Celaris\Game\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class EventCommand extends ContainerAwareCommand
{
    protected $serverName;

    protected function getDoctrine()
    {
        return $this->getContainer()->get('doctrine');
    }

    protected function getManager()
    {
        return $this->getDoctrine()->getManager($this->serverName);
    }

    protected function getRepository($entity)
    {
        return $this->getDoctrine()->getRepository($entity, $this->serverName);
    }

    protected function getEventBuilding()
    {
        return $this
            ->getRepository('CelarisGameBundle:EventBuilding')
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
