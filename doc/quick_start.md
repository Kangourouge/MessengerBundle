Quick start
===========

For this example, we use the CreateCommand message for insert a new 'stuff' in the database.

Basic usage
-----------

1 - Create your Action

```php
use KRG\Bundle\MessengerBundle\Message\Command\CreateCommand;

class CreateStuffAction
{
    protected $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke(CreateCommand $createCommand): Response
    {
        $createCommand->setId(Uuid::uuid4());
        $this->messageBus->dispatch($createCommand);

        return Response::create(null, Response::HTTP_CREATED, ['X-location' => $createCommand->getId()]);
    }
}
```

2 - Validate your message

```yaml
KRG\Bundle\MessengerBundle\Message\Command\CreateCommand:
  properties:
    payload:
    - Collection:
        fields:
          default:
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
        allowMissingFields: true
```

For multiple validation see [validation](validation);

3 - Add a new repository method

```php
interface StuffRepositoryInterface

    public function create(Uuid interface $id, array $content): void;
```

```php
class StuffRepository implement StuffRepositoryInterface

    public function create(UuidInterface $id, array $content): void
    {
        // Doing DB insert.
    }
```

4 - Add a new route

```yaml
create_stuff:
  path: /stuff
  methods: POST
  controller: App\Action\CreateStuffAction
  defaults:
    __message:
      repositoryInterface: 'Domain\Repository\StuffRepositoryInterface'
      repositoryMethod: 'create'
```

Messages available
------------------

**[Queries](queries.md):**
- Retrieve
- List
- Simple list
- List by entity

**[Command:](command.md)**
- Create
- Update
- Delete
- Patch

**Or [make your custom message](make_your_own_message.md)**
