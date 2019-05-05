<?php

namespace dozer111\serializer\serializer;





use dozer111\serializer\SerializeInterface;

class YamlSerialize implements SerializeInterface
{

    private $objectData;


    public function __construct(array $objectData)
    {
        $this->objectData = $objectData;
    }


    public function serialize(): string
    {
        return yaml_emit($this->objectData);
    }
}












