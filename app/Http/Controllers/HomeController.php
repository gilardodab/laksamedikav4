<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Customer;
use App\Models\Invoice_customer;
use App\Models\Invoiceppn;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //return view('home');
        $bulancust = date('m',strtotime('now'));
        $invoicecustomer  = Invoice_customer::with(['user', 'detail_customer'])->whereMonth('created_at',$bulancust)->get();
        $bulan = date('m',strtotime('now'));
        $invoice  = Invoice::with(['user', 'customer', 'detail'])->whereMonth('created_at',$bulan)->get();
        $bulanppn = date('m',strtotime('now'));
        $invoiceppn  = Invoiceppn::with(['user', 'customer', 'detailppn'])->whereMonth('created_at',$bulanppn)->get();
        $allinvoice  = Invoice::with(['user', 'customer', 'detail'])->orderBy('created_at', 'DESC')->paginate(10);
        $users = User::orderBy('created_at', 'DESC')->get();
        $customers = Customer::orderBy('created_at', 'DESC')->get();
        $sliders = Slider::all();
        // return view('home', compact('invoice', 'users', 'customers', 'allinvoice', 'invoiceppn', 'invoicecustomer'));
        return view('beranda.beranda', compact('invoice', 'users', 'customers', 'allinvoice', 'invoiceppn', 'invoicecustomer','sliders'));
        
    }
    public function invoicenondanppn()
    {
        $invoice = Invoice::where('total', 0)->where('user_id', Auth::user()->id)->get();
        $invoiceppn = Invoiceppn::where('total', 0)->where('user_id', Auth::user()->id)->get();
        return view('invoicenondanppn', compact('invoice', 'invoiceppn'));
    }
    public function invoicenondanppnapp()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->get();
        $invoice = Invoice::where('total', 0)->where('user_id', Auth::user()->id)->get();
        $invoiceppn = Invoiceppn::where('total', 0)->where('user_id', Auth::user()->id)->get();
        return view('beranda.menuorder', compact('invoice', 'invoiceppn','customers'));
    }

    public function notif()
    {
        $inv = Invoice::with('customer')->where('status', 0)->where('total', '!=', 0)->orderBy('id', 'desc')->get();
        return view('notif', compact('inv'));
    }
    public function notifppn()
    {
        $invppn = Invoiceppn::with('customer')->where('status', 0)->where('total', '!=', 0)->orderBy('id', 'desc')->get();
        return view('notifppn', compact('invppn'));
    }

    public function notifikasi(){
        
        return view('notifikasi', compact(''));
    }

    public function notifProduct()
    {
        $product = Product::where('stock', '<=', 5)->get();
        return view('product-notif', compact('product'));
    }
    public function read($id)
    {
        $invs = Invoice::find($id);
        if ($invs->status == 0) {
            $invs->status = 1;
        }
        $invs->update();
        return redirect()->route('invoice.edit', $id);
    }
    public function readppn($id)
    {
        $invs = Invoiceppn::find($id);
        if ($invs->status == 0) {
            $invs->status = 1;
        }
        $invs->update();
        return redirect()->route('invoiceppn.edit', $id);
    }
    
     public function closenotif($id)
    {
        $invs = Invoice::find($id);
        if ($invs->status == 0) {
            $invs->status = 1;
        }
        $invs->update();
        $data = Invoice::where('status', 0)->where('total', '!=', 0)->count();
        return response()->json($data);
    }
    public function closenotifppn($id)
    {
        $invs = Invoiceppn::find($id);
        if ($invs->status == 0) {
            $invs->status = 1;
        }
        $invs->update();
        $datappn = Invoiceppn::where('status', 0)->where('total', '!=', 0)->count();
        return response()->json($datappn);
    }

    public function slider()
    {
        $sliders = Slider::all();
        return view('beranda.beranda', compact('sliders'));
    }

    public function allinvoice()
    {
        $allinvoiceppn  = Invoiceppn::with(['user', 'customer', 'detailppn'])->orderBy('created_at', 'DESC')->get();;
        $allinvoice  = Invoice::with(['user', 'customer', 'detail'])->orderBy('created_at', 'DESC')->get();;
        $invoicecustomerall = Invoice_customer::with(['user', 'detail_customer'])->orderBy('created_at', 'DESC')->get();;
        return view('beranda.menuinvoice', compact('allinvoice','allinvoiceppn','invoicecustomerall'));
        // Logika untuk menampilkan data invoice non PPN
        // return view('beranda.menuinvoice');

    }
    public function order(){

    }

}
