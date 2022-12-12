<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use Inertia\Inertia;
use App\Models\Image;
use App\Models\InforTour;
use App\Models\Tour;

class ImageController extends Controller
{
    use FileUploadTrait;

    public function index($id, $slug){
        $tour= Tour::findOrFail($id);
        $infor = InforTour::with('tour','images')->findOrFail($slug);
        $images= $infor->images;
        return Inertia::render('Tour/Infor/Image', compact('tour','images', 'infor'));
    }
    public function store(Request $request, $id, $slug)
    {
            $this->validate(
                $request,
                [
                    'images.*' => 'required|mimes:png,jpg,jpeg',
                ]
            );
            $tour= Tour::findOrFail($id);
            $infor = InforTour::with('tour')->findOrFail($slug);

         
         
            $path = $this->createDirectoryTour($tour,'infor');
            $destinationpath= $path.$infor->id .'/';
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 0777, true);
            }
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

   

    public function update(Request $request,  $id, $slug)
    {
            $infor = InforTour::with('tour')->findOrFail($id);
            $image = Image::findOrFail($slug);
            $path = $this->createDirectoryTour($infor->tour,'infor');
            $destinationpath= $path.$infor->id.'/';
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 0777, true);
            }
         
            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'images' => 'nullable|mimes:png,jpg,jpeg',
                ]
            );
            $name = time();
            $image->update([
                'name' => $request->name,
                'image' =>  $request->hasFile('image') ? $this->update_image($request->file('image'), $name, $destinationpath, $image->image) : $image->image,
            ]);

            return back()->with('success', 'Update successfully');
      
    }

    public function delete($id)
    {
            $image = Image::findOrFail($id);
            $extension = " ";
            $this->DeleteFolder($image->image, $extension);
            $image->delete();
            return redirect()->back()->with('success', 'Delete  successfully');
    
    }


    public function priorityImage(Request $request)
    {
       
            $data = $request->data;
            for ($i = 0; $i < count($data); $i++) {
                Image::findOrFail($data[$i]['id'])->update(['id_priority' => $i]);
            }
            return redirect()->back()->with('success', 'Sort  successfully');
       
    }

 


  
}
