<?php

namespace KRG\Bundle\MessengerBundle\ParamConverter;

use KRG\Bundle\MessengerBundle\Exception\MethodNotAllowedForQueryException;
use KRG\Bundle\MessengerBundle\Message\Query\QueryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class QueryParamConverter
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
class QueryParamConverter implements ParamConverterInterface
{
    /**
     * @param Request        $request
     * @param ParamConverter $paramConverter
     */
    public function apply(Request $request, ParamConverter $paramConverter): void
    {
        if (!$request->isMethod('GET')) {
            throw MethodNotAllowedForQueryException::create($request->getMethod());
        }

        $routeParams = $request->get('_route_params');
        $messageParameters = $routeParams['__message'] ?? [];
        unset($routeParams['__message']);
        $pathParameters = $routeParams;
        $queryParameters = $request->query->all();

        $message = call_user_func_array(
            [$paramConverter->getClass(), 'create'],
            [
                $messageParameters['messageName'] ?? $request->get('_route'),
                $pathParameters,
                $queryParameters,
                $messageParameters['repositoryInterface'] ?? null,
                $messageParameters['repositoryMethod'] ?? null,
                $messageParameters['validationName'] ?? null,
                $messageParameters['validationGroups'] ?? [],
            ]
        );
        $request->attributes->set($paramConverter->getName(), $message);
    }

    /**
     * @param ParamConverter $configuration
     *
     * @return bool
     */
    public function supports(ParamConverter $configuration): bool
    {
        return is_string($configuration->getClass()) && in_array(QueryInterface::class, class_implements($configuration->getClass()));
    }
}
