<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use App\Models\Country;
use App\Models\Category;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        $countries  = Country::all();
        $categories = Category::all();
        return view('auth.register', compact('countries', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'password'              => 'required|confirmed|min:8',
            'raison_social'         => 'nullable|string|max:255',
            'forme_juridique'       => 'nullable|string|max:255',
            'activites_principales' => 'nullable|string',
            'adresse'               => 'nullable|string|max:255',
            'fax'                   => 'nullable|string|max:255',
            'phone'                 => 'nullable|string|max:255',
            'site_web'              => 'nullable|string|max:255',
            'nom_responsable'       => 'nullable|string|max:255',
            'titre_responsable'     => 'nullable|string|max:255',
            'date_creation'         => 'nullable|date',
            'chiffre_affaire'       => 'nullable|string|max:255',
            'country_id'            => 'nullable|exists:countries,id',
            'category_id'           => 'nullable|exists:categories,id',
            'profile_picture'       => 'nullable|image|max:2048',
        ]);

        // Handle logo upload
        $logoPath = null;
        if ($request->hasFile('profile_picture')) {
            $logoPath = $request->file('profile_picture')
                ->store('profile_pictures', 'public');
        }

        $user = User::create([
            'name'                  => $request->name,
            'email'                 => $request->email,
            'password'              => Hash::make($request->password),
            'raison_social'         => $request->raison_social,
            'forme_juridique'       => $request->forme_juridique,
            'activites_principales' => $request->activites_principales,
            'adresse'               => $request->adresse,
            'fax'                   => $request->fax,
            'phone'                 => $request->phone,
            'site_web'              => $request->site_web,
            'nom_responsable'       => $request->nom_responsable,
            'titre_responsable'     => $request->titre_responsable,
            'date_creation'         => $request->date_creation,
            'chiffre_affaire'       => $request->chiffre_affaire,
            'country_id'            => $request->country_id,
            'category_id'           => $request->category_id,
            'profile_picture'       => $logoPath,
            'status'                => 'pending',
            'role'                  => 'user',
        ]);

        // Notify admin (silent fail if mail not configured)
        try {
            $adminEmail = env('ADMIN_EMAIL', 'admin@seafood4africa.com');
            Mail::raw(
                "New company registration:\n\nName: {$user->name}\nCompany: {$user->raison_social}\nEmail: {$user->email}\nPhone: {$user->phone}\n\nReview: " . url('/admin/pending-users'),
                function ($m) use ($adminEmail, $user) {
                    $m->to($adminEmail)
                      ->subject("New Registration: {$user->name} — Pending Approval");
                }
            );
        } catch (\Exception $e) {
            \Log::warning('Admin notification email failed: ' . $e->getMessage());
        }

        return redirect()->route('register.pending');
    }
}