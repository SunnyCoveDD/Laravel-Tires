<?php

namespace App\Http\Controllers;

use App\Models\ProductDisk;
use App\Models\ProductModel;
use App\Models\ProductTire;
use App\Models\ProductVendor;
use App\Models\Url;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function get_vendors()
    {
        return response()->json([
           'tire_vendors' => ProductVendor::where('product_type', ProductTire::PRODUCT_TYPE)->get(),
           'disk_vendors' => ProductVendor::where('product_type', ProductDisk::PRODUCT_TYPE)->get(),
        ]);
    }

    public function get_data_by_alias($link_alias)
    {
        $url = Url::where('url', $link_alias)->first();
        if($url) {
            switch ($url->object_type) {
                case 'product_vendor':
                    return $this->show_vendor($url->object_id);
                case 'product_model':
                    return $this->show_model($url->object_id);
                case 'product_tire':
                    return ProductTire::findOrFail($url->object_id);
                case 'product_disk':
                    return ProductDisk::findOrFail($url->object_id);
            }
        }

        return response()->json([], 404);
    }

    public function show_vendor($object_id)
    {
        return response()->json([
            'vendor' => ProductVendor::findOrFail($object_id),
            'models' => ProductModel::where('product_vendor_id', $object_id)->paginate(10),
        ]);
    }

    public function show_model($object_id)
    {
        $model = ProductModel::with('vendor')->findOrFail($object_id);

        if(!$model->vendor)
            return response()->json([], 404);

        if($model->vendor->product_type === ProductTire::PRODUCT_TYPE)
            $products = ProductTire::where('product_model_id', $object_id)->paginate(10);
        else if($model->vendor->product_type === ProductDisk::PRODUCT_TYPE)
            $products = ProductDisk::where('product_model_id', $object_id)->paginate(10);

        return response()->json([
            'model' => $model,
            'products' => $products,
        ]);
    }
}
