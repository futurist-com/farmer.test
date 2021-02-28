<?php

namespace App\Controller\Outline;

use App\Models\Outline;
use Scr\ExtGeoApi\Dadata;
use Scr\ExtGeoApi\ExtGeoApi;

class CheckAdressController
{

    public $outline;

    public function __construct()
    {
        $this->outline = new Outline;
        $this->dadata=ExtGeoApi::getExtGeoApi(new Dadata);

    }

    /**
     * get adress dadata
     * @param int id outline
     * @return array
     */
    public function checkAdress($id)
    {
        $outline = $this->outline->firstId($id);
        $point= explode(',', $outline['main_point']);
        $adress=$this->dadata->getAddress($point[0], $point[1]);
        if ($outline['addres_otline']!=$adress){
            $this->outline->addres_otline=$adress;
            $outlineNew=$this->outline->update();
        }
        return $outline;
    }
}
