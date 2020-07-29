<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Http\Requests\Articles\CreateArticleRequest;
use App\Http\Requests\Articles\UpdateArticleRequest;
use App\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCategoryCount')->only(['create','store']);
    }

    public function index(): View
    {
        return view('article.index')->with('articles', Article::all())->with('categories',Category::all())->with('tags',Tag::all());
    }

    public function create(): View
    {
        return view('article.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    public function store(CreateArticleRequest $request): RedirectResponse
    {
        $image = $request->image->store('articles');

        $article = Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at,
            'category_id' => $request->category
        ]);

        if ($request->tags){
            $article->tags()->attach($request->tags);
        }

        session()->flash('success', 'Article created successfully');

        return redirect(route('article.index'));
    }

    public function show(Article $article): View
    {
        //
    }

    public function edit(Article $article): View
    {
        return view('article.create')->with('article', $article)->with('categories',Category::all())->with('tags',Tag::all());
    }

    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $data = $request->only(['title','description','published_at','content','category']);

        if ($request->hasFile('image')){
            $image = $request->image->store('articles');
            $article->deleteImage();

            $data['image'] = $image;
        }
        $data['category_id'] = $data['category'];

        if ($request->tags){
            $article->tags()->sync($request->tags);
        }

        $article->update($data);

        session()->flash('success', 'Article updated successfully');

        return redirect(route('article.index'));
    }

    public function destroy($id): RedirectResponse
    {
        $article = Article::withTrashed()->where('id',$id)->firstOrFail();

        if ($article->trashed()){
            $article->deleteImage();
            $article->forceDelete();
            session()->flash('success', 'Article deleted successfully');
        }
        else{
            $article->delete();
            session()->flash('success', 'Article trashed successfully');
        }

        return redirect(route('article.index'));
    }

    public function trashed(): View
    {
        $trashed = Article::onlyTrashed()->get();

        return view('article.index')->withArticles($trashed);
    }

    public function restore($id): RedirectResponse{
        $article = Article::withTrashed()->where('id',$id)->firstOrFail();

        $article->restore();

        session()->flash('success', 'Article restored successfully');

        return redirect()->back();
    }
}
