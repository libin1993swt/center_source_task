<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id';

    public $fillable = ['title','category_id','url'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function recursiveCategory() {
        return $this->category()->with('recursiveCategory');
        //It seems this is recursive
    }
}
