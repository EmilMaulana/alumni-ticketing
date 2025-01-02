<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;
use App\Models\Product;

class TransactionsList extends Component
{
    use WithPagination;
    public $search = '';
    public $selectedProduct = ''; // Menyimpan produk yang dipilih
    public $availableProducts = []; // Daftar produk untuk dropdown

    public function mount()
    {
        // Mengambil daftar produk dari database
        $this->availableProducts = Product::pluck('name', 'id'); // Ambil nama dan ID produk
    }

    public function render()
    {
        $query = Transaction::with(['product', 'user'])->latest();

        // Filter berdasarkan produk jika dipilih
        if ($this->selectedProduct) {
            $query->where('product_id', $this->selectedProduct);
        }

        // Filter berdasarkan pencarian Order ID
        if (!empty($this->search)) {
            $query->where('order_id', 'like', '%' . $this->search . '%');
        }

        return view('livewire.dashboard.transactions-list', [
            'transactions' => $query->paginate(10),
        ]);
    }
}
