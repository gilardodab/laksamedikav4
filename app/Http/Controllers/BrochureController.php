<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Brochure;
class BrochureController extends Controller
{
    public function index()
    {
        $brochures = Brochure::all();
        return view('brochures.index', compact('brochures'));
    }

    public function allbrosur()
    {
        $brochures = Brochure::all();
        return view('brochures.allbrosur', compact('brochures'));
    }

    public function create()
    {
        return view('brochures.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required|mimes:doc,docx,ppt,pdf|max:10240', // max:10240 is 10MB
        ]);

        $file = $request->file('file');
        $filePath = $file->store('brochures');

        Brochure::create([
            'title' => $request->title,
            'file_path' => $filePath,
        ]);

        return redirect()->route('brochures.index')->with('success', 'Brochure added successfully.');
    }

    public function edit($id)
    {
        $brochure = Brochure::findOrFail($id);
        return view('brochures.edit', compact('brochure'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'nullable|mimes:doc,docx,ppt,pdf|max:10240', // max:10240 is 10MB
        ]);

        $brochure = Brochure::findOrFail($id);

        $brochure->update([
            'title' => $request->title,
        ]);

        if ($request->hasFile('file')) {
            Storage::delete($brochure->file_path);

            $file = $request->file('file');
            $filePath = $file->store('brochures');
            $brochure->update([
                'file_path' => $filePath,
            ]);
        }

        return redirect()->route('brochures.index')->with('success', 'Brochure updated successfully.');
    }

    public function destroy($id)
    {
        $brochure = Brochure::findOrFail($id);
        Storage::delete($brochure->file_path);
        $brochure->delete();

        return redirect()->route('brochures.index')->with('success', 'Brochure deleted successfully.');
    }

    public function download($id)
    {
        $brochure = Brochure::findOrFail($id);
        $filePath = storage_path('app/' . $brochure->file_path);
        $fileName = $brochure->title . '_' . basename($brochure->file_path);
    
        return response()->download($filePath, $fileName);
    }
    
    
}
