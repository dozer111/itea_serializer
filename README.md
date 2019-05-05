# dozer111\serialize

Library, for serializing object to:
* json
* yaml
* xml
* your custom dataType

> \+ possibility to get setted visibility lvl properties  
---

## Installing
`composer require dozer111/serialize`




## Usage examples

#### Simple serializing
```php
use dozer111\serializer\SerializeFactory;

# ..........

$testData = new SomeYourObject();


# you can get json data like this 
$data = (new SerializeFactory('json'))->serialize($testData);
# or using one of SerializeFactory constants
/*
$data = (new SerializeFactory(SerializeFactory::SERIALIZER_JSON))
            ->serialize($testData);
*/
```


#### Serialize only protected properties using Factory constants
```php
use dozer111\serializer\SerializeFactory;

# ..........

$testData = new SomeYourObject();
$data = (new SerializeFactory(SerializeFactory::SERIALIZER_JSON))
            ->serialize($testData,SerializeFactory::SERIALIZE_PROTECTED);
```

#### Serialize data using custom serializers
```php
use dozer111\serializer\SerializeFactory;
use xxx\yyy\DummySerialize;

# ..........

$testData = new SomeYourObject();
$yourSerializer = DummySerialize::class;

$data = (new SerializeFactory($yourSerializer))
            ->serialize($testData);
```