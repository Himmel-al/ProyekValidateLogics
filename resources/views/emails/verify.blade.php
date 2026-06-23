<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body style="
font-family: Arial, sans-serif;
background:#f5f5f5;
padding:40px;
text-align:center;
">

    <div
        style="
max-width:600px;
margin:auto;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 2px 10px rgba(0,0,0,.1);
">

        <h2 style="color:#0d6efd;">
            Verifikasi Email
        </h2>

        <p>
            Terima kasih telah mendaftar.
            Klik tombol berikut untuk memverifikasi email Anda.
        </p>

        <br>

        <button> <a href="{{ $link }}"
                style="
       background:#0d6efd;
       color:white;
       padding:15px 25px;
       text-decoration:none;
       border-radius:8px;
       display:inline-block;
       font-weight:bold;
       ">
                Verifikasi Email
            </a></button>

        <br><br>

        <p style="color:gray;font-size:14px;">
            Jika tombol tidak berfungsi, salin link berikut:
        </p>

        <small>
            {{ $link }}
        </small>

    </div>

</body>

</html>
