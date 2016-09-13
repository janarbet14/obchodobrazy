<?php

namespace App;
use DB;

class Product extends BaseModel
{
    protected $primaryKey = 'id';
    protected $table = 'products';
    protected $fillable = array('name', 'title', 'description', 'unit_price', 'category_id', 'sizeX', 'sizeY ', 'design', 'img_src');
    protected $attributes = array('price');

    public function getPrice()
    {
        $d=0;
        $price=0;
        if($this->design=="Plátno") $d=1.01;
        if($this->design=="Papier") $d=1.02;
        if($this->design=="Tapeta") $d=1.03;
        $price=$this->sizeX*$this->sizeY*$this->unit_price*$d;
        return round($price,2);
    }

}