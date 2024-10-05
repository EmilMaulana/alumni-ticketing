<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Definisikan metode filter
    public function scopeFilter($query, array $filters)
    {
        // Menangani pencarian berdasarkan keyword
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . $filters['search'] . '%');
        }

        // Menangani filter berdasarkan kategori
        if ($filters['category'] ?? false) {
            $query->whereHas('category', function($query) use ($filters) {
                $query->where('slug', $filters['category']);
            });
        }

        // Menangani filter berdasarkan pengguna
        if ($filters['user'] ?? false) {
            $query->whereHas('user', function($query) use ($filters) {
                $query->where('name', $filters['user']);
            });
        }

        return $query; // Kembalikan query yang telah difilter
    }
}
