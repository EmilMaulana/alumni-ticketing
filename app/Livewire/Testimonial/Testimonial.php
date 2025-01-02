<?php

namespace App\Livewire\Testimonial;

use App\Models\Testimonial as ModelsTestimonial;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class Testimonial extends Component
{
    public $body;
    public $testimonials;
    public $transaction;

    public function mount()
    {
        $this->loadTestimonials(); // Load testimonials saat komponen dimuat
        // Ambil transaksi berdasarkan ID yang diberikan
    }

    public function loadTestimonials()
    {
        // Mengambil testimonial berdasarkan user yang sedang login
        $this->testimonials = ModelsTestimonial::where('user_id', Auth::id())->latest()->get();
    }

    public function render()
    {
        // Ambil semua transaksi pengguna
        $transactions = Transaction::where('user_id', Auth::id())->latest()->paginate(3);

        // Ambil transaksi terbaru dengan status 'is_checked'
        $checkedTransaction = Transaction::where('user_id', Auth::id())
            ->whereHas('check', function ($query) {
                $query->where('is_checked', true);
            })
            ->latest()
            ->first();

        return view('livewire.testimonial.testimonial', [
            'transactions' => $transactions,
            'checkedTransaction' => $checkedTransaction,
        ]);
    }

    public function store()
    {
        // Validasi input untuk memastikan body tidak kosong
        $validatedData = $this->validate([
            'body' => 'required|string|min:10|max:200', // Mengatur panjang dan tipe body
        ], [
            'body.required' => 'The testimonial body is required.',
            'body.min' => 'The testimonial must be at least 10 characters long.',
            'body.max' => 'The testimonial cannot be more than 200 characters.',
        ]);

        ModelsTestimonial::create([
            'body' => $validatedData['body'],
            'user_id' => Auth::id()
        ]);

        session()->flash('success', 'Your testimonial has been added successfully.');
        $this->resetInputFields();
        $this->loadTestimonials(); 
    }

    private function resetInputFields()
    {
        $this->body = '';
    }

    public function delete($id)
    {
        $testimonial = ModelsTestimonial::find($id);
        if ($testimonial) {
            $testimonial->delete();
            session()->flash('success', 'Testimonial has been deleted successfully.');
            $this->loadTestimonials(); // Reload testimonials setelah dihapus
        }
    }

}
