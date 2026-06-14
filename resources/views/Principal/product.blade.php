@extends('layouts.master')
@section('content')

<div class="popularCollection mt-3 pt-3 mt-md-4 pt-md-4 mt-lg-5 pt-lg-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="headingWh mb-2 mb-md-4">Discover Products</h2>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('product') }}">
          <div class="filters d-none d-md-block">
            <div class="filtertop">
              <div class="filterLeft">
                <div class="btn-group">
                  <select name="category_id" class="filterbtn form-select" onchange="this.form.submit()">
                    <option value="">All categories</option>
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }} class="textgraycolor">
                        {{ $category->name }}
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

<!-- Top sellers -->
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

@endsection
