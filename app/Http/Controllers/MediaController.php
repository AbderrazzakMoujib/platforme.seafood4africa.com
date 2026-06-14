<?php

namespace App\Http\Controllers;

use App\Models\Pdf;
use App\Models\Image;
use App\Models\Audio;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    public function createPdf()
    {
        $pdfs = Pdf::with('user')->orderBy('created_at', 'desc')->get();
        return view('upload.pdf', compact('pdfs'));
    }

    public function storePdf(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file'  => 'required|mimes:pdf|max:10240',
        ]);

        $filePath = $request->file('file')->storeAs(
            'pdfs', \Str::random(40) . '.pdf', 'public'
        );

        Pdf::create([
            'title'     => $request->title,
            'file_path' => $filePath,
            'user_id'   => Auth::id(),
        ]);

        return redirect()->route('pdfs.create')->with('success', 'PDF uploaded successfully!');
    }

    public function createImage()
    {
        $images = Image::with('user')->orderBy('created_at', 'desc')->get();
        return view('upload.image', compact('images'));
    }

    public function storeImage(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file'  => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $file     = $request->file('file');
        $filePath = $file->storeAs(
            'images', \Str::random(40) . '.' . $file->getClientOriginalExtension(), 'public'
        );

        Image::create([
            'title'     => $request->title,
            'file_path' => $filePath,
            'user_id'   => Auth::id(),
        ]);

        return redirect()->route('images.create')->with('success', 'Image uploaded successfully!');
    }

    public function createAudio()
    {
        return view('upload.audio');
    }

    public function storeAudio(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file'  => 'required|mimes:mp3,wav|max:20480',
        ]);

        $file     = $request->file('file');
        $filePath = $file->storeAs(
            'audios', \Str::random(40) . '.' . $file->getClientOriginalExtension(), 'public'
        );

        Audio::create([
            'title'     => $request->title,
            'file_path' => $filePath,
            'user_id'   => Auth::id(),
        ]);

        return redirect()->route('audios.create')->with('success', 'Audio uploaded successfully!');
    }

    public function createVideo()
    {
        $videos = Video::with('user')->orderBy('created_at', 'desc')->get();
        return view('upload.video', compact('videos'));
    }

    public function storeVideo(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file'  => 'required|mimes:mp4,avi,mkv,mov|max:102400',
        ]);

        $file     = $request->file('file');
        $filePath = $file->storeAs(
            'videos', \Str::random(40) . '.' . $file->getClientOriginalExtension(), 'public'
        );

        Video::create([
            'title'     => $request->title,
            'file_path' => $filePath,
            'user_id'   => Auth::id(),
        ]);

        return redirect()->route('videos.create')->with('success', 'Video uploaded successfully!');
    }
}