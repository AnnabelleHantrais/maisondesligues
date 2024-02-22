<?php

namespace App\Service;


use App\Entity\Licencie;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use Symfony\Component\Serializer\SerializerInterface;

class Deserialize
{
    public function __construct(
        private HttpClientInterface $client,
        private SerializerInterface $serializer
    ) {
    }
       
         
    public function getLicencie($id):Licencie
    {
        $json = $this->client->request('GET', 'http://localhost:2280/maisondesliguesAPI/public/index.php/licencie/'.$id);
        $responseContent = $json->getContent();
        $array = json_decode($responseContent, true);
        dump($array);
        $array['numlicence'] = strval($array['numlicence']);
        
        $json2= json_encode($array);
        dump($json2); // l'id est encore là
        $licencie = $this->serializer->deserialize($json2, Licencie::class, 'json');

        return $licencie;
    }
    
     public function getClub($id ): \App\Entity\Club
    {
        $json = $this->client->request('GET', 'http://localhost:2280/maisondesliguesAPI/public/index.php/club/'.$id);
        $responseContent = $json->getContent();
        $array = json_decode($responseContent, true);
        $json2= json_encode($array);
        $licencie = $this->serializer->deserialize($json2, Club::class, 'json');

        return $licencie;
    }
}
