<form method="POST" action="{{ route('email.kirim') }}">
    @csrf

    <h2>Verifikasi Email</h2>

    <input
        type="email"
        name="email"
        placeholder="Masukkan Email"
        required>

    <button type="submit">
        Kirim Kode Verifikasi
    </button>
</form>
