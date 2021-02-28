<?php
namespace Scr\ExtGeoApi;

use Scr\ExtGeoApi\IExtGeoApi;

class Dadata implements IExtGeoApi{
    
    public function __construct()
    {
        $token = "a1a18d1e4aff3723a84aa7e86bfbd4d62ebb9378";
        $secret = "9cd0d0da141cb9ecd1e71b809a88efea8ee2a312";
        $this->dadata = new \Dadata\DadataClient($token, $secret); 
    }

    /**
     * get address by main point
     * @param string $point1
     * @param string $point2
     * @retutn string
     */
    public function getAddress(string $point1, string $point2):string
    {
        $adress=$this->geolocateAddress(trim($point1), trim($point2));
        $adresStr=$adress[0]["unrestricted_value"];
        return $adresStr;
    }
    /**
     * geo loaction
     */

    public function geolocateAddress($point1, $point2){
      return $this->dadata->geolocate('address', trim($point1), trim($point2));  
    }
}