<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Transaction;
use App\Models\Check as ModelCheck;
use App\Models\Product;
use App\Models\User;
use Livewire\WithPagination;

class Kehadiran extends Component
{
    use WithPagination;

    public $selectedProduct = '';
    public $search = '';
    public $selectedJurusan = '';
    public $selectedAngkatan = '';
    public $isScanned = false;
    public $scannedTransactions = [];
    public $showModal = false;
    public $scannedBarcode = '';
    public $totalUsers;
    public $totalHadir;
    public $tidakHadir;
    

    protected $listeners = [
        'barcodeScanned' => 'handleBarcodeScanned',
        'closeModal' => 'closeModal'
    ];

    public function handleBarcodeScanned($barcode)
    {
        $this->scannedBarcode = '';
        $this->scannedTransactions = [];
        $this->scannedBarcode = $barcode;
        $this->search = $barcode;
        
        // Search for transactions with the scanned barcode
        $transactions = Transaction::with(['product', 'user', 'check'])
            ->where('order_id', 'like', '%' . $barcode . '%');

        // Apply existing filters to scanned results
        if ($this->selectedProduct) {
            $transactions->where('product_id', $this->selectedProduct);
        }

        if ($this->selectedJurusan) {
            $transactions->whereHas('user', function ($q) {
                $q->where('jurusan', $this->selectedJurusan);
            });
        }

        if ($this->selectedAngkatan) {
            $transactions->whereHas('user', function ($q) {
                $q->where('angkatan', $this->selectedAngkatan);
            });
        }

        $this->scannedTransactions = $transactions->get();
        $this->isScanned = true;
        $this->showModal = true;
        
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->isScanned = false;
        $this->scannedTransactions = [];
        $this->scannedBarcode = '';
        $this->resetPage();
    }

    public function refresh()
    {
        $this->scannedTransactions = [];
        $this->scannedBarcode = '';
        $this->resetPage();
    }

    public function updateStatus($transactionId, $status)
    {
        $transaction = Transaction::find($transactionId);

        if ($transaction) {
            // Cari apakah data check sudah ada untuk transaksi ini
            $check = $transaction->check()->first();

            if ($check) {
                // Jika data sudah ada, update status
                $check->update([
                    'is_checked' => $status === 'hadir',
                ]);
            } else {
                // Jika belum ada, buat data baru
                $transaction->check()->create([
                    'is_checked' => $status === 'hadir',
                ]);
            }

            // Refresh scanned transactions if in modal
            if ($this->isScanned && $this->scannedBarcode) {
                $this->handleBarcodeScanned($this->scannedBarcode);
            }

            // Show success message
            session()->flash('message', 'Status kehadiran berhasil diperbarui.');
        }

        $this->scannedTransactions = [];
    }


    public function mount()
    {
        $this->totalUsers = Transaction::where('status', 'success')->count();
        $this->totalHadir = Transaction::whereHas('check', function ($query) {
            $query->where('is_checked', true);
        })->count();
        $this->tidakHadir = Transaction::whereHas('check', function ($query) {
            $query->where('is_checked', false);
        })->count();
    

        $this->resetPage();
    }

    public function render()
    {
        $query = Transaction::with(['product', 'user', 'check'])->latest();

        if ($this->selectedProduct) {
            $query->where('product_id', $this->selectedProduct);
        }

        if (!empty($this->search)) {
            $query->where('order_id', 'like', '%' . $this->search . '%');
        }

        if (!empty($this->selectedJurusan)) {
            $query->whereHas('user', function ($q) {
                $q->where('jurusan', $this->selectedJurusan);
            });
        }

        if (!empty($this->selectedAngkatan)) {
            $query->whereHas('user', function ($q) {
                $q->where('angkatan', $this->selectedAngkatan);
            });
        }

        return view('livewire.product.kehadiran', [
            'transactions' => $query->paginate(15),
            'products' => Product::all(),
            'jurusans' => User::select('jurusan')->distinct()->get(),
            'angkatans' => User::select('angkatan')->distinct()->get(),

        ]);
    }
}