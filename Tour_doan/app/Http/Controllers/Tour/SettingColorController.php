<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Tour;
class SettingColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-tour|create-tour|delete-tour|edit-tour', ['only' => ['index']]);
        $this->middleware('permission:create-tour', ['only' => ['store']]);
        $this->middleware('permission:edit-tour', ['only' => ['update']]);
        $this->middleware('permission:delete-tour', ['only' => ['destroy']]);
    }

    public function index($id){
        $tour = Tour::with('setting_color')->findOrFail($id);
        $setting_color = $tour->setting_color;
        return Inertia::render('Tour/Setting/SettingColor', compact('tour','setting_color'));
    }

    public function store(Request $request, $id){
        $tour = Tour::with('setting_color')->findOrFail($id);
        if($tour->setting_color){
            $tour->setting_color->update([
                'icon_color' => $request->icon_color,
                'bg_icon_color' => $request->bg_icon_color,
                'hover_color_icon' => $request->hover_color_icon,
                'hover_bg_icon_color' => $request->hover_bg_icon_color,
                'active_icon_color' => $request->active_icon_color,
                'active_bg_icon_color' => $request->active_bg_icon_color,
                'bg_menu_color' => $request->bg_menu_color,
                'bg_color_category' => $request->bg_color_category,
                'color_category' => $request->color_category,
                'color_item' => $request->color_item,
                'hover_color_item' => $request->hover_color_item,
                'active_color_item' => $request->active_color_item,
            ]);
        }
        else{
            $tour->setting_color()->create([
                'icon_color' => $request->icon_color,
                'bg_icon_color' => $request->bg_icon_color,
                'hover_color_icon' => $request->hover_color_icon,
                'hover_bg_icon_color' => $request->hover_bg_icon_color,
                'active_icon_color' => $request->active_icon_color,
                'active_bg_icon_color' => $request->active_bg_icon_color,
                'bg_menu_color' => $request->bg_menu_color,
                'bg_color_category' => $request->bg_color_category,
                'color_category' => $request->color_category,
                'color_item' => $request->color_item,
                'hover_color_item' => $request->hover_color_item,
                'active_color_item' => $request->active_color_item,
            ]);
        }
        return back()->with('success', 'Successfully');
    }

}
