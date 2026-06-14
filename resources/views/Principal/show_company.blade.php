@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/show_company.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/show_company.js') }}"></script>
@endpush

@section('content')


<!-- Authore Profile -->
<div class="authoreprofile authoSm mt-0 mt-md-5 pt-0 pt-md-2">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="authoreproimg">
        <div class="authoreproimgBox">
        <img class="img-fluid d-none d-md-block" src="{{asset('img/background_company.webp')}}" id="background" alt="img">
          
        </div>
          <div class="authoreproicon"><img class="img-fluid" src="{{ asset('storage/' . $user->profile_picture) }}" alt="img"></div>
        </div>
        <div class="auProfileDetail">
    
          <div class="prCnt">
            <h2 class="textwhitecolor">{{ $user->name }}</h2>
            <h3 class="textgraycolor mt-3 mb-4"><span class="textbluecolor">by {{ $user->nom_responsable }}</h3>
            <span class="textgraycolor"> {{ \Illuminate\Support\Str::words($user->description, 30) }}</span>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Article sec -->
<div class="articlesec">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="article-wrap">
         
          <div class="article-detail">
            <div class="tagbox mb-5 d-flex align-items-center justify-content-between">
              <!-- Contact Buttons: WhatsApp + Email side by side -->
              <div class="contact-buttons">
                @if($user->phone)
                  <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone) }}" target="_blank" class="greenbtn">
                    <i class="fab fa-whatsapp"></i> Send Message
                  </a>
                @endif
                @if($user->email)
                  <a href="mailto:{{ $user->email }}" class="greenbtn emailbtn">
                    <i class="fas fa-envelope"></i> Send Email
                  </a>
                @endif
              </div>
            </div>
            <h2 class="mb-4"> <span class="textbluecolor">About Company</span></h2>
            <p class="mb-4">{{$user->description }}</p>
            <h2 class="mb-4"> <span class="textbluecolor">Info Company</span></h2>
            <ul>
            <li class="textwhitecolor">Email : {{ $user->email}}</li>
              <li class="textwhitecolor">Phone : {{ $user->phone}}</li>
              <li class="textwhitecolor">Site Web : {{$user->site_web }} </li>
              <li class="textwhitecolor">Activites_Principales : {{$user->activites_principales }} </li>
              
              <li class="textwhitecolor">Address : {{$user->adresse }} </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Last Added Items -->
<div class="LastAddedItems mt-5 pt-3">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="headingWh mb-3 mb-sm-3 mb-md-4 mb-xl-4">Last Added Items Products</h2>
        <div class="lastAdded slider">
        @foreach ($products as $product)
          <div class="aboutitem">
            <div class="aboutitemImg"><img class="img-fluid" src="{{ asset('storage/' . $product->image) }}" alt="img" id="product"></div>
            <div class="bgdarkbluecolor aboutitemcnt">
              <div class="itemtitlecode">
                <h2 class="textgraycolor">{{ $product->title }}</h2>
                <h3 class="textwhitecolor">{{ $product->category->name }}</h3>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

@endsection