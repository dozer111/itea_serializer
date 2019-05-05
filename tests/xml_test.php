<?php
namespace dozer\test;
require_once "../vendor/autoload.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
use dozer111\serializer\SerializeFactory;
use dozer111\test\TestObject;

echo "SerializeFactory:xml test start".PHP_EOL;

$testObject = new TestObject();
$data = (new SerializeFactory(SerializeFactory::SERIALIZER_XML))
    ->serialize($testObject,SerializeFactory::SERIALIZE_NOT_PRIVATE);

    
$originalString = '<?xml version="1.0" encoding="UTF-8"?>
<properties><property><name>address</name><value>Springfield XX YY ZZ</value><name>city</name><value>Springfield</value><name>country</name><value>USA</value><name>someProtInfo</name><value>some protected data</value><name>name</name><value>Homer</value><name>surname</name><value>Simpson</value><name>age</name><value>42</value><name>somePubInfo</name><value> some real test public data</value></property></properties>
';

echo ($data === $originalString)?"SerializeFactory:xml success".PHP_EOL:"SerializeFactory:xml error".PHP_EOL;
echo "======================================================================".PHP_EOL;














