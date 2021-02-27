<?php

namespace App\Controller\Outline;

use App\Models\Outline;
use Scr\Request\Request;

class OutlineController
{

    public $outline;

    public function __construct()
    {
        $this->outline = new Outline;
    }

    /**
     * get one outline by id
     * @param int id outline
     * @return array
     */
    public function index($id)
    {
        $sql = $this->outline->firstId($id);
        return $sql;
    }

    /**
     * get all outline for owner by id
     * @param int id owner
     * @return array 
     */
    public function getOwnerId($id)
    {
        $outline = $this->outline->getOutlinesOwner($id);
        return $outline;
    }
    /**
     * create outline 
     * @return array created outline
     */
    public function store()
    {
        $outline = $this->outline->create(Request::all());
        return $outline;
    }
    /**
     * update outline
     * @param int id outline
     * @return array updated outline
     */
    public function update($id)
    {
        $this->outline->firstId($id);
        return $this->outline->change(Request::all());
    }
}
