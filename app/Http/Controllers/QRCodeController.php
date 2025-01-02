<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\Builder\Builder;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class QRCodeController extends Controller
{
    //
    public function download($orderId)
    {
        // Ambil data transaksi berdasarkan Order ID
        $transaction = Transaction::with(['product', 'user'])->where('order_id', $orderId)->firstOrFail();

        // Generate QR Code sebagai Base64 menggunakan Endroid QR Code
        $qrCode = Builder::create()
            ->data($transaction->order_id)
            ->size(300)
            ->margin(10)
            ->build();

        $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($qrCode->getString());

        // Load PDF view dengan data transaksi dan QR Code
        $pdf = Pdf::loadView('pdf.transaction', [
            'transaction' => $transaction,
            'qrCodeImage' => $qrCodeBase64,
        ]);

        // Nama file PDF
        $fileName = 'TRANSAKSI-' . $transaction->order_id . '.pdf';

        // Unduh file PDF
        return $pdf->download($fileName);

    }
}
