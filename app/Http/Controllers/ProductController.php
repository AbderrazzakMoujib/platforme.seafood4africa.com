<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.add-product', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePath = $request->file('image')->store('product_images', 'public');

        Product::create([
            'user_id'      => Auth::id(),
            'title'        => $request->title,
            'description'  => $request->description,
            'image'        => $imagePath,
            'category_id'  => $request->category_id,
            'search_count' => 0,
        ]);

        return redirect()->route('add_products_user')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product    = Product::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.edit-product', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->title       = $request->title;
        $product->description = $request->description;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('product_images', 'public');
        }

        $product->save();

        return redirect()->route('add_products_user')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (Auth::user()->role === 'admin' || $product->user_id == Auth::id()) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $product->delete();
            return redirect()->route('add_products_user')->with('success', 'Product deleted successfully!');
        }

        return redirect()->route('add_products_user')->with('error', 'You do not have permission to delete this product.');
    }
}