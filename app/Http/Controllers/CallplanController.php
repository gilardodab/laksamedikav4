<?php

namespace App\Http\Controllers;

use App\Call_plan;
use App\Call_plan_detail;
use App\Call_plan_detail_customer;
use App\Customer;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CallplanController extends Controller
{
    //
    public function index()
    {

        $callplans = Call_plan::orderBy('created_at', 'ASC')->get();
        return view('callplan.index', compact('callplans'));
    }

    public function allcallplan()
    {

        $callplans = Call_plan::orderBy('created_at', 'ASC')->get();
        $details = Call_plan_detail::orderBy('created_at', 'ASC')->get();
        $detail_customers = Call_plan_detail_customer::orderBy('created_at', 'ASC')->get();
        return view('callplan.allcallplan', compact('callplans', 'details', 'detail_customers'));
    }

    public function save(Request $request)
    {
        $callplans = Call_plan::create([
            'bulan' =>  $request->bulan,
            'user_id' => Auth::user()->id,
        ]);
        $callplans->save();
        return redirect('/callplan')->with(['success' => '<strong>' . $callplans->bulan . '</strong> Telah disimpan']);
    }

    public function createDetail($id)
    {
        $callplans = Call_plan::where('id', $id)->first();
        $details = Call_plan_detail::where('call_plan_id', $id)->orderBy('tanggal', 'ASC')->get();
        $detail_customers = Call_plan_detail_customer::where('call_plan_id', 'call_plan_detail_id', $id)->orderBy('created_at', 'ASC')->get();
        $customers = Customer::orderBy('created_at', 'DESC')->get();
        return view('callplan.detail', compact('callplans', 'customers', 'details', 'detail_customers'));
    }

    public function saveDetail(Request $request, $id)
    {
        $details = Call_plan_detail::create([
            'call_plan_id' => $request->call_plan_id,
            // 'customer_id' =>  $request->customer_id,
            'tanggal' => $request->tanggal,
            'user_id' => Auth::user()->id,

        ]);
        $details->save();


        return redirect()->route('callplan.create', [$details->call_plan_id])->with(['success' => 'Call Plan <strong>' . $details->tanggal . '</strong> Telah ditambahkan']);
    }

    public function createDetailCustomer($id)
    {
        $details = Call_plan_detail::where('id', $id)->first();
        $detail_customers = Call_plan_detail_customer::where('call_plan_detail_id', $id)->get();
        // $callplans = Call_plan::where('id', $id)->orderBy('created_at', 'ASC')->get();
        // $details = Call_plan_detail::orderBy('tanggal', 'ASC')->get();
        $customers = Customer::orderBy('created_at', 'DESC')->get();
        // dd($detail_customers);
        return view('callplan.detail_customer', compact('detail_customers', 'details', 'customers'));
    }

    public function saveDetailCustomer(Request $request, $id)
    {
        $details = Call_plan_detail::find($id);
        $detail_customers = Call_plan_detail_customer::create([
            'call_plan_id' => $request->call_plan_id,
            'call_plan_detail_id' => $details->id,
            'customer_id' =>  $request->customer_id,
            'user_id' => Auth::user()->id,
            // 'tanggal' => $request->tanggal,
        ]);
        //dd($request->all());
        $details->save();


        return redirect()->route('callplan.DetailCustomer', [$detail_customers->call_plan_detail_id])->with(['success' => 'Call Plan <strong>' . $detail_customers->customer->name . '</strong> Telah ditambahkan']);
    }

    public function lihatDetail($id)
    {
        $details = Call_plan_detail::where('id', $id)->find($id);
        $detail_customers = Call_plan_detail_customer::where('call_plan_detail_id', $id)->orderBy('created_at', 'ASC')->get();
        $customers = Customer::orderBy('created_at', 'DESC')->get();
        return view('callplan.lihat_detail', compact('customers', 'details', 'detail_customers'));
    }

    public function destroy($id)
    {
        $details = Call_plan_detail::find($id);
        $detail_customers = Call_plan_detail_customer::where('call_plan_detail_id', $details->id)->delete();
        $details->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->back()->with(['success' => '</strong>' . $details->tanggal . '</strong> Dihapus']); // DIARAHKAN KEMBALI KEHALAMAN /product
    }

    public function destroycustomer($id)
    {
        $detail_customers = Call_plan_detail_customer::find($id);
        $detail_customers->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->back()->with(['success' => '</strong>' . $detail_customers->customer->name . '</strong> Dihapus']); // DIARAHKAN KEMBALI KEHALAMAN /product
    }

    public function destroycallplan($id)
    {
        $callplans = Call_plan::find($id);
        $detail = Call_plan_detail::where('call_plan_id', $callplans->id)->delete();
        $detail_customer = Call_plan_detail_customer::where('call_plan_id', $callplans->id)->delete();
        $callplans->delete(); // MENGHAPUS DATA YANG ADA DIDATABASE
        return redirect()->back()->with(['success' => '</strong>' . $callplans->bulan . '</strong> Dihapus']); // DIARAHKAN KEMBALI KEHALAMAN /product
    }

    public function generateCallplan($id)
    {
        //GET DATA BERDASARKAN ID
        $callplans = Call_plan::with(['customer', 'call_plan_detail_customer', 'call_plan_detail'])->find($id);
        //dd($callplans);
        //LOAD PDF YANG MERUJUK KE VIEW PRINT.BLADE.PHP DENGAN MENGIRIMKAN DATA DARI INVOICE
        //KEMUDIAN MENGGUNAKAN PENGATURAN LANDSCAPE A4
        $pdf = PDF::loadView('callplan.print', compact('callplans'))->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
}
