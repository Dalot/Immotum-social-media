<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['title','category_name','original_price','min','max',"description", "our_price", "type"];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
}
