<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\HotsPot;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Tour\Hotspot\Content\StoreRequest;
use GuzzleHttp\HandlerStack;
use Illuminate\Support\Facades\Http;
class ContentController extends Controller
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
    public function index($id)
    {
        $hotspot = HotsPot::with('pano.tour')->findOrFail($id);
        $pano = $hotspot->pano;
        $tour = $pano->tour;
      
        $contents = Content::with('voices')->where('hotspot_id', $hotspot->id)->get();

        return Inertia::render('Tour/Hotspot/Content', compact('hotspot', 'tour', 'pano', 'contents'));
    }

    public function store(StoreRequest $request, $id)
    {

        $hotspot = HotsPot::with('pano.tour')->findOrFail($id);
        $pano = $hotspot->pano;
        $tour = $pano->tour;
        $hotspot_path = $this->createDirectory($tour, $hotspot);
        $content_path = $hotspot_path . '/content/';
        if (!file_exists($content_path)) {
            mkdir($content_path, 0777, true);
        }
        $content = Content::create([
            'name' => $request->name,
            'video' => $request->video,
            'description_en' => $request->description_en,
            'description_vn' => $request->description_vn,
            'link' => $request->link,
            'image' => $request->hasFile('image') ? $this->image($request->file('image'), $content_path) : null,
            'hotspot_id' => $hotspot->id

        ]);
        return back()->with('success', 'Create successfully');
    }

    public function update(StoreRequest $request, $id)
    {
        $content = Content::with('hotspot.pano.tour')->findOrFail($id);
        $hotspot = $content->hotspot;
        $pano = $hotspot->pano;
        $tour = $pano->tour;
        $hotspot_path = $this->createDirectory($tour, $hotspot);
        $content_path = $hotspot_path . '/content/';
        if (!file_exists($content_path)) {
            mkdir($content_path, 0777, true);
        }
        $content->update([
            'name' => $request->name,
            'video' => $request->video,
            'description_en' => $request->description_en,
            'description_vn' => $request->description_vn,
            'link' => $request->link,
            'image' => $request->hasFile('image') ? $this->image($request->file('image'), $content_path) : null,
            'hotspot_id' => $hotspot->id

        ]);
        return back()->with('success', 'Create successfully');
    }

    public function delete($id)
    {
        $content = Content::with('hotspot.pano.tour','voices')->findOrFail($id);
        $extension = " ";
        $this->DeleteFolder($content->image, $extension);
        foreach($content->voices as $voice){
            $this->DeleteFolder($voice->voice, $extension);
        }
        $content->delete();
        return back()->with('success', 'Delete successfully');
    }
}
