<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('assets1/images/favicon.ico')}}">
    <link href="{{asset('assets1/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets1/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets1/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .stat-card { border-radius: 12px; padding: 20px 22px; border: 1px solid rgba(255,255,255,0.07); }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-value { font-size: 28px; font-weight: 700; line-height: 1.1; }
        .stat-label { font-size: 12px; color: #8a9bb0; margin-top: 2px; }
        .product-row { display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .product-row:last-child { border-bottom: none; }
        .product-thumb { width: 40px; height: 40px; border-radius: 8px; object-fit: cover; background: rgba(48,81,211,0.1); flex-shrink: 0; display: flex; align-items: center; justify-content: center; }
        .search-bar-fill { height: 5px; border-radius: 3px; background: linear-gradient(90deg, #019DEA, #3051d3); }
    </style>
</head>
<body data-topbar="colored">
<div id="layout-wrapper">

    {{-- ─── Topbar ─── --}}
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <div class="navbar-brand-box">
                    <a href="{{route('home')}}" class="logo logo-dark">
                        <span class="logo-sm"><img src="{{ asset('assets1/images/logo/favicon.webp') }}" width="30px"></span>
                        <span class="logo-lg"><img src="{{ asset('assets1/images/logo/logo3.webp') }}" width="160px"></span>
                    </a>
                    <a href="{{route('home')}}" class="logo logo-light">
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

    {{-- ─── Sidebar ─── --}}
    <div class="vertical-menu">
        <div data-simplebar class="h-100">
            <div id="sidebar-menu">
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Menu</li>
                    <li class="mm-active"><a href="{{route('dashboard')}}" class="waves-effect active"><span>Dashboard</span></a></li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm me-1"><i class="uim uim-comment-message"></i></div>
                            <span>Products</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('add_products_user')}}">Add Product</a></li>
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

    {{-- ─── Main Content ─── --}}
    <div class="main-content">
        <div class="page-content">

            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">My Dashboard</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Welcome, {{ Auth::user()->raison_social ?? Auth::user()->name }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="container-fluid">

                    {{-- ─── Company Card + Stats ─── --}}
                    <div class="row g-3 mb-4">
                        {{-- Company info --}}
                        <div class="col-xl-4">
                            <div class="card h-100 mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-3 mb-4">
                                        <div style="width:72px;height:72px;border-radius:14px;overflow:hidden;border:2px solid rgba(48,81,211,0.25);background:rgba(48,81,211,0.07);flex-shrink:0;display:flex;align-items:center;justify-content:center;">
                                            @if(Auth::user()->profile_picture)
                                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                                     alt="Logo"
                                                     style="width:100%;height:100%;object-fit:cover;"
                                                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                                <div style="display:none;width:100%;height:100%;align-items:center;justify-content:center;font-size:26px;font-weight:700;color:#3051d3;">
                                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                                </div>
                                            @else
                                                <div style="font-size:26px;font-weight:700;color:#3051d3;">
                                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <h5 class="mb-1" style="color:#fff;">{{ Auth::user()->raison_social ?? Auth::user()->name }}</h5>
                                            <div style="font-size:12px;color:#8a9bb0;">
                                                @if(Auth::user()->country)
                                                    <i class="mdi mdi-earth me-1"></i>{{ Auth::user()->country->name }}
                                                @endif
                                                @if(Auth::user()->category)
                                                    &nbsp;·&nbsp;<i class="mdi mdi-tag-outline me-1"></i>{{ Auth::user()->category->name }}
                                                @endif
                                            </div>
                                            @if(Auth::user()->site_web)
                                            <a href="{{ Auth::user()->site_web }}" target="_blank" style="font-size:12px;color:#019DEA;">
                                                <i class="mdi mdi-web me-1"></i>{{ Auth::user()->site_web }}
                                            </a>
                                            @endif
                                        </div>
                                    </div>

                                    @if(Auth::user()->activites_principales)
                                    <p style="font-size:13px;color:#8a9bb0;line-height:1.6;">{{ Str::limit(Auth::user()->activites_principales, 120) }}</p>
                                    @endif

                                    <div class="d-flex gap-2 mt-3">
                                        <a href="{{ route('information') }}" class="btn btn-primary btn-sm flex-grow-1">
                                            <i class="mdi mdi-pencil me-1"></i>Edit Profile
                                        </a>
                                        <a href="{{ route('show_company', Auth::user()->id) }}" class="btn btn-outline-secondary btn-sm" target="_blank">
                                            <i class="mdi mdi-eye me-1"></i>View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Stats --}}
                        <div class="col-xl-8">
                            <div class="row g-3 h-100">
                                <div class="col-6">
                                    <div class="card stat-card mb-0 h-100">
                                        <div class="card-body d-flex align-items-center gap-3">
                                            <div class="stat-icon" style="background:rgba(1,157,234,0.15);">
                                                <i class="mdi mdi-package-variant" style="font-size:22px;color:#019DEA;"></i>
                                            </div>
                                            <div>
                                                <div class="stat-value">{{ $totalProducts }}</div>
                                                <div class="stat-label">My Products</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card stat-card mb-0 h-100">
                                        <div class="card-body d-flex align-items-center gap-3">
                                            <div class="stat-icon" style="background:rgba(40,167,69,0.15);">
                                                <i class="mdi mdi-magnify" style="font-size:22px;color:#28a745;"></i>
                                            </div>
                                            <div>
                                                <div class="stat-value">{{ number_format($totalSearches) }}</div>
                                                <div class="stat-label">Total Searches</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card mb-0">
                                        <div class="card-body">
                                            <h5 class="header-title mb-3">
                                                <i class="mdi mdi-chart-bar me-1" style="color:#019DEA;"></i>
                                                Search Activity by Product
                                            </h5>
                                            @if($totalProducts > 0)
                                                <div id="user-search-chart" style="min-height:180px;"></div>
                                            @else
                                                <div class="text-center py-4">
                                                    <i class="mdi mdi-package-variant-closed" style="font-size:40px;color:#8a9bb0;"></i>
                                                    <p class="text-muted mt-2">No products yet. <a href="{{ route('add_products_user') }}">Add your first product</a></p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ─── Products Table ─── --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="header-title mb-0">
                                            <i class="mdi mdi-format-list-bulleted me-1" style="color:#3051d3;"></i>
                                            My Products
                                        </h5>
                                        <a href="{{ route('add_products_user') }}" class="btn btn-primary btn-sm">
                                            <i class="mdi mdi-plus me-1"></i>Add Product
                                        </a>
                                    </div>

                                    @if($products->isEmpty())
                                    <div class="text-center py-5">
                                        <i class="mdi mdi-package-variant-closed" style="font-size:48px;color:#8a9bb0;"></i>
                                        <p class="text-muted mt-3">No products yet.</p>
                                        <a href="{{ route('add_products_user') }}" class="btn btn-primary btn-sm">Add your first product</a>
                                    </div>
                                    @else
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0" style="font-size:13px;">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Category</th>
                                                    <th>Searches</th>
                                                    <th>Popularity</th>
                                                    <th>Added</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $maxSearch = $products->max('search_count') ?: 1; @endphp
                                                @foreach($products as $product)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            @if($product->image)
                                                                <img src="{{ asset('storage/' . $product->image) }}"
                                                                     style="width:36px;height:36px;border-radius:8px;object-fit:cover;"
                                                                     onerror="this.style.display='none';">
                                                            @else
                                                                <div style="width:36px;height:36px;border-radius:8px;background:rgba(48,81,211,0.1);display:flex;align-items:center;justify-content:center;">
                                                                    <i class="mdi mdi-package-variant" style="color:#3051d3;"></i>
                                                                </div>
                                                            @endif
                                                            <span style="font-weight:600;color:#e4e4e4;">{{ $product->title }}</span>
                                                        </div>
                                                    </td>
                                                    <td style="color:#8a9bb0;">{{ optional($product->category)->name ?? '—' }}</td>
                                                    <td>
                                                        <span style="font-weight:700;color:#019DEA;">{{ number_format($product->search_count) }}</span>
                                                        <span style="font-size:11px;color:#8a9bb0;"> searches</span>
                                                    </td>
                                                    <td style="min-width:100px;">
                                                        <div style="background:rgba(255,255,255,0.05);border-radius:3px;height:5px;">
                                                            <div class="search-bar-fill" style="width:{{ $maxSearch > 0 ? round(($product->search_count / $maxSearch) * 100) : 0 }}%;"></div>
                                                        </div>
                                                    </td>
                                                    <td style="color:#8a9bb0;">{{ $product->created_at->format('d M Y') }}</td>
                                                    <td>
                                                        <div class="d-flex gap-1">
                                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-secondary btn-sm">
                                                                <i class="mdi mdi-pencil"></i>
                                                            </a>
                                                            <form method="POST" action="{{ route('products.destroy', $product->id) }}" onsubmit="return confirm('Delete this product?')">
                                                                @csrf @method('DELETE')
                                                                <button type="submit" class="btn btn-outline-danger btn-sm">
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
<script src="{{asset('assets1/libs/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets1/js/app.js')}}"></script>

@if($totalProducts > 0)
<script>
var chartLabels = {!! $chartLabels !!};
var chartData   = {!! $chartData !!};

new ApexCharts(document.querySelector("#user-search-chart"), {
    series: [{ name: 'Searches', data: chartData }],
    chart: { type: 'bar', height: 180, toolbar: { show: false }, background: 'transparent' },
    theme: { mode: 'dark' },
    plotOptions: { bar: { borderRadius: 5, columnWidth: '60%' } },
    colors: ['#3051d3'],
    xaxis: { categories: chartLabels, labels: { style: { fontSize: '11px' } } },
    yaxis: { labels: { formatter: v => Math.round(v) } },
    grid: { borderColor: 'rgba(255,255,255,0.05)' },
    tooltip: { theme: 'dark' },
    dataLabels: { enabled: false },
}).render();
</script>
@endif
</body>
</html>