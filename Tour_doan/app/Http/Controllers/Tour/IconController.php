<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use App\Http\FileManager;
use App\Http\Requests\Tour\Icon\StoreRquest;
use App\Http\Requests\Tour\Icon\UpdateRquest;
use App\Http\Requests\Tour\StoreRequest;
use App\Models\IconTour;
use App\Models\Tour;
use Inertia\Inertia;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class IconController extends Controller
{
    use FileTrait, FileUploadTrait;
    public $pathPrefix;
    public function __construct()
    {
        $this->middleware('permission:view-tour|create-tour|delete-tour|edit-tour', ['only' => ['index']]);
        $this->middleware('permission:create-tour', ['only' => ['store']]);
        $this->middleware('permission:edit-tour', ['only' => ['update']]);
        $this->middleware('permission:delete-tour', ['only' => ['destroy','deleteAll']]);

        $this->pathPrefix = Storage::disk('public')
            ->getDriver()
            ->getAdapter()
            ->getPathPrefix();
    }

    public function index(Request $request, $id)
    {

        $tour = Tour::findOrFail($id);
        $icons = IconTour::where('tour_id', $tour->id)->where(function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->term . '%');
        })->paginate(10)->appends($request->term);
        return Inertia::render("Tour/Icon/Index", compact('tour', 'icons'));
    }

    public function store(StoreRquest $request, $id)
    {

        $tour = Tour::findOrFail($id);

        $tour_path = 'Tour/' . $tour->id;
        if (!file_exists($tour_path)) {
            mkdir($tour_path, 0777, true);
        }
        $icon_path = $tour_path . '/icons/';
        if (!file_exists($icon_path)) {
            mkdir($icon_path, 0777, true);
        }
        // dd($request->hasFile('icon'));
        IconTour::create([
            'name' => $request->name,
            'icon' => $request->hasFile('icon') ? $this->image($request->file('icon'), $icon_path) : null,
            'tour_id' => $tour->id
        ]);
        return back()->with('success', "Create successfully");
    }

    public function update(UpdateRquest $request, $id)
    {
        $icon = IconTour::findOrFail($id);
   
        $tour = $icon->tour;
        $tour_path = 'Tour/' . $tour->id;
        if (!file_exists($tour_path)) {
            mkdir($tour_path, 0777, true);
        }
        $icon_path = $tour_path . '/icons/';
        if (!file_exists($icon_path)) {
            mkdir($icon_path, 0777, true);
        }
        if(Str::contains($icon->icon, $tour->path)){
            $icon->update([
                'name' => $request->name,
                'icon' =>  $request->hasFile('icon') ? $this->update_icon_tour($request->file('icon'), time(), $icon_path, $icon->icon) : $icon->icon
            ]);
        }
        else{
            $icon->update([
                'name' => $request->name,
                'icon' =>  $request->hasFile('icon') ? $this->update_image($request->file('icon'), time(), $icon_path, $icon->icon) : $icon->icon
            ]);
        }
     
        
        return back()->with('success', "Update successfully");
    }

  

    public function delete($id)
    {
        $icon = IconTour::findOrFail($id);
        $extension = " ";
        $this->DeleteFolder($icon->icon, $extension);
        $icon->delete();
        return back()->with('success', "Update successfully");
    }

    public function deleteAll(Request $request)
    {
      
            $ids = $request->ids;
            if($ids ==null){
                return back()->with('warning' ,"You must choose in checkbox !!!.");
            }
            $icons = IconTour::whereIn('id',  $ids)->get();
            foreach ($icons as $icon) {
                unlink($icon->icon);
                $icon->delete();
            }
            return back()->with( 'success' ,"Delete changed successfully.");
      
    }
}
