<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if (! Auth::check()) {
            return redirect('/login')
                ->with('warning', 'Anda wajib login terlebih dahulu.');
        }

        if (! Auth::user()->ktp_file || ! Auth::user()->sim_file) {
            return redirect()->route('user.profile')
                ->with('warning', 'Silakan lengkapi unggah data KTP dan SIM Anda terlebih dahulu sebelum melakukan penyewaan.');
        }

        $productId = $request->input('product_id');

        // 1. Tangkap tanggal dari URL
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if (! $productId) {
            return redirect('/product')->with('warning', 'Mobil belum dipilih untuk disewa.');
        }

        $product = Product::findOrFail($productId);

        return view('payment.index', [
            'product' => $product,
            // 2. Kirim ke View
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function store(Request $request)
    {
        if (! Auth::check()) {
            return redirect('/login')
                ->with('warning', 'Anda wajib login terlebih dahulu.');
        }

        if (! Auth::user()->ktp_file || ! Auth::user()->sim_file) {
            return redirect()->route('user.profile')
                ->with('warning', 'Silakan lengkapi data KTP dan SIM Anda terlebih dahulu.');
        }

        $validated = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_contact' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email'],
            'alamat' => ['nullable', 'string'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'pickup_location' => ['nullable', 'string'],
            'pickup_method' => ['nullable', 'string'],
            'return_method' => ['nullable', 'string'],
            'source_info' => ['nullable', 'string'],
            'payment_method' => ['required', 'string'],
            'agree_terms' => ['accepted'], // Validasi backend wajib centang terms
        ]);

        $product = Product::findOrFail($validated['product_id']);

        $startDate = new \DateTime($validated['start_date']);
        $endDate = new \DateTime($validated['end_date']);
        $duration = $startDate->diff($endDate)->days;

        if ($duration <= 0) {
            $duration = 1;
        }

        $totalPrice = $duration * $product->price;

        Booking::create([
            'user_id' => auth()->id(),
            'product_id' => $validated['product_id'],
            'customer_name' => $validated['customer_name'],
            'customer_contact' => $validated['customer_contact'],
            'email' => $validated['email'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_price' => $totalPrice,
            'pickup_location' => $validated['pickup_location'] ?? null,
            'pickup_method' => $validated['pickup_method'] ?? null,
            'return_method' => $validated['return_method'] ?? null,
            'source_info' => $validated['source_info'] ?? null,
            'payment_method' => $validated['payment_method'],
            'status' => 'pending',
        ]);

        return redirect()->route('user.rental-history')
            ->with('success', 'Booking berhasil dibuat! Silahkan tunggu konfirmasi admin.');
    }
}
