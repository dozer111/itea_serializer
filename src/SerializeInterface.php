<?php
namespace dozer111\serializer;

# 1 сериализовать данные
# 2 определить, какие именной свойства выводить
interface SerializeInterface
{



    public function __construct(array $objectData);
    public function serialize():string;
}












