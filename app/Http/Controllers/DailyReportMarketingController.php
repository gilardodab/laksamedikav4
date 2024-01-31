<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Daily_report_marketing;
use Illuminate\Support\Facades\Auth;
use App\Models\Daily_report_marketing_detail;
use Barryvdh\DomPDF\Facade\Pdf;

class DailyReportMarketingController extends Controller
{
    //
    public function index()
    {
        $dailyreportmkts = Daily_report_marketing::with(['user'])->where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10); // 2
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('daily_report_marketing.index', compact('dailyreportmkts')); // 3
    }

    public function alldailyreportmkt()
    {
        $dailyreportmkts = Daily_report_marketing::all();
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('daily_report_marketing.alldailyreportmkt', compact('dailyreportmkts')); // 3
    }

    public function create()
    {
        $dailyreportmkts = Daily_report_marketing::orderBy('created_at', 'DESC')->get();
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('daily_report_marketing.create', compact('dailyreportmkts')); // 3
    }

    public function save(Request $request)
    {
        //MELAKUKAN VALIDASI DATA YANG DIKIRIM DARI FORM INPUTAN
        $this->validate($request, [
            'customer' => 'required|string|max:100',
            // 'address' => 'required|string',
        ]);

        try {
            //MENYIMPAN DATA KEDALAM DATABASE
            $dailyreportmkts = Daily_report_marketing::create([
                'customer' => $request->customer,
                // 'address' => $request->address,
                'user_id' => Auth::user()->id,
            ]);
            $details = Daily_report_marketing_detail::create([
                'daily_report_marketing_id' => $dailyreportmkts->id,
            ]);

            //REDIRECT KEMBALI KE HALAMAN /PRODUCT DENGAN FLASH MESSAGE SUCCESS
            return redirect()->route('detail.dailyreportmkt', $dailyreportmkts->id)->with(['success' => '<strong>' . $dailyreportmkts->customer . '</strong> Telah dibuat']);
        } catch (\Exception $e) {
            //APABILA TERDAPAT ERROR MAKA REDIRECT KE FORM INPUT
            //DAN MENAMPILKAN FLASH MESSAGE ERROR
            return redirect('/daily-report-marketing/new')->with(['error' => $e->getMessage()]);
        }
    }

    public function detail($id)
    {
        $details = Daily_report_marketing_detail::where('daily_report_marketing_id', $id)->where('tujuan', '!=', null)->orderBy('created_at', 'DESC')->get();
        $dailyreportmkts = Daily_report_marketing::where('id', $id)->first(); // 2
        // CODE DIATAS SAMA DENGAN > select * from `products` order by `created_at` desc 
        return view('daily_report_marketing.detail', compact('dailyreportmkts', 'details')); // 3
    }

    public function savedetail(Request $request, $id)
    {
        //MELAKUKAN VALIDASI DATA YANG DIKIRIM DARI FORM INPUTAN
        $this->validate($request, [
            'tujuan' => 'required|string',
        ]);

        try {
            //MENYIMPAN DATA KEDALAM DATABASE
            $details = Daily_report_marketing_detail::create([
                'daily_report_marketing_id' => $request->daily_report_marketing_id,
                'tanggal' => $request->tanggal,
                'tujuan' => $request->tujuan,
                'petugas' => $request->petugas,
                'no_hp' => $request->no_hp,
                'produk' => $request->produk,
                'penjelasan' => $request->penjelasan,
            ]);
            $dailyreportmkts = Daily_report_marketing::find($id);
            $dailyreportmkts->update([
                'updated_at' => now(),
            ]);
            //REDIRECT KEMBALI KE HALAMAN /PRODUCT DENGAN FLASH MESSAGE SUCCESS
            return redirect()->back()->with(['success' => '<strong>' . $details->tujuan . '</strong> Telah ditambah']);
        } catch (\Exception $e) {
            //APABILA TERDAPAT ERROR MAKA REDIRECT KE FORM INPUT
            //DAN MENAMPILKAN FLASH MESSAGE ERROR
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function lihatdetail($id)
    {
        $dailyreportmkts = Daily_report_marketing::where('id', $id)->orderBy('created_at', 'DESC')->first();
        $details = Daily_report_marketing_detail::where('daily_report_marketing_id', $id)->where('tujuan', '!=', null)->orderBy('created_at', 'DESC')->get();
        return view('daily_report_marketing.lihat_detail', with(compact('details', 'dailyreportmkts')));
    }

    public function destroydetail($id)
    {
        $details = Daily_report_marketing_detail::find($id);
        $details->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->route('detail.dailyreportmkt', [$details->daily_report_marketing_id])->with(['success' => '<strong>' . $details->tanggal . '</strong> Dihapus']);
    }

    public function destroy($id)
    {
        $dailyreportmkts = Daily_report_marketing::find($id);
        $details = Daily_report_marketing_detail::where('daily_report_marketing_id', $dailyreportmkts->id)->delete();
        $dailyreportmkts->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->back()->with(['success' => 'Data telah dihapus']); // DIARAHKAN KEMBALI KEHALAMAN /product
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $dailyreportmkts = Daily_report_marketing::where('customer', 'like', "%" . $cari . "%")
            ->paginate();

        // mengirim data pegawai ke view index
        return view('daily_report_marketing.index', compact('dailyreportmkts'));
    }

    public function printdailyreportmkt($id)
    {
        // Use find instead of first for better performance
        $dailyreportmkts = Daily_report_marketing::find($id);
    
        if (!$dailyreportmkts) {
            abort(404); // Or handle the case where the record is not found
        }
    
        // Use eloquent relationship to load details
        $details = $dailyreportmkts->details()
            ->where('tujuan', '!=', null)
            ->orderBy('created_at', 'desc')
            ->get();
    
        // Load the view and pass the data
        $pdf = PDF::loadView('daily_report_marketing.print', compact('dailyreportmkts', 'details'))
            ->setPaper('a4', 'portrait');
    
        // Stream the PDF to the browser
        return $pdf->stream();
    }
}
