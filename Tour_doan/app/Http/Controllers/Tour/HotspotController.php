<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Tour\Hotspot\StoreRequest;
use App\Http\Requests\Tour\Icon\StoreRquest;
use App\Models\CategoryHotspot;
use App\Models\Content;
use App\Models\HotsPot;
use App\Models\IconTour;
use App\Models\Pano;
use App\Models\Tour;
use Illuminate\Support\Facades\File;

class HotspotController extends Controller
{
    use  FileUploadTrait;
    public $pathPrefix;
    public function __construct()
    {
        $this->middleware('permission:view-tour|create-tour|delete-tour|edit-tour', ['only' => ['index']]);
        $this->middleware('permission:create-tour', ['only' => ['store']]);
        $this->middleware('permission:edit-tour', ['only' => ['update']]);
        $this->middleware('permission:delete-tour', ['only' => ['destroy']]);
    }
    public function index(Request $request, $name, $id)
    {
        $tour = Tour::with("panos")->where('code', $name)->first();
        $panos = $tour->panos;
        if ($tour == null) {
            abort(404);
        }
        $icons = IconTour::where('tour_id', $tour->id)->get();

        $pano = Pano::with('tour')->findOrFail($id);
        $hotspots = HotsPot::with('category')->where('pano_id', $pano->id)->where(function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->term . '%');
        })->paginate(15)->appends($request->term);
        $tour = $pano->tour;
        $category_hotspots = CategoryHotspot::get();
        // dd($panos);

        return Inertia::render('Tour/Hotspot/Index', compact('pano', 'hotspots', 'tour', 'category_hotspots','icons','panos'));
    }

    public function store(StoreRequest $request, $id)
    {
        $pano = Pano::with('tour')->findOrFail($id);
        $tour = $pano->tour;
                // Create hotspot dicrectory

        $hotspot = HotsPot::create([
            'name' => $request->name,
            'pano_id' => $pano->id,
            'icon_id' => $request->icon_id,
            'category_hotspot_id' => $request->category_hotspot_id
        ]);
        $this->saveContent($hotspot,$request);

        return back()->with('success', "Create successfully");
    }

    public function update(StoreRequest $request, $id)
    {
        $hotspot = HotsPot::findOrFail($id);
        // $icon = IconTour::findOrFail($request->icon_id);
        $hotspot->update([
            'name' => $request->name,
            // 'icon_id' => $request->icon_id,
            // 'category_hotspot_id' => $request->category_hotspot_id,
            // 'style' => $icon->name,
            'html' => $request->html,
        ]);
        return back()->with('success', "Update successfully");
    }

    public function delete($id)
    {

        $hotspot = HotsPot::with('contents', 'pano.tour')->findOrFail($id);
        $pano = $hotspot->pano;
        $tour = $pano->tour;
        $hotspot_path = $this->createDirectory($tour, $hotspot);
        File::deleteDirectory($hotspot_path);
        $hotspot->delete();
        return back()->with('success', "Delete successfully");
    }

    public function saveDataAction(Request $request,$idhotspot){
        $hotspot = HotsPot::with('contents', 'pano.tour','category','icon')->findOrFail($idhotspot);
        $type = $request->type;
        switch($type){
            case "show_text" :
                $this->saveActionShowText($hotspot,$request->action,$request);
                break;
            case "popup_image" :
                $this->saveActionPopUpImage($hotspot,$request->action,$request);
                break;
            case "popup_webframe" : break;
            case "linkedscene" :
                $this->saveLinkScene($hotspot,$request);
                break;
            default: break;
        }
    }
    public function saveActionShowText($hotspot,$action,$request){
        switch($action){
            case "onload" : break;
            case "onloaded" : break;
            case "onhover" :
                $hotspot->onhover = "showInfo(" . $request->description_en . ")";
                $hotspot->save();
                break;
            case "onclick" :
                $content = $this->saveContent($hotspot,$request);
                $hotspot->onclick = "js(showform(" . $hotspot->pano->name . "," . $content->description_en . "))";
                $hotspot->save();
                break;
        }
    }

    public function clearAction(Request $request, $id){
        $hotspot = HotsPot::with('contents', 'pano.tour','category','icon')->findOrFail($id);

        $hotspot->update([
            $request->type_action => null
        ]);
        return back()->with('success', "Clear successfully");

    }

    public function saveActionPopUpImage($hotspot,$action,$request){
        switch($action){
            case "onload" : break;
            case "onloaded" : break;
            case "onhover" :
                $hotspot->onhover = "showInfo(" . $request->description_en . ")";
                $hotspot->save();
                break;
            case "onclick" :
                $content = $this->saveContent($hotspot,$request);
                $hotspot->onclick = "popup('image'," . $content->image . ")";
                $hotspot->save();
                break;
        }
    }
    public function saveContent($hotspot,$request)
    {
        $hotspot_path = $this->createDirectory($hotspot->pano->tour, $hotspot);
        $content_path = $hotspot_path . '/content/';
        if (!file_exists($content_path)) {
            mkdir($content_path, 0777, true);
        }
        $content = Content::create([
            'name' => $hotspot->name,
            'video' => $request->video,
            'description_en' => $request->description_en,
            'link' => $request->link,
            'image' => $request->hasFile('image') ? $this->image($request->file('image'), $content_path) : null,
            'hotspot_id' => $hotspot->id
        ]);
        return $content;
    }
    public function checkContent(){

    }
    public function saveLinkScene($hotspot,$request){
        $hotspot->linkedscene = $request->linkedscene;
        $hotspot->save();
    }
}
