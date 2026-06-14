<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function sendEmail(Request $request, User $user)
    {
        $request->validate(['message' => 'required|string']);

        try {
            Mail::raw($request->message, function ($m) use ($user, $request) {
                $m->to($user->email)
                  ->subject($request->input('subject', 'Message from SeaFood4Africa'))
                  ->from(config('mail.from.address'), config('mail.from.name'));
            });
            return back()->with('success', "Email sent to {$user->name} ({$user->email}).");
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function editUser(User $user)
    {
        $countries = Country::orderBy('name')->get();
        return view('admin.edit_user', compact('user', 'countries'));
    }

    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'phone'    => 'nullable|string|max:50',
            'raison_social' => 'nullable|string|max:255',
            'status'   => 'required|in:pending,approved',
            'role'     => 'required|in:user,admin',
            'country_id' => 'nullable|exists:countries,id',
        ]);

        $user->update($request->only('name', 'email', 'phone', 'raison_social', 'status', 'role', 'country_id'));

        return redirect()->route('tables_users')->with('success', "User {$user->name} updated successfully.");
    }

    public function pendingUsers()
    {
        $users = User::where('status', 'pending')->with('country')->latest()->get();
        return view('admin.pending_users', compact('users'));
    }

    public function approveUser(User $user)
    {
        $user->update(['status' => 'approved']);

        Mail::raw(
            "Hello {$user->name},\n\nYour registration on SeaFood4Africa platform has been approved.\n\nYou can now log in at: " . url('/login'),
            function ($m) use ($user) {
                $m->to($user->email)->subject('Your account has been approved — SeaFood4Africa');
            }
        );

        return back()->with('success', "User {$user->name} approved and notified by email.");
    }

    public function rejectUser(User $user)
    {
        $email = $user->email;
        $name  = $user->name;
        $user->delete();

        Mail::raw(
            "Hello {$name},\n\nUnfortunately your registration request on SeaFood4Africa platform was not approved at this time.\n\nFor more information, please contact us.",
            function ($m) use ($email, $name) {
                $m->to($email)->subject('Registration update — SeaFood4Africa');
            }
        );

        return back()->with('success', "User {$name} rejected and removed.");
    }
}
