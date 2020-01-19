Messenger Bundle
=================

Messenger bundle provide many helpers for use CQRS (with Symfony messenger component) in json API based system.

-----

He must be use for generate **basics** REST endpoints like:

- list entity *(with filters and pagination)*
- list entity by reference *(get users comments by example)*
- retrieve entity
- create entity
- update entity
- patch entity
- delete entity

For other specific endpoints, **we do not recommend** to use messenger bundle. Use a classic message is probably better.

Basic configuration
-------------

Set buses and route message.

```yaml
# config/packages/messenger.yaml
framework:
    messenger:
        transports:
             sync: 'sync://'
        routing:
            Kangourouge\MessengerBundle\Message\MessageInterface: sync
        default_bus: command.bus
        buses:
            command.bus:
                middleware:
                - validation
            query.bus:
                middleware:
                - validation
            event.bus:
                default_middleware: allow_no_handlers
                middleware:
                - validation
```

Load routes
```yaml
# config/route.yaml
messenger_routes:
  resource: 'Kangourouge\MessengerBundle\Routing\ApiRouteLoader'
  type: service
```

Tag our repositories with 'messenger_bundle.repository'

```yaml
# services/repository.yaml
services:
  Infrastructure\Repository\:
    resource: RepositoryConfig
    tags: ['messenger_bundle.repository']
    public: true
```

How to use
-----------

- [Quick start](./doc/quick_start.md)
- [Configuration reference](./doc/configuration_reference.md)
- [Validation](./doc/validation.md)

Advanced use
------------

If your are not familiar with messenger and CQRS we highly recommend to read these pages before starting this section:

- [Messenger](https://symfony.com/doc/current/messenger.html)
- [CQRS with messenger](https://symfony.com/doc/current/messenger/multiple_buses.html)
- [Get query result](https://symfony.com/doc/current/messenger/handler_results.html)

---

- [Commands](./doc/command.md)
- [Queries](./doc/queries.md)
- @TODO [Make your own message](./doc/make_your_own_message.md)
