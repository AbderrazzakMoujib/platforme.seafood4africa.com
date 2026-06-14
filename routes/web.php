<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;


// ─── Public Routes ────────────────────────────────────────────────────────────

Route::get('/', [PlatformController::class, 'home'])->name('home');

Route::get('/term', [PlatformController::class, 'term'])->name('term');
Route::get('/privacy-policy', fn () => view('Principal.privacy-policy'))->name('privacy.policy');
Route::get('/about', [PlatformController::class, 'about'])->name('about');
Route::get('/contact', [PlatformController::class, 'contact'])->name('contact');
Route::get('/product', [PlatformController::class, 'product'])->name('product');
Route::get('/b2b', [PlatformController::class, 'b2b'])->name('b2b');
Route::get('/show_company/{id}', [PlatformController::class, 'show_company'])->name('show_company');
Route::get('/search', [PlatformController::class, 'search'])->name('search');

Route::post('/contact', [PlatformController::class, 'store'])->name('contact.store');

Route::get('/register/pending', fn () => view('auth.pending'))->name('register.pending');

Route::get('/user-media/{id}', [PlatformController::class, 'userMedia'])->name('user.media');
Route::get('/partage/{id}', [PlatformController::class, 'partage'])->name('user.partage');


// ─── Authenticated Routes ─────────────────────────────────────────────────────

Route::middleware(['auth'])->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::get('/add-product', [ProductController::class, 'create'])->name('product.create');
    Route::post('/store-product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    // Media uploads
    Route::get('/upload/pdf', [MediaController::class, 'createPdf'])->name('pdfs.create');
    Route::post('/upload/pdf', [MediaController::class, 'storePdf'])->name('pdfs.store');
    Route::get('/upload/image', [MediaController::class, 'createImage'])->name('images.create');
    Route::post('/upload/image', [MediaController::class, 'storeImage'])->name('images.store');
    Route::get('/upload/audio', [MediaController::class, 'createAudio'])->name('audios.create');
    Route::post('/upload/audio', [MediaController::class, 'storeAudio'])->name('audios.store');
    Route::get('/upload/video', [MediaController::class, 'createVideo'])->name('videos.create');
    Route::post('/upload/video', [MediaController::class, 'storeVideo'])->name('videos.store');

    // Resources (requires login)
    Route::get('/resources', [PlatformController::class, 'resources'])->name('resources');

    // User information
    Route::get('/information', [PlatformController::class, 'information'])->name('information');
    Route::patch('/information', [PlatformController::class, 'updateInformation'])->name('update.information');

    // User product pages
    Route::get('/create_products', [PlatformController::class, 'create_products'])->name('create_products');
    Route::get('/products-user', [PlatformController::class, 'add_products_user'])->name('add_products_user');
});


// ─── Admin Routes ─────────────────────────────────────────────────────────────

Route::middleware(['auth', 'admin'])->group(function () {

    // Admin dashboard
    Route::get('/dashboard/admin', [DashboardController::class, 'adminIndex'])->name('dashboard.admin');
    Route::post('/dashboard/add-admin', [DashboardController::class, 'addAdmin'])->name('dashboard.add-admin');

    // Contacts
    Route::get('/admin/contacts', [PlatformController::class, 'index'])->name('admins.contacts_tables');

    // Users management
    Route::get('/tables_users', [PlatformController::class, 'tables_users'])->name('tables_users');
    Route::delete('/dashboard/delete-user/{id}', [PlatformController::class, 'deleteUser'])->name('dashboard.delete-user');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::post('/admin/users/{user}/send-email', [AdminController::class, 'sendEmail'])->name('admin.users.send-email');

    // Categories
    Route::get('/Secteur', [PlatformController::class, 'add_secteur'])->name('add_secteur');
    Route::post('/dashboard/add-category', [CategoryController::class, 'addCategory'])->name('dashboard.add-category');
    Route::delete('/dashboard/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('dashboard.delete-category');

    // Countries
    Route::get('/country', [PlatformController::class, 'add_country'])->name('add_country');
    Route::post('/dashboard/store-country', [CategoryController::class, 'storeCountry'])->name('dashboard.store-country');
    Route::delete('/dashboard/delete-country/{id}', [CategoryController::class, 'deleteCountry'])->name('dashboard.delete-country');

    // Products management (admin)
    Route::get('/products', [PlatformController::class, 'add_products'])->name('add_products');
    Route::get('/product_tables', [PlatformController::class, 'products_tables'])->name('products_tables');

    // Add admin page
    Route::get('/admins', [PlatformController::class, 'add_admin'])->name('add_admin');

    // Pending registrations
    Route::get('/admin/pending-users', [AdminController::class, 'pendingUsers'])->name('admin.pending.users');
    Route::post('/admin/users/{user}/approve', [AdminController::class, 'approveUser'])->name('admin.users.approve');
    Route::delete('/admin/users/{user}/reject', [AdminController::class, 'rejectUser'])->name('admin.users.reject');
});


// ─── Authentication Routes ────────────────────────────────────────────────────

require __DIR__.'/auth.php';
