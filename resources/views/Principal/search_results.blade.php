@extends('layouts.master')
@section('content')

@if($users->isEmpty() && $products->isEmpty())
    <p>No users or products found.</p>
@endif

<!-- Display matched users and their products -->
@if(!$users->isEmpty())
    <div class="popularCollection mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="headingWh mb-4">Search Results for "{{ $query }}"</h2>
                    <div class="tab-sec">
                        <div class="popular slider">
                            @foreach($users as $user)
                                <div class="creators">
                                    <div class="creatorImg">
                                        <img class="img-fluid" id="img-fluid" src="{{ asset('storage/' . $user->background_image) }}" alt="img">
                                    </div>
                                    <div class="creatorIcon">
                                        <a href="{{ route('show_company', $user->id) }}" class="textwhitecolor">
                                            <img class="img-fluid" id="profile" src="{{ asset('storage/' . $user->profile_picture) }}" alt="img">
                                        </a>
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">
                                            <a href="{{ route('show_company', $user->id) }}" class="textwhitecolor">{{ $user->name }}</a>
                                        </h2>
                                        <h3 class="textbluecolor">{{ $user->nom_responsable }}</h3>
                                        <p class="textgraycolor">{{ \Illuminate\Support\Str::words($user->description, 20, '...') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Display matched products -->
@if(!$products->isEmpty())
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
                                        @foreach($products as $product)
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
@endif

@endsection
