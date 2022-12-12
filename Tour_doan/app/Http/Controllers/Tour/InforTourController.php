<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\InforTour;
use App\Models\Tour;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Tour\InforTour\StoreRequest;

class InforTourController extends Controller
{
    use FileUploadTrait;
    public function index($id){
        $tour= Tour::with('infors.images')->findOrFail($id);
        $infor_tours = $tour->infors;
        return Inertia::render('Tour/Infor/Index', compact('tour', 'infor_tours'));
    }

    public function store(StoreRequest $request,$id){
        $tour = Tour::findOrFail($id);

        $image_path = $this->createDirectoryTour($tour,'infor');

        $infor = InforTour::create([
            'title'=> $request->title,
            'description_en' => $request->description_en,
            'description_vn' => $request->description_vn,
            'tour_id' => $tour->id
        ]);
        $destinationpath= $image_path.$infor->id.'/';
        if ($request->hasFile('images')) {
            $files = $request->images;

            foreach ($files as $file) {
                $image = new Image();
                $image->name = $file->getClientOriginalName();
                $image->image = $this->image($file, $destinationpath);
                $infor->images()->save($image);

            }
        }
        return back()->with('success', 'Create successfully');
        
    }

    public function update(StoreRequest $request, $id){
        $infor = InforTour::with('tour')->findOrFail($id);
  

        $infor->update([
            'title'=> $request->title,
            'description_en' => $request->description_en,
            'description_vn' => $request->description_vn,
        ]);

        return back()->with('success', 'Create successfully');
    }

    public function inforPrority(Request $request){

            $data = $request->data;
            for ($i = 0; $i < count($data); $i++) {
                InforTour::findOrFail($data[$i]['id'])->update(['id_priority' => $i]);
            }
            return redirect()->back()->with('success', 'Sort  successfully');
    }

    public function delete($id){
        $infor = InforTour::with('tour')->findOrFail($id);
        $image_path = $this->createDirectoryTour($infor->tour,'infor');
        $destinationpath= $image_path.$infor->id;
        $extension= " ";
        $this->DeleteFolder($destinationpath, $extension);
        return back()->with('success', 'Delete successfully');

    }
}
