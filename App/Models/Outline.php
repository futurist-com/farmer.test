<?php

namespace App\Models;

use Scr\Model\Model;
use App\Models\MainPoint;

class Outline extends Model
{
    //
    protected $table = "outlines";

    /**
     * get all outline  for one owner
     * @param int owner id
     * @return array  
     */
    public function getOutlinesOwner($ownerId)
    {

        return $this->select()->where('owner_id', $ownerId, "=")->get();
    }
    /**
     * create outline
     * @param array data for create 
     * @return array create ouline  
     */
    public function create($date)
    {
        foreach ($date as $key => $d) {
            $this->$key = $d;
        }
        return $this->insert();
    }
    /**
     * update otline
     * @param array data for update
     * @return array update outline
     */
    public function change($date)
    {
        foreach ($date as $key => $d) {
            $this->$key = $d;
        }
        return $this->update();
    }
    /**
     * get for outline  additional point
     * @return array
     */
    public function MainPoint()
    {
        $point = new MainPoint;
        if ($this->id)
            return $point->pointByOutlinesId($this->id);
    }
}
