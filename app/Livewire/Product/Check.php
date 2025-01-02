<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Check as ModelCheck;

class Check extends Component
{
    public $selectedProduct = ''; // Filter produk
    public $search = ''; // Pencarian Order ID

    public function updateStatus($transactionId, $status)
    {
        $transaction = Transaction::find($transactionId);

        // Cek apakah transaksi memiliki relasi dengan 'attendance'
        $attendance = $transaction->attendance; // Perhatikan penggunaan 'attendance' sebagai relasi

        // Jika belum ada relasi attendance, buat baru
        if (!$attendance) {
            $attendance = new ModelCheck(); // Ganti Check dengan Attendance jika nama model diubah
            $attendance->transaction_id = $transactionId;
        }

        // Perbarui status kehadiran
        $attendance->is_checked = ($status === 'hadir');
        $attendance->save();
    }


    public function render()
    {
        $query = Transaction::with(['product', 'user', 'check'])->latest();

        // Filter berdasarkan produk
        if ($this->selectedProduct) {
            $query->where('product_id', $this->selectedProduct);
        }

        // Filter berdasarkan pencarian Order ID
        if (!empty($this->search)) {
            $query->where('order_id', 'like', '%' . $this->search . '%');
        }

        return view('livewire.product.check', [
            'transactions' => $query->paginate(5),
            'products' => Product::all(), // Untuk dropdown filter
        ]);
    }
}
