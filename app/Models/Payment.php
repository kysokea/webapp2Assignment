<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    // app/Models/Payment.php
    protected $primaryKey = 'payment_id';
    protected $fillable = ['sale_id', 'payment_method'];
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'sale_id');
    }
}
