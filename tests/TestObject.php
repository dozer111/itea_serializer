<?php

namespace dozer111\test;




/**
 * Simple DTO class with defined properties
 * Class TestObject
 */
class TestObject
{

    public $name = "Homer";
    public $surname  = "Simpson";
    public $age  = 42;
    public $somePubInfo = " some real test public data";


    protected $address = 'Springfield XX YY ZZ';
    protected $city = 'Springfield';
    protected $country = 'USA';
    protected $someProtInfo = 'some protected data';



    private $son = 'Bart';
    private $daughter = 'Maggy';
    private $wife = 'Marge';
    private $somePrivInfo = 'work on atomic station';







}









