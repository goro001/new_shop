<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
		protected $fillable = [
   		    'category_id',
   		    'user_id',
   		    'name',
   		    'image',
   		    'price',
   		    'description',
   		];

   		////////////////belongsTo mekiy mekiin

    public function Category()
    {
        return $this->belongsTo(Category::class,'category_id');
 // karanq grenq naev senc
      //   1. return $this->belongsTo(Category::class,'category_id','id');
      //   2. return $this->hasOne(Category::class,'id','category_id');
    }



        public function User()
    {
        return $this->belongsTo(User::class,'user_id');
 // karanq grenq naev senc
      //   1. return $this->belongsTo(Category::class,'category_id','id');
      //   2. return $this->hasOne(Category::class,'id','category_id');
    }
}
