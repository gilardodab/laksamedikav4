<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hemoglobin_yofalab;
use App\Models\Hemoglobin_yofalab_detail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;

class HemoglobinYofalabController extends Controller
{
    //
    public function index()
    {
        $hbyofalabs = Hemoglobin_yofalab::orderBy('created_at', 'DESC')->get(); // 2
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('hemoglobin_yofalab.index', compact('hbyofalabs')); // 3
    }

    public function create()
    {
        $hbyofalabs = Hemoglobin_yofalab::orderBy('created_at', 'DESC')->get(); // 2
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('hemoglobin_yofalab.create', compact('hbyofalabs')); // 3
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
            $hbyofalabs = Hemoglobin_yofalab::create([
                'customer' => $request->customer,
                'address' => $request->address,
            ]);

            $details = Hemoglobin_yofalab_detail::create([
                'hemoglobin_yofalab_id' => $hbyofalabs->id,
                'customer' => $hbyofalabs->customer,
            ]);
            //REDIRECT KEMBALI KE HALAMAN /PRODUCT DENGAN FLASH MESSAGE SUCCESS
            return redirect()->route('detail.hbyofalab', $hbyofalabs->id)->with(['success' => '<strong>' . $hbyofalabs->customer . '</strong> Telah dibuat']);
        } catch (\Exception $e) {
            //APABILA TERDAPAT ERROR MAKA REDIRECT KE FORM INPUT
            //DAN MENAMPILKAN FLASH MESSAGE ERROR
            return redirect('/hemoglobin-yofalab/new')->with(['error' => $e->getMessage()]);
        }
    }

    public function detail($id)
    {
        $hbyofalabs = Hemoglobin_yofalab::where('id', $id)->first();
        $details = Hemoglobin_yofalab_detail::where('hemoglobin_yofalab_id', $id)->where('serial_number', '!=', null)->orderBy('created_at', 'DESC')->get();
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('hemoglobin_yofalab.detail', compact('hbyofalabs', 'details')); // 3
    }

    public function savedetail(Request $request)
    {
        //MELAKUKAN VALIDASI DATA YANG DIKIRIM DARI FORM INPUTAN
        $this->validate($request, [
            'serial_number' => 'required|string',
        ]);

        try {
            //MENYIMPAN DATA KEDALAM DATABASE
            $details = Hemoglobin_yofalab_detail::create([
                'hemoglobin_yofalab_id' => $request->hemoglobin_yofalab_id,
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
        $hbyofalabs = Hemoglobin_yofalab::orderBy('created_at', 'DESC')->first();
        $details = Hemoglobin_yofalab_detail::where('hemoglobin_yofalab_id', $id)->where('serial_number', '!=', null)->orderBy('created_at', 'DESC')->get();
        return view('hemoglobin_yofalab.lihat_detail', with(compact('details', 'hbyofalabs')));
    }

    public function printhbyofalab()
    {
        $details = Hemoglobin_yofalab_detail::where('serial_number', '!=', null)->orderBy('created_at', 'DESC')->get();
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        $pdf = PDF::loadView('hemoglobin_yofalab.print', compact('details'))->setPaper('a4', 'potrait');
        return $pdf->stream();
    }

    public function destroydetail($id)
    {
        $details = Hemoglobin_yofalab_detail::find($id);
        $details->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->route('detail.hbyofalab', [$details->hemoglobin_yofalab_id])->with(['success' => '<strong>' . $details->serial_number . '</strong> Dihapus']);
    }

    public function destroy($id)
    {
        $hbyofalabs = Hemoglobin_yofalab::find($id);
        $details = Hemoglobin_yofalab_detail::where('hemoglobin_yofalab_id', $hbyofalabs->id)->delete();
        $hbyofalabs->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->back()->with(['success' => 'Data telah dihapus']); // DIARAHKAN KEMBALI KEHALAMAN /product
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $hbyofalabs = Hemoglobin_yofalab::where('customer', 'like', "%" . $cari . "%")
            ->paginate();

        // mengirim data pegawai ke view index
        return view('hemoglobin_yofalab.index', compact('hbyofalabs'));
    }


    public function signaturepad()
{
   return view('hemoglobin_yofalab.signaturepad');
}

public function upload(Request $request)
    {
        $folderPath = public_path('upload/');
        
        $image_parts = explode(";base64,", $request->signed);
              
        $image_type_aux = explode("image/", $image_parts[0]);
           
        $image_type = $image_type_aux[1];
           
        $image_base64 = base64_decode($image_parts[1]);
           
        $file = $folderPath . uniqid() . '.'.$image_type;
        file_put_contents($file, $image_base64);
        return back()->with('success', 'success Full upload signature');
    }

}
