<?php

namespace App\Http\Controllers;

use App\Invoice_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use App\Models\Invoiceppn;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade as PDF;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan_penjualan.index');
    }

    public function cari(Request $request)
    {
       

        $this->validate($request, [
            'dari' => 'required',
            'sampai' => 'required'
        ]);

        $dari = date('Y-m-d', strtotime($request->dari));
        $sampai = date('Y-m-d', strtotime($request->sampai));

        $invoices = Invoice::with('customer')->whereBetween(
            'tanggal',
            [$dari, $sampai]
            )->withTrashed()->get();

        $total_pemasukan = DB::table('invoices')->whereBetween(
            'tanggal',
            [$dari, $sampai]
        )->sum('total');

        //dd($request->all());
        $pdf = PDF::loadView('laporan_penjualan.cetak', compact('invoices', 'total_pemasukan', 'dari', 'sampai'))->setPaper('a4', 'potrait');
        return $pdf->stream();
    }

    public function carippn(Request $request)
    {
       

        $this->validate($request, [
            'darippn' => 'required',
            'sampaippn' => 'required'
        ]);

        $darippn = date('Y-m-d', strtotime($request->darippn));
        $sampaippn = date('Y-m-d', strtotime($request->sampaippn));

        $invoiceppns = Invoiceppn::with('customer')->whereBetween(
            'tanggal',
            [$darippn, $sampaippn]
        )->withTrashed()->get();
        
        $pdf = PDF::loadView('laporan_penjualan.cetakppn', compact('invoiceppns', 'darippn', 'sampaippn'))->setPaper('a4', 'potrait');
        return $pdf->stream();

        // return view(
        //     'laporan_penjualan.cetakppn',
        //     compact('invoiceppns', 'darippn', 'sampaippn')
        // );
    }
    
}
