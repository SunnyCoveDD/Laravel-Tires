<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    public const OBJECT_TYPE = "product_model";

    protected $guarded = ['id'];

    public function vendor() {
        return $this->belongsTo(ProductVendor::class, 'product_vendor_id');
    }

    public function productDisks()
    {
        return $this->hasMany(ProductDisk::class);
    }

    public function productTires()
    {
        return $this->hasMany(ProductTire::class);
    }
}
