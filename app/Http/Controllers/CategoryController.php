<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::when($request->search, function($query) use($request){
            $query->where('title', 'like', '%'.$request->search.'%');
        })->paginate(20)->appends(['search' => $request->search]);

        return view('admin.categories.indexCategories', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Добавить спикера';

        return view('admin.categories.formCategories', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required'
        ]);

        $imageThumbnail = null;

        if ($request->thumbnail) {
            $imageThumbnail = time().'.'.$request->file('thumbnail')->extension();
            $request->thumbnail->storeAs('public/categories/', $imageThumbnail);
        }

        Category::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'thumbnail' => $imageThumbnail
        ]);

        return redirect()->route('categories.index')->with('success', 'Спикер добавлен!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
