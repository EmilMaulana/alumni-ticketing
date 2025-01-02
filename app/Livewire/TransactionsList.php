<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionsList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.transactions-list', [
            // Ambil transaksi berdasarkan user yang sedang login, urutkan dari yang terbaru dan paginate
            'transactions' => Transaction::where('user_id', Auth::id())->latest()->paginate(10),
        ]);
    }
}
