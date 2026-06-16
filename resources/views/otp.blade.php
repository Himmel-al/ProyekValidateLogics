<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi OTP - Matematika Diskrit</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        h2 {
            color: #1e293b;
            font-size: 22px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .simulasi-box {
            background-color: #e0f2fe;
            border: 1px dashed #0284c7;
            color: #0369a1;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 24px;
            font-weight: 500;
        }

        .simulasi-box strong {
            font-size: 16px;
            letter-spacing: 1px;
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

        input[type="text"] {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            font-size: 16px;
            text-align: center;
            letter-spacing: 4px;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
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
            transition: background-color 0.2s ease;
        }

        button:hover {
            background-color: #2563eb;
        }

        .error-box {
            background-color: #fef2f2;
            border-left: 4px solid #ef4444;
            color: #991b1b;
            padding: 12px;
            border-radius: 4px;
            font-size: 13px;
            margin-top: 16px;
            text-align: left;
        }
    </style>
</head>
<body>

    <div class="card">
        <h2>Otentikasi Dua Faktor</h2>
        <div class="subtitle">Sistem Validasi Login (SuperAdmin)</div>

        @if(session('info'))
            <div class="simulasi-box">
                {{ str_replace(strrchr(session('info'), ':'), '', session('info')) }}
                <br>
                <strong>{{ substr(session('info'), -6) }}</strong>
            </div>
        @endif

        <form action="{{ route('otp.proses') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="otp_input">Masukkan 6 Digit OTP (Proposisi $s$):</label>
                <input type="text" id="otp_input" name="otp_input" maxlength="6" placeholder="000000" autocomplete="off" required>
            </div>
            <button type="submit">Verifikasi Proposisi</button>
        </form>

        @if($errors->any())
            <div class="error-box">
                {{ $errors->first() }}
            </div>
        @endif
    </div>

</body>
</html>
