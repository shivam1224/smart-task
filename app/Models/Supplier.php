<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id', 'country_id'];

    public function category(){
    	return $this->hasOne('App\Models\Category','id', 'category_id');
    }
    public function country(){
    	return $this->hasOne('App\Models\Country','id','country_id');
    }
    
}
