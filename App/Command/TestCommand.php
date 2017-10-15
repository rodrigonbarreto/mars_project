<?php

namespace App\Command;

use App\Enum\DirectionsEnum;
use App\Model\Rover;
use App\Service\RoverService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class TestCommand
 * @package App\Command
 */
class TestCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:run')

            // the short description shown while running "php bin/console list"
            ->setDescription('Hello Hello Astronauta.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to communicate with Mars...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ...
        $output->writeln([
            '########',
            '============',
        ]);

        $roverService = new RoverService(new Rover());
        $roverService->setPosition(1,2, DirectionsEnum::N);
        $roverService->getCommands("LMLMLMLMM");
        $output->writeln($roverService->printPosition());

        $roverService = new RoverService(new Rover());
        $roverService->setPosition(3,3, DirectionsEnum::E);
        $roverService->getCommands("MMRMMRMRRM");
        $output->writeln($roverService->printPosition());

        $output->writeln([
            '============',
            '########',
        ]);
    }
}