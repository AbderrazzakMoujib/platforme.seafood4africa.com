<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Country;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return view('dashboard', compact('categories'));
    }

    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        $imagePath = null;
        $iconPath = null;
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category_images', 'public');
        }
    
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('category_icons', 'public');
        }
    
        Category::create([
            'name' => $request->name,
            'image' => $imagePath, 
            'icon' => $iconPath,
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Category added successfully!');
    }
    
    public function deleteCategory($id)
    {
        $category = Category::find($id);

        if ($category) {
            
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            if ($category->icon) {
                Storage::disk('public')->delete($category->icon);
            }

            $category->delete();
            return redirect()->route('dashboard')->with('success', 'Category deleted successfully!');
        }

        return redirect()->route('dashboard')->with('error', 'Category not found.');
    }

    public function add_country()
    {
        $countries = Country::all();
        return view('admins.add_country' , compact('countries'));
    }

    public function storeCountry(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Country::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('dashboard')->with('success', 'Country added successfully.');
    }
}
