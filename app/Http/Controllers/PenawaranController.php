<?php

namespace App\Http\Controllers;

use App\Models\Harga_penawaran;
use App\Models\Kondisi_penawaran;
use Illuminate\Http\Request;
use App\Models\Penawaran;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PenawaranController extends Controller
{
    //
    public function index()
    {
        $penawarans = Penawaran::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get(); // 2
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('penawaran.index', compact('penawarans')); // 3
    }

    public function allpenawaran()
    {
        $penawarans = Penawaran::orderBy('created_at', 'DESC')->get(); // 2
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('penawaran.allpenawaran', compact('penawarans')); // 3
    }

    public function create()
    {
        $penawarans = Penawaran::orderBy('created_at', 'DESC')->get(); // 2
        return view('penawaran.create', compact('penawarans')); // 3
    }

    public function save(Request $request)
    {
        //MELAKUKAN VALIDASI DATA YANG DIKIRIM DARI FORM INPUTAN
        $this->validate($request, [
            'customer' => 'required|string|max:100',
            'address' => 'required|string',
            'perihal' => 'required|string',
        ]);

        try {
            //MENYIMPAN DATA KEDALAM DATABASE
            $penawarans = Penawaran::create([
                'customer' => $request->customer,
                'address' => $request->address,
                'perihal' => $request->perihal,
                'no_hp' => Auth::user()->no_hp,
                'user_id' => Auth::user()->id,
            ]);
            $kondisis = Kondisi_penawaran::create([
                'penawaran_id' => $penawarans->id,
            ]);

            $hargapenawarans = Harga_penawaran::create([
                'penawaran_id' => $penawarans->id,
            ]);
            //REDIRECT KEMBALI KE HALAMAN /PRODUCT DENGAN FLASH MESSAGE SUCCESS
            return redirect()->route('detail.penawaran', $penawarans->id)->with(['success' => '<strong>' . $penawarans->customer . '</strong> Penawaran Telah dibuat']);
        } catch (\Exception $e) {
            //APABILA TERDAPAT ERROR MAKA REDIRECT KE FORM INPUT
            //DAN MENAMPILKAN FLASH MESSAGE ERROR
            return redirect('/penawaran/new')->with(['error' => $e->getMessage()]);
        }
    }

    public function detail($id)
    {
        $products = Product::orderBy('created_at', 'DESC')->get();
        $kondisis = Kondisi_penawaran::where('penawaran_id', $id)->where('kondisi', '!=', null)->orderBy('created_at', 'ASC')->get();
        $hargapenawarans = Harga_penawaran::where('penawaran_id', $id)->where('price', '!=', null)->orderBy('created_at', 'ASC')->get();
        $penawarans = Penawaran::where('id', $id)->first(); // 2
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('penawaran.detail', compact('penawarans', 'products', 'kondisis', 'hargapenawarans')); // 3
    }

    public function savekondisi(Request $request)
    {
        //MELAKUKAN VALIDASI DATA YANG DIKIRIM DARI FORM INPUTAN
        $this->validate($request, [
            'kondisi' => 'required|string',
        ]);

        try {
            //MENYIMPAN DATA KEDALAM DATABASE
            $kondisis = Kondisi_penawaran::create([
                'penawaran_id' => $request->penawaran_id,
                'kondisi' => $request->kondisi,
            ]);
            //REDIRECT KEMBALI KE HALAMAN /PRODUCT DENGAN FLASH MESSAGE SUCCESS
            return redirect()->back()->with(['success' => '<strong>' . $kondisis->kondisi . '</strong> Telah ditambah']);
        } catch (\Exception $e) {
            //APABILA TERDAPAT ERROR MAKA REDIRECT KE FORM INPUT
            //DAN MENAMPILKAN FLASH MESSAGE ERROR
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function saveharga(Request $request)
    {
        //MELAKUKAN VALIDASI DATA YANG DIKIRIM DARI FORM INPUTAN
        $this->validate($request, [
            'price' => 'required|integer',
        ]);

        try {
            //MENYIMPAN DATA KEDALAM DATABASE
            $hargapenawarans = Harga_penawaran::create([
                'penawaran_id' => $request->penawaran_id,
                'product_id' => $request->product_id,
                'price' => $request->price,
                'qty' => $request->qty,
            ]);
            //REDIRECT KEMBALI KE HALAMAN /PRODUCT DENGAN FLASH MESSAGE SUCCESS
            return redirect()->back()->with(['success' => '<strong>' . $hargapenawarans->product->title . '</strong> Telah ditambah']);
        } catch (\Exception $e) {
            //APABILA TERDAPAT ERROR MAKA REDIRECT KE FORM INPUT
            //DAN MENAMPILKAN FLASH MESSAGE ERROR
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroyKondisi($id)
    {
        $kondisis = Kondisi_penawaran::find($id);
        $kondisis->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->route('detail.penawaran', [$kondisis->penawaran_id])->with(['success' => '<strong>' . $kondisis->kondisi . '</strong> Dihapus']);
    }


    public function destroyHarga($id)
    {
        $hargapenawarans = Harga_penawaran::find($id);
        $hargapenawarans->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->route('detail.penawaran', [$hargapenawarans->penawaran_id])->with(['success' => '<strong>' . $hargapenawarans->product->title . '</strong> Dihapus']);
    }

    public function destroy($id)
    {
        $penawarans = Penawaran::find($id);
        $kondisis = Kondisi_penawaran::where('penawaran_id', $penawarans->id)->delete(); //QUERY KEDATABASE UNTUK MENGAMBIL DATA BERDASARKAN ID
        $hargapenawarans = Harga_penawaran::where('penawaran_id', $penawarans->id)->delete();
        $penawarans->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->back()->with(['success' => 'Penawaran telah dihapus']); // DIARAHKAN KEMBALI KEHALAMAN /product
    }
         
    public function printpenawaran($id)
    {
        $kondisis = Kondisi_penawaran::where('penawaran_id', $id)->where('kondisi', '!=', null)->orderBy('created_at', 'ASC')->get();
        $hargapenawarans = Harga_penawaran::where('penawaran_id', $id)->where('price', '!=', null)->orderBy('created_at', 'ASC')->get();
        $penawarans = Penawaran::where('id', $id)->first();
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        $pdf = PDF::loadView('penawaran.print', compact('kondisis', 'hargapenawarans', 'penawarans'))->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
    
    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $penawarans = Penawaran::where('customer', 'like', "%" . $cari . "%")
            ->paginate();

        // mengirim data pegawai ke view index
        return view('penawaran.index', compact('penawarans'));
    }
}