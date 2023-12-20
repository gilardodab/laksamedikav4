<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Product as AppProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Models\Product;
class CustomerController extends Controller
{
    //
    public function index()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->paginate(10);
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.add');
    }

    public function save(Request $request)
    {
        //VALIDASI DATA
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'max:13', //maximum karakter 13 digit
            'address' => 'required|string',
            //unique berarti email ditable customers tidak boleh sama
            'email' => '', // format yag diterima harus email

        ]);

        try {

            $customer = Customer::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                // 'product_id' => AppProduct::product()->id,


            ]);
            return redirect('/customer')->with(['success' => 'Data telah disimpan']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'phone' => 'max:13',
            'address' => 'required|string',
            'email' => '',
            // 'product_id' => 'int',
        ]);

        try {
            $customer = Customer::find($id);
            $customer->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address
            ]);
            return redirect('/customer')->with(['success' => 'Data telah diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->back()->with(['success' => '<strong>' . $customer->name . '</strong> Telah dihapus']);
    }
    
    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $customers = Customer::where('name', 'like', "%" . $cari . "%")
            ->paginate();

        // mengirim data pegawai ke view index
        return response()->json($customers);
        // return view('customer.index', compact('customers'));
    }
}
