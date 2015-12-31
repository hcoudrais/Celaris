<?php

namespace Celaris\Game\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Celaris\Game\Entity\Confederation;

class TestCommand extends EventCommand
{
    protected function configure()
    {
        $this
            ->setName('demo:greet')
            ->setDescription('Greet someone')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )
            ->addOption(
                'yell',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will yell in uppercase letters'
            )
        ;
    }

    protected function start(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        if ($name) {
            $text = 'Hello '.$name;
        } else {
            $text = 'Hello';
        }

        if ($input->getOption('yell')) {
            $text = strtoupper($text);
        }

        $date = new \DateTime();
        $dateString = $date->format(\DateTime::ISO8601);

//        $confederation = new Confederation();
//        $confederation->setName($dateString);
//
//        $em = $this->getContainer()->get('doctrine')->getManager('Alpha');
//        $em->persist($confederation);
//        $em->flush();

//        $output->writeln($text);
    }
}
