<?php

namespace Kangourouge\MessengerBundle\Registry;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class RepositoryRegistry
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
class RepositoryRegistry
{
    /** @var ContainerInterface */
    private $container;

    /** @var array */
    private $repositories;

    /**
     * @param ContainerInterface $container
     * @param array              $repositories
     */
    public function __construct(ContainerInterface $container, array $repositories)
    {
        $this->container = $container;
        $this->repositories = $repositories;
    }

    /**
     * @param $name
     *
     * @return object
     */
    public function get($name)
    {
        if (!isset($this->repositories[$name])) {
            throw new \InvalidArgumentException(sprintf('The repository "%s" is not registered with the service container.', $name));
        }

        return $this->container->get($this->repositories[$name]);
    }
}
