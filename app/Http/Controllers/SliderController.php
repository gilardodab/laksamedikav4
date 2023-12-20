<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('slider.index', compact('sliders'));
    }

    public function all()
    {
        $sliders = Slider::all();
        return view('slider.all', compact('sliders'));
    }

    public function create()
    {
        return view('slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images/slider'), $imageName);

        Slider::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect()->route('slider.index')->with('success', 'Slider berhasil ditambahkan');
    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slider = Slider::find($id);

        $slider->title = $request->title;
        $slider->description = $request->description;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/slider'), $imageName);
            $slider->image = $imageName;
        }

        $slider->save();

        return redirect()->route('slider.index')->with('success', 'Slider berhasil diperbarui');
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);
        $slider->delete();

        return redirect()->route('slider.index')->with('success', 'Slider berhasil dihapus');
    }
}
