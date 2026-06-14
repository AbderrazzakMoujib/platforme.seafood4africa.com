<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Pending Approvals - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('assets1/images/favicon.ico')}}">
    <link href="{{asset('assets1/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets1/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets1/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .user-card { border: 1px solid rgba(255,255,255,0.07); border-radius: 10px; padding: 18px 20px; margin-bottom: 14px; background: rgba(255,255,255,0.02); transition: border-color .2s; }
        .user-card:hover { border-color: rgba(48,81,211,0.4); }
        .user-card .meta { font-size: 13px; color: #8a9bb0; }
        .user-card .company { font-size: 15px; font-weight: 600; }
        .info-row { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 6px; }
        .info-badge { background: rgba(48,81,211,0.1); border: 1px solid rgba(48,81,211,0.2); border-radius: 6px; padding: 3px 10px; font-size: 12px; color: #8a9bb0; }
        .modal-backdrop-custom { position:fixed;inset:0;background:rgba(0,0,0,.6);z-index:1040;display:none; }
        .modal-backdrop-custom.show { display:block; }
        .side-modal { position:fixed;top:0;right:-520px;width:500px;max-width:95vw;height:100%;background:#1f2d3d;z-index:1050;transition:right .3s ease;overflow-y:auto;box-shadow:-4px 0 30px rgba(0,0,0,.4); }
        .side-modal.open { right:0; }
        .side-modal-header { padding:20px 24px;border-bottom:1px solid rgba(255,255,255,.07);display:flex;align-items:center;justify-content:space-between; }
        .side-modal-body { padding:24px; }
        .detail-group { margin-bottom:16px; }
        .detail-label { font-size:11px;text-transform:uppercase;letter-spacing:.5px;color:#8a9bb0;margin-bottom:4px; }
        .detail-value { font-size:14px;color:#e4e4e4; }
        .detail-value a { color:#3051d3; }
        .divider { border:none;border-top:1px solid rgba(255,255,255,.07);margin:20px 0; }

        /* Avatar placeholder */
        .avatar-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(48,81,211,0.15);
            font-size: 20px;
            font-weight: 700;
            color: #3051d3;
            text-transform: uppercase;
        }
    </style>
</head>
<body data-topbar="colored">

<div id="layout-wrapper">

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
                        @if(Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
                                 alt="Profile" width="40px" class="rounded-circle" />
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
                    <li><a href="{{route('dashboard.admin')}}" class="waves-effect"><span>Dashboard</span></a></li>
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
                    <li class="mm-active">
                        <a href="javascript: void(0);" class="has-arrow waves-effect mm-active">
                            <div class="d-inline-block icons-sm me-1"><i class="uim uim-grids"></i></div><span>User</span>
                        </a>
                        <ul class="sub-menu mm-show" aria-expanded="true">
                            <li><a href="{{route('tables_users')}}">Tables Users</a></li>
                            <li class="mm-active"><a href="{{route('admin.pending.users')}}" class="active">Pending Approvals
                                @php $pc = \App\Models\User::where('status','pending')->where('role','!=','admin')->count(); @endphp
                                @if($pc > 0)<span class="badge bg-danger ms-1">{{ $pc }}</span>@endif
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
                            <h4 class="page-title mb-1">Pending Approvals</h4>
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard.admin')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Pending Registrations</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-content-wrapper">
                <div class="container-fluid">

                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mb-4">
                                Pending Registrations
                                <span class="badge bg-danger ms-2">{{ $users->count() }}</span>
                            </h4>

                            @if($users->isEmpty())
                                <div class="text-center py-5">
                                    <i class="mdi mdi-check-circle-outline" style="font-size:48px;color:#28a745;"></i>
                                    <p class="text-muted mt-3">No pending registrations. All caught up!</p>
                                </div>
                            @else
                                @foreach($users as $user)
                                @php
                                    $initials = strtoupper(substr($user->raison_social ?? $user->name, 0, 1));
                                @endphp
                                <div class="user-card">
                                    <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <!-- Company Logo -->
                                            <div style="width:52px;height:52px;border-radius:10px;overflow:hidden;border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.05);flex-shrink:0;">
                                                @if($user->profile_picture)
                                                    <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                                         alt="logo"
                                                         style="width:100%;height:100%;object-fit:cover;"
                                                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                                    <div class="avatar-placeholder" style="display:none;">{{ $initials }}</div>
                                                @else
                                                    <div class="avatar-placeholder">{{ $initials }}</div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="company">{{ $user->raison_social ?? $user->name }}</div>
                                                <div class="meta mt-1">
                                                    <i class="mdi mdi-account-outline me-1"></i>{{ $user->nom_responsable ?? $user->name }}
                                                    &nbsp;·&nbsp;
                                                    <i class="mdi mdi-email-outline me-1"></i>
                                                    <a href="mailto:{{ $user->email }}" style="color:#3051d3;">{{ $user->email }}</a>
                                                    &nbsp;·&nbsp;
                                                    <i class="mdi mdi-phone-outline me-1"></i>{{ $user->phone ?? '—' }}
                                                </div>
                                                <div class="info-row mt-2">
                                                    @if($user->country)
                                                        <span class="info-badge"><i class="mdi mdi-earth me-1"></i>{{ $user->country->name }}</span>
                                                    @endif
                                                    @if($user->category)
                                                        <span class="info-badge"><i class="mdi mdi-tag-outline me-1"></i>{{ $user->category->name }}</span>
                                                    @endif
                                                    <span class="info-badge"><i class="mdi mdi-clock-outline me-1"></i>{{ $user->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2 flex-wrap">
                                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="openModal({{ $user->id }})">
                                                <i class="mdi mdi-eye me-1"></i>View & Contact
                                            </button>
                                            <form method="POST" action="{{ route('admin.users.approve', $user->id) }}" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="mdi mdi-check me-1"></i>Approve
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.users.reject', $user->id) }}" style="display:inline;" onsubmit="return confirm('Reject and delete {{ addslashes($user->name) }}?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="mdi mdi-close me-1"></i>Reject
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Side Modal for user {{ $user->id }} -->
                                <div class="modal-backdrop-custom" id="backdrop-{{ $user->id }}" onclick="closeModal({{ $user->id }})"></div>
                                <div class="side-modal" id="modal-{{ $user->id }}">
                                    <div class="side-modal-header">
                                        <div class="d-flex align-items-center gap-3">
                                            <!-- Logo in modal header -->
                                            <div style="width:56px;height:56px;border-radius:10px;overflow:hidden;border:1px solid rgba(255,255,255,0.15);background:rgba(255,255,255,0.08);flex-shrink:0;">
                                                @if($user->profile_picture)
                                                    <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                                         alt="logo"
                                                         style="width:100%;height:100%;object-fit:cover;"
                                                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                                    <div class="avatar-placeholder" style="display:none;font-size:22px;">{{ $initials }}</div>
                                                @else
                                                    <div class="avatar-placeholder" style="font-size:22px;">{{ $initials }}</div>
                                                @endif
                                            </div>
                                            <div>
                                                <h5 class="mb-0" style="color:#fff;">{{ $user->raison_social ?? $user->name }}</h5>
                                                <small style="color:#8a9bb0;">Registration details</small>
                                            </div>
                                        </div>
                                        <button type="button" onclick="closeModal({{ $user->id }})" style="background:none;border:none;color:#8a9bb0;font-size:22px;cursor:pointer;">&times;</button>
                                    </div>
                                    <div class="side-modal-body">

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="detail-group">
                                                    <div class="detail-label">Raison Sociale</div>
                                                    <div class="detail-value">{{ $user->raison_social ?? '—' }}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="detail-group">
                                                    <div class="detail-label">Nom Responsable</div>
                                                    <div class="detail-value">{{ $user->nom_responsable ?? '—' }}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="detail-group">
                                                    <div class="detail-label">Email</div>
                                                    <div class="detail-value"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="detail-group">
                                                    <div class="detail-label">Téléphone</div>
                                                    <div class="detail-value">{{ $user->phone ?? '—' }}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="detail-group">
                                                    <div class="detail-label">Pays</div>
                                                    <div class="detail-value">{{ optional($user->country)->name ?? '—' }}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="detail-group">
                                                    <div class="detail-label">Secteur</div>
                                                    <div class="detail-value">{{ optional($user->category)->name ?? '—' }}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="detail-group">
                                                    <div class="detail-label">Forme Juridique</div>
                                                    <div class="detail-value">{{ $user->forme_juridique ?? '—' }}</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="detail-group">
                                                    <div class="detail-label">Site Web</div>
                                                    <div class="detail-value">
                                                        @if($user->site_web)
                                                            <a href="{{ $user->site_web }}" target="_blank">{{ $user->site_web }}</a>
                                                        @else —
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="detail-group">
                                                    <div class="detail-label">Activités Principales</div>
                                                    <div class="detail-value">{{ $user->activites_principales ?? '—' }}</div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="detail-group">
                                                    <div class="detail-label">Adresse</div>
                                                    <div class="detail-value">{{ $user->adresse ?? '—' }}</div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="divider">

                                        <div style="font-size:14px;font-weight:600;color:#fff;margin-bottom:14px;">
                                            <i class="mdi mdi-email-send-outline me-1" style="color:#3051d3;"></i>
                                            Send Email to {{ $user->name }}
                                        </div>
                                        <form method="POST" action="{{ route('admin.users.send-email', $user->id) }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label" style="font-size:12px;color:#8a9bb0;">Subject</label>
                                                <input type="text" name="subject" class="form-control form-control-sm"
                                                    value="Your registration request — SeaFood4Africa">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" style="font-size:12px;color:#8a9bb0;">Message</label>
                                                <textarea name="message" class="form-control" rows="7" required>Bonjour {{ $user->nom_responsable ?? $user->name }},

Nous avons bien reçu votre demande d'inscription sur la plateforme SeaFood4Africa.

Après examen de votre dossier, nous souhaitons vous informer que :

[Écrivez votre message ici]

Cordialement,
L'équipe SeaFood4Africa</textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                                <i class="mdi mdi-send me-1"></i> Send Email
                                            </button>
                                        </form>

                                        <hr class="divider">

                                        <div class="d-flex gap-2">
                                            <form method="POST" action="{{ route('admin.users.approve', $user->id) }}" style="flex:1;">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm w-100">
                                                    <i class="mdi mdi-check me-1"></i>Approve
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.users.reject', $user->id) }}" style="flex:1;" onsubmit="return confirm('Reject and delete {{ addslashes($user->name) }}?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm w-100">
                                                    <i class="mdi mdi-close me-1"></i>Reject
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                                @endforeach
                            @endif

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
                        <div class="text-sm-end d-none d-sm-block">Created with <i class="mdi mdi-heart text-danger"></i> by Smart Expos</div>
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
<script>
function openModal(id) {
    document.getElementById('modal-' + id).classList.add('open');
    document.getElementById('backdrop-' + id).classList.add('show');
    document.body.style.overflow = 'hidden';
}
function closeModal(id) {
    document.getElementById('modal-' + id).classList.remove('open');
    document.getElementById('backdrop-' + id).classList.remove('show');
    document.body.style.overflow = '';
}
</script>
</body>
</html>