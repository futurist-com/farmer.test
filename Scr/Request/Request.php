<?php
namespace Scr\Request;

class Request{
     /**
      * get  request data
      * @return $array;
      */
    static public function all()
    {
        $data=array();
        foreach ($_REQUEST as $key=>$val)
        {
            $data[$key]=$val;
        }
        return $data;
    }
}