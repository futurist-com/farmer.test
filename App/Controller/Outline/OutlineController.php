<?php

namespace App\Controller\Outline;

use App\Models\Outline;
use Scr\Request\Request;

class OutlineController
{

    public $outline;

    //@todo  не  нравится    как  сделать покрасивее
    public function __construct()
    {
        $this->outline = new Outline;
    }

    public function index($id)
    {
        return $sql = $this->outline->select([])->where('id', $id, "=")->get();
        //var_dump($sql);
    }
    public function getOwnerId($id)
    {
        $outline = $this->outline->getOutlinesOwner($id); 
        //var_dump($outline);
        return $outline;
    }

    public function store()
    {
        //придумать  валидацию
        return $this->outline->insert(Request::all())->save();
    }
    
    public function update($id){
       return $this->outline->update(Request::all())->where('id', $id, '=')->save();
    }
}
