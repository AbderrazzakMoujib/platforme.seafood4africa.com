<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Add Video</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('assets1/images/favicon.ico')}}">
    <link href="{{asset('assets1/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets1/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets1/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .resource-thumb { width:80px;height:50px;border-radius:6px;object-fit:cover;background:rgba(48,81,211,0.1); }
        .upload-zone { border:2px dashed rgba(48,81,211,0.3);border-radius:12px;padding:32px;text-align:center;cursor:pointer;transition:border-color .2s; }
        .upload-zone:hover { border-color:rgba(48,81,211,0.6); }
        .file-info { display:none;margin-top:10px;font-size:13px;color:#019DEA; }
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
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm me-1"><i class="uim uim-comment-message"></i></div>
                            <span>Products</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('add_products_user')}}">My Products</a></li>
                        </ul>
                    </li>
                    <li class="mm-active">
                        <a href="javascript: void(0);" class="has-arrow waves-effect mm-active">
                            <div class="d-inline-block icons-sm me-1"><i class="uim uim-comment-message"></i></div>
                            <span>Add Resources</span>
                        </a>
                        <ul class="sub-menu mm-show" aria-expanded="true">
                            <li class="mm-active"><a href="{{ route('videos.create') }}" class="active">Add Video</a></li>
                            <li><a href="{{ route('pdfs.create') }}">Add PDF</a></li>
                            <li><a href="{{ route('images.create') }}">Add Image</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('information') }}" class="waves-effect"><span>My Profile</span></a></li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Main --}}
    <div class="main-content">
        <div class="page-content">

            <div class="page-title-box">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="page-title mb-1">Add Video</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Add Video</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="container-fluid">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="row g-3">
                        {{-- Upload Form --}}
                        <div class="col-xl-4">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <h5 class="header-title mb-4">
                                        <i class="mdi mdi-video-plus me-1" style="color:#019DEA;"></i>
                                        Upload New Video
                                    </h5>
                                    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data" id="upload-form">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" style="font-size:13px;">Video Title <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" placeholder="Enter video title" name="title" required>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" style="font-size:13px;">Video File <span class="text-danger">*</span></label>
                                            <div class="upload-zone" onclick="document.getElementById('video-file').click()">
                                                <i class="mdi mdi-cloud-upload" style="font-size:32px;color:#3051d3;"></i>
                                                <div style="font-size:13px;color:#8a9bb0;margin-top:8px;">Click to upload video</div>
                                                <div style="font-size:11px;color:#8a9bb0;">MP4, AVI, MKV, MOV — max 100MB</div>
                                            </div>
                                            <input type="file" id="video-file" name="file" accept="video/*" required style="display:none;"
                                                   onchange="showFileInfo(this, 'video-info')">
                                            <div id="video-info" class="file-info">
                                                <i class="mdi mdi-check-circle text-success me-1"></i>
                                                <span id="video-name"></span>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary w-100" type="submit">
                                            <i class="mdi mdi-upload me-1"></i>Upload Video
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Videos List --}}
                        <div class="col-xl-8">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <h5 class="header-title mb-4">
                                        <i class="mdi mdi-video me-1" style="color:#3051d3;"></i>
                                        My Videos
                                        <span class="badge ms-2" style="background:rgba(1,157,234,0.15);color:#019DEA;">{{ $videos->count() }}</span>
                                    </h5>
                                    @if($videos->isEmpty())
                                    <div class="text-center py-5">
                                        <i class="mdi mdi-video-off" style="font-size:48px;color:#8a9bb0;"></i>
                                        <p class="text-muted mt-3">No videos uploaded yet.</p>
                                    </div>
                                    @else
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0" style="font-size:13px;">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Preview</th>
                                                    <th>Uploaded by</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($videos as $video)
                                                <tr>
                                                    <td style="font-weight:600;color:#e4e4e4;">{{ $video->title }}</td>
                                                    <td>
                                                        <video width="120" height="60" controls style="border-radius:6px;">
                                                            <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                                                        </video>
                                                    </td>
                                                    <td style="color:#8a9bb0;">{{ optional($video->user)->name ?? '—' }}</td>
                                                    <td style="color:#8a9bb0;">{{ $video->created_at->format('d M Y') }}</td>
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
                    <div class="col-sm-6"><div class="text-sm-end d-none d-sm-block">Crafted with <i class="mdi mdi-heart text-danger"></i> by Smart Expos</div></div>
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
function showFileInfo(input, infoId) {
    if (input.files && input.files[0]) {
        var name = input.files[0].name;
        var size = (input.files[0].size / 1024 / 1024).toFixed(2);
        document.getElementById(infoId).style.display = 'block';
        document.getElementById(infoId).querySelector('span') &&
            (document.getElementById(infoId).innerHTML = '<i class="mdi mdi-check-circle text-success me-1"></i>' + name + ' (' + size + ' MB)');
    }
}
</script>
</body>
</html>