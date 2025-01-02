<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket - {{ $transaction->user->name }}</title>
    <!-- Importing Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 200px;
            margin-bottom: 15px;
        }

        .header h2 {
            color: #0077b6;
            
        }

        .qr-code {
            text-align: center;
            margin: 20px 0;
        }

        .qr-code img {
            width: 150px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .transaction-details {
            margin-top: 20px;
        }

        .transaction-details h2 {
            color: #0077b6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
        }

        table th {
            background-color: #f8f8f8;
            color: #555;
        }

        table td {
            background-color: #ffffff;
            color: #444;
        }

        .highlight {
            font-weight: bold;
            color: #0077b6;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }

        .cta {
            text-align: center;
            margin-top: 30px;
        }

        .cta a {
            padding: 12px 25px;
            background-color: #0077b6;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 50px;
            transition: background-color 0.3s ease;
        }

        .cta a:hover {
            background-color: #005f8c;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="images/weone-dark.png" alt="Logo">
            <h2>E-TIKET TRANSAKSI</h2>
        </div>

        <!-- QR Code -->
        <div class="qr-code">
            <img src="{{ $qrCodeImage }}" alt="QR Code">
        </div>

        <!-- Transaction Details -->
        <div class="transaction-details">
            <h2>Detail Transaksi</h2>
            <table>
                <tr>
                    <th>Order ID</th>
                    <td class="highlight">{{ $transaction->order_id }}</td>
                </tr>
                <tr>
                    <th>Nama Agenda</th>
                    <td>{{ $transaction->product->name }}</td>
                </tr>
                <tr>
                    <th>Nama Pengguna</th>
                    <td>{{ $transaction->user->name }}</td>
                </tr>
                <tr>
                    <th>Jurusan</th>
                    <td>{{ $transaction->user->jurusan }}</td>
                </tr>
                <tr>
                    <th>Angkatan</th>
                    <td>{{ $transaction->user->angkatan }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih telah mempercayai layanan kami.</p>
            <p>© {{ date('Y') }} Teknik Rekayasa. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>
