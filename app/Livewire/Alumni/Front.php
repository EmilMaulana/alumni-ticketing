<?php

namespace App\Livewire\Alumni;

use Livewire\Component;
use App\Models\User;

class Front extends Component
{
    public $search = ''; // Properti untuk pencarian
    public $angkatan = ''; // Properti untuk pencarian
    public $jurusan = ''; // Properti untuk pencarian
    public $availableYears = [];
    public $availableMajors = [];

    public function mount()
    {
        // Ambil daftar angkatan unik dari tabel users
        $this->availableYears = User::select('angkatan')->distinct()->orderBy('angkatan', 'desc')->pluck('angkatan')->toArray();

        // Daftar jurusan (bisa langsung diambil dari database atau hardcode)
        $this->availableMajors = User::select('jurusan')->distinct()->orderBy('jurusan')->pluck('jurusan')->toArray();
    }

    public function render()
    {
        // Query untuk pencarian dan filter
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->angkatan, function ($query) {
                $query->where('angkatan', $this->angkatan);
            })
            ->when($this->jurusan, function ($query) {
                $query->where('jurusan', $this->jurusan);
            })
            ->orderBy('angkatan', 'desc')
            ->paginate(10);

        return view('livewire.alumni.front', [
            'users' => $users,
        ]);
    }
}
