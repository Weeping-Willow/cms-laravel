<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests\Articles\CreateArticleRequest;
use App\Http\Requests\Articles\UpdateArticleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        return view('article.index')->with('articles', Article::all());
    }

    public function create(): View
    {
        return view('article.create');
    }

    public function store(CreateArticleRequest $request): RedirectResponse
    {
        $article = new Article();

        $article->name = $request->name;

        $article->save();

        session()->flash('success', 'Article created successfully');

        return redirect(route('article.index'));
    }

    public function show($id): View
    {
        //
    }

    public function edit(Article $article): View
    {
        return view('article.create')->with('article', $article);
    }

    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $article->name = $request->name;

        $article->save();

        session()->flash('success', 'Article updated successfully');

        return redirect(route('article.index'));
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        session()->flash('success', 'Article deleted successfully');

        return redirect(route('article.index'));
    }
}
