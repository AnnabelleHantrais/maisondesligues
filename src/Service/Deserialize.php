<?php

namespace App\Service;
use App\Entity\Licencie;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use \App\Entity\Club;

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
        //$json = $this->client->request('GET', 'http://localhost:2280/maisondesliguesAPI/public/index.php/licencie/'.$id); //url test
        $json = $this->client->request('GET', 'http://maisondesliguesapi.fr:8080/licencie/'.$id); 
        $licencie = $this->serializer->deserialize($json->getContent(), Licencie::class, 'json');

        return $licencie;
    }
    
     public function getClub($id ): Club
    {
        //$json = $this->client->request('GET', 'http://10.10.2.148/maisondesliguesAPI/public/index.php/club/'.$id); //url test
         
        $json = $this->client->request('GET', 'http://maisondesliguesapi.fr:8080/club/'.$id);
        $licencie = $this->serializer->deserialize($json->getContent(), Club::class, 'json');

        return $licencie;
    }
}
