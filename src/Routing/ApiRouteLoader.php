<?php

namespace Kangourouge\MessengerBundle\Routing;

use Doctrine\Common\Inflector\Inflector;
use Symfony\Bundle\FrameworkBundle\Routing\RouteLoaderInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ApiRouteLoader
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class ApiRouteLoader implements RouteLoaderInterface
{
    const ACTION_LIST = 'list';
    const ACTION_LIST_BY_REFERENCE = 'list_by_reference';
    const ACTION_RETRIEVE = 'retrieve';
    const ACTION_RETRIEVE_MANY = 'retrieve_many';
    const ACTION_CREATE = 'create';
    const ACTION_UPDATE = 'update';
    const ACTION_PATCH = 'patch';
    const ACTION_DELETE = 'delete';
    const ACTION_UPDATE_MANY = 'update_many';
    const ACTION_DELETE_MANY = 'delete_many';

    /** @var array */
    private $config;

    /** @var array */
    private $defaultsAction;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->defaultsAction = Yaml::parseFile(__DIR__.'/../Resources/config/actions.yaml')['actions'];
    }

    /**
     * @throws \Exception
     *
     * @return RouteCollection
     */
    public function __invoke(): RouteCollection
    {
        $routes = new RouteCollection();
        $configs = [];

        foreach ($this->config['entities'] as $entityName => $entity) {
            $actions = $entity['actions'];
            unset($entity['actions']);
            $defaultActionConfig['other_parameters'] = $this->config['other_parameters'] ?? [];
            $defaultActionConfig['repository_interface'] = $this->getDefaultRepositoryInterface($this->config['repository_namespace'], $entityName);
            $defaultActionConfig['entity_class'] = $this->getDefaultEntityClass($this->config['entity_namespace'], $entityName);

            foreach (array_keys($entity) as $key) {
                $this->push($defaultActionConfig, $key, $entity);
            }

            foreach ($actions as $actionName => $action) {
                $actionConfig = $defaultActionConfig;
                $this->setDefaultByType($actionConfig, $actionName);
                $actionConfig['path'] = $this->getPath($actionName, $entityName);
                $actionConfig['route_name'] = sprintf('%s_%s', $actionName, $entityName);
                $actionConfig['validation_name'] = $entityName;

                foreach (array_keys($action) as $key) {
                    $this->push($actionConfig, $key, $action);
                }

                $configs[] = $actionConfig;
            }
        }

        foreach ($configs as $config) {
            $otherParameters = $config['other_parameters'];
            $path = $config['path'];
            $method = $config['method'];
            $controller = $config['controller'];
            $routeName = $config['route_name'];
            unset($config['other_parameters']);
            unset($config['path']);
            unset($config['method']);
            unset($config['controller']);
            unset($config['route_name']);
            $route = new Route($path);
            $route->setMethods($method);
            $route->setDefault('_controller', $controller);
            $message = [];

            foreach (array_keys($config) as $key) {
                $this->push($message, $key, $config);
            }

            $route->setDefault('__message', $message);

            foreach ($otherParameters as $name => $otherParameter)
            {
                $route->setDefault($name, $otherParameter);
            }

            $routes->add($routeName, $route);
        }

        return $routes;
    }

    /**
     * @return array
     */
    public static function getCommandsName(): array
    {
        return [
            self::ACTION_CREATE,
            self::ACTION_DELETE,
            self::ACTION_DELETE_MANY,
            self::ACTION_PATCH,
            self::ACTION_UPDATE,
            self::ACTION_UPDATE_MANY,
        ];
    }

    /**
     * @return array
     */
    public static function getQueriesName(): array
    {
        return [
            self::ACTION_LIST,
            self::ACTION_LIST_BY_REFERENCE,
            self::ACTION_RETRIEVE,
            self::ACTION_RETRIEVE_MANY,
        ];
    }

    /**
     * @param array  $array
     * @param string $key
     * @param array  $data
     *
     * @return ApiRouteLoader
     */
    private function push(array &$array, string $key, array $data): self
    {
        if (null !== $data[$key]) {
            $array[$key] = $data[$key];
        }

        return $this;
    }

    /**
     * @param array  $action
     * @param string $type
     *
     * @throws \Exception
     */
    private function setDefaultByType(array &$action, string $type): void
    {
        if (empty($this->defaultsAction[$type])) {
            throw new \Exception('Action not found.'); //@TODO custom exception
        }

        $default = $this->defaultsAction[$type];
        $action['method'] = $default['method'];
        $action['controller'] = $default['controller'];
        $action['repository_method'] = $default['repository_method'];
    }

    /**
     * @param string $namespace
     * @param string $interfaceName
     *
     * @return string
     */
    private function getDefaultRepositoryInterface(string $namespace, string $interfaceName): string
    {
        return sprintf('%s\%sRepositoryInterface', $namespace, Inflector::classify($interfaceName));
    }

    /**
     * @param string $namespace
     * @param string $className
     *
     * @return string
     */
    private function getDefaultEntityClass(string $namespace, string $className): string
    {
        return sprintf('%s\%s', $namespace, Inflector::classify($className));
    }

    /**
     * @param string $type
     * @param string $name
     *
     * @throws \Exception
     * @return string
     */
    private function getPath(string $type, string $name): string
    {
        if (empty($this->defaultsAction[$type])) {
            throw new \Exception('Action not found.'); //@TODO custom exception
        }

        $path = str_replace('{entity}', str_replace('_', '-', Inflector::pluralize($name)), $this->defaultsAction[$type]['path']);

        return sprintf('%s%s', $this->config['route_prefix'], $path);
    }
}
