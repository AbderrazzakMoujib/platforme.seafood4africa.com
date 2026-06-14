@extends('layouts.master')

<style>
    .card {
    border: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-title {
    font-size: 1rem;
    font-weight: bold;
    color: #333;
}

.card-text {
    font-size: 0.9rem;
    color: #666;
}

.btn-primary {
    background-color: #007bff;
    border: none;
    border-radius: 5px;
}

</style>
@section('content')

<div class="container mt-5">
    <h2 class="headingWh mb-4">BEST PRACTICES EXCHANGE BY {{ $country->name }}</h2>
    
    <!-- Tabs for Categories -->
    <ul class="nav nav-tabs" id="mediaTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab" aria-controls="images" aria-selected="true">
                Images
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos" type="button" role="tab" aria-controls="videos" aria-selected="false">
                Videos
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pdfs-tab" data-bs-toggle="tab" data-bs-target="#pdfs" type="button" role="tab" aria-controls="pdfs" aria-selected="false">
                PDFs
            </button>
        </li>
    </ul>
    
    <!-- Tab Content -->
    <div class="tab-content mt-4" id="mediaTabsContent">
        <!-- Images Tab -->
        <div class="tab-pane fade show active" id="images" role="tabpanel" aria-labelledby="images-tab">
            <div class="row">
                @forelse ($users as $user)
                    @foreach ($user->images as $image)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="{{ asset('storage/' . $image->file_path) }}" class="card-img-top" alt="Image" width="250px" height="250px">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $image->title }}</h6>
                                    <p class="card-text">{{ $user->name }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @empty
                    <p class="text-center">No images available for this country.</p>
                @endforelse
            </div>
        </div>

        <!-- Videos Tab -->
        <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
            <div class="row">
                @forelse ($users as $user)
                    @foreach ($user->videos as $video)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <video controls class="card-img-top">
                                    <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                                </video>
                                <div class="card-body">
                                    <h6 class="card-title">{{ $video->title }}</h6>
                                    <p class="card-text">{{ $user->name }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @empty
                    <p class="text-center">No videos available for this country.</p>
                @endforelse
            </div>
        </div>

        <!-- PDFs Tab -->
        <div class="tab-pane fade" id="pdfs" role="tabpanel" aria-labelledby="pdfs-tab">
            <div class="row">
                @forelse ($users as $user)
                    @foreach ($user->pdfs as $pdf)
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">{{ $pdf->title }}</h6>
                                    <p class="card-text">{{ $user->name }}</p>
                                    <a href="{{ asset('storage/' . $pdf->file_path) }}" target="_blank" class="btn btn-primary btn-sm">View PDF</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @empty
                    <p class="text-center">No PDFs available for this country.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
