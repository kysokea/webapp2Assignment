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
        'discount',
        'sub_total_dollar',
        'grand_total_dollar',
        'sub_total_riel',
        'grand_total_riel',
        'cash_receive',
        'cash_return',
        'exchange_rate',
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
        return $this->belongsTo(Payment::class, 'payment_id', 'payment_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
