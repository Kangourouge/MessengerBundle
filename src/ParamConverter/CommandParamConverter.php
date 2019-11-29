<?php

namespace KRG\Bundle\MessengerBundle\ParamConverter;

use KRG\Bundle\MessengerBundle\Exception\MethodNotAllowedForCommandException;
use KRG\Bundle\MessengerBundle\Message\Command\CommandInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class CommandParamConverter
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
class CommandParamConverter implements ParamConverterInterface
{
    /**
     * @param Request        $request
     * @param ParamConverter $paramConverter
     */
    public function apply(Request $request, ParamConverter $paramConverter): void
    {
        if ($request->isMethod('GET')) {
            throw MethodNotAllowedForCommandException::create();
        }

        $routeParams = $request->get('_route_params');
        $messageParameters = $routeParams['__message'] ?? [];
        unset($routeParams['__message']);
        $pathParameters = $routeParams;

        try {
            $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $jsonException) {
            throw new BadRequestHttpException('Invalid json body content.');
        }

        $content = is_array($content) ? $content : [$content];

        $message = call_user_func_array(
            [$paramConverter->getClass(), 'create'],
            [
                $messageParameters['messageName'] ?? $request->get('_route'),
                $pathParameters,
                $content,
                $messageParameters['repositoryInterface'] ?? null,
                $messageParameters['repositoryMethod'] ?? null,
                $messageParameters['validationName'] ?? null,
                $messageParameters['validationGroups'] ?? [],
                $messageParameters['entityClass'] ?? null,
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
        return is_string($configuration->getClass()) && in_array(CommandInterface::class, class_implements($configuration->getClass()));
    }
}
