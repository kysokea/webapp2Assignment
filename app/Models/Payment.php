<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // app/Models/Payment.php
    protected $primaryKey = 'payment_id';
    protected $fillable = ['sale_id', 'payment_method_en','payment_method_kh'];
    public function sales()
    {
        return $this->hasMany(Sale::class, 'payment_id', 'payment_id');
    }
}
