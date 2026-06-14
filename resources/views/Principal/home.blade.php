@extends('layouts.master')
@section('content')


<!-- ===== HERO BANNER SECTION ===== -->

  <section class="hero-banner">
    <!-- Mobile Hero Image -->
    <div class="hero-mobile-img">
        <img src="{{asset('img/images1_1.png')}}" alt="Seafood Platform">
    </div>

    <div class="container">
        <div class="hero-wrapper">
            
            <!-- Left Content -->
            <div class="hero-content">
                <h1 class="hero-title">
                    Un réseau B2B de collaboration pour une croissance 
                    <span class="highlight-text">bleue en Afrique</span>
                </h1>
                <p class="hero-subtitle">Solutions for your business</p>
                
                <!-- CTA Buttons -->
                <div class="hero-actions">
                    <a href="{{route('b2b')}}" class="btn-primary-custom">
                        <span>Marketplace</span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </a>
                    
                    @auth
                        <a href="{{ route('resources') }}" class="btn-secondary-custom">
                            <span>Resources</span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M7.5 15L12.5 10L7.5 5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </a>
                    @else
                        <button class="btn-secondary-custom open-modal-trigger">
                            <span>Resources</span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M10 5V15M5 10H15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </button>
                    @endauth
                </div>
            </div>

            <!-- Right Images - Side by Side -->
            <div class="hero-images-grid">
                <div class="hero-image-item item-1">
                    <div class="image-wrapper">
                        <img src="{{asset('img/img1.png')}}" alt="Seafood 1">
                        <div class="image-overlay"></div>
                    </div>
                </div>
                <div class="hero-image-item item-2">
                    <div class="image-wrapper">
                        <img src="{{asset('img/img2.png')}}" alt="Seafood 2">
                        <div class="image-overlay"></div>
                    </div>
                </div>
                <div class="hero-image-item item-3">
                    <div class="image-wrapper">
                        <img src="{{asset('img/img3.png')}}" alt="Seafood 3">
                        <div class="image-overlay"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Background Elements -->
    <div class="hero-bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
    </div>
  </section>

  
<!--  ===== ABOUT SECTION =====  -->
<div class="about-sec">
  <div class="container">
    <h2 class="headingWh mb-4">About the Platform</h2>
    <div class="row">
      <div class="col-xl-6">
        <div class="about-content">
          <h2 class="textwhitecolor abouth">Plateforme - <span>B2B</span></h2>
          <p>
            Cette plateforme B2B est conçue pour faciliter les connexions entre les entreprises africaines du secteur de la pêche et de l'aquaculture. 
            Elle permet de développer des partenariats stratégiques, d'explorer de nouvelles opportunités commerciales, et de renforcer le réseau professionnel à l’échelle continentale.
         </p>          
        </div>
      </div>
      <div class="col-xl-6">
        <div class="about-img mt-5">
          <img src="img/images_header.png" alt="img" class="img-fluid">
        </div>
      </div>
    </div>
  </div>
</div>


<!--  ===== ABOUT SECTION WITH SERVICES =====  -->
<div class="about-sec">
  <div class="container">
    <h2 class="headingWh mb-4">Our Services</h2>

    <div class="row mt-5">
      <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="createsell">
          <div class="createsellHead">
            <div class="creatsellicon"><img src="img/setupwalleticon.svg" alt="img"></div>
            <h3 class="textwhitecolor">Marketplace</h3>
          </div>
          <p class="textgraycolor">Join a B2B marketplace connecting seafood professionals. Discover top products, services, and partners across Africa—simplifying sourcing, negotiations, and growth</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="createsell">
          <div class="createsellHead">
            <div class="creatsellicon"><img src="img/collectionicon.svg" alt="img"></div>
            <h3 class="textwhitecolor">Create your Resources</h3>
          </div>
          <p class="textgraycolor">Effortlessly manage your resources: create a profile, list certifications, showcase services, and highlight strengths—boosting visibility in seafood and aquaculture</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="createsell">
          <div class="createsellHead">
            <div class="creatsellicon"><img src="img/addyouricon.svg" alt="img"></div>
            <h3 class="textwhitecolor">Add your Products</h3>
          </div>
          <p class="textgraycolor">Easily upload and categorize your products—seafood, packaging, equipment, or services—to reach buyers and partners seeking quality solutions. </p>
        </div>
      </div>

      <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="createsell">
          <div class="createsellHead">
            <div class="creatsellicon"><img src="img/listthemicon.svg" alt="img"></div>
            <h3 class="textwhitecolor">List them for sale</h3>
          </div>
          <p class="textgraycolor">List products, connect directly with buyers, and negotiate deals seamlessly. Access a global market and boost sales with ease on our B2B platform. </p>
        </div>
      </div>
    </div>
    <div class="row about-row2 mt-3 mt-lg-3 mt-xl-5 pt-3 pt-lg-3 pt-xl-5">
      <div class="col-xl-6">
        <div class="about-img">
          <img src="img/dashboard.png" alt="img" id="images_platforme" class="img-fluid">
        </div>
      </div>
      <div class="col-xl-6 pb-5 pb-md-0">
        <div class="about-content">
          <h2 class="textwhitecolor abouth">Espace Unique </h2>
          <p>
          Elle offre un espace unique d’échanges B2B, où les participants peuvent partager des idées, collaborer sur des initiatives, et accéder à des ressources favorisant une croissance durable de l’industrie. En rejoignant cette plateforme, les entreprises bénéficient d’outils permettant de construire des relations durables et fructueuses avec d’autres professionnels du secteur.
          </p> 
          <div class="watch-btn">
          <button class="btn btnlightblue mt-5" ><a href="{{route('contact')}}" id="btn_header" >Contact Us</a></button>
          
          </div>        
        </div>
      </div>      
    </div>
  </div>
