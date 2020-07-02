<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Categories\CreateCategoryRequest;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function index(): View
    {
        return view('categories.index')->with('categories',Category::all());
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(CreateCategoryRequest $request): RedirectResponse
    {
        $category = new Category();

        $category->name = $request->name;

        $category->save();

        session()->flash('success', 'Category created successfully');

        return redirect(route('categories.index'));
    }

    public function show($id): View
    {
        //
    }

    public function edit(Category $category): View
    {
        return view('categories.create')->with('category',$category);
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->name = $request->name;

        $category->save();

        session()->flash('success','Category updated successfully');

        return redirect(route('categories.index'));
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        session()->flash('success','Category deleted successfully');

        return redirect(route('categories.index'));
    }
}
