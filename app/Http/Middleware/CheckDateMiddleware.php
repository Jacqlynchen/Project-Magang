<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDateMiddleware
{
    /**
     * Mengecek apakah halaman boleh diakses berdasarkan hari.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // mengambil hari saat ini
        $today = now()->dayOfWeek;

        // 0 = Minggu, 6 = Sabtu
        if ($today === 0 || $today === 6) {
            abort(403, 'Halaman ini hanya bisa diakses pada hari kerja.');
        }

        return $next($request);
    }
}
