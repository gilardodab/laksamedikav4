<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hemochroma;
use App\Models\Hemochroma_detail;
use Barryvdh\DomPDF\Facade as PDF;

class HemochromaController extends Controller
{
    //
    public function index()
    {
        $hemochromas = Hemochroma::orderBy('created_at', 'DESC')->get(); // 2
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('hemochroma.index', compact('hemochromas')); // 3
    }

    public function create()
    {
        $hemochromas = Hemochroma::orderBy('created_at', 'DESC')->get(); // 2
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('hemochroma.create', compact('hemochromas')); // 3
    }

    public function save(Request $request)
    {
        //MELAKUKAN VALIDASI DATA YANG DIKIRIM DARI FORM INPUTAN
        $this->validate($request, [
            'customer' => 'required|string|max:100',
            'address' => 'required|string',
        ]);

        try {
            //MENYIMPAN DATA KEDALAM DATABASE
            $hemochromas = Hemochroma::create([
                'customer' => $request->customer,
                'address' => $request->address,
            ]);

            $details = Hemochroma_detail::create([
                'hemochroma_id' => $hemochromas->id,
                'customer' => $hemochromas->customer,
            ]);
            //REDIRECT KEMBALI KE HALAMAN /PRODUCT DENGAN FLASH MESSAGE SUCCESS
            return redirect()->route('detail.hemochroma', $hemochromas->id)->with(['success' => '<strong>' . $hemochromas->customer . '</strong> Telah dibuat']);
        } catch (\Exception $e) {
            //APABILA TERDAPAT ERROR MAKA REDIRECT KE FORM INPUT
            //DAN MENAMPILKAN FLASH MESSAGE ERROR
            return redirect('/hemochroma/new')->with(['error' => $e->getMessage()]);
        }
    }

    public function detail($id)
    {
        $hemochromas = Hemochroma::where('id', $id)->first();
        $details = Hemochroma_detail::where('hemochroma_id', $id)->where('serial_number', '!=', null)->orderBy('created_at', 'DESC')->get();
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('hemochroma.detail', compact('hemochromas', 'details')); // 3
    }

    public function savedetail(Request $request)
    {
        //MELAKUKAN VALIDASI DATA YANG DIKIRIM DARI FORM INPUTAN
        $this->validate($request, [
            'serial_number' => 'required|string',
        ]);

        try {
            //MENYIMPAN DATA KEDALAM DATABASE
            $details = Hemochroma_detail::create([
                'hemochroma_id' => $request->hemochroma_id,
                'customer' => $request->customer,
                'serial_number' => $request->serial_number,
                'tanggal' => $request->tanggal,
            ]);
            //REDIRECT KEMBALI KE HALAMAN /PRODUCT DENGAN FLASH MESSAGE SUCCESS
            return redirect()->back()->with(['success' => '<strong>' . $details->serial_number . '</strong> Telah ditambah']);
        } catch (\Exception $e) {
            //APABILA TERDAPAT ERROR MAKA REDIRECT KE FORM INPUT
            //DAN MENAMPILKAN FLASH MESSAGE ERROR
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function lihatDetail($id)
    {
        $hemochromas = Hemochroma::orderBy('created_at', 'DESC')->first();
        $details = Hemochroma_detail::where('hemochroma_id', $id)->where('serial_number', '!=', null)->orderBy('created_at', 'DESC')->get();
        return view('hemochroma.lihat_detail', with(compact('details', 'hemochromas')));
    }

    public function printhemochroma()
    {
        $details = Hemochroma_detail::where('serial_number', '!=', null)->orderBy('created_at', 'DESC')->get();
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        $pdf = PDF::loadView('hemochroma.print', compact('details'))->setPaper('a4', 'potrait');
        return $pdf->stream();
    }

    public function destroydetail($id)
    {
        $details = Hemochroma_detail::find($id);
        $details->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->route('detail.hemochroma', [$details->hemochroma_id])->with(['success' => '<strong>' . $details->serial_number . '</strong> Dihapus']);
    }

    public function destroy($id)
    {
        $hemochromas = Hemochroma::find($id);
        $details = Hemochroma_detail::where('hemochroma_id', $hemochromas->id)->delete();
        $hemochromas->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->back()->with(['success' => 'Data telah dihapus']); // DIARAHKAN KEMBALI KEHALAMAN /product
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $hemochromas = Hemochroma::where('customer', 'like', "%" . $cari . "%")
            ->paginate();

        // mengirim data pegawai ke view index
        return view('hemochroma.index', compact('hemochromas'));
    }
}
