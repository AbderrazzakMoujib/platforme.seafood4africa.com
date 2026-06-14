<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'admin') {
            return redirect()->route('dashboard.admin');
        }

        $categories = Category::all();
        $countries  = Country::all();

        $products      = Product::where('user_id', $user->id)->latest()->get();
        $totalProducts = $products->count();
        $totalSearches = $products->sum('search_count');

        $chartProducts = $products->sortByDesc('search_count')->take(7);
        $chartLabels   = $chartProducts->pluck('title')->toJson();
        $chartData     = $chartProducts->pluck('search_count')->toJson();

        return view('dashboard.user', compact(
            'products', 'categories', 'countries', 'user',
            'totalProducts', 'totalSearches',
            'chartLabels', 'chartData'
        ));
    }

    public function adminIndex()
    {
        $totalProducts   = Product::count();
        $totalUsers      = User::where('role', 'user')->count();
        $totalSearches   = Product::sum('search_count');
        $totalCategories = Category::count();

        $categories  = Category::all();
        $countries   = Country::all();

        $topProducts = Product::with('user')
                        ->orderBy('search_count', 'desc')
                        ->take(5)
                        ->get();

        $users = User::where('role', 'user')
                    ->with(['products', 'country', 'category'])
                    ->withCount('products')
                    ->orderBy('products_count', 'desc')
                    ->paginate(10);

        $pendingUsers = User::where('status', 'pending')
                            ->where('role', '!=', 'admin')
                            ->with('country')
                            ->latest()
                            ->get();
        $pendingCount = $pendingUsers->count();

        $chartProducts = Product::with('user')
                            ->orderBy('search_count', 'desc')
                            ->take(7)
                            ->get();
        $chartLabels = $chartProducts->pluck('title')->toJson();
        $chartData   = $chartProducts->pluck('search_count')->toJson();

        $categoryStats = Category::withCount('products')->get();
        $catLabels     = $categoryStats->pluck('name')->toJson();
        $catData       = $categoryStats->pluck('products_count')->toJson();

        return view('dashboard.admin', compact(
            'totalProducts', 'totalUsers', 'totalSearches', 'totalCategories',
            'topProducts', 'users', 'pendingUsers', 'pendingCount',
            'chartLabels', 'chartData', 'catLabels', 'catData',
            'categories', 'countries'
        ));
    }

    public function addAdmin(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role'     => 'admin',
            'status'   => 'approved',
        ]);
        return redirect()->route('dashboard.admin')->with('success', 'Admin added successfully!');
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

    public function addCategory(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'icon'  => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        $imagePath = null;
        $iconPath  = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category_images', 'public');
        }
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('category_icons', 'public');
        }
        Category::create([
            'name'  => $request->name,
            'image' => $imagePath,
            'icon'  => $iconPath,
        ]);
        return redirect()->route('dashboard.admin')->with('success', 'Category added successfully!');
    }
}