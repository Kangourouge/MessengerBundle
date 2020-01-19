Command
=======

Try to follow REST spec.
Query must be only used on POST, PUT, DELETE or PATCH request.

Command rules:

- Can become asynchronous
- Never return a response body
- Can use many handler (be careful with this)
- All data in command must be valid

CreateCommand
-------------
Persist a new entity.  

Usually return a Response 201 with X-location header. (202 in Ascyn)

By example:

```php
public function __invoke(CreateCommand $createCommand): Response
{
        $command->setEntityId(Uuid::uuid4()->toString());
        $this->commandBus->dispatch($command);

        return Response::create('', Response::HTTP_CREATED, ['X-location' => $command->getEntityId()]);
} 
```

Route:

```yaml
create_stuff:
  path: /stuff
  methods: POST
  controller: App\Action\CreateStuffAction
  defaults:
    __message:
      repository_interface: 'Domain\Repository\StuffRepositoryInterface'
      repository_method: 'createMethod'
```

Repository method:

```php
public function createMethod(string $id, array $content): void;
```

UpdateCommand
-------------
Update an existent entity.   

Usually return a Response 204 (202 in Ascyn)

Route:

```yaml
update_stuff:
  path: /stuff/{id}
  methods: PUT
  controller: App\Action\UpdateStuffAction
  defaults:
    __message:
      repository_interface: 'Domain\Repository\StuffRepositoryInterface'
      repository_method: 'updateMethod'
```

Repository method:


```php
public function updateMethod(string $id, array $content): void;
```

DeleteCommand
-------------

Delete an entity.   

Usually return a Response 204 (202 in Ascyn)

Route:

```yaml
update_stuff:
  path: /stuff/{id}
  methods: DELETE
  controller: App\Action\DeleteStuffAction
  defaults:
    __message:
      repository_interface: 'Domain\Repository\StuffRepositoryInterface'
      repository_method: 'deleteMethod'
```

Repository method:


```php
public function deleteMethod(string $id): void;
```

PatchCommand
------------

Patch an entity. Useful for status change by ex.

Usually return a Response 204 (202 in Ascyn)

Route:

```yaml
close_stuff:
  path: /stuff/{id}
  methods: PATCH
  controller: App\Action\PatchStuffAction
  defaults:
    __message:
      repository_interface: 'Domain\Repository\StuffRepositoryInterface'
      repository_method: 'patchMethod'
```

Repository method:


```php
public function patchMethod(string $id, array $content): void;
```

Use denormilizer (optional)
---------------------------
For create and update message only.   

If you want persist with Doctrine, add an entityClass parameter in the __message field.

```yaml
__message:
  entity_class: 'Domain\Entity\Stuff'
```

Create, if needed, a [custom denormilzer](https://symfony.com/doc/current/serializer/custom_normalizer.html).  

Then adapt the repository method (just replace $content by your entity).

```php
public function createStuff(string $id, Stuff $stuff): void;
```

Logged Command
--------------

Commonly, you need to know who use the command. Simply set it into the action with the setUser() method.  

```php
public function __invoke(CreateCommand $createCommand): Response
{
        if ($command->isLogged()) {
            $this->messageLogger->log($command);
        }

        $command->setEntityId(Uuid::uuid4()->toString());
        $this->commandBus->dispatch($command);

        return Response::create('', Response::HTTP_CREATED, ['X-location' => $command->getEntityId()]);
}
```

Then add a user parameter in your repository method (always the last parameter).

```php
public function createMethod(string $id, array $content, string $user): void;
```

Custom command
--------------

For more specific command, see [make your own message](make_your_own_message.md).
