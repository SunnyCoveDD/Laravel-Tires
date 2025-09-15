<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTire extends Model
{
    use HasFactory;
    public const PRODUCT_TYPE = 1;
    public const OBJECT_TYPE = "product_tire";

    protected $guarded = ['id'];

    public function model() {
        return $this->belongsTo(ProductModel::class, 'product_model_id');
    }

    public function vendor() {
        return $this->belongsTo(ProductVendor::class, 'product_vendor_id');
    }
}
