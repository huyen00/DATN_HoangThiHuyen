<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Tour\Sound\StoreRequest;
use App\Models\Sound;
use App\Models\Tour;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SoundController extends Controller
{
    
    use  FileUploadTrait;
    public function __construct()
    {
        $this->middleware('permission:view-tour|create-tour|delete-tour|edit-tour', ['only' => ['index']]);
        $this->middleware('permission:create-tour', ['only' => ['store']]);
        $this->middleware('permission:edit-tour', ['only' => ['update']]);
        $this->middleware('permission:delete-tour', ['only' => ['destroy']]);
    }

    public function index($id){

        $tour= Tour::with('sounds')->findOrFail($id);
        $sounds = $tour->sounds;
        return Inertia::render("Tour/Sound/Index",compact('tour','sounds'));

    }


    public function store(StoreRequest $request, $id){
      
        $tour= Tour::findOrFail($id);
        $path = $this->createDirectoryTour($tour,'sound');
        if ($request->hasFile('sounds')) {
            $files = $request->sounds;
            foreach ($files as $file) {
                $sound = new Sound();
                $sound->name = $file->getClientOriginalName();
                $sound->sound = $this->image($file, $path);
                $sound->tour_id= $tour->id;
                $sound->save();

            }
        }
        return back()->with('success', 'Create successfully');
    }

    public function update(Request $request, $id){

        $this->validate(
            $request,
            [
                'name' => 'required',
                'sounds' =>'nullable|mimes:application/octet-stream,audio/mpeg,mpga,mp3,wav',
            ]
        );
        $sound = Sound::with('tour')->findOrFail($id);
        $tour = $sound->tour;
        $path = $this->createDirectoryTour($tour,'sound');
        $name = time();
        $sound->update([
            'name' => $request->name,
            'sound' =>  $request->hasFile('sounds') ? $this->update_image($request->file('sounds'), $name, $path, $sound->sound) : $sound->sound,
        ]);

        return back()->with('success', 'Update successfully');

    }

    public function delete($id)
    {
            $sound = Sound::findOrFail($id);
            $extension = " ";
            $this->DeleteFolder($sound->sound, $extension);
            $sound->delete();
            return redirect()->back()->with('success', 'Delete  successfully');
    
    }


    public function prioritySound(Request $request)
    {
       
            $data = $request->data;
            for ($i = 0; $i < count($data); $i++) {
                Sound::findOrFail($data[$i]['id'])->update(['id_priority' => $i]);
            }
            return redirect()->back()->with('success', 'Sort  successfully');
       
    }

    public function changeState(Request $request,$id){
        $sound= Sound::findOrFail($id)->update(['state'=> $request->state]);
        return response()->json('Change successfully', Response::HTTP_OK);

    }

}
