<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVendor extends Model
{
    use HasFactory;
    public const OBJECT_TYPE = "product_vendor";
    protected $guarded = ['id'];

    public function models() {
        return $this->hasMany(ProductModel::class);
    }
}
