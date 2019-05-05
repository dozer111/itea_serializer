<?php
namespace dozer111\serializer\exceptions;



class InvalidSerializeException extends \DomainException
{
    protected $message = "Serializer class must implement dozer111\serializer\SerializeInterface";
}









