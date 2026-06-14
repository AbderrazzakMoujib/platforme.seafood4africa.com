<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('assets1/images/favicon.ico')}}">
    <link href="{{asset('assets1/libs/air-datepicker/css/datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets1/libs/jqvmap/jqvmap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets1/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets1/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets1/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .stat-card { border-radius: 12px; padding: 20px 22px; border: 1px solid rgba(255,255,255,0.07); }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .stat-value { font-size: 28px; font-weight: 700; line-height: 1.1; }
        .stat-label { font-size: 12px; color: #8a9bb0; margin-top: 2px; }
        .top-product-row { display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .top-product-row:last-child { border-bottom: none; }
        .product-thumb { width: 40px; height: 40px; border-radius: 8px; object-fit: cover; background: rgba(48,81,211,0.1); flex-shrink: 0; }
        .search-bar-fill { height: 6px; border-radius: 3px; background: linear-gradient(90deg, #019DEA, #3051d3); }
        .user-row-img { width: 36px; height: 36px; border-radius: 8px; object-fit: cover; }
        .avatar-sm { width: 36px; height: 36px; border-radius: 8px; background: rgba(48,81,211,0.15); display: flex; align-items: center; justify-content: center; color: #3051d3; font-weight: 700; font-size: 14px; flex-shrink: 0; }
        /* Pagination */
        .pagination { display:flex;gap:4px;flex-wrap:wrap;align-items:center;margin:0;padding:0;list-style:none; }
        .pagination .page-item .page-link { padding:5px 12px;font-size:13px;border-radius:6px;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.03);color:#8a9bb0;text-decoration:none;display:block; }
        .pagination .page-item.active .page-link { background:#3051d3;border-color:#3051d3;color:#fff; }
        .pagination .page-item.disabled .page-link { opacity:.4;cursor:not-allowed; }
        .pagination .page-item .page-link:hover { background:rgba(48,81,211,0.2);color:#fff; }
    </style>
</head>
<body data-topbar="colored">
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <div class="navbar-brand-box">
                    <a href="{{route('home')}}" class="logo logo-dark">
                        <span class="logo-sm"><img src="{{ asset('assets1/images/logo/favicon.png') }}" width="30px"></span>
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

    <div class="vertical-menu">
        <div data-simplebar class="h-100">
            <div id="sidebar-menu">
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Menu</li>
                    <li class="mm-active"><a href="{{route('dashboard.admin')}}" class="waves-effect active"><span>Dashboard</span></a></li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm me-1"><i class="uim uim-comment-message"></i></div><span>Products</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('add_products')}}">Add Product</a></li>
                            <li><a href="{{route('products_tables')}}">All Products</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm me-1"><i class="uim uim-sign-in-alt"></i></div><span>Category</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('add_secteur')}}">Add Branches D'activites</a></li>
                            <li><a href="{{route('add_country')}}">Add Country</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm me-1"><i class="uim uim-grids"></i></div><span>Admin</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('add_admin')}}">Add Admin</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm me-1"><i class="uim uim-grids"></i></div><span>User</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('tables_users')}}">Tables Users</a></li>
                            <li><a href="{{route('admin.pending.users')}}">Pending Approvals
                                @if($pendingCount > 0)<span class="badge bg-danger ms-1">{{ $pendingCount }}</span>@endif
                            </a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm me-1"><i class="uim uim-comment-message"></i></div><span>Add Resources</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('videos.create') }}">Add Video</a></li>
                            <li><a href="{{ route('pdfs.create') }}">Add PDF</a></li>
                            <li><a href="{{ route('images.create') }}">Add Image</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('admins.contacts_tables')}}" class="waves-effect"><span>Contact</span></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="page-content">

            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Dashboard</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Welcome to SeaFood4Africa Admin Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @if($pendingCount > 0)
            <div class="page-content-wrapper pb-0">
                <div class="container-fluid">
                    <div class="card border-0" style="background:linear-gradient(135deg,#1a2a3a,#0d1e2e);border-left:4px solid #019DEA !important;">
                        <div class="card-body py-3">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div style="width:48px;height:48px;background:rgba(1,157,234,0.15);border-radius:12px;display:flex;align-items:center;justify-content:center;">
                                        <i class="mdi mdi-account-clock" style="font-size:24px;color:#019DEA;"></i>
                                    </div>
                                    <div>
                                        <div style="font-size:13px;color:#8a9bb0;">Pending Registrations</div>
                                        <div style="font-size:22px;font-weight:700;color:#fff;">
                                            {{ $pendingCount }}
                                            <span style="font-size:13px;font-weight:400;color:#019DEA;margin-left:6px;">account{{ $pendingCount > 1 ? 's' : '' }} waiting for approval</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    @foreach($pendingUsers->take(3) as $pu)
                                    <div style="background:rgba(255,255,255,0.05);border:1px solid rgba(1,157,234,0.2);border-radius:8px;padding:8px 14px;font-size:13px;color:#fff;">
                                        <div style="font-weight:600;">{{ $pu->name }}</div>
                                        <div style="color:#019DEA;font-size:12px;">{{ $pu->email }}</div>
                                        <div style="color:#8a9bb0;font-size:11px;">{{ optional($pu->country)->name ?? '—' }} · {{ $pu->created_at->diffForHumans() }}</div>
                                    </div>
                                    @endforeach
                                    @if($pendingCount > 3)
                                    <div style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:8px 14px;font-size:13px;color:#8a9bb0;">
                                        +{{ $pendingCount - 3 }} more
                                    </div>
                                    @endif
                                    <a href="{{ route('admin.pending.users') }}" style="background:#019DEA;color:#fff;border-radius:8px;padding:10px 20px;font-size:13px;font-weight:600;text-decoration:none;">
                                        Review All <i class="mdi mdi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="page-content-wrapper">
                <div class="container-fluid">

                    {{-- Stats --}}
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-xl-3">
                            <div class="card stat-card mb-0">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <div class="stat-icon" style="background:rgba(48,81,211,0.15);">
                                        <i class="mdi mdi-account-group" style="font-size:22px;color:#3051d3;"></i>
                                    </div>
                                    <div>
                                        <div class="stat-value">{{ $totalUsers }}</div>
                                        <div class="stat-label">Total Companies</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <div class="card stat-card mb-0">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <div class="stat-icon" style="background:rgba(1,157,234,0.15);">
                                        <i class="mdi mdi-package-variant" style="font-size:22px;color:#019DEA;"></i>
                                    </div>
                                    <div>
                                        <div class="stat-value">{{ $totalProducts }}</div>
                                        <div class="stat-label">Total Products</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <div class="card stat-card mb-0">
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
                        <div class="col-6 col-xl-3">
                            <div class="card stat-card mb-0">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <div class="stat-icon" style="background:rgba(255,193,7,0.15);">
                                        <i class="mdi mdi-tag-multiple" style="font-size:22px;color:#ffc107;"></i>
                                    </div>
                                    <div>
                                        <div class="stat-value">{{ $totalCategories }}</div>
                                        <div class="stat-label">Categories</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Charts --}}
                    <div class="row g-3 mb-4">
                        <div class="col-xl-8">
                            <div class="card h-100 mb-0">
                                <div class="card-body">
                                    <h5 class="header-title mb-4">
                                        <i class="mdi mdi-chart-bar me-1" style="color:#019DEA;"></i>
                                        Most Searched Products
                                    </h5>
                                    <div id="search-chart" style="min-height:300px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card h-100 mb-0">
                                <div class="card-body">
                                    <h5 class="header-title mb-4">
                                        <i class="mdi mdi-chart-donut me-1" style="color:#3051d3;"></i>
                                        Products by Category
                                    </h5>
                                    <div id="cat-chart" style="min-height:300px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Top Products + Users --}}
                    <div class="row g-3">
                        <div class="col-xl-5">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <h5 class="header-title mb-3">
                                        <i class="mdi mdi-fire me-1" style="color:#ff6b35;"></i>
                                        Top 5 Most Searched
                                    </h5>
                                    @php $maxSearch = $topProducts->max('search_count') ?: 1; @endphp
                                    @forelse($topProducts as $i => $product)
                                    <div class="top-product-row">
                                        <div style="width:24px;height:24px;border-radius:6px;background:{{ $i === 0 ? 'rgba(255,193,7,0.2)' : 'rgba(255,255,255,0.05)' }};display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:{{ $i === 0 ? '#ffc107' : '#8a9bb0' }};flex-shrink:0;">
                                            {{ $i + 1 }}
                                        </div>
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" class="product-thumb" onerror="this.style.display='none'">
                                        @else
                                            <div class="product-thumb d-flex align-items-center justify-content-center">
                                                <i class="mdi mdi-package-variant" style="color:#3051d3;"></i>
                                            </div>
                                        @endif
                                        <div class="flex-grow-1" style="min-width:0;">
                                            <div style="font-size:13px;font-weight:600;color:#e4e4e4;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $product->title }}</div>
                                            <div style="font-size:11px;color:#8a9bb0;">{{ optional($product->user)->raison_social ?? optional($product->user)->name ?? '—' }}</div>
                                            <div class="mt-1" style="background:rgba(255,255,255,0.05);border-radius:3px;height:4px;">
                                                <div class="search-bar-fill" style="width:{{ round(($product->search_count / $maxSearch) * 100) }}%;"></div>
                                            </div>
                                        </div>
                                        <div style="text-align:right;flex-shrink:0;">
                                            <div style="font-size:15px;font-weight:700;color:#019DEA;">{{ number_format($product->search_count) }}</div>
                                            <div style="font-size:10px;color:#8a9bb0;">searches</div>
                                        </div>
                                    </div>
                                    @empty
                                    <p class="text-muted text-center py-3">No products yet.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-7">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="header-title mb-0">
                                            <i class="mdi mdi-domain me-1" style="color:#3051d3;"></i>
                                            Companies on Platform
                                        </h5>
                                        <a href="{{ route('tables_users') }}" class="btn btn-sm btn-outline-primary">View All</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0" style="font-size:13px;">
                                            <thead>
                                                <tr>
                                                    <th>Company</th>
                                                    <th>Country</th>
                                                    <th>Products</th>
                                                    <th>Searches</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($users as $u)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            @if($u->profile_picture)
                                                                <img src="{{ asset('storage/' . $u->profile_picture) }}"
                                                                     class="user-row-img"
                                                                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                                                <div class="avatar-sm" style="display:none;">{{ strtoupper(substr($u->name,0,1)) }}</div>
                                                            @else
                                                                <div class="avatar-sm">{{ strtoupper(substr($u->name,0,1)) }}</div>
                                                            @endif
                                                            <div>
                                                                <div style="font-weight:600;color:#e4e4e4;">{{ $u->raison_social ?? $u->name }}</div>
                                                                <div style="font-size:11px;color:#8a9bb0;">{{ $u->email }}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td style="color:#8a9bb0;">{{ optional($u->country)->name ?? '—' }}</td>
                                                    <td>
                                                        <span class="badge" style="background:rgba(1,157,234,0.15);color:#019DEA;">{{ $u->products_count }}</span>
                                                    </td>
                                                    <td style="color:#28a745;font-weight:600;">
                                                        {{ number_format($u->products->sum('search_count')) }}
                                                    </td>
                                                    <td>
                                                        <span class="badge" style="background:{{ $u->status === 'approved' ? 'rgba(40,167,69,0.15)' : 'rgba(255,193,7,0.15)' }};color:{{ $u->status === 'approved' ? '#28a745' : '#ffc107' }};">
                                                            {{ ucfirst($u->status) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr><td colspan="5" class="text-center text-muted py-4">No companies yet.</td></tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- Custom Pagination --}}
                                    <div class="d-flex justify-content-between align-items-center mt-3" style="font-size:13px;">
                                        <span style="color:#8a9bb0;">
                                            Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }} companies
                                        </span>
                                        <div class="d-flex gap-2">
                                            @if($users->onFirstPage())
                                                <span class="btn btn-sm btn-outline-secondary disabled" style="font-size:12px;">← Prev</span>
                                            @else
                                                <a href="{{ $users->previousPageUrl() }}" class="btn btn-sm btn-outline-secondary" style="font-size:12px;">← Prev</a>
                                            @endif
                                            <span style="color:#8a9bb0;line-height:30px;font-size:12px;">
                                                {{ $users->currentPage() }} / {{ $users->lastPage() }}
                                            </span>
                                            @if($users->hasMorePages())
                                                <a href="{{ $users->nextPageUrl() }}" class="btn btn-sm btn-primary" style="font-size:12px;">Next →</a>
                                            @else
                                                <span class="btn btn-sm btn-primary disabled" style="font-size:12px;">Next →</span>
                                            @endif
                                        </div>
                                    </div>

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
<script>
var searchLabels = {!! $chartLabels !!};
var searchData   = {!! $chartData !!};
new ApexCharts(document.querySelector("#search-chart"), {
    series: [{ name: 'Searches', data: searchData }],
    chart: { type: 'bar', height: 300, toolbar: { show: false }, background: 'transparent' },
    theme: { mode: 'dark' },
    plotOptions: { bar: { borderRadius: 6, columnWidth: '55%' } },
    colors: ['#019DEA'],
    xaxis: { categories: searchLabels, labels: { style: { fontSize: '11px' } } },
    yaxis: { labels: { formatter: v => Math.round(v) } },
    grid: { borderColor: 'rgba(255,255,255,0.05)' },
    tooltip: { theme: 'dark' },
    dataLabels: { enabled: false },
}).render();

var catLabels = {!! $catLabels !!};
var catData   = {!! $catData !!};
new ApexCharts(document.querySelector("#cat-chart"), {
    series: catData,
    chart: { type: 'donut', height: 300, background: 'transparent' },
    theme: { mode: 'dark' },
    labels: catLabels,
    legend: { position: 'bottom', fontSize: '12px' },
    tooltip: { theme: 'dark' },
    dataLabels: { enabled: false },
    plotOptions: { pie: { donut: { size: '65%' } } },
}).render();
</script>
</body>
</html>