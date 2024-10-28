<?php

namespace App\Livewire\Product;

use App\Models\CustomProduct;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Custom extends Component
{
    public $deskripsi;
    public $nomorWa;

    protected $rules = [
        'deskripsi' => 'required|string|max:1000',
        'nomorWa' => 'required|string|regex:/^\+?[\d]{8,15}$/|max:15',
    ];

    public function submit()
    {
        // Validasi input
        $this->validate();

        // Pastikan nomor WhatsApp diawali dengan '62'
        $nomorWa = ltrim($this->nomorWa, '0'); // Hapus 0 di depan jika ada
        if (!str_starts_with($nomorWa, '62')) {
            $nomorWa = '62' . $nomorWa;
        }

        // Simpan data ke database
        CustomProduct::create([
            'user_id' => Auth::id(), // Mengambil ID pengguna yang sedang login
            'deskripsi' => $this->deskripsi,
            'nomor_wa' => $nomorWa,
        ]);

        // Reset form setelah submit
        $this->reset(['deskripsi', 'nomorWa']);

        session()->flash('success', 'Data custom produk berhasil disimpan. Staf kami akan segera menghubungimu untuk informasi lebih lanjut!');
    }

    public function render()
    {
        return view('livewire.product.custom');
    }
}
