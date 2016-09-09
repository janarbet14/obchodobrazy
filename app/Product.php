<?php

namespace App;

class Product extends BaseModel {
    protected $primaryKey = 'id';
    protected $table = 'products';
    protected $fillable = array('name', 'title', 'description','unit_price','category_id','sizeX','sizeY','design', 'img_src');
}