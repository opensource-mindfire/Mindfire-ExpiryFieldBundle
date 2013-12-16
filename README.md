Mindfire ExpiryFieldBundle
==================

A Symfony2 Custom field type with month and year selectors which is useful for applications reading Expiry Month and Year inputs such as Credit Card Expiration.

Usage
-------
In composer.json, add the repository and the bundle.

```json
"repositories": [
        {"type": "vcs", "url": "https://github.com/mfsirameshk/Mindfire-ExpiryFieldBundle.git"}
    ],
    
 "require": {
        "mindfire/expiryfieldbundle": "*"
    }
```

Register the bundle in AppKernel.php
```php
new Mindfire\Bundle\ExpiryFieldBundle\MfsiExpiryFieldBundle(),
```

Add the parameter to specify the object manager:(Default value is `doctrine.orm.entity_manager`)
```yaml
expiry.object_manager_id: doctrine_mongodb.odm.document_manager
```

In your form type,
```php
$builder->add('ccExpiration', 'expiry');
```




License
-------

This bundle is available under the [MIT license](Resources/meta/LICENSE).

