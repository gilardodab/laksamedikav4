<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service_kendaraan;
use App\Models\Service_kendaraan_detail;
use Barryvdh\DomPDF\Facade as PDF;

class ServiceKendaraanController extends Controller
{
    //
    public function index()
    {
        $servicekendaraans = Service_kendaraan::orderBy('created_at', 'DESC')->get();
        return view('service_kendaraan.index', compact('servicekendaraans'));
    }

    public function create()
    {
        $servicekendaraans = Service_kendaraan::all();
        return view('service_kendaraan.create', compact('servicekendaraans'));
    }

    public function save(Request $request)
    {
        // dd($request->all());
        try {
                        
            $servicekendaraans = Service_kendaraan::create([
                'nama' => $request->nama,
                'merk_mobil' => $request->merk_mobil,
                'tanggal' => $request->tanggal,
            ]);
            

            return redirect(route('service_kendaraan.detail', ['id' => $servicekendaraans->id]));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function detail($id)
    {
        $servicekendaraans = Service_kendaraan::where('id', $id)->first();
        $details = Service_kendaraan_detail::where('service_kendaraan_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('service_kendaraan.detail', compact('servicekendaraans', 'details')); 
    }

    public function savedetail(Request $request)
    {
     
        // dd($request->all());
        foreach ($request->addmore as $key => $value) {
            Service_kendaraan_detail::create($value);
        }
     
        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function destroydetail($id)
    {
        $details = Service_kendaraan_detail::find($id);
        $details->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->back()->with(['success' => '<strong>' . $details->service . '</strong> Dihapus']);
    }

    public function destroy($id)
    {
        $servicekendaraans = Service_kendaraan::find($id);
        $details = Service_kendaraan_detail::where('service_kendaraan_id', $servicekendaraans->id)->delete(); 
        $servicekendaraans->delete(); 
        return redirect()->back()->with(['success' => 'Data telah dihapus']); 
    }

    public function print($id)
    {
        $details = Service_kendaraan_detail::where('service_kendaraan_id', $id)->orderBy('created_at', 'ASC')->get();
        $servicekendaraans = Service_kendaraan::where('id', $id)->first();
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        $pdf = PDF::loadView('service_kendaraan.print', compact('servicekendaraans', 'details'))->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
}
