<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class productmodel extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'price',
        'description',
        'category_id',
    ];
    

    public function category(){
        return $this->belongsTo(categorymodel::class);
    }
}
