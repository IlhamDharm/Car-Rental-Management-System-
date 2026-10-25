<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class GlobalSearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword = $request->input('q');

        $operator = (new Product)->getConnection()->getDriverName() === 'pgsql' ? 'ILIKE' : 'LIKE';

        // 1. Cari Produk berdasarkan nama, spesifikasi, tipe, lokasi, dll
        $products = Product::where('is_active', 1)
            ->where(function ($query) use ($keyword, $operator) {
                $query->where('name', $operator, "%{$keyword}%")
                    ->orWhere('sku', $operator, "%{$keyword}%")
                    ->orWhere('brand', $operator, "%{$keyword}%")
                    ->orWhere('model', $operator, "%{$keyword}%")
                    ->orWhere('transmission', $operator, "%{$keyword}%")
                    ->orWhere('fuel_type', $operator, "%{$keyword}%")
                    ->orWhere('location', $operator, "%{$keyword}%")
                    ->orWhere('type', $operator, "%{$keyword}%")
                    ->orWhere('description', $operator, "%{$keyword}%");

                // Cegah PostgreSQL casting error dengan hanya mencari integer pada kolom integer
                if (is_numeric($keyword)) {
                    $query->orWhere('capacity', (int) $keyword)
                        ->orWhere('price', '<=', (int) $keyword);
                }
            })
            ->get();

        // 2. Cek apakah keyword merujuk ke elemen/halaman website
        $websiteElements = [
            [
                'title' => 'Beranda (Home)',
                'description' => 'Kembali ke halaman utama website Adam Rental.',
                'url' => url('/'),
                'icon' => 'bi-house-door',
                'keywords' => ['beranda', 'home', 'utama', 'dashboard', 'adam', 'rental', 'depan'],
            ],
            [
                'title' => 'Katalog Produk (Sewa)',
                'description' => 'Lihat daftar mobil/produk yang tersedia untuk disewa dan lakukan filter.',
                'url' => url('/product'),
                'icon' => 'bi-car-front',
                'keywords' => ['product', 'produk', 'katalog', 'daftar', 'mobil', 'sewa', 'rent', 'sepatu', 'baju', 'stok', 'kendaraan', 'pilihan'],
            ],
            [
                'title' => 'Pembayaran (Payment)',
                'description' => 'Halaman informasi dan konfirmasi pembayaran sewa kendaraan.',
                'url' => url('/payment'),
                'icon' => 'bi-credit-card',
                'keywords' => ['payment', 'pembayaran', 'bayar', 'transaksi', 'checkout', 'sewa', 'rekening', 'bukti', 'tf'],
            ],
            [
                'title' => 'Profil Pengguna',
                'description' => 'Lihat dan ubah data diri, password, serta profil akun Anda.',
                'url' => url('/user/profile'),
                'icon' => 'bi-person-circle',
                'keywords' => ['profile', 'profil', 'akun', 'user', 'pengguna', 'edit profil', 'data diri', 'password', 'ganti sandi'],
            ],
            [
                'title' => 'Riwayat Sewa',
                'description' => 'Lihat daftar transaksi, tagihan, dan status riwayat pemesanan Anda.',
                'url' => url('/user/rental-history'),
                'icon' => 'bi-calendar-check',
                'keywords' => ['riwayat', 'history', 'sewa', 'transaksi', 'order', 'pesanan', 'booking', 'status', 'kembali'],
            ],
            [
                'title' => 'Login (Masuk)',
                'description' => 'Masuk ke akun Anda untuk melakukan booking sewa mobil.',
                'url' => url('/login'),
                'icon' => 'bi-box-arrow-in-right',
                'keywords' => ['login', 'masuk', 'sign in', 'signin', 'akun', 'password', 'email'],
            ],
            [
                'title' => 'Register (Daftar)',
                'description' => 'Daftar akun baru di Adam Rental untuk mulai bertransaksi.',
                'url' => url('/register'),
                'icon' => 'bi-person-plus',
                'keywords' => ['register', 'daftar', 'signup', 'sign up', 'buat akun', 'baru'],
            ],
        ];

        $matchedElements = [];
        if (! empty($keyword)) {
            foreach ($websiteElements as $element) {
                $matches = false;
                if (stripos($element['title'], $keyword) !== false || stripos($element['description'], $keyword) !== false) {
                    $matches = true;
                } else {
                    foreach ($element['keywords'] as $kw) {
                        if (stripos($kw, $keyword) !== false || stripos($keyword, $kw) !== false) {
                            $matches = true;
                            break;
                        }
                    }
                }
                if ($matches) {
                    $matchedElements[] = $element;
                }
            }
        }

        // 3. Cek apakah keyword merujuk ke fungsi website / Bantuan
        $helpTopics = [];
        if (! empty($keyword)) {
            if (stripos($keyword, 'cara booking') !== false || stripos($keyword, 'pesan') !== false || stripos($keyword, 'sewa') !== false) {
                $helpTopics[] = "Untuk melakukan booking, buka halaman Katalog Produk, pilih mobil, lalu klik tombol 'Booking Now'.";
            }
            if (stripos($keyword, 'bayar') !== false || stripos($keyword, 'payment') !== false || stripos($keyword, 'transfer') !== false) {
                $helpTopics[] = 'Pembayaran dapat dilakukan melalui halaman Pembayaran dengan mengunggah bukti transfer bank yang valid.';
            }
            if (stripos($keyword, 'syarat') !== false || stripos($keyword, 'ktp') !== false || stripos($keyword, 'sim') !== false) {
                $helpTopics[] = 'Penyewaan memerlukan dokumen berupa KTP dan SIM A aktif yang diunggah saat pemesanan.';
            }
        }

        return view('search.results', compact('products', 'keyword', 'matchedElements', 'helpTopics'));
    }
}
