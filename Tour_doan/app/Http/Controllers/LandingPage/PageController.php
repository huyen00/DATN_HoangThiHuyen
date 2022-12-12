<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\InertiaController;

use App\Repositories\PageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\LanguageTrait;
use App\Http\Requests\Page\StorePageRequest;
use App\Models\Language;
use App\Models\Page;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class PageController extends InertiaController
{
    use LanguageTrait;
    protected $page;

    public function __construct(PageRepository $pageRepository)
    {
        $this->page = $pageRepository;
    }


    public function index()
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $pages = $this->page->get();
            return Inertia::render('Page', compact('pages'));
        } {
            return $this->errors()->errors_403();
        }
    }

    public function store(StorePageRequest $request)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {


            $page = Page::create([
                'title' => $request->title,
                'description' => 'description' . time()
            ]);

            $this->CreateLanguage($page->title, $request->title_en, $request->title_vn, $page);
            $this->CreateLanguage($page->description, $request->description_en, $request->description_vn, $page);
            return back()->with('success', 'Create successfully');
        } {
            return $this->errors()->errors_403();
        }
    }

    public function update(Request $request, $id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $page = Page::with('languages')->findOrFail($id);
            $language_title = Language::where('key', $page->title)->first();
            $this->validate(
                $request,
                [
                    // 'title' => 'required|unique:languages,key,' . $language_title->id,
                    'description_en' => 'nullable',
                    'description_vn' => 'nullable',
                    'title_en' => 'required',
                    'title_vn' => 'required'
                ],
                [
                    'title_en.required' => __('Hãy nhập tiêu đề Tiếng Anh'),
                    'title_vn.required' => __('Hãy nhập tiêu đề  Tiếng Việt'),
                ]

            );
            $this->updateLanguage($page->title, $request->title_en, $request->title_vn, $page);
            $this->updateLanguage($page->description, $request->description_en, $request->description_vn, $page);
            return back()->with('success', 'Update successfully');
        } {
            return $this->errors()->errors_403();
        }
    }

    public function delete($id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $page = Page::with('languages')->findOrFail($id);
            foreach ($page->languages as $language) {
                $this->deleteLanguage($language->key, 'en.json');
                $this->deleteLanguage($language->key, 'vi.json');
            }
            $page->languages()->delete();
            $page->delete();


            return back()->with('success', 'Update successfully');
        } else {
            return $this->errors()->errors_403();
        }
    }
    public function priorityPage(Request $request)
    {
        if (Gate::allows(config('constants.USER_PERMISSION')) || Gate::allows(config('constants.CREATE_VIRTUAL'))) {
            $data = $request->data;
            $this->page->priority($data);
            return redirect()->back()->with('success', 'Sort  successfully');
        } else {
            return $this->errors()->errors_403();
        }
    }
}
