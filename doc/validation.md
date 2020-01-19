Validation
==========

Validation is executed by the Middleware Validation of Symfony messenger, just after dispatch the message.  
Use the [Sf validation yaml file]('https://symfony.com/doc/current/validation.html').

```yaml
Kangourouge\MessengerBundle\Message\Query\RetrieveQuery:
  properties:
    payload:
    - Collection:
        allowMissingFields: true # don't forget this line!
        fields:
          default:
            - Collection:
                fields:
                  pathParameter:
                    - Collection:
                        fields:
                          id:
                            - IsNull: ~
```

Validation multiple
-------------------

Often, you need to separate your validation for same message class (mandatory for command).
For do this, set the validation name in the route:

```yaml
create_stuff:
   path: /stuff
   methods: POST
   controller: App\Action\CreateStuffAction
   defaults:
     __message:
       repository_interface: 'Domain\Repository\Stuffrepository_interface:'
       repository_method: 'create'
       validation_name: 'create_stuff'
```

If you don't declare the validation name field, he is set as 'default'.

```yaml
Kangourouge\MessengerBundle\Message\Command\CreateCommand:
  properties:
    payload:
    - Collection:
        fields:    
        
          default: # if validation name not set
          - Collection:
              fields:
                content:
                - Collection:
                    fields:
                      name:
                      - NotNull: ~
                      - Type: string
                      startAt:
                      - NotNull: ~
                      - Type: DateTime
                      
          create_stuff: # create stuff only
          - Collection:
              fields:
                content:
                - Collection:
                    fields:
                      name:
                      - NotNull: ~
                      - Type: string
                      category:
                      - NotNull: ~
                      - Type: Category
                      
        allowMissingFields: true
```
       
Validation Groups
-----------------

If you want use validation groups, create an envelope and add a ValidationStamp.

```yaml
create_stuff:
   path: /stuff
   methods: POST
   controller: App\Action\CreateStuffAction
   defaults:
     __message:
       repository_interface: 'Domain\Repository\Stuffrepository_interface:'
       repository_method: 'create'
       validationGroups:
        - 'update'
        - 'stuff'
```

```php
use Kangourouge\MessengerBundle\Message\Command\CreateCommand;

class CreateStuffAction
{
    protected $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke(CreateCommand $command): Response
    {
        $command->setEntityId(Uuid::uuid4()->toString());
        $this->messageBus->dispatch(new Envelope($createCommand, [
            new ValidationStamp($command->getValidationGroups()),
        ]);

        return Response:create(null, Response:HTTP_CREATED, ['X-location' =>  $command->getEntityId()]);
    }
}
```
