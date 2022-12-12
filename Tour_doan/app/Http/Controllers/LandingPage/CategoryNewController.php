<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\InertiaController;
use App\Http\Requests\CateogoryNew\PostRequest;
use App\Http\Requests\CateogoryNew\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CategoryNew;
use App\Repositories\CategoryNewRepository;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;


class CategoryNewController extends InertiaController
{
    protected $category;
    public function __construct(CategoryNewRepository $categoryNewRepository)
    {
        $this->category = $categoryNewRepository;
    }

    public function index()
    {
        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $categories = $this->category->get();
            return Inertia::render('Blog/TheLoai', compact('categories'));
        } else {
            return $this->errors()->errors_403();
        }
    }

    public function store(PostRequest $request)
    {

        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $category = CategoryNew::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name)
            ]);
            return back()->with('success', 'Create successfully');
        } else {
            return $this->errors()->errors_403();
        }
    }

    public function update(UpdateRequest $request, $id)
    {

        if (Gate::allows(config('constants.USER_PERMISSION'))) {
            $category = CategoryNew::findOrFail($id);
            $category->update([
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
            $category = CategoryNew::findOrFail($id);

            $category->delete();
            return back()->with('success', 'Delete successfully');
        } else {
            return $this->errors()->errors_403();
        }
    }
}
