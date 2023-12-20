<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Barang;
class BarangController extends Controller
{
    public function index()
    {
        $data = Barang::all();
        return view('barang.index', compact('data'));
    }

    public function masukBarang(Request $request)
    {
        // Validasi request jika diperlukan

        Barang::create($request->all());

        return redirect()->route('barang.index');
    }

    public function keluarBarang(Request $request)
    {
        // Validasi request jika diperlukan

        $barang = Barang::find($request->id);
        $barang->update($request->all());

        return redirect()->route('barang.index');
    }

    public function edit($id)
    {
        $barang = Barang::find($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);
        $barang->update($request->all());

        return redirect()->route('barang.index');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
        $barang->delete();

        return redirect()->route('barang.index');
    }

    public function printlapbaranggudang()
    {
        // Menggunakan orderByDesc untuk lebih jelas
        $data = Barang::orderByDesc('created_at')->get();
    
        // Load view dengan menggunakan 'barangs.printgudang' sesuai dengan struktur folder view Anda
        $pdf = PDF::loadView('barang.printgudang', compact('data'))->setPaper('a4', 'landscape');
    
        // Menggunakan download() agar dapat diunduh daripada stream()
        return $pdf->download('laporan_barang_gudang.pdf');
    }
}