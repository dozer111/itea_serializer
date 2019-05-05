<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "vendor/autoload.php";



use dozer111\serializer\SerializeFactory;

class X  {


    public $name = 'zzz';
    public $age = 22;

    protected $surname = "khonko";
    protected $surname2 = "khonko2";
    protected $surname3 = "khonko3";

    private $aaa1 = 'aaa1';
    private $aaa2 = 'aaa2 test ssss ';
    private $aaa3 = 'aaa3';





}

class DummySerialize implements \dozer111\serializer\SerializeInterface
{
    public function __construct(array $objectData)
    {

    }

    public function serialize(): string
    {
        return "some data dddd";
    }


}

$ddd = DummySerialize::class;

$a = new X();
$factory = new SerializeFactory(SerializeFactory::SERIALIZER_JSON);
$factory2 = new SerializeFactory(SerializeFactory::SERIALIZER_YAML);
$factory3 = new SerializeFactory(SerializeFactory::SERIALIZER_XML);

$res = $factory->serialize($a,SerializeFactory::SERIALIZE_NOT_PRIVATE);
$res2 = $factory2->serialize($a,SerializeFactory::SERIALIZE_PUBLIC);
$res3 = $factory3->serialize($a,SerializeFactory::SERIALIZE_PUBLIC);



echo "<pre>";
var_dump($res2);
echo "</pre>";
echo"<hr>";
die;




























