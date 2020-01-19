Queries
=======

Try to follow REST spec.  
Query must be only used on GET request and return 200 Response.

Queries rules:

- always synchronous
- must be return a response
- only read operation

Use QueryBus
------------

For get and return your response, use the query bus class and dispatch with query method.

```php
    $result = $queryBus->dispatch($retrieveStuff);
```

It's basically a class who inject MessageBus with the Handle Symfony trait. You can use it for your own standard queries.

RetrieveQuery
-------------

Return values of single entity.   

Entity id must be in the path.

Route:

```yaml
retrieve_stuff:
  path: /stuff/{id}
  methods: GET
  controller: App\Action\RetrieveStuffAction
  defaults:
    __message:
      repository_interface: 'Domain\Repository\StuffRepositoryInterface'
      repository_method: 'retrieveMethod'
```

Repository method:

```php
public function retrieveMethod(string $id): array;
```

ListQuery
---------

Return a filtered list.  

Pass filters, page, row per page and sort on query parameters;

Route:

```yaml
list_stuff:
  path: /stuff
  methods: GET
  controller: App\Action\ListStuffAction
  defaults:
    __message:
      repository_interface: 'Domain\Repository\StuffRepositoryInterface'
      repository_method: 'listMethod'
```

Repository method:

```php
public function listMethod(array $filters, int $page, int $rowPerPage, array $sort): array;
```

SimpleListQuery
---------------

Use this query for very simple list like get all category names by example.

Route:

```yaml
list_stuff:
  path: /stuff
  methods: GET
  controller: App\Action\SimpleListStuffAction
  defaults:
    __message:
      repository_interface: 'Domain\Repository\StuffRepositoryInterface'
      repository_method: 'SimpleListMethod'
```

Repository method:

```php
public function simpleListMethod(): array;
```

ListByEntityQuery
-----------------

Similar to ListQuery but include a resource filter in the path.

Route:

```yaml
list_stuff_by_warehouse:
  path: /warehouse/{id}/stuff
  methods: GET
  controller: App\Action\ListStuffAction
  defaults:
    __message:
      repository_interface: 'Domain\Repository\StuffRepositoryInterface'
      repository_method: 'listByEntityMethod'
```

Repository method:

```php
public function listMethod(array $filters, int $page, int $rowPerPage, array $sort): array;
```

Logged Query
--------------

Commonly, you need to know who use the query. Simply set it into the action with the setUser() method.  

```php
public function __invoke(RetireveQuery $retrieveStuff): Response
{
    $user = //get your user
    $retrieveStuff->setUser($user);
    
    return Response::create($this->queryBus->dispatch($retrieveStuff), RESPONSE::HTTP_OK);
}
```

Then add a user parameter in your repository method (always the last parameter).

```php
public function retireveMethod(string $id, string $user): void;
```

Custom query
------------

For more specific query, see [make your own message](make_your_own_message.md).
