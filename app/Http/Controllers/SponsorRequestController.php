<?php

namespace App\Http\Controllers;

// app/Http/Controllers/SponsorRequestController.php
// app/Http/Controllers/SponsorRequestController.php

use App\Models\SponsorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SponsorRequestController extends Controller
{
    public function create()
    {
        return view('sponsor_request.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_sponsor' => 'required',
            'jumlah_rupiah' => 'required|numeric',
            'waktu_kegiatan' => 'required|date',
        ]);
    
        // Mendapatkan ID user yang sedang login
        $userId = Auth::id();
    
        // Menambahkan kolom 'user_id' ke data pengajuan
        $requestData = array_merge($request->all(), ['user_id' => $userId]);
    
        // Menyimpan data pengajuan
        SponsorRequest::create($requestData);
    
        return redirect()->route('sponsor-request.create')->with('status', 'Pengajuan Anda telah berhasil dikirim. Silakan tunggu konfirmasi dalam waktu 3x24 jam.');
    }

    public function process()
    {
        $requests = SponsorRequest::where('is_processed', false)->get();

        foreach ($requests as $request) {
            // Logika pemrosesan, misalnya mengirim notifikasi ke Finance dan menandai bahwa permohonan telah diproses
        }

        return redirect()->route('dashboard')->with('status', 'Pengajuan telah diproses.');
    }

    public function approve(Request $request, SponsorRequest $sponsorRequest)
    {
        $request->validate([
            'waktu_kegiatan' => 'required|date|after:2 weeks ago',
        ]);

        $sponsorRequest->update([
            'is_processed' => true,
            'is_approved' => true,
        ]);

        return redirect()->route('dashboard')->with('status', 'Pengajuan Anda telah disetujui.');
    }
    // app/Http/Controllers/SponsorRequestController.php

public function index()
{
    $requests = SponsorRequest::all();
    return view('sponsor_request.index', compact('requests'));
}

public function edit(SponsorRequest $sponsorRequest)
{
    return view('sponsor_request.edit', compact('sponsorRequest'));
}

public function update(Request $request, SponsorRequest $sponsorRequest)
{
    $request->validate([
        'status' => 'required|in:Setuju,Tolak',
    ]);

    $sponsorRequest->update([
        'status' => $request->status,
    ]);

    return redirect()->route('sponsor-request.index')->with('status', 'Status pengajuan diperbarui.');
}

public function history($id)
{
    $requests = SponsorRequest::where('user_id', $id)->get();
    return view('sponsor_request.history', compact('requests'));
}

}
