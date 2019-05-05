<?php
namespace dozer\test;
require_once "../vendor/autoload.php";


use dozer111\serializer\SerializeFactory;
use dozer111\test\TestObject;

echo "SerializeFactory:json test start".PHP_EOL;

$testObject = new TestObject();
$data = (new SerializeFactory(SerializeFactory::SERIALIZER_JSON))
->serialize($testObject,SerializeFactory::SERIALIZE_NOT_PRIVATE);


$originalString = '{"address":"Springfield XX YY ZZ","city":"Springfield","country":"USA","someProtInfo":"some protected data","name":"Homer","surname":"Simpson","age":42,"somePubInfo":" some real test public data"}';

echo ($data === $originalString)?"SerializeFactory:json success".PHP_EOL:"SerializeFactory:json error".PHP_EOL;
echo "======================================================================".PHP_EOL;














