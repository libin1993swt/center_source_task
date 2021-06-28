<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'id';

    public $fillable = ['title','parent_id','url'];


    /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function parent() {
        return $this->hasMany('App\Category','id','parent_id') ;
    }

    public function child() {
        return $this->hasMany('App\Category','parent_id','id') ;
    }

    public function product(){
        return $this->hasMany('App\Product');
    }

    public function recursiveParents() {
        return $this->child()->with('recursiveParents');
        //It seems this is recursive
    }

    public function recursiveChildren() {
        return $this->child()->with('recursiveChildren');
        //It seems this is recursive
    }
}
