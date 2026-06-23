<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minta Kode OTP - Matematika Diskrit</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', serif;
        }

        body {
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        h2 {
            color: #1e293b;
            font-size: 20px;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #475569;
            font-size: 14px;
            font-weight: 500;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
        }

        button {
            width: 100%;
            background-color: #3b82f6;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background-color: #2563eb;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2>Metode Pengiriman OTP</h2>
        <form action="{{ route('otp.proses_minta_email') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Silakan masukkan alamat email Anda untuk menerima kode OTP berlapis:</label>
                <input type="email" name="email_tujuan" placeholder="kamu@gmail.com" required autocomplete="off">
            </div>
            <button type="submit">Kirim Kode OTP (Email Asli)</button>
        </form>
    </div>
</body>

</html>
