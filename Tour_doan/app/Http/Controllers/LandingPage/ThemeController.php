<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\InertiaController;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\LanguageTrait;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\Theme;
use App\Repositories\ThemeRepository;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ThemeController extends InertiaController
{
    use LanguageTrait, FileUploadTrait;
    protected $theme;

    public function __construct(ThemeRepository $themeRepository)
    {
        $this->theme = $themeRepository;
    }

    public function index()
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $themes = $this->theme->get();
            return Inertia::render('Theme/Theme', compact('themes'));
        } else {

            return $this->errors()->errors_403();
        }
    }

    public function store(Request $request)
    {

        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $this->validate($request, [
                'title' => 'required|unique:themes,title',
                'link_code' => 'required',
                'image_template' => 'required|mimes:png,jpg,jpeg',
                'type' => 'required',


            ]);

            $destinationpath = 'images/theme/';
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 0777, true);
            }

            Theme::create([
                'title' => $request->title,
                'link_code' => $request->link_code,
                'image_template' => $this->image($request->file('image_template'), $destinationpath),
                'type' => $request->type
            ]);
            return back()->with('success', 'Create successfully');
        } else {
            return $this->errors()->errors_403();
        }
    }

    public function update(Request $request, $id)
    {

        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $theme = Theme::findOrFail($id);
            $this->validate($request, [
                'title' => 'required|unique:themes,title,' . $theme->id,
                'link_code' => 'required',
                'image_template' => 'nullable|mimes:png,jpg,jpeg',
                'type' => 'required',


            ]);

            $destinationpath = 'images/theme/';
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 0777, true);
            }

            $name = time();
            $theme->update([
                'title' => $request->title,
                'link_code' => $request->link_code,
                'image_template' => $request->hasFile('image_template') ? $this->update_image($request->file('image_template'), $name, $destinationpath, $theme->image_template) : $theme->image_template,
                'type' => $request->type
            ]);
            return back()->with('success', 'Update successfully');
        } else {
            return $this->errors()->errors_403();
        }
    }


    public function delete($id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $theme = Theme::findOrFail($id);
            $extension = " ";
            $this->DeleteFolder($theme->image_template, $extension);
            $theme->delete();
            return back()->with('success', 'Delete sucussefully');
        } else {
            return $this->errors()->errors_403();
        }
    }
}
