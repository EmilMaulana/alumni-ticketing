<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Verifikasi Email</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: white;
            text-align: center;
            padding: 20px;
        }
        .header img {
            max-width: 150px;
            height: auto;
        }
        .container {
            background-color: white;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .content {
            text-align: left;
            margin-bottom: 20px;
        }
        .content h1 {
            color: #333;
            font-size: 24px;
        }
        .button {
            display: inline-block;
            background-color: #6525CE;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .footer {
            background-color: #6525CE;
            text-align: center;
            padding: 20px;
            font-size: 12px;
            color: white;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="https://teknikrekayasa.com/images/logos/logo.png" alt="teknikrekayasa" style="max-width: 300px; margin-top: 10px;">
    </div>
    
    <div class="container">
        <h2>Verifikasi Alamat Email kamu</h2>
        <p>Terima kasih telah mendaftar! </p>
        <p>Untuk memverifikasi alamat email kamu, silakan klik tombol di bawah ini:</p>
        <a href="{{ $url }}" class="button">Verifikasi Email</a>
        <p>Jika kamu tidak mendaftar, kamu tidak perlu melakukan tindakan apa pun.</p>
        <p>Jaga keamanan akun kamu dengan tidak membagikan link verifikasi kepada siapa pun, termasuk staf kami.</p>
        <br>
        <p>Terima kasih telah menggunakan platform Teknik Rekayasa.</p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} TEKNIK REKAYASA. Semua hak dilindungi Undang-Undang.</p>
    </div>
</body>
</html>
