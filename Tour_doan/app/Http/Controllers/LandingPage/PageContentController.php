<?php

namespace App\Http\Controllers\LandingPage;

use Illuminate\Http\Request;
use App\Models\PageContent;
use App\Models\Picture;
use Illuminate\Support\Facades\Gate;
use App\Models\Section;
use Inertia\Inertia;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Controllers\Traits\LanguageTrait;
use App\Http\Requests\Content\StoreRequest;
use App\Models\Images;
use App\Models\Language;
use App\Repositories\SectionRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InertiaController;

class PageContentController extends InertiaController
{
    use FileUploadTrait, LanguageTrait;
    protected $section;

    public function __construct(SectionRepository $sectionRepository)
    {
        $this->section = $sectionRepository;
    }
    public function index(Request $request, $slug)
    {

        if (Gate::allows(config('constants.USER_PERMISSION'))) {

            $section = Section::with('page_contents.languages', 'page', 'theme', 'languages', 'page_contents.images')->where('title', $slug)->first();
            if ($section == null) {
                $erros = 404;
                return Inertia::render('Error', ['status' => $erros]);
            }
            $page = $section->page;

            return Inertia::render('Content/Content', compact('section', 'page'));
        } else {
            return $this->errors()->errors_403();
        }
    }
    public function createContent($slug)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $section = $this->section->findOnebySlug($slug);
            if ($section == null) {
                $erros = 404;
                return Inertia::render('Error', ['status' => $erros]);
            }
            $page = $section->page;

            return Inertia::render('Content/CreateContent', compact('section', 'page'));
        } else {
            return $this->errors()->errors_403();
        }
    }





    public function edit($id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $content = PageContent::with('languages', 'page_contentable', 'images')->findOrFail($id);

            $section = $content->page_contentable;

            $page = $section->page;
            $theme = $section->theme;
            if ($content == null) {
                return $this->errors()->errors_404();
            }

            return Inertia::render('Content/UpdateContent', compact('content', 'section', 'page'));
        } else {
            return $this->errors()->errors_403();
        }
    }

    public function store(StoreRequest $request, $id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
          
            $section = Section::findOrFail($id);
            $name = time();
            $destinationpath = 'images/page_contents/';
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 0777, true);
            }

            // $content = Content::create([
            //     'title' => 'title' . $name,
            //     'description' => 'description' . $name,
            //     'sub_title' => 'sub_title' . $name,
            //     'link' => $request->link,
            //     'video' => $request->video,
            //     'image' => $request->hasFile('icon') ? $this->image($request->file('icon'), $destinationpath) : null,
            // ]);

            $content = new PageContent();
            $content->title = 'title' . $name;
            $content->description = 'description' . $name;
            $content->sub_title =  'sub_title' . $name;
            $content->link = $request->link;
            $content->video = $request->video;
            $content->image = $request->hasFile('icon') ? $this->image($request->file('icon'), $destinationpath) : null;
            $section->page_contents()->save($content);
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

            $this->CreateLanguage($content->title, $request->title_en, $request->title_vn, $content);
            $this->CreateLanguage($content->description, $request->description_en, $request->description_vn, $content);
            $this->CreateLanguage($content->sub_title, $request->subtitle_en, $request->subtitle_vn, $content);
            return redirect('/admin/pages/section/' . $section->title . '/content')->with('success', 'Create successfully');
        } else {
            return $this->errors()->errors_403();
        }
    }



    public function update(Request $request, $id)
    {

        if (Gate::allows(config('constants.USER_PERMISSION'))) {

            $content = PageContent::with('languages', 'page_contentable')->findOrFail($id);
            $language_title = Language::where('key', $content->title)->first();
            // $language_sub_title = Languages::where('key', $content->sub_title)->first();
            // $language_description = Languages::where('key', $content->description)->first();
            $this->validate(
                $request,
                [
                    'title_en' => 'required|unique:languages,en,' . $language_title->id,
                    'title_vn' => 'required|unique:languages,vn,' . $language_title->id,
                    'subtitle_en' => 'nullable',
                    'subtitle_vn' => 'nullable',
                    'description_en' => 'nullable',
                    'description_vn' => 'nullable',
                    'link' => 'nullable',
                    'video' => 'nullable',
                    'icon' => 'nullable|mimes:png,svg,webp'
                ]
            );
            $destinationpath = 'images/page_contents/';
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 0777, true);
            }

            $name = time();

            $content->link = $request->link;
            $content->video = $request->video;
            $content->image = $request->hasFile('icon') ? $this->update_image($request->file('icon'), $name, $destinationpath, $content->image) : $content->image;
            $content->save();

            $this->updateLanguage($content->title, $request->title_en, $request->title_vn, $content);
            $this->updateLanguage($content->sub_title, $request->subtitle_en, $request->subtitle_vn, $content);

            $this->updateLanguage($content->description, $request->description_en, $request->description_vn, $content);
            return redirect('/admin/pages/section/' . $content->page_contentable->title . '/content')->with('success', 'Update successfully');
        } else {
            return $this->errors()->errors_403();
        }
    }
    public function delete($id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $content = PageContent::with('languages')->findOrFail($id);
            $extension = " ";
            $this->DeleteFolder($content->image, $extension);
            foreach ($content->languages as $language) {
                $this->deleteLanguage($language->key, 'en.json');
                $this->deleteLanguage($language->key, 'vi.json');
            }
            $content->languages()->delete();
            $content->delete();
            return back()->with('success', 'Delete sucussefully');
        } else {
            $erros = 403;
            return Inertia::render('Erros', ['status' => $erros]);
        }
    }

    public function priorityContent(Request $request)
    {
        if (Gate::allows(config('constants.USER_PERMISSION')) || Gate::allows(config('constants.CREATE_VIRTUAL'))) {
            $data = $request->data;
            for ($i = 0; $i < count($data); $i++) {
                PageContent::findOrFail($data[$i]['id'])->update(['id_priority' => $i]);
            }
            return redirect()->back()->with('success', 'Sort  successfully');
        } else {
            return $this->errors()->errors_403();
        }
    }
}
