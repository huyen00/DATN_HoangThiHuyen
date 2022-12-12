<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Tour\Map\StoreRequest;
use App\Models\Map;
use App\Models\Tour;
use Inertia\Inertia;

class MapController extends Controller
{
    use FileUploadTrait;
    public $pathPrefix;
    public function __construct()
    {
        $this->middleware('permission:view-tour|create-tour|delete-tour|edit-tour', ['only' => ['index']]);
        $this->middleware('permission:create-tour', ['only' => ['store']]);
        $this->middleware('permission:edit-tour', ['only' => ['update']]);
        $this->middleware('permission:delete-tour', ['only' => ['delete']]);
    }

    public function index($id)
    {
        $tour = Tour::with('map')->findOrFail($id);
        $map = $tour->map;
        return Inertia::render('Tour/Map/Index', compact('tour', 'map'));
    }
    public function store(StoreRequest $request, $id)
    {
        $tour = Tour::with('map')->findOrFail($id);
        $tour_path = 'Tour/' . $tour->id;
        if (!file_exists($tour_path)) {
            mkdir($tour_path, 0777, true);
        }
        $setting_path = $tour_path . '/map/';
        if (!file_exists($setting_path)) {
            mkdir($setting_path, 0777, true);
        }

        $name = time();
        if ($tour->map) {
            $tour->map->update([
                'image' => $request->hasFile('image') ? $this->update_image($request->file('image'), $name, $setting_path, $tour->map->image) : $tour->map->image,
                'name' => $request->name,
                'address' => $request->address,
                'longtitude' => $request->longtitude,
                'latitude' => $request->latitude,
            ]);
        } else {
            $tour->map()->create([
                'image' => $request->hasFile('image') ? $this->image($request->file('image'), $setting_path) : null,
                'name' => $request->name,
                'address' => $request->address,
                'longtitude' => $request->longtitude,
                'latitude' => $request->latitude,
            ]);
        }
        return back()->with('success', "Successfully");
    }
    public function delete($id)
    {

        $map = Map::findOrFail($id);
        $extension = " ";
        $this->DeleteFolder($map->image, $extension);
        $map->delete();
        return back()->with('success', "Delete Successfully");
    }
}
