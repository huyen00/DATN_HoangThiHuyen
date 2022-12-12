<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Models\CategoryPano;
use App\Models\Tour;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryPanoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-tour|create-tour|delete-tour|edit-tour', ['only' => ['index']]);
        $this->middleware('permission:create-tour', ['only' => ['store']]);
        $this->middleware('permission:edit-tour', ['only' => ['update']]);
        $this->middleware('permission:delete-tour', ['only' => ['destroy']]);
    }

    public function index($id)
    {
        $tour = Tour::with('category_panos')->findOrFail($id);
        $category_panos = $tour->category_panos;
        return Inertia::render('Tour/Category/CategoryPano', compact('category_panos', 'tour'));
    }

    public function store(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);
        $this->validate(
            $request,
            [
                'name' => 'required',
            ]
        );

        $category_pano = CategoryPano::create([
            'name' => $request->name,
            'tour_id' => $tour->id

        ]);
        return back()->with('success', 'Create succssesfully');
    }


    public function update(Request $request, $id)
    {
        $category = CategoryPano::findOrFail($id);
        $this->validate(
            $request,
            [
                'name' => 'required',
            ]
        );
        $category->update([
            'name' => $request->name
        ]);
        return back()->with('success', 'Update succssesfully');
    }
    public function delete($id)
    {
        $category = CategoryPano::findOrFail($id);
        $category->delete();
        return back()->with('success', 'Delete succssesfully');
    }
    public function priorityCategoryPano(Request $request)
    {
        $data = $request->data;
        for ($i = 0; $i < count($data); $i++) {
            CategoryPano::findOrFail($data[$i]['id'])->update(['id_priority' => $i]);
        }
        return redirect()->back()->with('success', 'Sort  successfully');
    }
}
