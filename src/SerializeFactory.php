<?php

namespace dozer111\serializer;





use dozer111\serializer\exceptions\InvalidSerializeException;
use dozer111\serializer\serializer\JsonSerialize;
use dozer111\serializer\serializer\XmlSerialize;
use dozer111\serializer\serializer\YamlSerialize;
use ReflectionClass;
use ReflectionObject;
use ReflectionProperty;

final class SerializeFactory
{
    private $serializerType;
    private $serializerObject;

    public const SERIALIZER_JSON = 'json';
    public const SERIALIZER_YAML = 'yaml';
    public const SERIALIZER_XML = 'xml';


    public const SERIALIZE_ALL = 0;

    public const SERIALIZE_PUBLIC = 1;
    public const SERIALIZE_PROTECTED = 2;
    public const SERIALIZE_PRIVATE = 3;

    public const SERIALIZE_NOT_PUBLIC = 4;
    public const SERIALIZE_NOT_PROTECTED = 5;
    public const SERIALIZE_NOT_PRIVATE = 6;







    /**
     * SerializeFactory constructor.
     * @param string $serializeType
     * $serialize type can be one of defined value or className of custom serializer
     */
    public function __construct(string $serializeType)
    {
        $this->serializerType = $serializeType;
        #return $this;
    }


    public function serialize($objectToSerialize,int $propertySerializeType = self::SERIALIZE_ALL):string
    {

        $properties = $this->getPropertyList($objectToSerialize,$propertySerializeType);



        switch ($this->serializerType)
        {
            case self::SERIALIZER_JSON:
                $this->serializerObject = new JsonSerialize($properties);
                break;
            case self::SERIALIZER_YAML:
                $this->serializerObject = new YamlSerialize($properties);
                break;
            case self::SERIALIZER_XML :
                $this->serializerObject = new XmlSerialize($properties);
                break;
            default :
                $interfaces = class_implements($this->serializerType);

                if(!in_array(SerializeInterface::class,$interfaces))
                    throw new InvalidSerializeException();
                $this->serializerObject = new $this->serializerType($properties);
                break;


        }


        return $this->serializerObject->serialize();



    }



    protected function getPropertyList($object,int $type):array
    {
        if(!is_object($object))
            throw new \InvalidArgumentException("$object variable must be an object, now:"
                .gettype($object));


        # Set properties to serialize
        switch ($type)
        {
            case self::SERIALIZE_ALL:
                $properties = (new ReflectionObject($object))->getProperties();
                break;
            case self::SERIALIZE_PUBLIC:
                $properties = (new ReflectionObject($object))->getProperties(ReflectionProperty::IS_PUBLIC);
                break;
            case self::SERIALIZE_PROTECTED:
                $properties = (new ReflectionObject($object))->getProperties(ReflectionProperty::IS_PROTECTED);
                break;
            case self::SERIALIZE_PRIVATE:
                $properties = (new ReflectionObject($object))->getProperties(ReflectionProperty::IS_PRIVATE);
                break;
            case self::SERIALIZE_NOT_PUBLIC:
                $properties = array_merge(
                    (new ReflectionObject($object))->getProperties(ReflectionProperty::IS_PROTECTED),
                    (new ReflectionObject($object))->getProperties(ReflectionProperty::IS_PRIVATE)
                    );
                break;
            case self::SERIALIZE_NOT_PROTECTED:
                $properties = array_merge(
                    (new ReflectionObject($object))->getProperties(ReflectionProperty::IS_PUBLIC),
                    (new ReflectionObject($object))->getProperties(ReflectionProperty::IS_PRIVATE)
                );
                break;
            case self::SERIALIZE_NOT_PRIVATE:
                $properties = array_merge(
                    (new ReflectionObject($object))->getProperties(ReflectionProperty::IS_PROTECTED),
                    (new ReflectionObject($object))->getProperties(ReflectionProperty::IS_PUBLIC)

                );
                break;
        }



        # Set array to serialize from filtered properties
        $arrayToSerialize = [];
        foreach ($properties as $property)
        {
            $propertyName = $property->name;


            $reflectionClass = new ReflectionClass($object);
            $reflectionProperty = $reflectionClass->getProperty($propertyName);
            $reflectionProperty->setAccessible(true);


            $propertyValue = $reflectionProperty->getValue($object);


            $arrayToSerialize[$propertyName] = $propertyValue;
        }

        return $arrayToSerialize;
    }











}












