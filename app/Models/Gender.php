<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $primaryKey = 'gender_id';
    public function users(){
        return $this->hasMany(User::class,'gender_id');
    }
}
