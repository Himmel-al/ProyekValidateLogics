<form method="POST" action="{{ route('email.verify') }}">
    @csrf

    <h2>Masukkan Kode Verifikasi Email</h2>

    <input
        type="text"
        name="otp_input"
        placeholder="6 Digit Kode"
        required>

    <button type="submit">
        Verifikasi Email
    </button>
</form>
