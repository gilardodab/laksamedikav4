<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductDetail;
use App\Models\Product;
use App\Models\Product_customer_detail;

class ProductController extends Controller
{
    //
    public function index($id)
    {
        $product = ProductDetail::with('product:id,stock')->where('id', $id)->first();
        return response()->json($product);
    }

    public function stokCustomerDetail($id)
    {
        $productcustomerdetail = Product_customer_detail::with('product:id,stock')->where('id', $id)->first();
        return response()->json($productcustomerdetail);
    }
    public function product(){
        $product = Product::get();
        return response()->json($product);
    }
}
