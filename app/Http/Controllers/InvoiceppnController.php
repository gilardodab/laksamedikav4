<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invoiceppn;
use App\Models\Product;
use App\Models\Invoice_detailppn;
use App\Models\ProductDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Pengirimanppn;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InvoiceppnController extends Controller
{
    //
    public function index()
    {
        $invoiceppn  = Invoiceppn::with(['user', 'customer', 'detailppn'])->where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('invoiceppn.index', compact('invoiceppn'));
    }

    public function create()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->paginate(10);
        return view('invoiceppn.create', compact('customers'));
    }

    public function save(Request $request)
    {

        $this->validate($request, [
            'customer_id' => 'required|exists:customers,id'
        ]);

        try {
             $invoiceppn = Invoiceppn::orderBy('no_faktur_2023' ,'DESC')->select('no_faktur_2023')->first();
            if(empty($invoiceppn)){
                $id = 1;
            }
            else{
                $id = $invoiceppn->no_faktur_2023+1;
            }
            $invoiceppn = Invoiceppn::create([
                'customer_id' => $request->customer_id,
                'status' => 0,
                'total' => 0,
                'tenggat' => date('Y-m-d H:i:s', time() + (60 * 60 * 24 * 30)),
                'tanggal' => date('Y-m-d H:i:s', time()),
                'user_id' => Auth::user()->id,
                'no_faktur_2023' => $id,





            ]);
            // Mail::to($invoiceppn->user->email)->send(new \App\Mail\PostMail($invoiceppn->customer->name, 'Laksa Medika Internusa', $invoiceppn->id));
            // Mail::to('laksatechno@gmail.com')->send(new \App\Mail\PostMail($invoiceppn->customer->name, 'Laksa Medika Internusa', $invoiceppn->id));
            // Mail::to('haryokodrajaddwi@gmail.com')->send(new \App\Mail\PostMail($invoiceppn->customer->name, 'Laksa Medika Internusa', $invoiceppn->id));

            return redirect(route('invoiceppn.edit', ['id' => $invoiceppn->id]));
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $customers = Customer::orderBy('created_at', 'DESC', 'id')->get();
        $invoiceppn = Invoiceppn::with(['product', 'customer', 'detailppn', 'detailppn.product_detail'])->find($id);
        $products = Product::orderBy('title', 'ASC', 'customer_id')->get();
        $details = ProductDetail::orderBy('product_id', 'DESC')->get();
        return view('invoiceppn.edit', compact('invoiceppn', 'products', 'details', 'customers'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, [
            //'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer',
            'diskon' => 'integer',
            'tanggal' => 'date',
            'user_id' => 'int',
        ]);

        try {

            $invoiceppn = Invoiceppn::find($id);
            //$product = Product::find($request->product_id);
            $detail = ProductDetail::find($request->product_detail_id);
            $invoice_detailppn = $invoiceppn->detailppn()->where('product_detail_id', $detail->id)->first();
            if ($invoice_detailppn) {
                $invoice_detailppn->update([
                    'qty' => $invoice_detailppn->qty + $request->qty,
                    'diskon' => $invoice_detailppn->diskon + $request->diskon
                ]);
            } else {
                Invoice_detailppn::create([
                    'invoiceppn_id' => $invoiceppn->id,
                    //'product_id' => $request->product_id,
                    'product_detail_id' => $request->product_detail_id,
                    'price' => $detail->price,
                    'qty' => $request->qty,
                    //'tenggat' => $request->tenggat,
                    'diskon' => $request->diskon,
                    // 'tanggal' => $request->tanggal,
                    'user_id' => $invoiceppn->user_id,
                ]);
            }
            $detail->product->stock -= $request->qty;
            $detail->product->save();

            return redirect()->back()->with(['success' => 'Product Telah Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function deleteProduct($id)
    {

        // $detail = Invoice_detail::find($id);
        // $detail->delete();


        $detailppn = Invoice_detailppn::find($id);
        $jumlah = $detailppn->qty;
        $detailppn->delete();
        $detailppn->product_detail->product->stock += $jumlah;
        $detailppn->product_detail->product->save();
        return redirect()->back()->with(['success' => 'Product telah dihapus']);
    }

    public function destroy($id)
    {
        $invoiceppn = Invoiceppn::find($id);
        $invoice_detailppn = Invoice_detailppn::where('invoiceppn_id', $invoiceppn->id)->get();
        foreach ($invoice_detailppn as $detailppn) {
            $detailppn->qty;
            $invoiceppn->forcedelete();
            $detailppn->product_detail->product->stock += $detailppn->qty;
            $detailppn->product_detail->product->save();
        }
        return redirect()->back()->with(['success' => 'Data telah dihapus']);
    }

    public function status($id)
    {
        $invoiceppn = Invoiceppn::find($id);
        $invoiceppn->delete();
        return redirect()->back()->with(['success' => 'Faktur telah lunas']);
    }

    public function trash()
    {
        $invoiceppn  = Invoiceppn::onlyTrashed()->orderBy('created_at', 'DESC')->paginate(10);
        return view('invoiceppn.trash', compact('invoiceppn'));
    }

    public function allinvoice()
    {
        $allinvoiceppn  = Invoiceppn::with(['user', 'customer', 'detailppn'])->orderBy('created_at', 'DESC')->paginate(10);
        return view('invoiceppn.allinvoice', compact('allinvoiceppn'));
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $customers = Customer::where('name', 'like', "%" . $cari . "%")
            ->paginate(5);

        // mengirim data pegawai ke view index
        return response()->json($customers);
    }


    public function generateInvoice($id)
    {
        // //GET DATA BERDASARKAN ID
        // $invoiceppn = Invoiceppn::with(['customer', 'detailppn', 'detailppn.product_detail.product'])->find($id);
        // //LOAD PDF YANG MERUJUK KE VIEW PRINT.BLADE.PHP DENGAN MENGIRIMKAN DATA DARI INVOICE
        // //KEMUDIAN MENGGUNAKAN PENGATURAN LANDSCAPE A4
        // $pdf = PDF::loadView('invoiceppn.print', compact('invoiceppn'))->setPaper('a4', 'potrait');
        // return $pdf->stream();
        $invoiceppn = Invoiceppn::with(['customer', 'detailppn', 'detailppn.product_detail.product'])->find($id);
        // Format nomor invoice
        $noInvoice = 'INVOICEPPN-' . $invoiceppn->no_faktur_2023;
        // Nama customer
        $customerName = str_replace(' ', '_', $invoiceppn->customer->name);
        // Nama file PDF dengan nomor invoice dan nama customer
        $fileName = $noInvoice . '_' . $customerName . '.pdf';
        $pdf = PDF::loadView('invoiceppn.print', compact('invoiceppn'))->setPaper('a4', 'portrait');
        // Untuk menampilkan PDF di browser
        return $pdf->stream($fileName);
    }
    public function generateInvoice2($id)
    {
        //GET DATA BERDASARKAN ID
        $invoiceppn = Invoiceppn::with(['customer', 'detailppn', 'detailppn.product_detail.product'])->find($id);
        //LOAD PDF YANG MERUJUK KE VIEW PRINT.BLADE.PHP DENGAN MENGIRIMKAN DATA DARI INVOICE
        //KEMUDIAN MENGGUNAKAN PENGATURAN LANDSCAPE A4
        $pdf = PDF::loadView('invoiceppn.print2', compact('invoiceppn'))->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
    
    public function pengirimanppn($id)
    {
        $invoiceppn = Invoiceppn::with(['product', 'customer', 'detailppn', 'detailppn.product_detail', 'pengirimanppn'])->find($id);
        $products = Product::orderBy('title', 'ASC', 'customer_id')->get();
        $details = ProductDetail::orderBy('product_id', 'DESC')->get();
        return view('invoiceppn.pengiriman', compact('invoiceppn', 'products', 'details'));
    }

    public function savepengirimanppn(Request $request, $id)
    {
        // dd($request->all());
        

        try {
            $invoiceppn = Invoiceppn::find($id);
            $invoice_detailppn = Invoice_detailppn::find($request->invoice_detailppn_id);
            // dd($invoice_detail->product_detail_id);
            $pengirimanppns = Pengirimanppn::where('invoice_detailppn_id', $invoice_detailppn->id)->first();
            if ($pengirimanppns) {
                $pengirimanppns->update([
                    'qty' => $pengirimanppns->qty + $request->qty,
                ]);
            } else {
                Pengirimanppn::create([
                    'invoiceppn_id' => $invoiceppn->id,
                    'product_detail_id' => $invoice_detailppn->product_detail_id,
                    //'product_id' => $request->product_id,
                    'invoice_detailppn_id' => $request->invoice_detailppn_id,
                    'qty' => $request->qty,
                ]);
            }
            $invoice_detailppn->qty -= $request->qty;
            $invoice_detailppn->save();

            return redirect()->back()->with(['success' => 'Product Telah Dikirim']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function deletepengirimanppn($id)
    {
        $pengirimanppns = Pengirimanppn::find($id);
        // dd($pengirimans);
        $detailppns = Invoice_detailppn::find($pengirimanppns->invoice_detailppn_id);
        // dd($details);
        $detailppns->update([
            'qty'=>$detailppns->qty+$pengirimanppns->qty
        ]);
        $pengirimanppns->delete();
        
        return redirect()->back()->with(['success' => 'Product telah dihapus']);
    }
}
