<?php


namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\InertiaController;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Tag;
use Illuminate\Support\Str;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Controllers\Traits\LanguageTrait;
use App\Http\Requests\News\PostNewsRequest;

use App\Models\CategoryNew;
use App\Models\News;
use App\Repositories\NewRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Language;

class NewController extends InertiaController
{
    use FileUploadTrait, LanguageTrait;

    protected $new;
    public function __construct(NewRepository $newRepository)
    {
        $this->new = $newRepository;
    }

    public function index(Request $request)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {

            $news = $this->new->query($request);
            $category_news = CategoryNew::get();
            $tags = Tag::get();
            return Inertia::render('Blog/Tintuc', compact('news', 'category_news', 'tags'));
        } else {
            return $this->errors()->errors_403();
        }
    }

    public function create()
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $category_news = CategoryNew::get();
            $tags = Tag::get();

            return Inertia::render('Blog/CreateNew', compact('category_news', 'tags'));
        } else {
            return $this->errors()->errors_403();
        }
    }

    public function edit($id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $new = News::with('languages', 'tags')->findOrFail($id);
            $category_news = CategoryNew::get();
            $tags = Tag::get();

            return Inertia::render('Blog/UpdateNew', compact('category_news', 'tags', 'new'));
        } else {
            return $this->errors()->errors_403();
        }
    }
    public function store(PostNewsRequest $request)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $destinationpath = 'images/tintuc/';
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 777, true);
            }
            $name = time();
            $tintuc = News::create([
                'title' => 'title' . $name,
                'slug' => 'slug' . $name,
                'content' => 'content' . $name,
                'image' => $request->hasFile('image') ? $this->image($request->file('image'), $destinationpath) : null,
                'category_id' => $request->category_id,
                'outstanding' => $request->outstanding,

            ]);
            $tags = Tag::find($request->tags);
            $tintuc->tags()->sync($tags);
            $this->CreateLanguage($tintuc->title, $request->title_en, $request->title_vn, $tintuc);
            $this->CreateLanguage($tintuc->content, $request->content_en, $request->content_vn, $tintuc);
            $this->CreateLanguage($tintuc->slug, Str::slug($request->title_en), Str::slug($request->title_vn), $tintuc);
            return redirect('/admin/blogs/tintuc')->with('success', 'Create successfully');
        } else {
            return $this->errors()->errors_403();
        }
    }

    public function update(Request $request, $id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $tintuc = News::with('languages')->findOrFail($id);
            $language_title = Language::where('key', $tintuc->title)->first();
            $language_sub_title = Language::where('key', $tintuc->slug)->first();

            $this->validate(
                $request,
                [
                    'title_en' => 'required|unique:languages,en,' . $language_title->id,
                    'title_vn' => 'required|unique:languages,vn,' . $language_title->id,
                    'content_en' => 'required_with:NoiDung',
                    'content_vn' => 'required_with:NoiDung',
                    'image' => 'nullable|mimes:png,jpg,jpeg',
                    'outstanding' => 'required',
                    'tags' => 'required',
                    'category_id' => 'required'
                ],
                [
                    'title_en.required' => __('Hãy nhập tiêu đề Tiếng Anh'),
                    'title_vn.required' => __('Hãy nhập tiêu đề  Tiếng Việt'),
                    'title_en.unique' => __('Bài viết  bằng Tiếng Anh đã tồn tại'),
                    'title_vn.unique' => __('Bài viết bằng Tiếng Việt đã tồn tại'),
                    'content_en.required' => __('Hãy nhập nội dung tin tức Tiếng Anh'),
                    'content_vn.required' => __('Hãy nhập nội dung tin tức  Tiếng Việt'),
                    'category_id.required' => __('Hãy chọn Thể loại cho tin tức'),
                    'outstanding.required' => __('Hãy chọn tin tức có nổi bật hay không?'),
                    'tags.required' => __('Hãy chọn tags cho tin tức'),
                ]
            );
            $destinationpath = 'images/tintuc/';
            if (!file_exists($destinationpath)) {
                mkdir($destinationpath, 777, true);
            }
            $name = time();
            $tintuc->update([
                'image' =>  $request->hasFile('image') ? $this->update_image($request->file('image'), $name, $destinationpath, $tintuc->image) : $tintuc->image,
                'category_id' => $request->category_id,
                'outstanding' => $request->outstanding,

            ]);

            $tags = Tag::find($request->tags);
            $tintuc->tags()->sync($tags);
            $tintuc->save();
            $this->updateLanguage($tintuc->title, $request->title_en, $request->title_vn, $tintuc);
            $this->updateLanguage($tintuc->slug, Str::slug($request->title_en), Str::slug($request->title_vn), $tintuc);
            $this->updateLanguage($tintuc->content, $request->content_en, $request->content_vn, $tintuc);

            return redirect('/admin/blogs/tintuc')->with('success', 'Update successfully');
        } else {
            return $this->errors()->errors_403();
        }
    }
    public function delete($id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $tintuc = News::with('languages')->findOrFail($id);
            $extension = " ";
            $this->DeleteFolder($tintuc->image, $extension);
            foreach ($tintuc->languages as $language) {
                $this->deleteLanguage($language->key, 'en.json');
                $this->deleteLanguage($language->key, 'vi.json');
            }
            $tintuc->languages()->delete();
            $tintuc->delete();
            return back()->with('success', 'Delete sucussefully');
        } else {
            return $this->errors()->errors_403();
        }
    }

    public function preview(Request $request, $slug)
    {
        $language = Language::where('en', $slug)->orWhere('vn', $slug)->first();
        if ($language) {
            $tintuc = News::with('category', 'tags')->findOrFail($language->languageable->id);
            if ($tintuc) {
                return view('preview.index', compact('tintuc'));
            }
        } else {

            return $this->errors()->errors_404();
        }
    }
}
