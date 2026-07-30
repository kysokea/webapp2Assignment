<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('product_id', 'asc')
            ->paginate(5);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function createProduct(Request $request)
    {
        $data = $request->validate([
            'product_name_kh' => 'required|string|max:255',
            'product_name_en' => 'required|string|max:255',
            'price'           => 'required|numeric|min:0',
            'category_id'     => 'required|exists:categories,category_id',
            'avatar'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'disable'          => 'boolean',
        ]);

        if ($request->hasFile('avatar')) {

            $image = $request->file('avatar');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('img', $imageName, 'public');

            $data['avatar'] = $imageName;
        }

        Product::create($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product has been created successfully.');
    }

    public function edit($id)
    {
        $product = Product::with('category')->findOrFail($id);

        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'product_name_kh' => 'required|string|max:255',
            'product_name_en' => 'required|string|max:255',
            'price'           => 'required|numeric|min:0',
            'category_id'     => 'required|exists:categories,category_id',
            'avatar'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'disable'          => 'boolean',
        ]);

        if ($request->hasFile('avatar')) {

            // delete old image
            if ($product->avatar && Storage::disk('public')->exists('img/' . $product->avatar)) {
                Storage::disk('public')->delete('img/' . $product->avatar);
            }

            // upload new image
            $image = $request->file('avatar');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('img', $imageName, 'public');

            $data['avatar'] = $imageName;
        }

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product has been updated successfully.');
    }
}
