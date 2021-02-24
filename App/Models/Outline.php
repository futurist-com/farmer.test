<?php 
namespace App\Models;

use Scr\Model\Model;

class Outline extends Model{
    //
    protected $table="outlines";

    public function getOutlinesOwner($ownerId){
       return $this->select([])->where('owner_id', $ownerId, "=")->get();
    }    
}
