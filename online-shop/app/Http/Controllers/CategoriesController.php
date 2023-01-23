<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    //
    function index()
    {
        $categories = Category::paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    function create()
    {
        return view('admin.categories.create');
    }

    function store(Request $request)
    {
        $request->validate(Category::$rules);

        $imageUrl = $request->file('image')->store('categories', ['disk' => 'public']);
        $category = new Category;

        $category->fill($request->post());
        $category['image'] = $imageUrl;

        $category->save();
        return redirect()->route('admin.categories');
    }

    function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    function update($id, Request $request)
    {
        $category = Category::findOrFail($id);

        $request->validate(Category::$rules);

        $category->fill($request->post());

        $imageUrl = $request->file('image')->store('categories', ['disk' => 'public']);

        $category['image'] = $imageUrl;

        $category->save();
        return redirect()->route('admin.categories');
    }

    function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.show', compact('category'));
    }

    function destroy($id)
    {
        $category = Category::findOrFail($id);
        Category::destroy($id);
        return redirect()->route('admin.categories')->with('success', 'Record has been deleted successfully!');
    }
}