<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orderDetail()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function supplierProduct()
    {
        return $this->hasMany(SupplierProduct::class);
    }

}
