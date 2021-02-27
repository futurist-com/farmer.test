<?php

namespace App\Models;

use Scr\Model\Model;

class MainPoint extends Model
{
    protected $table = "main_point";
    
    /**
     *  get all addirional poit for outline
     * @param outlineId - outline id
     * @return Array  - array  all addirional poit for outline
     */
    public function pointByOutlinesId($outlineId)
    {
        return $this->select()->where('outline_id', $outlineId, "=")->get();
    }
}
