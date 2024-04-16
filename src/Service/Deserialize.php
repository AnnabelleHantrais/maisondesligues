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
        $json = $this->client->request('GET', 'http://localhost:2280/maisondesliguesAPI/public/index.php/licencie/'.$id); //url test
        dump($json->getContent());
//        $json = $this->client->request('GET', 'http://maisondesliguesapi.fr:8080/licencie/'.$id); 
        $licencie = $this->serializer->deserialize($json->getContent(), Licencie::class, 'json');

        return $licencie;
    }
    /**
     * Fonction qui retourne un Licencie si le numero de licence passé en paramètre existe dans la base oracle et false sinon.
     * @param type $numLicence
     * @return Licencie|boolean
     */
     public function getLicencieByNumLicence(int $numLicence):Licencie|bool
    {
        //$json = $this->client->request('GET', 'http://localhost:2280/maisondesliguesAPI/public/index.php/licencie/'.$numLicence); //url test
//        $json = $this->client->request('GET', 'http://10.10.2.148/maisondesliguesAPI/public/index.php/licencieByNum/'.$numLicence); //url test
       
        //$json = $this->client->request('GET', 'http://maisondesliguesapi.fr:8080/licencie/'. strval($numLicence) ); 
        $json = $this->client->request('GET', 'http://localhost:2280/maisondesliguesAPI/public/index.php/licencie/'. $numLicence ); 
//        dump($json->getContent());exit;
        $licencie = $this->serializer->deserialize($json->getContent(), Licencie::class, 'json');
//        var_dump($licencie->getNumlicence());exit;
        
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
