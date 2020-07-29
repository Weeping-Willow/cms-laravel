<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Http\Requests\Articles\CreateArticleRequest;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Http\Requests\tags\CreateTagsRequest;
use App\Http\Requests\tags\UpdateTagsRequest;
use App\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagsController extends Controller
{
    public function index(): View
    {
        return view('tags.index')->with('tags',Tag::all());
    }

    public function create(): View
    {
        return view('tags.create');
    }

    public function store(CreateTagsRequest $request): RedirectResponse
    {
        $tags = new Tag();

        $tags->name = $request->name;

        $tags->save();

        session()->flash('success', 'Tag created successfully');

        return redirect(route('tags.index'));
    }

    public function show($id): View
    {
        //
    }

    public function edit(Tag $tag): View
    {
        return view('tags.create')->with('tag',$tag);
    }

    public function update(UpdateTagsRequest $request, Tag $tag): RedirectResponse
    {
        $tag->name = $request->name;

        $tag->save();

        session()->flash('success','Tag updated successfully');

        return redirect(route('tags.index'));
    }

    public function destroy(Tag $tag): RedirectResponse
    {
        if ($tag->articles->count() > 0) {
            session()->flash('error','Tag cannot be deleted because it has some Articles');

            return redirect()->back();
        }

        $tag->delete();

        session()->flash('success','Tag deleted successfully');

        return redirect(route('tags.index'));
    }
}
