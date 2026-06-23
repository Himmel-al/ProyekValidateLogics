<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Login Diskrit</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .hero-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .1);
        }

        .status-success {
            color: #198754;
            font-size: 50px;
        }

        .truth-value-true {
            color: #198754;
            font-weight: bold;
        }

        .truth-value-false {
            color: #dc3545;
            font-weight: bold;
        }

        .formula-box {
            background: #eef7ff;
            border-left: 5px solid #0d6efd;
            padding: 15px;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <div class="container py-5">

        <div class="card hero-card mb-4">
            <div class="card-body text-center p-5">

                <div class="status-success">
                    ✓
                </div>

                <h1 class="fw-bold text-success">
                    Login Berhasil Ter-validasi
                </h1>

                <p class="fs-5">
                    Selamat datang,
                    <strong>{{ auth()->user()->username }}</strong>
                </p>

                <a href="{{ route('logout') }}" class="btn btn-danger mt-2">
                    Logout
                </a>

            </div>
        </div>

        <div class="row">

            <div class="col-md-8">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            Analisis Validasi Login
                        </h5>
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Variabel</th>
                                    <th>Keterangan</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>p</td>
                                    <td>Username ditemukan</td>
                                    <td class="text-success fw-bold">TRUE</td>
                                </tr>
                                <tr>
                                    <td>q</td>
                                    <td>Password benar</td>
                                    <td class="text-success fw-bold">TRUE</td>
                                </tr>
                                <tr>
                                    <td>r</td>
                                    <td>Email terverifikasi</td>
                                    <td class="text-success fw-bold">TRUE</td>
                                </tr>
                                <tr>
                                    <td>s</td>
                                    <td>Akun aktif</td>
                                    <td class="text-success fw-bold">TRUE</td>
                                </tr>
                                <tr>
                                    <td>t</td>
                                    <td>OTP terverifikasi</td>
                                    <td class="text-success fw-bold">TRUE</td>
                                </tr>
                                <tr class="table-success fw-bold">
                                    <td colspan="2"> p ∧ q ∧ r ∧ s ∧ t </td>
                                    <td> TRUE </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

            <div class="col-md-4">

                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        Formula Login
                    </div>

                    <div class="card-body">

                        <div class="formula-box">

                            <h4 class="text-center">
                                p ∧ q ∧ r ∧ s ∧ t
                            </h4>

                            <hr>

                            <p><b>p</b> = Username ditemukan</p>
                            <p><b>q</b> = Password benar</p>
                            <p><b>r</b> = Email terverifikasi</p>
                            <p><b>s</b> = Akun status aktif</p>
                            <p><b>t</b> = OTP Valid</p>


                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="card shadow-sm mt-4">
            <div class="card-header bg-dark text-white">
                Kesimpulan Analisis
            </div>

            <div class="card-body">

                <p>
                    Sistem login menggunakan logika konjungsi (AND) dengan formula:
                </p>

                <h4 class="text-center">
                    p ∧ q ∧ r ∧ s ∧ t
                </h4>

                <p class="mt-3">
                    Login hanya berhasil apabila username ditemukan,
                    password benar, email telah diverifikasi,
                    akun aktif, dan OTP berhasil diverifikasi.
                    Jika salah satu kondisi bernilai FALSE,
                    maka hasil akhir validasi login adalah FALSE.
                </p>

            </div>
        </div>

    </div>

</body>

</html>
