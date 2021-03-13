<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
    const UNPAID = 0;
    const PAID = 1;
    
    	protected $fillable = [
   		    'product_id',
   		    'user_id',
   		    'status',
   		];




   	public function Product(){
        return $this->belongsTo(Product::class,'product_id');
    }


    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
}
