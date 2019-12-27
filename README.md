Messenger Bundle
=================

Common CQRS messages/handler & tools for Symfony messenger.

This bundle provide an easy and reusable way for simple request treatment.  

-----

If your are not familiar with messenger and CQRS we highly recommend to read these pages before starting:

- [Messenger](https://symfony.com/doc/current/messenger.html)
- [CQRS with messenger](https://symfony.com/doc/current/messenger/multiple_buses.html)
- [Get query result](https://symfony.com/doc/current/messenger/handler_results.html)

Configuration
-------------

Set buses and route message.

```yaml
framework:
    messenger:
        transports:
             sync: 'sync://'
        routing:
            KRG\Bundle\MessengerBundle\Message\MessageInterface: sync
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

Tag our repositories with 'messenger_bundle.repository'

```yaml
services:
  Infrastructure\Repository\:
    resource: '../../src/Infrastructure/Repository/*'
    tags: ['messenger_bundle.repository']
    public: true
```


How to use
-----------

- [Quick start](./doc/quick_start.md)
- [Commands](./doc/command.md)
- [Queries](./doc/queries.md)
- [Validation](./doc/validation.md)

Advanced
--------

- @TODO [Make your own message](./doc/make_your_own_message.md)

Todo
----

- Get only query param in paramconverter
