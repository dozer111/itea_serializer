<?php

namespace dozer111\serializer\serializer;






use dozer111\serializer\SerializeInterface;

class XmlSerialize implements SerializeInterface
{

    private $objectData;


    public function __construct(array $objectData)
    {
        
        $this->objectData = $objectData;
    }

    public function serialize(): string
    {


        $domtree = new \DOMDocument('1.0', 'UTF-8');

        $xmlRoot = $domtree->createElement("properties");
        $xmlRoot = $domtree->appendChild($xmlRoot);

        $currentTrack = $domtree->createElement("property");
        $currentTrack = $xmlRoot->appendChild($currentTrack);

        foreach ($this->objectData as $property => $value)
        {
            $currentTrack->appendChild($domtree->createElement('name',$property));
            $currentTrack->appendChild($domtree->createElement('value',$value));

        }


        $res =  $domtree->saveXML();

        return $res;
    }


}












