<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Tour;
use App\Models\SettingTour;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Tour\Icon\UpdateRquest;
use App\Http\Requests\Tour\Setting\StoreRequest;

class SettingController extends Controller
{
    use FileUploadTrait;
    function __construct()
    {
        $this->middleware('permission:view-tour|create-tour|delete-tour|edit-tour', ['only' => ['index']]);
        $this->middleware('permission:create-tour', ['only' => ['store']]);
        $this->middleware('permission:edit-tour', ['only' => ['update']]);
        $this->middleware('permission:delete-tour', ['only' => ['destroy']]);
    }

    public function index($id)
    {
        $tour = Tour::with('setting_tour')->findOrFail($id);
        $setting_tour = $tour->setting_tour;
        return Inertia::render("Tour/Setting/Index", compact('tour', 'setting_tour'));
    }


    public function store(StoreRequest $request, $id)
    {

        $tour = Tour::with('setting_tour')->findOrFail($id);
        $tour_path = 'Tour/' . $tour->id;
        if (!file_exists($tour_path)) {
            mkdir($tour_path, 0777, true);
        }
        $setting_path = $tour_path . '/setting/';
        if (!file_exists($setting_path)) {
            mkdir($setting_path, 0777, true);
        }
        $name = time();
        if ($tour->setting_tour) {
            $tour->setting_tour->update([
                'description' => $request->description,
                'thumb' => $request->hasFile('thumb') ? $this->update_image($request->file('thumb'), $name, $setting_path, $tour->setting_tour->thumb) : $tour->setting_tour->thumb,
                'logo' => $request->hasFile('logo') ? $this->update_image($request->file('logo'), $name, $setting_path, $tour->setting_tour->logo) : $tour->setting_tour->logo,
                'favicon' => $request->hasFile('favicon') ? $this->update_image($request->file('favicon'), $name, $setting_path, $tour->setting_tour->favicon) : $tour->setting_tour->favicon,
            ]);
        } else {
            $tour->setting_tour()->create([
                'description' => $request->description,
                'thumb' => $request->hasFile('thumb') ? $this->image($request->file('thumb'), $setting_path) : null,
                'logo' => $request->hasFile('logo') ? $this->image($request->file('logo'), $setting_path) : null,
                'favicon' => $request->hasFile('favicon') ? $this->image($request->file('favicon'),  $setting_path) : null,
            ]);
        }
        return back()->with('success', 'Successfully');
    }

    public function delete($id)
    {
        $setting = SettingTour::findOrFail($id);
        $extension = " ";
        $this->DeleteFolder($setting->logo, $extension);
        $this->DeleteFolder($setting->thumb, $extension);
        $this->DeleteFolder($setting->favicon, $extension);
        $setting->delete();
        return back()->with('success', 'Successfully');
    }
}
