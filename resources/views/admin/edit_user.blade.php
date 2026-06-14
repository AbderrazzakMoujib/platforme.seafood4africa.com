<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit User - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('assets1/images/favicon.ico')}}">
    <link href="{{asset('assets1/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets1/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets1/css/app.min.css')}}" rel="stylesheet" type="text/css" />
</head>
<body data-topbar="colored">

<div id="layout-wrapper">

    <!-- ===== Top Header ===== -->
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <div class="navbar-brand-box">
                    <a href="{{route('dashboard.admin')}}" class="logo logo-dark">
                        <span class="logo-sm"><img src="{{ asset('assets1/images/logo/favicon.webp') }}" width="30px"></span>
                        <span class="logo-lg"><img src="{{ asset('assets1/images/logo/logo3.webp') }}" width="160px"></span>
                    </a>
                    <a href="{{route('dashboard.admin')}}" class="logo logo-light">
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
                    <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" width="40px" class="rounded-circle" />
                        <span class="d-none d-sm-inline-block ms-1">{{ Auth::user()->name }}</span>
                        <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">
                            <i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i> Profile
                        </a>
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

    <!-- ===== Left Sidebar ===== -->
    <div class="vertical-menu">
        <div data-simplebar class="h-100">
            <div id="sidebar-menu">
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Menu</li>
                    <li>
                        <a href="{{route('dashboard.admin')}}" class="waves-effect"><span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm me-1"><i class="uim uim-comment-message"></i></div>
                            <span>Products</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('add_products')}}">Add Product</a></li>
                            <li><a href="{{route('products_tables')}}">All Products</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm me-1"><i class="uim uim-sign-in-alt"></i></div>
                            <span>Category</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('add_secteur')}}">Add Branches D'activites</a></li>
                            <li><a href="{{route('add_country')}}">Add Country</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm me-1"><i class="uim uim-grids"></i></div>
                            <span>Admin</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('add_admin')}}">Add Admin</a></li>
                        </ul>
                    </li>
                    <li class="mm-active">
                        <a href="javascript: void(0);" class="has-arrow waves-effect mm-active">
                            <div class="d-inline-block icons-sm me-1"><i class="uim uim-grids"></i></div>
                            <span>User</span>
                        </a>
                        <ul class="sub-menu mm-show" aria-expanded="true">
                            <li class="mm-active"><a href="{{route('tables_users')}}" class="active">Tables Users</a></li>
                            <li><a href="{{route('admin.pending.users')}}">Pending Approvals</a></li>
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
                    <li>
                        <a href="{{route('admins.contacts_tables')}}" class="waves-effect"><span>Contact</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- ===== Main Content ===== -->
    <div class="main-content">
        <div class="page-content">

            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Edit User</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.admin')}}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{route('tables_users')}}">Users</a></li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="container-fluid">

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-4">Edit: {{ $user->name }}</h4>

                            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                                @csrf @method('PUT')

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Company Name</label>
                                        <input type="text" name="raison_social" class="form-control" value="{{ old('raison_social', $user->raison_social) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Country</label>
                                        <select name="country_id" class="form-select">
                                            <option value="">— Select country —</option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ old('country_id', $user->country_id) == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                                            <option value="pending"   {{ old('status', $user->status) === 'pending'  ? 'selected' : '' }}>Pending</option>
                                            <option value="approved"  {{ old('status', $user->status) === 'approved' ? 'selected' : '' }}>Approved</option>
                                        </select>
                                        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Role</label>
                                        <select name="role" class="form-select @error('role') is-invalid @enderror">
                                            <option value="user"  {{ old('role', $user->role) === 'user'  ? 'selected' : '' }}>User</option>
                                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>

                                <div class="d-flex gap-2 mt-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="mdi mdi-content-save me-1"></i> Save Changes
                                    </button>
                                    <a href="{{ route('tables_users') }}" class="btn btn-secondary">
                                        <i class="mdi mdi-arrow-left me-1"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">2024 © Fenip.</div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Created with <i class="mdi mdi-heart text-danger"></i> by Smart Expos
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

</div>

<div class="rightbar-overlay"></div>

<script src="{{ asset('assets1/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets1/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets1/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('assets1/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets1/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets1/js/app.js') }}"></script>

</body>
</html>
