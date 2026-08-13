<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'product_id';
    protected $fillable = [
        'product_name_kh',
        'product_name_en',
        'price',
        'avatar',
        'category_id',
        'disable'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    public function sales()
    {
        return $this->hasMany(Sale::class, 'product_id', 'product_id');
    }
}
