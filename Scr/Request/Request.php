<?php
namespace Scr\Request;

class Request{
    static public function all()
    {
        foreach ($_REQUEST as $key=>$val)
        {
            $data[$key]=$val;
        }
        return $data;
    }
}