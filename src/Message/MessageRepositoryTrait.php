<?php

namespace Kangourouge\MessengerBundle\Message;

use Kangourouge\MessengerBundle\Registry\RepositoryRegistry;

/**
 * Trait MessageRepositoryTrait
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
trait MessageRepositoryTrait
{
    /** @var RepositoryRegistry */
    protected $repositoryRegistry;

    /** @var Object */
    protected $repository;

    /** @var string */
    protected $repositoryMethod;

    /** @var string */
    protected $userId;

    /** @var array */
    protected $methodParameters;

    /**
     * @param RepositoryRegistry $repositoryRegistry
     */
    public function __construct(RepositoryRegistry $repositoryRegistry)
    {
        $this->repositoryRegistry = $repositoryRegistry;
    }

    /**
     * @param MessageInterface $message
     *
     * @return self
     */
    protected function generateRepository(MessageInterface $message): self
    {
        $this->userId = $message->getUserId();
        $repositoryInterface = $message->getRepositoryInterface();
        $this->repositoryMethod = $message->getRepositoryMethod();
        $this->repository = $this->repositoryRegistry->get($repositoryInterface);

        return $this;
    }

    /**
     * @param mixed $parameter
     *
     * @return self
     */
    protected function addParameter($parameter): self
    {
        $this->methodParameters[] = $parameter;

        return $this;
    }

    /**
     * @param array $parameters
     */
    protected function addParameters(array $parameters): void
    {
        foreach ($parameters as $parameter) {
            $this->addParameter($parameter);
        }
    }

    /**
     * @return void
     */
    protected function execute(): void
    {
        if (null !== $this->userId) {
            $this->methodParameters[] = $this->userId;
        }

        call_user_func_array([$this->repository, $this->repositoryMethod], $this->methodParameters ?? []);
    }

    /**
     * @return array
     */
    protected function getResult(): array
    {
        if (null !== $this->userId) {
            $this->methodParameters[] = $this->userId;
        }

        return call_user_func_array([$this->repository, $this->repositoryMethod], $this->methodParameters ?? []);
    }
}
