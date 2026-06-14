<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>My Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('assets1/images/favicon.ico')}}">
    <link href="{{asset('assets1/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets1/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets1/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .product-thumb { width:48px;height:48px;border-radius:10px;object-fit:cover;background:rgba(48,81,211,0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0; }
        .search-bar-fill { height:5px;border-radius:3px;background:linear-gradient(90deg,#019DEA,#3051d3); }
        .stat-icon { width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0; }
        .form-section { background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.07);border-radius:12px;padding:24px; }
    </style>
</head>
<body data-topbar="colored">
<div id="layout-wrapper">

    {{-- Topbar --}}
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <div class="navbar-brand-box">
                    <a href="{{route('dashboard')}}" class="logo logo-dark">
                        <span class="logo-sm"><img src="{{ asset('assets1/images/logo/favicon.webp') }}" width="30px"></span>
                        <span class="logo-lg"><img src="{{ asset('assets1/images/logo/logo3.webp') }}" width="160px"></span>
                    </a>
                    <a href="{{route('dashboard')}}" class="logo logo-light">
                        <span class="logo-sm"><img src="{{ asset('assets1/images/logo/favicon.webp') }}" width="30px" alt=""></span>
                        <span class="logo-lg"><img src="{{ asset('assets1/images/logo/logo2.webp') }}" alt="" width="160px"></span>
                    </a>
                </div>
                <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                    <i class="mdi mdi-backburger"></i>
                </button>
            </div>
            <div class="d-flex">
                <div class="dropdown d-none d-sm-inline-block">
                    <button type="button" class="btn header-item" id="light-dark-mode">
                        <i class="mdi mdi-moon-waning-crescent align-middle fs-4"></i>
                    </button>
                </div>
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown">
                        @if(Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
                                 alt="Profile" width="40px" class="rounded-circle" style="height:40px;object-fit:cover;" />
                            <div style="display:none;width:40px;height:40px;border-radius:50%;background:rgba(48,81,211,0.2);align-items:center;justify-content:center;color:#3051d3;font-weight:700;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @else
                            <div style="display:flex;width:40px;height:40px;border-radius:50%;background:rgba(48,81,211,0.2);align-items:center;justify-content:center;color:#3051d3;font-weight:700;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <span class="d-none d-sm-inline-block ms-1">{{ Auth::user()->name }}</span>
                        <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="mdi mdi-logout font-size-16 align-middle me-1"></i> {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Sidebar --}}
    <div class="vertical-menu">
        <div data-simplebar class="h-100">
            <div id="sidebar-menu">
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Menu</li>
                    <li><a href="{{route('dashboard')}}" class="waves-effect"><span>Dashboard</span></a></li>
                    <li class="mm-active">
                        <a href="javascript: void(0);" class="has-arrow waves-effect mm-active">
                            <div class="d-inline-block icons-sm me-1"><i class="uim uim-comment-message"></i></div>
                            <span>Products</span>
                        </a>
                        <ul class="sub-menu mm-show" aria-expanded="true">
                            <li class="mm-active"><a href="{{route('add_products_user')}}" class="active">My Products</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm me-1"><i class="uim uim-comment-message"></i></div>
                            <span>Add Resources</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('videos.create') }}">Add Video</a></li>
                            <li><a href="{{ route('pdfs.create') }}">Add PDF</a></li>
                            <li><a href="{{ route('images.create') }}">Add Image</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('information') }}" class="waves-effect"><span>My Profile</span></a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="main-content">
        <div class="page-content">

            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">My Products</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="container-fluid">

                    {{-- Alerts --}}
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    {{-- Stats --}}
                    @php
                        $totalProducts = $products->count();
                        $totalSearches = $products->sum('search_count');
                        $topProduct    = $products->sortByDesc('search_count')->first();
                    @endphp
                    <div class="row g-3 mb-4">
                        <div class="col-4">
                            <div class="card mb-0">
                                <div class="card-body d-flex align-items-center gap-3 py-3">
                                    <div class="stat-icon" style="background:rgba(1,157,234,0.15);">
                                        <i class="mdi mdi-package-variant" style="font-size:20px;color:#019DEA;"></i>
                                    </div>
                                    <div>
                                        <div style="font-size:22px;font-weight:700;">{{ $totalProducts }}</div>
                                        <div style="font-size:12px;color:#8a9bb0;">Total Products</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card mb-0">
                                <div class="card-body d-flex align-items-center gap-3 py-3">
                                    <div class="stat-icon" style="background:rgba(40,167,69,0.15);">
                                        <i class="mdi mdi-magnify" style="font-size:20px;color:#28a745;"></i>
                                    </div>
                                    <div>
                                        <div style="font-size:22px;font-weight:700;">{{ number_format($totalSearches) }}</div>
                                        <div style="font-size:12px;color:#8a9bb0;">Total Searches</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card mb-0">
                                <div class="card-body d-flex align-items-center gap-3 py-3">
                                    <div class="stat-icon" style="background:rgba(255,193,7,0.15);">
                                        <i class="mdi mdi-fire" style="font-size:20px;color:#ffc107;"></i>
                                    </div>
                                    <div style="min-width:0;">
                                        <div style="font-size:14px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                            {{ $topProduct ? Str::limit($topProduct->title, 20) : '—' }}
                                        </div>
                                        <div style="font-size:12px;color:#8a9bb0;">Most Searched</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        {{-- Add Product Form --}}
                        <div class="col-xl-4">
                            <div class="card h-100 mb-0">
                                <div class="card-body">
                                    <h5 class="header-title mb-4">
                                        <i class="mdi mdi-plus-circle me-1" style="color:#019DEA;"></i>
                                        Add New Product
                                    </h5>
                                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" style="font-size:13px;">Product Title <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="title" placeholder="Enter product title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" style="font-size:13px;">Description <span class="text-danger">*</span></label>
                                            <textarea name="description" class="form-control" rows="4" placeholder="Describe your product..." required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" style="font-size:13px;">Product Image <span class="text-danger">*</span></label>
                                            <input type="file" name="image" accept="image/*" class="form-control" required
                                                   onchange="previewImage(this)">
                                            <div id="image-preview" class="mt-2" style="display:none;">
                                                <img id="preview-img" src="" alt="Preview"
                                                     style="width:100%;max-height:150px;object-fit:cover;border-radius:8px;border:1px solid rgba(255,255,255,0.1);">
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" style="font-size:13px;">Category <span class="text-danger">*</span></label>
                                            <select name="category_id" class="form-control" required>
                                                <option value="">— Select Category —</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button class="btn btn-primary w-100" type="submit">
                                            <i class="mdi mdi-plus me-1"></i>Add Product
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Products Table --}}
                        <div class="col-xl-8">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <h5 class="header-title mb-4">
                                        <i class="mdi mdi-format-list-bulleted me-1" style="color:#3051d3;"></i>
                                        My Products
                                        <span class="badge ms-2" style="background:rgba(1,157,234,0.15);color:#019DEA;">{{ $totalProducts }}</span>
                                    </h5>

                                    @if($products->isEmpty())
                                    <div class="text-center py-5">
                                        <i class="mdi mdi-package-variant-closed" style="font-size:48px;color:#8a9bb0;"></i>
                                        <p class="text-muted mt-3">No products yet. Add your first product!</p>
                                    </div>
                                    @else
                                    @php $maxSearch = $products->max('search_count') ?: 1; @endphp
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0" style="font-size:13px;">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Category</th>
                                                    <th>Searches</th>
                                                    <th>Popularity</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($products as $product)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            @if($product->image)
                                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                                     style="width:40px;height:40px;border-radius:8px;object-fit:cover;"
                                                                     onerror="this.style.display='none';">
                                                            @else
                                                                <div style="width:40px;height:40px;border-radius:8px;background:rgba(48,81,211,0.1);display:flex;align-items:center;justify-content:center;">
                                                                    <i class="mdi mdi-package-variant" style="color:#3051d3;"></i>
                                                                </div>
                                                            @endif
                                                            <div>
                                                                <div style="font-weight:600;color:#e4e4e4;">{{ $product->title }}</div>
                                                                <div style="font-size:11px;color:#8a9bb0;">{{ Str::limit($product->description, 40) }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="color:#8a9bb0;">{{ optional($product->category)->name ?? '—' }}</td>
                                                    <td>
                                                        <span style="font-weight:700;color:#019DEA;">{{ number_format($product->search_count) }}</span>
                                                    </td>
                                                    <td style="min-width:80px;">
                                                        <div style="background:rgba(255,255,255,0.05);border-radius:3px;height:5px;">
                                                            <div class="search-bar-fill" style="width:{{ round(($product->search_count / $maxSearch) * 100) }}%;"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-secondary btn-sm" title="Edit">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <form method="POST" action="{{ route('products.destroy', $product->id) }}"
                                                                  onsubmit="return confirm('Delete {{ addslashes($product->title) }}?')">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
                                                                    <i class="mdi mdi-trash-can"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">2024 © SeaFood4Africa.</div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">Crafted with <i class="mdi mdi-heart text-danger"></i> by Smart Expos</div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>

<div class="rightbar-overlay"></div>
<script src="{{asset('assets1/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets1/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets1/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets1/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets1/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('assets1/js/app.js')}}"></script>
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>