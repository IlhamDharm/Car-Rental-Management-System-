<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Pastikan ini di-import
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Halaman Profil User
    public function profile()
    {
        if (! Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }

        $user = Auth::user();

        return view('user.profile', compact('user')); // Perbaikan: Sesuaikan dengan nama view profile.blade.php Anda
    }

    // Update Profil User (Terbaru mendukung KTP, SIM, Alamat)
    public function updateProfile(Request $request)
    {
        /** @var User $user */ // 3. Type-hinting ini akan memaksa IDE mengenali method save()
        $user = auth()->user();

        // Validasi inputan form
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:500'],
            'alamat' => ['required', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'ktp_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'sim_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        // 1. Handle Upload Foto Profil
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo); // Hapus file lama jika ada
            }
            $user->photo = $request->file('photo')->store('profiles/photos', 'public');
        }

        // 2. Handle Upload KTPP
        if ($request->hasFile('ktp_file')) {
            if ($user->ktp_file) {
                Storage::disk('public')->delete($user->ktp_file);
            }
            $user->ktp_file = $request->file('ktp_file')->store('profiles/ktp', 'public');
        }

        // 3. Handle Upload SIM
        if ($request->hasFile('sim_file')) {
            if ($user->sim_file) {
                Storage::disk('public')->delete($user->sim_file);
            }
            $user->sim_file = $request->file('sim_file')->store('profiles/sim', 'public');
        }

        // Simpan data tekstual
        $user->name = $request->name;
        $user->bio = $request->bio;
        $user->alamat = $request->alamat;
        $user->save();

        return back()->with('success', 'Profil dan data verifikasi berhasil dilengkapi!');
    }

    // Riwayat Sewa User
    public function rentalHistory()
    {
        if (! Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu');
        }

        $user = Auth::user();
        // Menggunakan relasi product sesuai perbaikan sistem rental sebelumnya
        $bookings = Booking::where('user_id', $user->id)->with('product')->latest()->get();

        return view('user.rental-history', compact('user', 'bookings'));
    }
}
