<?php
declare(strict_types=1);


namespace Nexus\SprykerEnv\Communication;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Xervice\Console\Business\Model\Command\AbstractCommand;

/**
 * @method \Nexus\SprykerEnv\Business\SprykerEnvFacade getFacade()
 */
class BuildEnvCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('spryker:env:server')
            ->setDescription('Create a spryker ready ubuntu server')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the new instance')
            ->addArgument('sshport', InputArgument::OPTIONAL, 'SSH Port for the new instance', '22022')
            ->addArgument('webport', InputArgument::OPTIONAL, 'WEB Port for the new instance', '8080');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getFacade()->createSprykerServer(
            $input->getArgument('name'),
            (int)$input->getArgument('sshport'),
            (int)$input->getArgument('webport'),
            $output
        );
    }

}