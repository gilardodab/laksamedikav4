<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\App;
use App\Models\User;
use App\Models\Product_customer_detail;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->get(); // 2
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('products.index', compact('products')); // 3
    }

    public function create()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->get();
        $users = User::get();
        return view('products.create', compact('customers', 'users'));
    }

    public function createDetail($id)
    {
        $products = Product::where('id', $id)->first();
        $details = ProductDetail::where('product_id', $id)->get('customer_id');
        $ids = [];
        foreach ($details as $detail) {
            $ids[] = $detail->customer_id;
        }
        $customers = Customer::whereNotIn('id', $ids)->get();

        $detailcustomers = Product_customer_detail::where('product_id', $id)->get('user_id');
        $ids = [];
        foreach ($detailcustomers as $detailcustomer) {
            $ids[] = $detailcustomer->user_id;
        }
        $users = User::whereNotIn('id', $ids)->get();
        return view('products.detail', compact('details', 'customers', 'products', 'users', 'detailcustomers'));
    }

    // public function createDetail($id)
    // {
    //     $details = ProductDetail::orderBy('id', 'DESC')->get();
    //     $products = Product::where('id', $id)->first();
    //     $product = Product::orderBy('created_at', 'DESC')->get();
    //     $customers = Customer::orderBy('created_at', 'DESC')->get();
    //     return view('products.detail', compact('details', 'product', 'customers', 'products'));
    // }

    public function detailProduct(Request $request)
    {
        $detail = ProductDetail::create([
            'product_id' => $request->product_id,
            'price' => $request->price,
            'customer_id' =>  $request->customer_id,
        ]);
        $detail->save();
        return redirect()->route('lihat.detail', [$detail->product_id])->with(['success' => '<strong>' . $detail->customer->name . '</strong> Ditambahkan']);
    }

    public function SaveDetailCustomer(Request $request)
    {
        $detailcustomer = Product_customer_detail::create([
            'product_id' => $request->product_id,
            'price' => $request->price,
            'user_id' =>  $request->user_id,
        ]);
        $detailcustomer->save();
        return redirect()->route('lihat.detail', [$detailcustomer->product_id])->with(['success' => '<strong>' . $detailcustomer->user->name . '</strong> Ditambahkan']);
    }

    public function save(Request $request)
    {
        // dd($request->all());
        //MELAKUKAN VALIDASI DATA YANG DIKIRIM DARI FORM INPUTAN
        $this->validate($request, [
            'title' => 'required|string|max:100',
            'description' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'customer_id' => 'required|integer'
        ]);

        try {
            //MENYIMPAN DATA KEDALAM DATABASE
            $product = Product::create([
                'title' => $request->title,
                'description' => $request->description,
                'stock' => $request->stock,
                'customer_id' =>  $request->customer_id,
                'user_id' =>  Auth::user()->id,
            ]);

            $detail = ProductDetail::create([
                // 'id' => $product->id,
                'product_id' => $product->id,
                'price' => $request->price,
                'customer_id' => $request->customer_id,
            ]);

            $detailcustomer = Product_customer_detail::create([
                // 'id' => $product->id,
                'product_id' => $product->id,
                'price' => $request->price_customer,
                'user_id' => $request->user_id,
            ]);

            //REDIRECT KEMBALI KE HALAMAN /PRODUCT DENGAN FLASH MESSAGE SUCCESS
            return redirect('/product')->with(['success' => '<strong>' . $product->title . '</strong> Telah disimpan']);
        } catch (\Exception $e) {
            //APABILA TERDAPAT ERROR MAKA REDIRECT KE FORM INPUT
            //DAN MENAMPILKAN FLASH MESSAGE ERROR
            return redirect('/product/new')->with(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $customers = Customer::orderBy('created_at', 'DESC')->get();
        $details = ProductDetail::where('id', $id)->first();
        $product = Product::find($id); // Query ke database untuk mengambil data dengan id yang diterima
        return view('products.edit', with(compact('product', 'customers', 'details')));
    }

    public function update(Request $request, $id)
    {

        $product = Product::find($id); // QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        //KEMUDIAN MENGUPDATE DATA TERSEBUT
        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            //'price' => $request->price,
            'stock' => $request->stock,
            //'customer_id' =>  $request->customer_id,
        ]);
        //LALU DIARAHKAN KE HALAMAN /product DENGAN FLASH MESSAGE SUCCESS
        return redirect('/product')->with(['success' => '<strong>' . $product->title . '</strong> Diperbaharui']);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $detail = ProductDetail::where('product_id', $product->id)->delete();//QUERY KEDATABASE UNTUK MENGAMBIL DATA BERDASARKAN ID
        $detailcustomer = Product_customer_detail::where('product_id', $product->id)->delete();
        $product->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect('/product')->with(['success' => '</strong>' . $product->title . '</strong> Dihapus']); // DIARAHKAN KEMBALI KEHALAMAN /product
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $products = Product::where('title', 'like', "%" . $cari . "%")
            ->paginate();

        // mengirim data pegawai ke view index
        // return view('products.index', compact('products'));
        return response()->json($products);
    }

    public function lihatDetail($id)
    {
        $details = ProductDetail::where('product_id', $id)->get();
        $detailcustomers = Product_customer_detail::where('product_id', $id)->get();
        return view('products.lihat_detail', with(compact('details', 'detailcustomers')));
    }

    public function editDetail($id)
    {
        $customers = Customer::orderBy('created_at', 'DESC')->get();
        $details = ProductDetail::where('id', $id)->first();
        return view('products.edit_detail', with(compact('details', 'customers')));
    }

    public function editDetailCustomer($id)
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        $details = Product_customer_detail::where('id', $id)->first();
        return view('products.edit_detail_customer', with(compact('details', 'users')));
    }
    

    public function updateDetail(Request $request, $id)
    {

        $details = ProductDetail::find($id); // QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        //KEMUDIAN MENGUPDATE DATA TERSEBUT
        $details->update([
            'price' => $request->price,
            'customer_id' => $request->customer_id,
        ]);
        //LALU DIARAHKAN KE HALAMAN /product DENGAN FLASH MESSAGE SUCCESS
        return redirect()->route('lihat.detail', [$details->product_id])->with(['success' => '<strong>' . $details->product->title . '</strong> Diperbaharui']);
    }

    public function updateCustomerDetail(Request $request, $id)
    {

        $details = Product_customer_detail::find($id); // QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        //KEMUDIAN MENGUPDATE DATA TERSEBUT
        $details->update([
            'price' => $request->price,
            'user_id' => $request->customer_id,
        ]);
        //LALU DIARAHKAN KE HALAMAN /product DENGAN FLASH MESSAGE SUCCESS
        return redirect()->route('lihat.detail', [$details->product_id])->with(['success' => '<strong>' . $details->product->title . '</strong> Diperbaharui']);
    }

    public function destroyDetail($id)
    {
        $details = ProductDetail::find($id);
        $details->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->route('lihat.detail', [$details->product_id])->with(['success' => '<strong>' . $details->customer->name . '</strong> Dihapus']);
    }

    public function destroyDetailCustomer($id)
    {
        $details = Product_customer_detail::find($id);
        $details->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->route('lihat.detail', [$details->product_id])->with(['success' => '<strong>' . $details->user->name . '</strong> Dihapus']);
    }

    public function tambahStock(Request $request, $id)
    {
        $product = Product::find($id); // QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        //KEMUDIAN MENGUPDATE DATA TERSEBUT
        $product->update([
            'stock' => $product->stock + $request->stock,
        ]);
        //LALU DIARAHKAN KE HALAMAN /product DENGAN FLASH MESSAGE SUCCESS
        return redirect('/product')->with(['success' => 'Stock <strong>' . $product->title . '</strong> Diperbaharui']);
    }
}
