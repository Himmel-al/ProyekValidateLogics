<!DOCTYPE html>
<html>
<head>
    <title>Kode OTP Anda</title>
</head>
<body style="font-family: sans-serif; text-align: center; color: #333;">
    <div style="padding: 30px; background: #f4f6f9; border-radius: 10px;">
        <h2>Portal Home Server</h2>
        <p>Anda sedang mencoba masuk.</p>
        <p>Silakan gunakan kode OTP di bawah ini untuk verifikasi:</p>
        <div style="background: #ffffff; padding: 20px; font-size: 32px; font-weight: bold; color: #3b82f6; display: inline-block; border-radius: 8px; letter-spacing: 3px; margin: 20px 0;">
            {{ $otp }}
        </div>
        <p style="font-size: 13px; color: #777;">Kode ini berlaku selama 5 menit.</p>
    </div>
</body>
</html>
