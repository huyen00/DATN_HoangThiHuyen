<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\InertiaController;

use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\PageContent;
use App\Models\Picture;
use Illuminate\Http\Response;

class PictureController extends InertiaController
{
    use FileUploadTrait;
    public function store(Request $request, $id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $content = PageContent::findOrFail($id);

            $this->validate(
                $request,
                [
                    'images.*' => 'required|mimes:png,jpg,jpeg',
                ]
            );
            $destinationpath = 'images/contents/';
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 0777, true);
            }
            if ($request->hasFile('images')) {
                $files = $request->images;

                foreach ($files as $file) {
                    Picture::create([
                        'name' => $file->getClientOriginalName(),
                        'image' => $this->image($file, $destinationpath),
                        'page_content_id' => $content->id
                    ]);
                }
            }
            return back()->with('success', 'Create successfully');
        } else {
            $erros = 403;
            return Inertia::render('Erros', ['status' => $erros]);
        }
    }

    public function list_image(Request $request, $id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $content = PageContent::findOrFail($id);

            $section = $content->page_contentable;

            $page = $section->page;
            $theme = $section->theme;
            if ($content == null) {
                return $this->errors()->errors_404();
            }
            $list_image = Picture::where('page_content_id', $id)->orderBy('id_priority', 'asc')->orderBy('id', 'asc')->get();
            return Inertia::render('Image/ListImage', compact('content', 'list_image', 'section', 'page'));
        } else {
            $erros = 403;
            return Inertia::render('Erros', ['status' => $erros]);
        }
    }


    public function update(Request $request, $id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $image = Picture::findOrFail($id);

            $this->validate(
                $request,
                [
                    'name' => 'required',
                    'images' => 'nullable|mimes:png,jpg,jpeg',
                ]
            );
            $name = time();
            $destinationpath = 'images/contents/';
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 0777, true);
            }
            $image->update([
                'name' => $request->name,
                'image' =>  $request->hasFile('images') ? $this->update_image($request->file('images'), $name, $destinationpath, $image->image) : $image->image,
            ]);

            return back()->with('success', 'Update successfully');
        } else {
            $erros = 403;
            return Inertia::render('Erros', ['status' => $erros]);
        }
    }

    public function delete($id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION')) || Gate::allows(config('constants.CREATE_VIRTUAL'))) {
            $image = Picture::findOrFail($id);
            $extension = " ";
            $this->DeleteFolder($image->image, $extension);
            $image->delete();
            return redirect()->back()->with('success', 'Delete  successfully');
        } else {
            $erros = 403;
            return Inertia::render('Erros', ['status' => $erros]);
        }
    }


    public function priorityImage(Request $request)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $data = $request->data;
            for ($i = 0; $i < count($data); $i++) {
                Picture::findOrFail($data[$i]['id'])->update(['id_priority' => $i]);
            }
            return redirect()->back()->with('success', 'Sort  successfully');
        } else {
            $erros = 403;
            return Inertia::render('Erros', ['status' => $erros]);
        }
    }

    public function selectElement(Request $request)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            Picture::find($request->id)->update(['element' => $request->element]);
            return response()->json('Change successfully', Response::HTTP_OK);
        } else {
            $erros = 403;
            return Inertia::render('Erros', ['status' => $erros]);
        }
    }

    public function selectEmbed(Request $request)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            Picture::find($request->id)->update(['embed' => $request->embed]);
            return response()->json('Change successfully', Response::HTTP_OK);
        } else {
            $erros = 403;
            return Inertia::render('Erros', ['status' => $erros]);
        }
    }

    public function editNameImage(Request $request)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            if ($request->id == null || $request->name == null) {
                return response()->json('The name must be required', Response::HTTP_BAD_REQUEST);
            }
            Picture::find($request->id)->update(['name' => $request->name]);
            return response()->json('Change successfully', Response::HTTP_OK);
        } else {
            $erros = 403;
            return Inertia::render('Erros', ['status' => $erros]);
        }
    }
}
