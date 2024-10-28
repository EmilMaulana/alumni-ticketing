<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Transaction;
use Livewire\WithPagination;

class TransactionsList extends Component
{
    use WithPagination;
    public function render()
    {
        return view('livewire.dashboard.transactions-list', [
            'transactions' => Transaction::with(['product', 'user'])->latest()->paginate(5)
        ]);
    }
}
