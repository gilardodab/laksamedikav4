<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\Soal_detail;
use App\Models\Jawaban;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class SoalController extends Controller
{
    //
    public function index()
    {
        $soals = Soal::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('soal.index', compact('soals'));
    }

    public function hasiltest()
    {
        $soals = Soal::orderBy('created_at', 'DESC')->get();
        return view('soal.hasil_test', compact('soals'));
    }

    public function buat_soal()
    {
        // $soals = Soal::where('id', $id)->get('user_id');
        // $ids = [];
        // foreach ($soals as $soal) {
        //     $ids[] = $soal->user_id;
        // }
        // $users = User::whereNotIn('id', $ids)->get();
        $users = User::all();
        return view('soal.buat_soal', compact('users'));
    }

    public function save(Request $request)
    {
        // dd($request->all());
        try {
                        
            $soals = Soal::create([
                'topik' => $request->topik,
                'user_id' => $request->user_id,
            ]);
            

            return redirect(route('soal.isi_soal', ['id' => $soals->id]));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function isi_soal($id)
    {
        $soaldetails = Soal_detail::where('soal_id', $id)->orderBy('created_at', 'ASC')->get();
        $soals = Soal::where('id', $id)->first(); // 2
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('soal.isi_soal', compact('soals', 'soaldetails')); // 3
    }

    public function savesoal(Request $request)
    {
        // dd($request->all());
        try {
                        
            Soal_detail::create([
                'soal_id' => $request->soal_id, 
                'soal' => $request->soal,
                'user_id' => Auth::user()->id, 
            ]);
            

            return redirect()->back()->with(['success' => 'Soal Telah Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroysoal($id)
    {
        $soaldetails = Soal_detail::find($id);
        $soaldetails->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->route('soal.isi_soal', [$soaldetails->soal_id])->with(['success' => '<strong>' . $soaldetails->soal . '</strong> Dihapus']);
    }

    public function destroy($id)
    {
        $soals = Soal::find($id);
        $soaldetails = Soal_detail::where('soal_id', $soals->id)->delete(); //QUERY KEDATABASE UNTUK MENGAMBIL DATA BERDASARKAN ID
        $jawabans = Jawaban::where('soal_id', $soals->id)->delete();
        $soals->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->back()->with(['success' => 'Topik Soal telah dihapus']); // DIARAHKAN KEMBALI KEHALAMAN /product
    }

    public function testsoal($id)
    {
        $soals = Soal::where('id', $id)->first();
        $soaldetails = Soal_detail::where('soal_id', $id)->orderBy('created_at', 'ASC')->paginate(1);
        $soaldetail = Soal_detail::orderBy('created_at', 'ASC')->get();
        return view('soal.test_soal', compact('soaldetails', 'soals','soaldetail'));
    }

    public function savejawaban(Request $request)
    {
        // dd($request->all());
        try {
            Jawaban::create([
                    'soal_id' => $request->soal_id,
                    'soal_detail_id' => $request->soal_detail_id,
                    'soal' => $request->soal,
                    'jawaban' => $request->jawaban,
                ]);

            return redirect()->back()->with(['success' => 'Soal Telah Di Jawab!']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function generateInvoice($id)
    {
        //GET DATA BERDASARKAN ID
        $soals = Soal::with(['soal_detail', 'jawaban', 'jawaban.soal_detail'])->find($id);
        //LOAD PDF YANG MERUJUK KE VIEW PRINT.BLADE.PHP DENGAN MENGIRIMKAN DATA DARI INVOICE
        //KEMUDIAN MENGGUNAKAN PENGATURAN LANDSCAPE A4
        //setPaper([0, 0, 396.85, 623.62], 'landscape');
        $pdf = PDF::loadView('soal.print', compact('soals'))->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
        // $jawabans = Jawaban::orderBy('created_at', 'ASC')->get();
        // $soaldetails = Soal_detail::where('soal_id', $id)->orderBy('created_at', 'ASC')->get();
        // $soals = Soal::where('id', $id)->first();
        //setPaper([0, 0, 396.85, 623.62], 'landscape');
    //     $pdf = PDF::loadView('soal.print', compact('soals','soaldetails', 'jawabans'))->setPaper('a4', 'potrait');
    //     return $pdf->stream();
    // }


}
