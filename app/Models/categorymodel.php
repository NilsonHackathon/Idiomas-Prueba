<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categorymodel extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'description',

    ];

    public function product(){
        return $this->hasMany(productmodel::class);
    }
}
