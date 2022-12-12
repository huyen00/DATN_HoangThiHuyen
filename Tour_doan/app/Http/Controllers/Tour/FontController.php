<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Tour\Font\StoreRequest;
use App\Models\Tour;
use App\Models\TourFont;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FontController extends Controller
{
    use FileUploadTrait;
    public function __construct()
    {
        $this->middleware('permission:view-tour|create-tour|delete-tour|edit-tour', ['only' => ['index']]);
        $this->middleware('permission:create-tour', ['only' => ['store']]);
        $this->middleware('permission:edit-tour', ['only' => ['update']]);
        $this->middleware('permission:delete-tour', ['only' => ['destroy']]);
    }

    public function index($id)
    {
        $tour = Tour::with('font')->findOrFail($id);
        $font = $tour->font;
        return Inertia::render("Tour/Font/Index", compact('tour', 'font'));
    }

    public function store(Request $request, $id)
    {
        $tour = Tour::with('font')->findOrFail($id);

        $font_path = $this->createDirectoryTour($tour, 'font');

        if ($tour->font) {
            $this->validate($request, [
                'name' => 'required',
                'font' =>  ['nullable', 'file', 'mimetypes:font/ttf,font/sfnt'],
                'size' => 'required|integer|gt:0',
                'weight' => 'required|integer|gt:100'
            ]);
            $tour->font->update([
                'name' => $request->name,
                'size' => $request->size,
                'weight' => $request->weight,
                'font' => $request->hasFile('font') ? $this->update_image($request->file('font'), time(), $font_path, $tour->font->font) : $tour->font->font,
            ]);
        } else {
            $this->validate($request, [
                'name' => 'required',
                'font' =>  ['required', 'file', 'mimetypes:font/ttf,font/sfnt'],
                'size' => 'required|integer|gt:0',
                'weight' => 'required|integer|gt:100'
            ]);
            $tour->font()->create([
                'name' => $request->name,
                'size' => $request->size,
                'weight' => $request->weight,
                'font' => $request->hasFile('font') ? $this->image($request->file('font'), $font_path) : null,
            ]);
        }
        return back()->with('success', 'Successfully');
    }

    public function delete($id)
    {
        $font = TourFont::findOrFail($id);
        $extension = " ";
        $this->DeleteFolder($font->font, $extension);
        $font->delete();
        return back()->with('success', 'Successfully');
    }
}
