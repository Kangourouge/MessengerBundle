Quick start
===========

The easiest way for map your api endpoints is to use the bundle configuration files.       
It's a little bit magic but avoid to write many config files and class.

Basic usage
-----------

1 - Set up yours endpoints:

```yaml
# config/packages/kangourouge_messenger.yaml
kangourouge_messenger:
  entities:
    my_entity_name:
      actions:
        list: ~
        create: ~
    an_other_entity_name:
      actions:
        list: ~
```

2 - Validate yours messages

```yaml
# config/validator/validation.yaml
Kangourouge\MessengerBundle\Message\Command\CreateCommand:
  properties:
    payload:
    - Collection:
        allowMissingFields: true
        fields:
          default:
            - Collection:
                allowExtraFields: true
          my_entity_name: #remove for avoid validation (not recommended!)
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
```

3 - Add a new repository method

```php
class MyEntityNameRepository implement MyEntityNameRepositoryInterface

    public function list(): array
    {
        // return a list of my_entity_name
    }

    public function create(string $id, array $content): void
    {
        // create a new my_entity_name
    }
```

It's all. If you check routes with ```bin/console debug:route ```, you will see 3 new route:
- list_my_entity_name
- create_my_entity_name
- list_an_other_entity_name

**Don't forget clear cache when you add new routes with this method!**
   
Messenger use preconfigure actions/message for map yours endpoints, entity and repository method.

Now you can read the [full configuration](./configuration_reference.md) reference for more customization.
