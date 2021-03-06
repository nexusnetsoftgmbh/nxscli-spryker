<?php


namespace Nexus\Spryker\Business;


use Nexus\DockerClient\Business\DockerClientFacade;
use Nexus\RabbitMq\Business\RabbitMqFacade;
use Nexus\Spryker\Business\Console\SprykerConsole;
use Nexus\Spryker\Business\Console\SprykerConsoleInterface;
use Nexus\Spryker\Business\Deploy\SprykerDeploy;
use Nexus\Spryker\Business\Installer\SprykerInstaller;
use Nexus\Spryker\Business\Installer\SprykerInstallerInterface;
use Nexus\Spryker\Business\Prepare\RabbitMqPrepare;
use Nexus\Spryker\Business\Prepare\RabbitMqPrepareInterface;
use Nexus\Spryker\SprykerDependencyProvider;
use Xervice\Core\Business\Model\Factory\AbstractBusinessFactory;

class SprykerBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @param string $container
     *
     * @return \Nexus\Spryker\Business\Prepare\RabbitMqPrepareInterface
     */
    public function createRabbitMqPrepare(string $container): RabbitMqPrepareInterface
    {
        return new RabbitMqPrepare(
            $this->getRabbitMqFacade(),
            $container
        );
    }

    /**
     * @param string $container
     *
     * @return \Nexus\Spryker\Business\Deploy\SprykerDeploy
     */
    public function createSprykerDeploy(string $container): SprykerDeploy
    {
        return new SprykerDeploy(
            $this->createSprykerConsole($container)
        );
    }

    /**
     * @param string $container
     *
     * @return \Nexus\Spryker\Business\Console\SprykerConsoleInterface
     */
    public function createSprykerConsole(string $container): SprykerConsoleInterface
    {
        return new SprykerConsole(
            $this->getDockerFacade(),
            $container
        );
    }

    /**
     * @param string $container
     *
     * @return \Nexus\Spryker\Business\Installer\SprykerInstallerInterface
     */
    public function createprykerInstaller(string $container): SprykerInstallerInterface
    {
        return new SprykerInstaller(
            $this->getDockerFacade(),
            $container
        );
    }

    /**
     * @return \Nexus\DockerClient\Business\DockerClientFacade
     */
    public function getDockerFacade(): DockerClientFacade
    {
        return $this->getDependency(SprykerDependencyProvider::DOCKER_FACADE);
    }

    /**
     * @return \Nexus\RabbitMq\Business\RabbitMqFacade
     */
    public function getRabbitMqFacade(): RabbitMqFacade
    {
        return $this->getDependency(SprykerDependencyProvider::RABBITMQ_FACADE);
    }

    /**
     * @return array
     */
    public function getCommandList(): array
    {
        return $this->getDependency(SprykerDependencyProvider::SPRYKER_COMMANDS);
    }
}