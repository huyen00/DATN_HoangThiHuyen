<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Page;
use Inertia\Inertia;
use App\Models\Section;
use App\Http\Controllers\Traits\LanguageTrait;
use App\Models\Languages;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Jobs\DeleteLanguage;
use App\Models\Theme;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class SectionController extends Controller
{
    use LanguageTrait, FileUploadTrait;
    public function index(Request $request, $id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
      
            $page = Page::with('sections.languages', 'sections.theme')->findOrFail($id);
            $themes = Theme::get();
            $sections = $page->sections;
            return Inertia::render('Section/Section', compact('page', 'themes', 'sections'));
        } else {
            $erros = "403";
            return Inertia::render('Erros', ['status' => $erros]);
        }
    }
    public function edit(Request $request, $id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $section = Section::with('languages')->findOrFail($id);
            $page = Page::findOrFail($section->page_id);
            $themes = Theme::get();
            return Inertia::render('Section/UpdateSection', compact('page', 'themes', 'section'));
        } else {
            $erros = 403;
            return Inertia::render('Erros', ['status' => $erros]);
        }
    }

    public function create(Request $request, $id)
    {
    
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $page = Page::with('sections.languages', 'sections.theme')->findOrFail($id);
            $themes = Theme::get();
            $sections = $page->sections;
            return Inertia::render('Section/SectionCreate', compact('page', 'themes', 'sections'));
        } else {
            $erros = 403;
            return Inertia::render('Erros', ['status' => $erros]);
        }
    }

    public function store(Request $request, $id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {

            $page = Page::findOrFail($id);

            $this->validate(
                $request,
                [

                    'title_en' => 'required',
                    'title_vn' => 'required',
                    'description_en' => 'nullable',
                    'description_vn' => 'nullable',
                    'sub_title_en' => 'nullable',
                    'sub_title_vn' => 'nullable',
                    'theme_id' => 'required',

                ]
            );
            $name = time();
            $section = Section::create([
                'title' => 'title' . $name,
                'description' => 'description' . $name,
                'theme_id' => $request->theme_id,
                'sub_title' => 'sub_title' . $name,
                'page_id' => $page->id
            ]);
            $this->CreateLanguage($section->title, $request->title_en, $request->title_vn, $section);
            $this->CreateLanguage($section->description, $request->description_en, $request->description_vn, $section);
            $this->CreateLanguage($section->sub_title, $request->sub_title_en, $request->sub_title_vn, $section);
            return redirect('/admin/pages/' . $page->id . '/section')->with('success', 'Create successfully');
        } else {
            $erros = 403;
            return Inertia::render('Error', ['status' => $erros]);
        }
    }


    public function update(Request $request, $id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $section = Section::with('languages')->findOrFail($id);
            $this->validate(
                $request,
                [

                    'title_en' => 'required',
                    'title_vn' => 'required',
                    'description_en' => 'nullable',
                    'description_vn' => 'nullable',
                    'sub_title_en' => 'nullable',
                    'sub_title_vn' => 'nullable',
                    'theme_id' => 'required',

                ]
            );
            $section->theme_id = $request->theme_id;
            $section->save();
            $this->updateLanguage($section->title, $request->title_en, $request->title_vn, $section);
            $this->updateLanguage($section->sub_title, $request->sub_title_en, $request->sub_title_vn, $section);
            $this->updateLanguage($section->description, $request->description_en, $request->description_vn, $section);
            return redirect('/admin/pages/' . $section->page->id . '/section')->with('success', 'Update successfully');
        } else {
            $erros = 403;
            return Inertia::render('Error', ['status' => $erros]);
        }
    }

    public function delete($id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $section = Section::with('languages', 'page_contents.languages')->findOrFail($id);

            foreach ($section->page_contents as $content) {
                $extension = " ";
                $this->DeleteFolder($content->image, $extension);
                foreach ($content->languages as $language) {
                    dispatch(new DeleteLanguage($language->key, 'en.json'));
                    dispatch(new DeleteLanguage($language->key, 'vi.json'));
                }
            }
          
            $section->page_contents()->delete();
            $section->delete();


            return back()->with('success', 'Update successfully');
        } else {
            $erros = 403;
            return Inertia::render('Error', ['status' => $erros]);
        }
    }


    public function prioritySection(Request $request)
    {
        if (Gate::allows(config('constants.USER_PERMISSION')) || Gate::allows(config('constants.CREATE_VIRTUAL'))) {
            $data = $request->data;
            for ($i = 0; $i < count($data); $i++) {
                Section::findOrFail($data[$i]['id'])->update(['id_priority' => $i]);
            }
            return redirect()->back()->with('success', 'Sort  successfully');
        } else {
            $erros = "Not found data booth!!";
            return Inertia::render('Erros/404', ['erros' => $erros]);
        }
    }

    public function changeActive(Request $request)
    {
        if (Gate::allows(config('constants.USER_PERMISSION')) || Gate::allows(config('constants.CREATE_VIRTUAL'))) {
            Section::findOrFail($request->id)->update(['active' => $request->active]);
            return response()->json('Change successfully', Response::HTTP_OK);
        } else {
            $erros = "Not found data booth!!";
            return Inertia::render('Erros/404', ['erros' => $erros]);
        }
    }
}
