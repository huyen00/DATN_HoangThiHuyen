<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\SettingDisplay;
use App\Models\SettingTour;
use App\Models\Tour;

class SettingDisplayController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-tour|create-tour|delete-tour|edit-tour', ['only' => ['index']]);
        $this->middleware('permission:create-tour', ['only' => ['store']]);
        $this->middleware('permission:edit-tour', ['only' => ['update']]);
        $this->middleware('permission:delete-tour', ['only' => ['delete']]);
    }
    public function index($id)
    {

        $tour = Tour::with('setting_display')->findOrFail($id);
        $setting_display = $tour->setting_display;
        return Inertia::render("Tour/Setting/SettingDisplay", compact('tour', 'setting_display'));
    }

    public function store(Request $request, $id)
    {
       
        $tour = Tour::with('setting_display')->findOrFail($id);
        if ($tour->setting_display) {
            $tour->setting_display->update([
                'sound' => $request->sound,
                'share' => $request->share,
                'back_scene' => $request->back_scene,
                'fullscreen' => $request->fullscreen,
                'infor' => $request->infor,
                'setting_map' => $request->setting_map,
                'guide' => $request->guide,
                'show_hotspot' => $request->show_hotspot,
                'setting_vr' => $request->setting_vr,
                'rotate' => $request->rotate,
                'contact' => $request->contact,
            ]);
        } else {
            $tour->setting_display()->create([
                'sound' => $request->sound,
                'share' => $request->share,
                'back_scene' => $request->back_scene,
                'fullscreen' => $request->fullscreen,
                'infor' => $request->infor,
                'setting_map' => $request->setting_map,
                'guide' => $request->guide,
                'show_hotspot' => $request->show_hotspot,
                'setting_vr' => $request->setting_vr,
                'contact' => $request->contact,
                'rotate' => $request->rotate,
            ]);
        }
        return back()->with('success', 'Successfully');
    }
}
