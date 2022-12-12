<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\InertiaController;
use App\Http\Requests\Tag\PostTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\Tag;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Illuminate\Support\Str;

class TagController extends InertiaController
{
    protected $tag;
    public function __construct(TagRepository $tagRepository)
    {
        $this->tag = $tagRepository;
    }
    public function index()
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $tags = $this->tag->get();
            return Inertia::render('Blog/Tag', compact('tags'));
        } else {
            return $this->errors()->errors_403();
        }
    }

    public function store(PostTagRequest $request)
    {

        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            
            Tag::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);
            return back()->with('success', 'Create successfully');
        } else {
            return $this->errors()->errors_403();
        }
    }

    public function update(Request $request, $id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {

            $tag = Tag::findOrFail($id);
            $this->validate(
                $request,
                [
                    'name' => 'required|min:2|max:100|unique:tags,name,' . $tag->id
                ],
                [
                    'name.required' => 'Bạn chưa nhập tên Tag!',
                    'name.unique' => 'Tên Tag đã tồn tại, vui lòng nhập lại!!',
                    'name.min' => 'Tên Tag gồm ít nhất 3 ký tự!',
                    'name.max' => 'Tên Tag gồm tối đa 100 ký tự!'
                ]
            );
            $tag->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);

            return back()->with('success', 'Create successfully');
        } else {
            return $this->errors()->errors_403();
        }
    }

    public function delete($id)
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $tag = Tag::findOrFail($id);

            $tag->delete();
            return back()->with('success', 'Delete successfully');
        } else {
            return $this->errors()->errors_403();
        }
    }
}
