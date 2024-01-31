<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengiriman;

class PengirimanController extends Controller
{
    public function index()
    {
        $pengirimans = Pengiriman::orderBy('created_at', 'desc')->get();

        return view('pengiriman.index', compact('pengirimans'));
    }
}

