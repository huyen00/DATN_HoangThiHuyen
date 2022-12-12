<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Models\CategoryHotspot;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryHotspotController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-tour|create-tour|delete-tour|edit-tour', ['only' => ['index']]);
        $this->middleware('permission:create-tour', ['only' => ['store']]);
        $this->middleware('permission:edit-tour', ['only' => ['update']]);
        $this->middleware('permission:delete-tour', ['only' => ['destroy']]);
    }

    public function index()
    {
        $category_hotspots = CategoryHotspot::get();
        return Inertia::render('Tour/Category/CategoryHotspot', compact('category_hotspots'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|unique:category_hotspots',
            ]
        );

        $category_hotspot = CategoryHotspot::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return back()->with('success', 'Create succssesfully');
    }


    public function update(Request $request, $id)
    {
        $category = CategoryHotspot::findOrFail($id);
        $this->validate(
            $request,
            [
                'name' => 'required|unique:category_hotspots,name,' . $category->id,
            ]
        );
        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return back()->with('success', 'Update succssesfully');
    }
    public function delete($id)
    {
        $category = CategoryHotspot::findOrFail($id);
        $category->delete();
        return back()->with('success', 'Delete succssesfully');
    }
}
