<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;
use App\Models\Category;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $categories = Category::all();
        $countries  = Country::all();

        return view('profile.edit', [
            'user'       => $request->user(),
            'categories' => $categories,
            'countries'  => $countries,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name'             => 'nullable|string|max:255',
            'email'            => 'nullable|string|email|max:255',
            'raison_social'    => 'nullable|string|max:255',
            'phone'            => 'nullable|string|max:15',
            'description'      => 'nullable|string|max:1000',
            'country_id'       => 'nullable|exists:countries,id',
            'category_id'      => 'nullable|exists:categories,id',
            'profile_picture'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'background_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();

        if ($request->filled('name'))          $user->name          = $request->name;
        if ($request->filled('email'))         $user->email         = $request->email;
        if ($request->filled('raison_social')) $user->raison_social = $request->raison_social;
        if ($request->filled('phone'))         $user->phone         = $request->phone;
        if ($request->filled('description'))   $user->description   = $request->description;
        if ($request->filled('country_id'))    $user->country_id    = $request->country_id;
        if ($request->filled('category_id'))   $user->category_id   = $request->category_id;

        if ($request->hasFile('profile_picture')) {
            // Delete old file if exists
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $user->profile_picture = $request->file('profile_picture')
                ->store('profile_pictures', 'public');
        }

        if ($request->hasFile('background_image')) {
            if ($user->background_image) {
                Storage::disk('public')->delete($user->background_image);
            }
            $user->background_image = $request->file('background_image')
                ->store('background_images', 'public');
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}