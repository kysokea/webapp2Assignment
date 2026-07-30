<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_title_kh',
        'category_title_en',
        'disable'
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
