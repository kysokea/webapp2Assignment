<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('category_id', 'asc')->paginate(5);

        return view('category.index', compact('categories'));
    }
    public function create()
    {
        return view('category.create');
    }
    public function createCategory(Request $request)
    {
        $validated = $request->validate([
            'category_title_kh' => 'required|string|max:255',
            'category_title_en' => 'required|string|max:255',
            'disable' => 'boolean',
        ]);

        Category::create($validated);

        return redirect()->route('category.index')
            ->with('success', 'Category created successfully.');
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'category_title_kh' => 'required|string|max:255',
            'category_title_en' => 'required|string|max:255',
            'disable' => 'boolean',
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'category_title_kh' => $request->category_title_kh,
            'category_title_en' => $request->category_title_en,
            'disable' => $request->disable ?? 0,
        ]);

        return redirect()->route('category.index')
            ->with('success', 'Category updated successfully');
    }
}
