<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow-lg border-0" style="width: 450px;">
        <div class="card-body p-4">

            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">
                    Verifikasi Email
                </h2>

                <p class="text-muted">
                    Masukkan email untuk menerima kode verifikasi
                </p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('email.kirim') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">
                        Alamat Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="contoh@gmail.com"
                        required>
                </div>

                <button
                    type="submit"
                    class="btn btn-primary w-100">
                    Kirim Kode Verifikasi
                </button>
            </form>

        </div>
    </div>
</div>

</body>
</html>
