<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice_customer;
use App\Models\Invoice_customer_detail;
use App\Models\PaymentProof;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Product_customer_detail;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class InvoiceCustomerController extends Controller
{
    //->where('ppn', '!=', 0)
    public function index()
    {
        // $invoicecust = Invoice_customer::where('total', 0)->where('user_id', Auth::user()->id)->get();
        $invoicecustomer = Invoice_customer::with(['user', 'detail_customer'])->where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(5);
        return view('invoice_customer.index', compact('invoicecustomer'));
    }

    public function allinvoicecustomer()
    {
        // $invoicecustomerall = Invoice_customer::with(['user', 'detail_customer'])->orderBy('created_at', 'DESC')->paginate(10);
        $invoicecustomerall = Invoice_customer::with(['user', 'detail_customer'])->orderBy('created_at', 'DESC')->paginate(100000000000000);
        return view('invoice_customer.allinvoice', compact('invoicecustomerall'));
    }

    public function save(Request $request)
    {
 
            $latestInvoiceCustomer = Invoice_customer::orderBy('no_faktur', 'DESC')->select('no_faktur')->first();

            // Calculate the new invoice number
            $id = $latestInvoiceCustomer ? $latestInvoiceCustomer->no_faktur + 1 : 1;

            // Create a new Invoice_customer record
            $invoicecustomer = Invoice_customer::create([
                'user_id' => Auth::user()->id,
                'total' => $request->total,
                'tempo' => now()->addDays(30), // Using Laravel's now() helper
                'ppn' => Auth::user()->jenis_institusi,
                'marketing' => Auth::user()->marketing,
                'no_faktur' => $id,
            ]);
    
            // Assuming 'PostMail' is the Mailable class you have created
            // Mail::to($invoicecustomer->user->email)->send(new \App\Mail\PostMail($invoicecustomer->user->name, 'Laksa Medika Internusa', $invoicecustomer->id));
            // Mail::to('gilardodestri@gmail.com')->send(new \App\Mail\PostMail($invoicecustomer->user->name, 'Laksa Medika Internusa', $invoicecustomer->id));
    
            return redirect(route('invoicecustomer.edit', ['id' => $invoicecustomer->id]));
 
    }
    

    public function create(Request $request)
    {
        // Your existing logic for determining the invoice number
        $invoicecustomer = Invoice_customer::orderBy('no_faktur', 'DESC')->select('no_faktur')->first();
        if (empty($invoicecustomer)) {
            $id = 1;
        } else {
            $id = $invoicecustomer->no_faktur + 1;
        
        }
        // Create the Invoice_customer record
        $invoicecustomer = Invoice_customer::create([
            'user_id' => Auth::user()->id,
            'total' => $request->total,
            'tempo' => date('Y-m-d H:i:s', time() + (60 * 60 * 24 * 30)),
            'ppn' => Auth::user()->jenis_institusi,
            'marketing' => Auth::user()->marketing,
            'no_faktur' => $id,
            // Add other fields as needed
        ]);

        // Redirect or do something else after creating the invoice
        return redirect()->route('invoice_show', ['id' => $invoicecustomer->id]);
    }

    public function show($id)
    {
        
        $invoicecustomers = Invoice_customer::with(['product', 'user', 'detail_customer', 'detail_customer.product_customer_detail'])->find($id);
        return view('invoice_customer.create', compact('users', 'invoicecustomers', 'detailcustomers'));
    }

    public function edit($id)
    {
        $users = User::orderBy('created_at', 'DESC', 'id')->get();
        $invoicecustomers = Invoice_customer::with(['product', 'user', 'detail_customer', 'detail_customer.product_customer_detail'])->find($id);
        $products = Product::orderBy('title', 'ASC', 'user_id')->get();
        $detailcustomers = Product_customer_detail::orderBy('product_id', 'DESC')->get();
        return view('invoice_customer.edit', compact('users', 'invoicecustomers', 'products', 'detailcustomers'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            //'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer',
            'diskon' => 'integer',
            'user_id' => 'int',
            'status' => 'string', // Tambahkan validasi untuk status_pembayaran jika diperlukan
        ]);

        try {

            $invoicecustomer = Invoice_customer::find($id);
            //$product = Product::find($request->product_id);
            $detailcustomer = Product_customer_detail::find($request->product_customer_detail_id);
            $invoice_customer_detail = $invoicecustomer->detail_customer()->where('product_customer_detail_id', $detailcustomer->id)->first();
            if ($invoice_customer_detail) {
                $invoice_customer_detail->update([
                    'qty' => $invoice_customer_detail->qty + $request->qty,
                    'diskon' => $invoice_customer_detail->diskon + $request->diskon
                ]);
            } else {
                    Invoice_customer_detail::create([
                    'invoice_customer_id' => $invoicecustomer->id,
                    //'product_id' => $request->product_id,
                    'product_customer_detail_id' => $request->product_customer_detail_id,
                    'price' => $detailcustomer->price,
                    'qty' => $request->qty,
                    //'tenggat' => $request->tenggat,
                    'diskon' => $request->diskon,
                ]);
            }
            $detailcustomer->product->stock -= $request->qty;
            $detailcustomer->product->save();
                        // Update status pembayaran jika ada
            if ($request->has('status')) {
                $invoicecustomer->status = $request->status;
                $invoicecustomer->save();
            }

            return redirect()->back()->with(['success' => 'Product Telah Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    // public function update(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'qty' => 'required|integer',
    //         'diskon' => 'integer',
    //         'user_id' => 'int',
    //         'status' => 'string', // Tambahkan validasi untuk status_pembayaran jika diperlukan
    //     ]);

    //     try {
    //         $invoicecustomer = Invoice_customer::find($id);

    //         $detailcustomer = Product_customer_detail::find($request->product_customer_detail_id);
    //         $invoice_customer_detail = $invoicecustomer->product_customer_detail()->where('product_customer_detail_id', $detailcustomer->id)->first();

    //         if ($invoice_customer_detail) {
    //             $invoice_customer_detail->update([
    //                 'qty' => $invoice_customer_detail->qty + $request->qty,
    //                 'diskon' => $invoice_customer_detail->diskon + $request->diskon,
    //             ]);
    //         } else {
    //             Product_customer_detail::create([
    //                 'invoice_customer_id' => $invoicecustomer->id,
    //                 'product_customer_detail_id' => $request->product_customer_detail_id,
    //                 'price' => $detailcustomer->price,
    //                 'qty' => $request->qty,
    //                 'diskon' => $request->diskon,
    //             ]);
    //         }

    //         $detailcustomer->product->stock -= $request->qty;
    //         $detailcustomer->product->save();

    //         // Update status pembayaran jika ada
    //         if ($request->has('status')) {
    //             $invoicecustomer->status = $request->status;
    //             $invoicecustomer->save();
    //         }

    //         return redirect()->back()->with(['success' => 'Product Telah Ditambahkan']);
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with(['error' => $e->getMessage()]);
    //     }
    // }

    public function deleteProduct($id)
    {


        $detail = Invoice_customer_detail::find($id);
        $jumlah = $detail->qty;
        $detail->delete();
        $detail->product_customer_detail->product->stock += $jumlah;
        $detail->product_customer_detail->product->save();
        return redirect()->back()->with(['success' => 'Product telah dihapus']);
    }

    public function destroy($id)
    {
        // Find the Invoice_customer by ID
        $invoicecustomer = Invoice_customer::find($id);
    
        // Check if the invoice customer exists
        if (!$invoicecustomer) {
            return redirect()->back()->with(['error' => 'Data tidak ditemukan']);
        }
    
        // Get the related invoice customer details
        $invoice_customer_details = Invoice_customer_detail::where('invoice_customer_id', $invoicecustomer->id)->get();
    
        // Loop through each detail
        foreach ($invoice_customer_details as $detail) {
            // Update the product stock
            $detail->product_customer_detail->product->stock += $detail->qty;
            $detail->product_customer_detail->product->save();
        }
    
        // Delete the invoice customer details
        Invoice_customer_detail::where('invoice_customer_id', $invoicecustomer->id)->delete();
    
        // Now you can force delete the invoice customer
        $invoicecustomer->forceDelete();
    
        // Redirect with success message
        return redirect()->back()->with(['success' => 'Data telah dihapus']);
    }
    

    public function generateInvoice($id)
    {
        //GET DATA BERDASARKAN ID
        $invoicecustomer = Invoice_customer::with(['user', 'detail_customer', 'detail_customer.product_customer_detail.product'])->find($id);
        //LOAD PDF YANG MERUJUK KE VIEW PRINT.BLADE.PHP DENGAN MENGIRIMKAN DATA DARI INVOICE
        //KEMUDIAN MENGGUNAKAN PENGATURAN LANDSCAPE A4
        //setPaper([0, 0, 396.85, 623.62], 'landscape');
        $pdf = PDF::loadView('invoice_customer.print', compact('invoicecustomer'))->setPaper('a4', 'potrait');
        return $pdf->stream();
    }

    public function generateInvoiceNonPPN($id)
    {
        //GET DATA BERDASARKAN ID
        $invoicecustomer = Invoice_customer::with(['user', 'detail_customer', 'detail_customer.product_customer_detail.product'])->find($id);
        //LOAD PDF YANG MERUJUK KE VIEW PRINT.BLADE.PHP DENGAN MENGIRIMKAN DATA DARI INVOICE
        //KEMUDIAN MENGGUNAKAN PENGATURAN LANDSCAPE A4
        //setPaper([0, 0, 396.85, 623.62], 'landscape');
        $pdf = PDF::loadView('invoice_customer.printnonppn', compact('invoicecustomer'))->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
    
    public function showPaymentForm($id)
    {
        $invoicecustomer = Invoice_customer::findOrFail($id);
        return view('payment_form', ['invoicecustomer' => $invoicecustomer]);
    }

    // public function processPayment(Request $request, $id)
    // {
    //     // Validate the form data as needed
    //     $request->validate([
    //         'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'status' => 'required|in:pending,paid',
    //     ]);

    //     // Process the form submission, update the invoice, and save the photo

    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', 'Payment submitted successfully.');
    // }

    // public function processPayment(Request $request, $id)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust file types and size as needed
    //         'status' => 'string',
    //     ]);

    //     // Find the corresponding invoice
    //     $invoicecustomer = Invoice_customer::findOrFail($id);

    //     // Handle photo upload if provided
    //     if ($request->hasFile('photo')) {
    //         $photoPath = $request->file('photo')->store('photos'); // Adjust the storage path
    //         $invoicecustomer->photo_path = $photoPath;
    //         $invoicecustomer->save();
    //     }

    //     // Update payment status
    //     $invoicecustomer->status = $request->input('status');
    //     $invoicecustomer->save();

    //     return redirect()->back()->with('success', 'Pembayaran berhasil.');
    // }
    public function processPayment(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjust file types and size as needed
        'status' => 'string',
    ]);

    // Find the corresponding invoice
    $invoicecustomer = Invoice_customer::findOrFail($id);

    // Handle photo upload if provided
    if ($request->hasFile('photo')) {
        // Generate a unique file name based on user, date, and time
        $user = Auth::user()->name;
        $dateTime = now();
        $fileName = $user . '_' . $dateTime->format('Ymd_His') . '.' . $request->file('photo')->getClientOriginalExtension();

        // Move the uploaded photo to the desired storage path
        $photoPath = $request->file('photo')->storeAs('photos', $fileName);

        // Save the photo path to the database
        $invoicecustomer->photo_path = $photoPath;
        $invoicecustomer->save();
    }

    // Update payment status
    $invoicecustomer->status = $request->input('status');
    $invoicecustomer->save();
    return redirect()->back()->with('success', 'Pembayaran berhasil.');
}

public function showPhoto($id)
{
    // Find the corresponding invoice
    $invoicecustomer = Invoice_customer::findOrFail($id);

    // Check if the invoice has a photo
    if (!$invoicecustomer->photo_path) {
        abort(404); // Or handle it differently, depending on your requirements
    }

    // Get the photo path
    $photoPath = $invoicecustomer->photo_path;

    // Get the photo content
    $photoContent = Storage::get($photoPath);

    // Get the photo MIME type
    $photoMimeType = Storage::mimeType($photoPath);

    // Create a response with the photo content and appropriate headers
    $response = response($photoContent, 200);
    $response->header("Content-Type", $photoMimeType);

    return $response;
}

public function updateStatus(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'status' => 'required|in:Disetujui,Ditolak',
        ]);

        // Find the corresponding invoice
        $invoicecustomer = Invoice_customer::findOrFail($id);

        // Update status
        $invoicecustomer->status = $request->input('status');
        $invoicecustomer->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
}
