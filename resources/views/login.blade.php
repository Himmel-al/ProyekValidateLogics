<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Home Server - Login</title>
    <style>
        /* RESET DASAR agar tampilan konsisten di semua browser */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Font modern */
        }

        body {
            background-color: #f0f2f5; /* Warna background abu-abu muda yang bersih */
            display: flex;
            justify-content: center; /* Pusat horizontal */
            align-items: center;     /* Pusat vertikal */
            min-height: 100vh;       /* Tinggi penuh layar */
        }

        /* DESAIN KARTU UTAMA (CARD) */
        .login-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px; /* Sudut tumpul yang modern */
            box-shadow: 0 10px 25px rgba(0,0,0,0.05); /* Bayangan halus */
            width: 100%;
            max-width: 400px; /* Lebar maksimal kartu */
            text-align: center;
        }

        /* JUDUL */
        .login-card h2 {
            color: #1a1a1a;
            font-size: 24px;
            margin-bottom: 30px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        /* CONTAINER FORM */
        .form-group {
            text-align: left; /* Label teks rata kiri */
            margin-bottom: 20px;
        }

        /* LABEL (p) dan (q) */
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #4b5563; /* Warna abu-abu gelap untuk teks label */
            font-size: 14px;
            font-weight: 500;
        }

        /* DESAIN INPUT BOX */
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e5e7eb; /* Border halus */
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.2s ease; /* Animasi saat diklik */
            background-color: #f9fafb;
        }

        /* Efek saat Input diklik (Focus) */
        .form-group input:focus {
            outline: none;
            border-color: #3b82f6; /* Warna biru Laravel/Tailwind */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); /* Efek glow biru */
            background-color: #ffffff;
        }

        /* DESAIN TOMBOL */
        .btn-submit {
            width: 100%;
            background-color: #2563eb; /* Biru gelap */
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 10px;
        }

        /* Efek Tombol saat di-hover */
        .btn-submit:hover {
            background-color: #1d4ed8;
        }

        /* GAYA UNTUK PESAN ERROR (Jika ada) */
        .error-message {
            color: #ef4444;
            background-color: #fef2f2;
            padding: 10px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 20px;
            border: 1px solid #fee2e2;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>Portal Home Server</h2>

        {{-- Menampilkan pesan error dari Laravel (p=false, q=false, dll) --}}
        @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.proses') }}" method="POST">
            @csrf

            {{-- Input Username (p) --}}
            <div class="form-group">
                <label for="username">Username (p):</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required autocomplete="off">
            </div>

            {{-- Input Password (q) --}}
            <div class="form-group">
                <label for="password">Password (q):</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" class="btn-submit">Evaluasi Login</button>
        </form>
    </div>

</body>
</html>
