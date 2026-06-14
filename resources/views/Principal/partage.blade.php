@extends('layouts.master')
@section('content')

<div class="container mt-5">
    <h2 class="headingWh mb-4">Media for {{ $user->name }}</h2>

    <div class="row">
        <div class="col-md-12">
            <h3>Images</h3>
            <div class="row">
                @foreach($user->images as $image)
                    <div class="col-md-3 mb-4">
                    <img src="{{ asset('storage/' . $image->file_path) }}" class="img-fluid" alt="Image">
                    </div>
                @endforeach
            </div>

            <h3>Videos</h3>
            <div class="row">
                @foreach($user->videos as $video)
                    <div class="col-md-4 mb-4">
                        <video controls width="100%">
                        <source src="{{ asset('storage/' . $video->file_path) }}" type="video/mp4">
                        </video>
                    </div>
                @endforeach
            </div>

            <h3>PDFs</h3>
            <ul>
                @foreach($user->pdfs as $pdf)
                    <li> <a href="{{ asset('storage/' . $pdf->file_path) }}" target="_blank">{{ $pdf->file_name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection
