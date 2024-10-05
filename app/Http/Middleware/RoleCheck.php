<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Cek apakah user terautentikasi
         if (!Auth::check()) {
            return abort(403, 'Unauthorized access.'); // Jika tidak terautentikasi
        }

        // Ambil user yang terautentikasi
        $user = Auth::user();

        // Cek apakah user memiliki role admin
        if (!$user->role || $user->role->name !== 'admin') {
            return abort(403, 'Unauthorized access.'); // Jika role tidak sesuai
        }

        return $next($request); // Jika semua pengecekan lolos, lanjutkan permintaan
    }
}
