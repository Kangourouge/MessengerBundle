<?php

namespace KRG\Bundle\MessengerBundle\ParamConverter;

use KRG\Bundle\MessengerBundle\Message\MessageInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * Class MessageParamConverter
 *
 * @author Alexandre Tomatis <alexandre.tomatis@gmail.com>
 */
final class MessageParamConverter implements ParamConverterInterface
{
    /**
     * @param Request        $request
     * @param ParamConverter $paramConverter
     */
    public function apply(Request $request, ParamConverter $paramConverter): void
    {
        $className = $paramConverter->getClass();
        $message = new $className($messageParameters['messageName'] ?? $request->get('_route'));
        $routeParams = $request->get('_route_params');
        $messageParameters = $routeParams['__message'] ?? [];
        //Remove messenger bundle metadata
        unset($routeParams['__message']);
        $pathParameters = $routeParams;
        $message
            ->setDenormalized($messageParameters['isDenormalized'] ?? false)
            ->setLogged($messageParameters['isLogged'] ?? false)
            ->setEntityClass($messageParameters['entityClass'] ?? null)
            ->setRepositoryInterface($messageParameters['repositoryInterface'] ?? null)
            ->setRepositoryMethod($messageParameters['repositoryMethod'] ?? null)
            ->setValidationName($messageParameters['validationName'] ?? 'default')
            ->setValidationGroups($messageParameters['validationGroups'] ?? [])
        ;

        $payload = [
            $message->getValidationName() => [
                'pathParameters' => $pathParameters,
                'queryParameters' => $request->query->all(),
                'content' => $this->getContent($request),
            ]
        ];

        $message->setPayload($payload);
        $request->attributes->set($paramConverter->getName(), $message);
    }

    /**
     * @param ParamConverter $configuration
     *
     * @return bool
     */
    public function supports(ParamConverter $configuration): bool
    {
        return is_string($configuration->getClass()) && in_array(MessageInterface::class, class_implements($configuration->getClass()));
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    private function getContent(Request $request): array
    {
        if('' === $request->getContent()) {
            return [];
        }

        try {
            $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $jsonException) {
            throw new BadRequestHttpException('Invalid json body content.');
        }

        return is_array($content) ? $content : [$content];
    }
}
