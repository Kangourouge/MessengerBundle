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
    $createCommand->setId(Uuid::uuid4());
    $this->messageBus->dispatch($createCommand);

    return Response::create(null, Response::HTTP_CREATED, ['X-location' => $createCommand->getId()]);
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
      repositoryInterface: 'Domain\Repository\StuffRepositoryInterface'
      repositoryMethod: 'createMethod'
```

Repository method:

```php
public function createMethod(UuidInterface $id, array $content): void;
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
      repositoryInterface: 'Domain\Repository\StuffRepositoryInterface'
      repositoryMethod: 'updateMethod'
```

Repository method:


```php
public function updateMethod(UuidInterface $id, array $content): void;
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
      repositoryInterface: 'Domain\Repository\StuffRepositoryInterface'
      repositoryMethod: 'deleteMethod'
```

Repository method:


```php
public function deleteMethod(UuidInterface $id): void;
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
      repositoryInterface: 'Domain\Repository\StuffRepositoryInterface'
      repositoryMethod: 'patchMethod'
```

Repository method:


```php
public function patchMethod(UuidInterface $id, array $content): void;
```

Use denormilizer (optional)
---------------------------
For create and update message only.   

If you want persist with Doctrine, add an entityClass parameter in the __message field.

```yaml
__message:
  entityClass: 'Domain\Entity\Stuff'
```

Create, if needed, a [custom denormilzer](https://symfony.com/doc/current/serializer/custom_normalizer.html).  

Then adapt the repository method (just replace $content by your entity).

```php
public function createStuff(UuidInterface $id, Stuff $stuff): void;
```

Logged Command
--------------

Commonly, you need to know who use the command. Simply set it into the action with the setUser() method.  

```php
public function __invoke(CreateCommand $createCommand): Response
{
    $user = //get your user
    $createCommand->setUser($user);
    $createCommand->setId(Uuid::uuid4());
    $this->messageBus->dispatch($createCommand);

    return Response::create(null, Response::HTTP_CREATED, ['X-location' => $createCommand->getId()]);
}
```

Then add a user parameter in your repository method (always the last parameter).

```php
public function createMethod(UuidInterface $id, array $content, UuidInterface $user): void;
```

Custom command
--------------

For more specific command, see [make your own message](make_your_own_message.md).
