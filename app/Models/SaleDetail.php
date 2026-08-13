<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
// app/Models/SaleDetail.php
protected $primaryKey = 'saleDetail_id';
protected $fillable = ['sale_id', 'product_id', 'qty', 'price'];
    // public function product()
    // {
    //     return $this->belongsTo(Product::class, 'product_id', 'product_id');
    // }
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'sale_id');
    }
}
