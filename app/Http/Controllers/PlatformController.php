<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\User;
use App\Models\Country;
use App\Models\Contact;


class PlatformController extends Controller
{
    protected function redirectTo($request)
{
    if (!$request->expectsJson()) {
        return route('login', ['error' => 'Please log in or create an account to access resources.']);
    }
}

    public function home(Request $request) {
        $countries = Country::all();
        $categories = Category::all();

        if ($request->filled('category_id')) {
            $users = User::whereHas('categories', function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })->with(['products', 'images'])->get();
        } else {
            $users = User::with(['products', 'images'])->get();
        }

        // Sort users by popularity score: sum of products' search_count + number of products
        // Companies with highly-searched products and more products rank higher
        $users = $users->sortByDesc(function ($user) {
            $searchScore = $user->products->sum('search_count');
            $productCount = $user->products->count();
            return $searchScore + $productCount;
        })->values();

        // Sort by search_count DESC — most searched products appear first
        $products = Product::with('user', 'category')
            ->orderBy('search_count', 'desc')
            ->get();

        return view('Principal.home', compact('categories', 'products', 'countries', 'users'));
    }
    
    public function platforme(){
        return view('Principal.home1');
    }
    
    
    public function term(){
        return view('Principal.term');
    }
    
    public function tables_users(){

        $users = User::all();
        return view('admins.tables_users' , compact( 'users'));
    }

    public function add_secteur(){
        $categories = Category::all();
        return view('admins.add_secteur' ,compact( 'categories'));
    }
    public function add_country()
    {
        $countries = Country::all();
        return view('admins.add_country' , compact('countries'));
    }

    public function add_products(){

        $users = User::all();
        $categories = Category::all();

        $user = auth()->user();
     
            $products = Product::where('user_id', $user->id)->get();
            $categories = Category::all();
          
            $users = User::all();
            return view('admins.add_products', data: compact('products', 'categories','user'));
    }


    public function product(Request $request)
    {
        $categories = Category::all();
    
        // Apply the category filter if a category_id is selected
        $products = Product::with('user', 'category');
    
        if ($request->filled('category_id')) {
            $products->where('category_id', $request->category_id);
        }
    
        $products = $products->get();
    
        return view('Principal.product', compact('products', 'categories'));
    }
    
    public function about(){
        return view('Principal.about');
    }
    public function contact(){
        return view('Principal.contact');
    }

 

public function destroy($id)
{
    $product = Product::findOrFail($id);

    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }

    $product->delete();

    return redirect()->route('add_products')->with('success', 'Product deleted successfully!');
}

    public function add_products_user(){

        $users = User::all();
        $categories = Category::all();

        $user = auth()->user();
    
            $products = Product::where('user_id', $user->id)->get();
            $categories = Category::all();
          
            $users = User::all();
            return view('admins.add_products_user', data: compact('products', 'categories','user'));
    }

    public function add_admin(){
        return view('admins.add_admin');
    }

    public function products_tables(){

        $users = User::all();
        $categories = Category::all();

        $user = auth()->user();
    
            $products = Product::all();
            $categories = Category::all();
          
            $users = User::all();
            return view('admins.products_tables', data: compact('products', 'categories','user'));

    }
    
    public function deleteUser($id)
    {
        $user = User::find($id);
    
        if ($user && $user->id !== auth()->id()) {
            $user->delete();
            return redirect()->route('dashboard')->with('success', 'User deleted successfully!');
        }
    
        return redirect()->route('dashboard')->with('error', 'Cannot delete this user.');
    }
    
    public function b2b(Request $request)
    {
        $countries = Country::all();
        $categories = Category::all();
    
        $users = User::query();
    
        if ($request->filled('category_id')) {
            $users->where('category_id', $request->category_id);
        }
    
        if ($request->filled('country_id')) {
            $users->where('country_id', $request->country_id);
        }
    
        $users = $users->simplePaginate(16); // Use simplePaginate for simpler pagination links
    
        return view('Principal.b2b', compact('users', 'categories', 'countries'));
    }
    
    public function show_company($id)
    {
        $user = User::find($id); 
        $products = Product::where('user_id', $id)->latest()->get(); 
        $categories = Category::all(); 
    
        if (!$user) {
            return redirect()->route('home')->with('error', 'User not found');
        }
    
        return view('Principal.show_company', compact('user', 'products', 'categories'));
    }
    
    public function search(Request $request)
    {
        $query = $request->input('SearchItem');

        if ($query) {
            $users = User::where('name', 'like', '%' . $query . '%')
                ->with('products')
                ->get();

            $products = Product::where('title', 'like', '%' . $query . '%')
                ->with('user')
                ->get();

            // Increment search_count for every matched product
            if ($products->isNotEmpty()) {
                Product::whereIn('id', $products->pluck('id'))
                    ->increment('search_count');
            }
        } else {
            $users    = collect();
            $products = collect();
        }

        return view('Principal.search_results', compact('users', 'products', 'query'));
    }

    public function resources(Request $request)
    {
        $countries = Country::all();
        $categories = Category::all();
    
        // Start with all users
        $users = User::query();
    
        // Apply category filter if selected
        if ($request->filled('category_id')) {
            $categoryId = $request->input('category_id');
            $users->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            });
        }
    
        // Apply country filter if selected
        if ($request->filled('country_id')) {
            $users->where('country_id', $request->input('country_id'));
        }
    
        $users = $users->with(['images', 'videos', 'pdfs'])->get();
    
        return view('Principal.resources', compact('users', 'categories', 'countries'));
    }
    
    public function partage($id)
{
    // Fetch the user's media (images, videos, PDFs) based on user ID
    $user = User::with(['images', 'videos', 'pdfs'])->findOrFail($id);

    return view('Principal.partage', compact('user'));
}

public function userMedia($id)
{
    // Fetch users in the selected country along with their media
    $users = User::where('country_id', $id)
                 ->with(['images', 'videos', 'pdfs'])
                 ->get();
    
    $country = Country::findOrFail($id);

    return view('Principal.user_media', compact('users', 'country'));
}

    


    public function information()
    {
        $user = auth()->user(); // Get the authenticated user
        $categories = Category::all(); // Fetch all categories if needed for the form
    
        return view('admins.information', compact('user', 'categories'));
    }

    public function updateInformation(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'raison_social' => 'nullable|string|max:255',
            'forme_juridique' => 'nullable|string|max:255',
            'activites_principales' => 'nullable|string',
            'adresse' => 'nullable|string|max:255',
            'fax' => 'nullable|string|max:15',
            'site_web' => 'nullable|url',
            'nom_responsable' => 'nullable|string|max:255',
            'titre_responsable' => 'nullable|string|max:255',
            'date_creation' => 'nullable|date',
            'chiffre_affaire' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'background_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
    
        $user = auth()->user();
    
        // Update all fields
        $user->fill($request->except(['profile_picture', 'background_image']));
    
        // Handle profile picture
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $path;
        }
    
        // Handle background image
        if ($request->hasFile('background_image')) {
            $path = $request->file('background_image')->store('background_images', 'public');
            $user->background_image = $path;
        }
    
        $user->save();
    
        return redirect()->route('information')->with('success', 'Information updated successfully.');
    }
    
        public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|min:10|max:5000',
        ]);

        // Store the data in the database
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Redirect or return success response
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function index()
    {
        // Display the stored messages
        $contacts = Contact::all();
        return view('admins.contacts_tables', compact('contacts'));
    }
    

    
      
}
