<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $primaryKey = 'sale_id';
    protected $fillable = [
        'customer_id',
        'user_id',
        'sale_date',
        'subtotal',
        'discount',
        'grand_total',
    ];
    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class, 'sale_id', 'sale_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class, 'sale_id', 'sale_id');
    }
}
