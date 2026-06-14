@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/b2b.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/b2b.js') }}"></script>
@endpush

@section('content')

<!-- Popular collections -->
<div class="popularCollection mt-3 pt-3 mt-md-4 pt-md-4 mt-lg-5 pt-lg-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="headingWh mb-2 mb-md-4">Discover B2B Company</h2>

        {{-- Desktop Filters --}}
        <form method="GET" action="{{ route('b2b') }}">
          <div class="filters d-none d-md-block">
            <div class="filtertop">
              <div class="filterLeft">

                {{-- Category Filter --}}
                <div class="btn-group">
                  <select name="category_id" class="filterbtn form-select" onchange="this.form.submit()">
                    <option value="">All categories</option>
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}
                        class="textgraycolor">
                        {{ $category->name }}
                      </option>
                    @endforeach
                  </select>
                </div>

                {{-- Country Filter --}}
                <div class="btn-group">
                  <select name="country_id" class="filterbtn form-select" onchange="this.form.submit()">
                    <option value="">Country</option>
                    @foreach($countries as $country)
                      <option value="{{ $country->id }}"
                        {{ request('country_id') == $country->id ? 'selected' : '' }}
                        class="textgraycolor">
                        {{ $country->name }}
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

    {{-- Company Cards Grid --}}
    <div class="row mt-3 mt-md-5">
      @forelse($users as $user)
        <div class="col-12 col-sm-6 col-xl-3 mb-4 d-flex">
          <div class="creators">

            {{-- Background Image --}}
            <div class="creatorImg">
              @if($user->background_image)
                <img
                  src="{{ asset('storage/' . $user->background_image) }}"
                  alt="{{ $user->name }} cover"
                  loading="lazy"
                >
              @else
                {{-- Fallback si pas d'image --}}
                <div class="creatorImg-fallback"></div>
              @endif
            </div>

            {{-- Profile Logo + Badge --}}
            <div class="creatorIcon">
              <a href="{{ route('show_company', $user->id) }}">
                <img
                  src="{{ asset('storage/' . $user->profile_picture) }}"
                  alt="{{ $user->name }}"
                  loading="lazy"
                >
              </a>
              <div class="creatorcheck">
                <img src="{{ asset('img/checkicon.svg') }}" alt="verified">
              </div>
            </div>

            {{-- Company Info --}}
            <div class="creatorsText text-center">
              <h2 class="textwhitecolor" title="{{ $user->name }}">
                <a href="{{ route('show_company', $user->id) }}" class="textwhitecolor">
                  {{ $user->name }}
                </a>
              </h2>

              @if($user->nom_responsable)
                <h3 class="textbluecolor" title="{{ $user->nom_responsable }}">
                  {{ $user->nom_responsable }}
                </h3>
              @endif

              @if($user->description)
                <p class="textgraycolor">
                  {{ \Illuminate\Support\Str::limit($user->description, 80, '...') }}
                </p>
              @else
                <p class="textgraycolor">&nbsp;</p>
              @endif

              {{-- Products count badge --}}
              @if($user->products && $user->products->count() > 0)
                <div class="creator-stats">
                  <span class="creator-stat">
                    <i class="fas fa-box"></i>
                    {{ $user->products->count() }} Products
                  </span>
                </div>
              @endif
            </div>

          </div>
        </div>
      @empty
        <div class="col-12 text-center py-5">
          <p class="textgraycolor">No companies found.</p>
        </div>
      @endforelse
    </div>

    {{-- Pagination --}}
    <div class="pagination-links d-flex justify-content-center mt-4">
      {{ $users->links() }}
    </div>

    {{-- Mobile Filter Button --}}
    <div class="row d-block d-md-none mt-5">
      <div class="col-md-12 text-center">
        <button type="button" class="btn btnlightblue filterbtnsm"
          data-bs-toggle="modal" data-bs-target="#filterModal">
          Filter
        </button>
      </div>
    </div>

  </div>
</div>


{{-- Filter Modal for Mobile --}}
<div class="modal fade" id="filterModal" tabindex="-1"
     aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        <img src="{{ asset('img/closeicon.svg') }}" alt="close">
      </button>

      <div class="modal-body">
        <form method="GET" action="{{ route('b2b') }}">
          <div class="filters">
            <div class="filtertop">
              <div class="filterLeft">

                {{-- Category --}}
                <div class="mb-3">
                  <label for="category_id_mobile" class="form-label textwhitecolor">All Categories</label>
                  <select name="category_id" id="category_id_mobile" class="filterbtn form-select">
                    <option value="">All categories</option>
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                      </option>
                    @endforeach
                  </select>
                </div>

                {{-- Country --}}
                <div class="mb-3">
                  <label for="country_id_mobile" class="form-label textwhitecolor">Country</label>
                  <select name="country_id" id="country_id_mobile" class="filterbtn form-select">
                    <option value="">All Countries</option>
                    @foreach($countries as $country)
                      <option value="{{ $country->id }}"
                        {{ request('country_id') == $country->id ? 'selected' : '' }}>
                        {{ $country->name }}
                      </option>
                    @endforeach
                  </select>
                </div>

              </div>
            </div>

            <div class="filtertop text-center">
              <button type="submit" class="btn btnlightblue mb-3">Apply Filters</button>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

@endsection