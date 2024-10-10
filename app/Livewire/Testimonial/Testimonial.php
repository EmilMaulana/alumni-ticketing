<?php

namespace App\Livewire\Testimonial;

use App\Models\Testimonial as ModelsTestimonial;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Testimonial extends Component
{
    public $body;
    public $testimonials;

    public function mount()
    {
        $this->loadTestimonials(); // Load testimonials saat komponen dimuat
    }

    public function loadTestimonials()
    {
        // Mengambil testimonial berdasarkan user yang sedang login
        $this->testimonials = ModelsTestimonial::where('user_id', Auth::id())->latest()->get();
    }

    public function render()
    {
        return view('livewire.testimonial.testimonial');
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
