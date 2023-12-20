<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\pdf;

class LaporanBarangController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get(); // 2
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('laporan_barang.index', compact('products')); // 3
    }
    
    public function printlapbarang()
    {
        $products = Product::orderBy('created_at', 'DESC')->get(); // 2
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        $pdf = PDF::loadView('laporan_barang.print', compact('products'))->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
    
}
