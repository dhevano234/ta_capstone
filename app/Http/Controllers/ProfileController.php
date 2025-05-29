<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:15',
            'nomor_ktp' => 'required|string|max:16',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:500',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'nomor_ktp' => $request->nomor_ktp,
            'birth_date' => $request->birth_date,
            'address' => $request->address,
        ]);

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }
}
