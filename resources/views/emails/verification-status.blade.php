<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Verifikasi Akun - Adam Rental</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        .header {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            padding: 30px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .content {
            padding: 40px 30px;
            color: #1f2937;
            line-height: 1.6;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .status-box {
            padding: 20px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 30px;
            display: inline-block;
        }
        .status-approved {
            background-color: #d1fae5;
            color: #065f46;
            border-left: 5px solid #10b981;
        }
        .status-rejected {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 5px solid #ef4444;
        }
        .reason-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            font-style: italic;
            color: #4b5563;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 20px;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2);
        }
        .footer {
            background-color: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
            border-top: 1px solid #f3f4f6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Adam Rental</h1>
        </div>
        <div class="content">
            <div class="greeting">Halo, {{ $user->name }}!</div>
            
            @if ($status === 'approved')
                <div class="status-box status-approved">
                    ✓ AKUN ANDA TELAH DISETUJUI
                </div>
                <p>Selamat! Dokumen KTP, SIM A, dan alamat Anda telah diperiksa dan disetujui oleh tim kami. Akun Anda sekarang telah aktif sepenuhnya.</p>
                <p>Anda sudah bisa masuk ke website kami dan melakukan reservasi mobil impian Anda sekarang juga.</p>
                
                <div style="text-align: center;">
                    <a href="{{ url('/login') }}" class="btn" style="color: #ffffff;">Mulai Sewa Mobil</a>
                </div>
            @else
                <div class="status-box status-rejected">
                    ✗ VERIFIKASI AKUN DITOLAK
                </div>
                <p>Mohon maaf, dokumen KTP atau SIM A yang Anda unggah saat pendaftaran tidak dapat kami setujui karena belum memenuhi kriteria kelayakan kami.</p>
                
                @if ($reason)
                    <p><strong>Alasan Penolakan:</strong></p>
                    <div class="reason-box">
                        "{{ $reason }}"
                    </div>
                @endif

                <p>Silakan daftar ulang dengan mengunggah foto KTP dan SIM A yang lebih jelas dan terbaca secara detail, atau hubungi pusat layanan kami jika Anda merasa ini adalah kekeliruan.</p>
            @endif
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Adam Rental. Hak Cipta Dilindungi.
        </div>
    </div>
</body>
</html>
