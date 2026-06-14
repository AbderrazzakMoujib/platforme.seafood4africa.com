<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>My Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('assets1/images/favicon.ico')}}">
    <link href="{{asset('assets1/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets1/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets1/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .profile-avatar {
            width: 100px; height: 100px; border-radius: 16px;
            object-fit: cover; border: 3px solid rgba(48,81,211,0.3);
        }
        .avatar-placeholder {
            width: 100px; height: 100px; border-radius: 16px;
            background: rgba(48,81,211,0.15); display: flex;
            align-items: center; justify-content: center;
            font-size: 36px; font-weight: 700; color: #3051d3;
            border: 3px solid rgba(48,81,211,0.3);
        }
        .info-item { padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .info-item:last-child { border-bottom: none; }
        .info-label { font-size: 11px; text-transform: uppercase; letter-spacing: .5px; color: #8a9bb0; margin-bottom: 3px; }
        .info-value { font-size: 14px; color: #e4e4e4; }
        .img-upload-zone { border: 2px dashed rgba(48,81,211,0.3); border-radius: 10px; padding: 16px; text-align: center; cursor: pointer; transition: border-color .2s; }
        .img-upload-zone:hover { border-color: rgba(48,81,211,0.6); }
        .img-preview { width: 80px; height: 80px; border-radius: 10px; object-fit: cover; display: none; margin: 8px auto 0; }
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
                    <button type="button" class="btn header-item user text-start d-flex align-items-center"
                            id="page-header-user-dropdown" data-bs-toggle="dropdown">
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
                    <li class="mm-active">
                        <a href="{{ route('information') }}" class="waves-effect active">
                            <span>My Profile</span>
                        </a>
                    </li>
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
                            <h4 class="page-title mb-1">My Profile</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">My Profile</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="container-fluid">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="mdi mdi-check-circle me-1"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="mdi mdi-alert-circle me-1"></i>{{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="row g-3">

                        {{-- Left: Profile Card --}}
                        <div class="col-xl-3">
                            <div class="card mb-0">
                                <div class="card-body text-center py-4">
                                    @if($user->profile_picture)
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                             class="profile-avatar mx-auto d-block"
                                             onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
                                             alt="Logo">
                                        <div class="avatar-placeholder mx-auto" style="display:none;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @else
                                        <div class="avatar-placeholder mx-auto">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif

                                    <h5 class="mt-3 mb-1" style="color:#fff;">{{ $user->raison_social ?? $user->name }}</h5>
                                    <div style="font-size:12px;color:#8a9bb0;">{{ $user->titre_responsable ?? '' }}</div>

                                    @if($user->country || $user->category)
                                    <div class="d-flex justify-content-center gap-2 mt-3 flex-wrap">
                                        @if($user->country)
                                        <span style="background:rgba(48,81,211,0.1);border:1px solid rgba(48,81,211,0.2);border-radius:6px;padding:3px 10px;font-size:12px;color:#8a9bb0;">
                                            <i class="mdi mdi-earth me-1"></i>{{ $user->country->name }}
                                        </span>
                                        @endif
                                        @if($user->category)
                                        <span style="background:rgba(1,157,234,0.1);border:1px solid rgba(1,157,234,0.2);border-radius:6px;padding:3px 10px;font-size:12px;color:#8a9bb0;">
                                            <i class="mdi mdi-tag-outline me-1"></i>{{ $user->category->name }}
                                        </span>
                                        @endif
                                    </div>
                                    @endif

                                    <hr style="border-color:rgba(255,255,255,0.07);margin:16px 0;">

                                    <div class="text-start">
                                        @if($user->phone)
                                        <div class="info-item">
                                            <div class="info-label">Phone</div>
                                            <div class="info-value"><i class="mdi mdi-phone me-1" style="color:#019DEA;"></i>{{ $user->phone }}</div>
                                        </div>
                                        @endif
                                        @if($user->adresse)
                                        <div class="info-item">
                                            <div class="info-label">Address</div>
                                            <div class="info-value"><i class="mdi mdi-map-marker me-1" style="color:#019DEA;"></i>{{ $user->adresse }}</div>
                                        </div>
                                        @endif
                                        @if($user->site_web)
                                        <div class="info-item">
                                            <div class="info-label">Website</div>
                                            <div class="info-value">
                                                <a href="{{ $user->site_web }}" target="_blank" style="color:#3051d3;font-size:13px;">
                                                    <i class="mdi mdi-web me-1"></i>{{ $user->site_web }}
                                                </a>
                                            </div>
                                        </div>
                                        @endif
                                        @if($user->date_creation)
                                        <div class="info-item">
                                            <div class="info-label">Date de Création</div>
                                            <div class="info-value"><i class="mdi mdi-calendar me-1" style="color:#019DEA;"></i>{{ \Carbon\Carbon::parse($user->date_creation)->format('d/m/Y') }}</div>
                                        </div>
                                        @endif
                                    </div>

                                    <a href="{{ route('show_company', $user->id) }}" target="_blank"
                                       class="btn btn-outline-primary btn-sm w-100 mt-3">
                                        <i class="mdi mdi-eye me-1"></i>View Public Profile
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Right: Edit Form --}}
                        <div class="col-xl-9">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <h5 class="header-title mb-4">
                                        <i class="mdi mdi-pencil me-1" style="color:#3051d3;"></i>
                                        Edit Company Information
                                    </h5>

                                    <form action="{{ route('update.information') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

                                        {{-- Section: Company --}}
                                        <div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:#8a9bb0;margin-bottom:12px;padding-bottom:6px;border-bottom:1px solid rgba(255,255,255,0.06);">
                                            Company Information
                                        </div>
                                        <div class="row g-3 mb-4">
                                            <div class="col-md-6">
                                                <label class="form-label" style="font-size:13px;">Raison Sociale</label>
                                                <input type="text" class="form-control" name="name"
                                                       value="{{ old('name', $user->name) }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="font-size:13px;">Forme Juridique</label>
                                                <input type="text" class="form-control" name="forme_juridique"
                                                       value="{{ old('forme_juridique', $user->forme_juridique) }}"
                                                       placeholder="SARL, SA, SAS...">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="font-size:13px;">Date de Création</label>
                                                <input type="date" class="form-control" name="date_creation"
                                                       value="{{ old('date_creation', $user->date_creation) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="font-size:13px;">Chiffre d'Affaires</label>
                                                <input type="text" class="form-control" name="chiffre_affaire"
                                                       value="{{ old('chiffre_affaire', $user->chiffre_affaire) }}"
                                                       placeholder="Ex: 5M MAD">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" style="font-size:13px;">Activités Principales</label>
                                                <textarea class="form-control" name="activites_principales" rows="3"
                                                          placeholder="Décrivez les activités principales...">{{ old('activites_principales', $user->activites_principales) }}</textarea>
                                            </div>
                                        </div>

                                        {{-- Section: Contact --}}
                                        <div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:#8a9bb0;margin-bottom:12px;padding-bottom:6px;border-bottom:1px solid rgba(255,255,255,0.06);">
                                            Contact Information
                                        </div>
                                        <div class="row g-3 mb-4">
                                            <div class="col-md-6">
                                                <label class="form-label" style="font-size:13px;">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" name="email"
                                                       value="{{ old('email', $user->email) }}" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="font-size:13px;">Phone</label>
                                                <input type="text" class="form-control" name="phone"
                                                       value="{{ old('phone', $user->phone) }}"
                                                       placeholder="+212 6XX XXX XXX">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="font-size:13px;">Fax</label>
                                                <input type="text" class="form-control" name="fax"
                                                       value="{{ old('fax', $user->fax) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="font-size:13px;">Site Web</label>
                                                <input type="url" class="form-control" name="site_web"
                                                       value="{{ old('site_web', $user->site_web) }}"
                                                       placeholder="https://...">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" style="font-size:13px;">Adresse</label>
                                                <input type="text" class="form-control" name="adresse"
                                                       value="{{ old('adresse', $user->adresse) }}">
                                            </div>
                                        </div>

                                        {{-- Section: Responsable --}}
                                        <div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:#8a9bb0;margin-bottom:12px;padding-bottom:6px;border-bottom:1px solid rgba(255,255,255,0.06);">
                                            Responsable
                                        </div>
                                        <div class="row g-3 mb-4">
                                            <div class="col-md-6">
                                                <label class="form-label" style="font-size:13px;">Nom Responsable</label>
                                                <input type="text" class="form-control" name="nom_responsable"
                                                       value="{{ old('nom_responsable', $user->nom_responsable) }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="font-size:13px;">Titre Responsable</label>
                                                <input type="text" class="form-control" name="titre_responsable"
                                                       value="{{ old('titre_responsable', $user->titre_responsable) }}"
                                                       placeholder="Directeur Général, PDG...">
                                            </div>
                                        </div>

                                        {{-- Section: Media --}}
                                        <div style="font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:#8a9bb0;margin-bottom:12px;padding-bottom:6px;border-bottom:1px solid rgba(255,255,255,0.06);">
                                            Logo & Background
                                        </div>
                                        <div class="row g-3 mb-4">
                                            <div class="col-md-6">
                                                <label class="form-label" style="font-size:13px;">Company Logo</label>
                                                <div class="img-upload-zone" onclick="document.getElementById('profile_picture').click()">
                                                    <i class="mdi mdi-image" style="font-size:24px;color:#3051d3;"></i>
                                                    <div style="font-size:12px;color:#8a9bb0;margin-top:4px;">Click to upload logo</div>
                                                    <div style="font-size:11px;color:#8a9bb0;">JPG, PNG, WebP — max 2MB</div>
                                                </div>
                                                <input type="file" id="profile_picture" name="profile_picture"
                                                       accept="image/*" style="display:none;"
                                                       onchange="previewImg(this, 'logo-preview')">
                                                <img id="logo-preview" class="img-preview mx-auto d-block mt-2" src="" alt="Preview">
                                                @if($user->profile_picture)
                                                <div style="font-size:11px;color:#28a745;margin-top:6px;text-align:center;">
                                                    <i class="mdi mdi-check-circle me-1"></i>Current logo uploaded
                                                </div>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="font-size:13px;">Background Image</label>
                                                <div class="img-upload-zone" onclick="document.getElementById('background_image').click()">
                                                    <i class="mdi mdi-image-filter-hdr" style="font-size:24px;color:#019DEA;"></i>
                                                    <div style="font-size:12px;color:#8a9bb0;margin-top:4px;">Click to upload background</div>
                                                    <div style="font-size:11px;color:#8a9bb0;">JPG, PNG, WebP — max 2MB</div>
                                                </div>
                                                <input type="file" id="background_image" name="background_image"
                                                       accept="image/*" style="display:none;"
                                                       onchange="previewImg(this, 'bg-preview')">
                                                <img id="bg-preview" class="img-preview mx-auto d-block mt-2" src="" alt="Preview">
                                                @if($user->background_image)
                                                <div style="font-size:11px;color:#28a745;margin-top:6px;text-align:center;">
                                                    <i class="mdi mdi-check-circle me-1"></i>Current background uploaded
                                                </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="d-flex gap-2">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="mdi mdi-content-save me-1"></i>Save Changes
                                            </button>
                                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                                                Cancel
                                            </a>
                                        </div>
                                    </form>
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
function previewImg(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var img = document.getElementById(previewId);
            img.src = e.target.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>