<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Transaction;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;
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
                    $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('wa', 'like', '%' . $this->search . '%');
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

        return view('livewire.user.user-list', [
            'users' => $users,
        ]);
    }


    // public function updateStatus($postId, $status)
    // {
    //     $post = Post::find($postId);
    //     if ($post) {
    //         $post->status = $status;
    //         $post->save();
    //     }
    // }

}