</div>


{{-- ===== POPULAR COMPANY SECTION ===== --}}
<div class="popularCollection">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="headingWh mb-4">Popular Company</h2>
                <div class="popular-slider-wrapper">

                    @foreach($users->filter(fn($u) => $u->profile_picture && $u->products->count() > 0)->take(10) as $user)
                    @php
                        $popularityScore = $user->products->sum('search_count') + $user->products->count();
                    @endphp

                    <div class="creator-item">
                        <a href="{{ route('show_company', $user->id) }}" class="creator-link">

                            {{-- Background Image --}}
                            <div class="creator-bg">
                                @if($user->background_image)
                                    <img
                                        src="{{ asset('storage/' . $user->background_image) }}"
                                        alt="{{ $user->name }} cover"
                                        loading="lazy"
                                    >
                                @else
                                    {{-- Fallback gradient if no background image --}}
                                    <div style="width:100%;height:100%;background:linear-gradient(135deg,#0a1f3a 0%,#019DEA22 100%);"></div>
                                @endif
                                <div class="creator-bg-overlay"></div>
                            </div>

                            {{-- Logo Profile --}}
                            <div class="creator-logo">
                                <img
                                    src="{{ asset('storage/' . $user->profile_picture) }}"
                                    alt="{{ $user->name }}"
                                    loading="lazy"
                                >
                                <span class="check-badge">
                                    <img src="{{ asset('img/checkicon.svg') }}" alt="verified">
                                </span>
                            </div>

                            {{-- Company Info --}}
                            <div class="creator-info">
                                <h3 title="{{ $user->name }}">{{ $user->name }}</h3>

                                @if($user->nom_responsable)
                                <h4 title="{{ $user->nom_responsable }}">{{ $user->nom_responsable }}</h4>
                                @endif

                                {{-- 
                                    FIXED: Str::limit(80) au lieu de Str::words(15)
                                    → longueur fixe en caractères = hauteur consistante
                                --}}
                                @if($user->description)
                                <p title="{{ $user->description }}">
                                    {{ \Illuminate\Support\Str::limit($user->description, 80, '...') }}
                                </p>
                                @else
                                <p>&nbsp;</p>
                                @endif

                                {{-- Stats pushed to bottom via margin-top: auto --}}
                                <div class="creator-stats">
                                    <span class="creator-stat">
                                        <i class="fas fa-box"></i>
                                        {{ $user->products->count() }} Products
                                    </span>

                                    @if($popularityScore > 0)
                                    <span class="creator-stat creator-stat--hot">
                                        <i class="fas fa-fire"></i>
                                        {{ $popularityScore }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </a>
                    </div>
                    @endforeach

                </div>{{-- /.popular-slider-wrapper --}}
            </div>
        </div>
    </div>
</div>
{{-- ===== END POPULAR COMPANY SECTION ===== --}}


<!--  ===== TOP PRODUCTS SECTION =====  -->
<div class="TopsellerSec pt-5 mt-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="headingWh mb-4">Top Products</h2>
        <div class="tab-sec">
 
          <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="SellerTabOne">
        <div class="topSellers">
            <ul>
                @php $count = 1; @endphp 
                @foreach($products->take(12) as $product)
                    <li>
                        <div class="seller">
                            <div class="sellerLeft">
                        
                                <div class="sellcount">{{ $count }}</div>
                                <div class="sellerimg">
                                    <img class="img-fluid" src="{{ asset('storage/' . $product->image) }}" alt="img"> 
                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                </div>
                                <div class="sellertitlepr">
                                    <h2>{{ $product->title }}</h2>
                                    <h6>
                                        <img src="img/priceicon.svg">
                                        <a class="textwhitecolor" id="btn_header" href="{{ route('show_company', ['id' => $product->user->id]) }}">
                                            {{ $product->user->name }}
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </li>
                    @php $count++; @endphp 
                @endforeach
            </ul>
        </div>
    </div>
</div>
        </div>
      </div>
    </div>
  </div>
</div>


<!--  ===== FAQ SECTION =====  -->
<div class="faq mt-3 pt-3 mt-md-4 pt-md-4 mt-lg-5 pt-lg-5">

<div class="circlebg3"><img class="img-fluid" src="img/circlebg21.svg" alt="img"></div>
<div class="container">
  <h2 class="headingWh mb-2 mb-md-2 mb-lg-4">Frequently Asked Questions</h2>

  <div class="faq-ques">
    <ul class="nav nav-tabs blueScroll" id="myTab" role="tablist">
      <!-- tab toogle -->
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button"
          role="tab" aria-controls="home" aria-selected="true">Quel est l'intérêt de cette plateforme B2B pour le forum SEAFOOD4AFRICA ?</button>
      </li>

            <!-- tab toogle -->
            <li class="nav-item" role="presentation">
        <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button" role="tab"
          aria-controls="home" aria-selected="true">Comment la plateforme garantit-elle la confidentialité de mes informations ?</button>
      </li>


      <!-- tab toogle -->
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button" role="tab"
          aria-controls="home" aria-selected="true">Puis-je consulter le profil des autres participants pour évaluer leur compatibilité ?</button>
      </li>
    </ul>

    <div class="tab-content accordion" id="accordionExample">
      <!-- tab item -->
      <div class="tab-pane fade accordion-item  show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
        <h2 class="accordion-header" id="collapsehead1">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1"
            aria-expanded="true" aria-controls="collapse1">
            Quel est l'intérêt de cette plateforme B2B pour le forum SEAFOOD4AFRICA ?
          </button>
        </h2>
        <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="collapsehead1"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <h3>l'intérêt de cette plateforme B2B?</h3>
            <p>Cette plateforme B2B est conçue pour connecter les entreprises africaines du secteur de la pêche et de l'aquaculture, leur permettant de développer des partenariats stratégiques, </p>
            <p>d'explorer de nouvelles opportunités commerciales et de renforcer leur réseau au niveau continental. Elle offre un espace unique pour échanger des idées, partager des ressources, et collaborer autour d’initiatives pour une croissance durable de l'industrie. En participant</p>
            <p>vous accédez à un écosystème de professionnels et bénéficiez d’outils pour établir des relations durables et fructueuses.</p>
          </div>
        </div>
      </div>

      <!-- tab item -->
      <div class="tab-pane fade accordion-item" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
        <h2 class="accordion-header" id="collapsehead2">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2"
            aria-expanded="true" aria-controls="collapse2">
            Comment la plateforme garantit-elle la confidentialité de mes informations ?
          </button>
        </h2>
        <div id="collapse2" class="accordion-collapse collapse " aria-labelledby="collapsehead2"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <h3>Comment la plateforme garantit-elle la confidentialité de mes informations ?</h3>
            <p>Toutes vos informations sont protégées et accessibles uniquement aux autres participants du forum. Nous nous engageons à respecter la confidentialité de vos données et à ne les partager qu'avec votre consentement.</p>
    
          </div>
        </div>
      </div>


      <!-- tab item -->
      <div class="tab-pane fade accordion-item" id="tab3" 
      role="tabpanel" aria-labelledby="tab3-tab">
        <h2 class="accordion-header" id="collapsehead3">
          <button class="accordion-button collapsed" type="button" 
          data-bs-toggle="collapse" data-bs-target="#collapse3"
            aria-expanded="true" aria-controls="collapse3">
            How do I add funds using MoonPay?
          </button>
        </h2>
        <div id="collapse3" class="accordion-collapse collapse " 
        aria-labelledby="collapsehead3"
          data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <h3>Puis-je consulter le profil des autres participants pour évaluer leur compatibilité ?</h3>
            <p>Absolument ! Consultez la liste des participants et explorez leurs profils pour voir leur secteur d'activité, leur expertise, et leurs attentes de partenariat.</p>
          </div>
        </div>
      </div>

      </div>
    </div>
  </div>
</div>




@endsection