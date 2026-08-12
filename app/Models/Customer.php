<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

// #[Fillable(['customer_type_kh', 'customer_type_en'])]
class Customer extends Model
{
    protected $table = 'customers';

    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'customer_type_kh',
        'customer_type_en',
    ];
    public function sales()
    {
        return $this->hasMany(Sale::class, 'customer_id', 'customer_id');
    }
}
