<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>Branches</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets1/images/favicon.ico')}}">

        <!-- Bootstrap Css -->
        <link href="{{asset('assets1/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('assets1/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('assets1/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body data-topbar="colored">

        <!-- Begin page -->
        <div id="layout-wrapper">

        <header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
            <a href="{{route('dashboard.admin')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets1/images/logo/favicon.webp') }}"   width="30px">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets1/images/logo/logo3.webp') }}" width="160px" >
                    </span>
                </a>

                <a href="{{route('dashboard.admin')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets1/images/logo/favicon.webp') }}" width="30px" alt="" >
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets1/images/logo/logo2.webp') }}" alt="" width="160px" >
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-backburger"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative mt-3">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="mdi mdi-magnify"></span>
                </div>
            </form>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown">
                    <form class="p-3">
                        <div class="form-group mt-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block language-switch">
                <button type="button" class="btn header-item noti-icon" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img id="header-lang-img" src="{{ asset('assets1/images/flags/Mr.png') }}" alt="Header Language" height="14">
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                        <img src="{{ asset('assets1/images/flags/spain.jpg') }}" alt="user-image" class="me-2" height="12"> <span class="align-middle">Spanish</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                        <img src="{{ asset('assets1/images/flags/germany.jpg') }}" alt="user-image" class="me-2" height="12"> <span class="align-middle">German</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                        <img src="{{ asset('assets1/images/flags/italy.jpg') }}" alt="user-image" class="me-2" height="12"> <span class="align-middle">Italian</span>
                    </a>
                    <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                        <img src="{{ asset('assets1/images/flags/russia.jpg') }}" alt="user-image" class="me-2" height="12"> <span class="align-middle">Russian</span>
                    </a>
                </div>
            </div>


            <!-- light dark btn -->
            <div class="dropdown d-none d-sm-inline-block">
                <button type="button" class="btn header-item" id="light-dark-mode">
                    <i class="mdi mdi-moon-waning-crescent align-middle fs-4"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" width="40px" class="w-8 h-8 rounded-full mr-2 rounded-circle" />
                    <span class="d-none d-sm-inline-block ms-1">{{ Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end ">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="mdi mdi-face-profile font-size-16 align-middle me-1"></i>
                        Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="mdi mdi-logout font-size-16 align-middle me-1"></i>
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

               <!-- ========== Left Sidebar Start ========== -->
               <div class="vertical-menu">

<div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Menu</li>

            <li>
                <a href="{{route('dashboard.admin')}}" class="waves-effect">
                    <span>Dashboard</span>
                </a>
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
                    <li><a href={{route('add_country')}}>Add Country</a></li>
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
            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <div class="d-inline-block icons-sm me-1"><i class="uim uim-comment-message"></i></div>
                                    <span>Add Resources</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{ route('videos.create') }}">Add Video</a></li>
                                <li><a href="{{ route('pdfs.create') }}">Add PDF</a></li>
                                <li><a href="{{ route('images.create') }}">Add Image</a></li>
                                
                                </ul>
                            </li>
                            <li>
                                <a href="{{route('admins.contacts_tables')}}" class="waves-effect">
                                    
                                    <span>Contact</span>
                                </a>
                            </li>
                            <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('information')}}">Information</a></li>
                            </ul>

        </ul>

    </div>
    <!-- Sidebar -->
</div>
</div>
<!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
            
                <div class="page-content">
            
                    <!-- Page-Title -->
                    <div class="page-title-box">
                        <div class="container-fluid">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h4 class="page-title mb-1">Form Elements</h4>
                                  
                                </div>
                            </div>
            
                        </div>
                    </div>
                    <!-- end page title end breadcrumb -->
            
                    <div class="page-content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
            
                                            <h4 class="header-title">Add New Product Category</h4>
                                            <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                                            <form action="{{ route('dashboard.add-category') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group mb-3 row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Category Secteur</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" placeholder="Enter Secteur" name="name" required >
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 row">
                                                <label for="example-search-input" class="col-md-2 col-form-label">Category Image (Optional):</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="file" name="image" accept="image/*" >
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 row">
                                                <label for="example-email-input" class="col-md-2 col-form-label">Category Icon (Optional):</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="file" name="icon" accept="image/*">
                                                </div>
                                            </div>
                                          
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">Add Category</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->

            <!-- tablesssssssss -->
            <div class="page-content-wrappe mt-5">
                        <div class="container-fluid">
                        
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
            
                                            <h4 class="header-title">Buttons example</h4>
                                            <p class="card-title-desc">The Buttons extension for DataTables
                                                provides a common set of options, API methods and styling to display
                                                buttons on a page that will interact with a DataTable. The core library
                                                provides the based framework upon which plug-ins can built.
                                            </p>
            
                                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>Images</th>
                                                    <th>Name</th>
                                                    <th>Icon</th>
                                                   
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($categories as $category)
                                                <tr>
                                                <td scope="row"><img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" width="50px" height="50px"></td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->icon }}</td>
                                                    <td>
                    <!-- Delete Button -->
                    <form action="{{ route('dashboard.delete-category', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">
                            Delete
                        </button>
                    </form>
                </td>
                                                </tr>
                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
             <!-- tablesssss -->
            
            
                        </div>
                        <!-- end container-fluid -->
                    </div>
                    <!-- end page-content-wrapper -->
                </div>
                <!-- End Page-content -->
            
            
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                2024 © Fenip.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Crafted with <i class="mdi mdi-heart text-danger"></i> by Smart Expos
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

       
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="assets1/libs/jquery/jquery.min.js"></script>
        <script src="assets1/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets1/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets1/libs/simplebar/simplebar.min.js"></script>
        <script src="assets1/libs/node-waves/waves.min.js"></script>

        <script src="../../../../../unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>


        <script src="assets1/js/app.js"></script>

    </body>

</html>
